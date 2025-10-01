<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\OrderTraining;
use App\Models\Training;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class PaymentService
{
    private string $apiUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->apiUrl = config('services.lygos.api_url');
        $this->apiKey = config('services.lygos.api_key');
    }

    /**
     * Create payment order
     *
     * @param Training $training
     * @param int $userId
     * @param float $conversionRate
     * @return OrderTraining
     * @throws Exception
     */
    public function createOrder(Training $training, int $userId, float $conversionRate = 2850): OrderTraining
    {
        $convertedPrice = $training->price * $conversionRate;

        return OrderTraining::create([
            'training_id' => $training->id,
            'user_id' => $userId,
            'status' => OrderStatus::PENDING,
            'amount' => $convertedPrice,
            'payment_method' => 'lygos',
            'payment_reference' => $this->generatePaymentReference(),
        ]);
    }

    /**
     * Initialize payment with Lygos gateway
     *
     * @param OrderTraining $order
     * @param Training $training
     * @param string $successUrl
     * @param string $failureUrl
     * @return array
     * @throws Exception
     */
    public function initializePayment(OrderTraining $order, Training $training, string $successUrl, string $failureUrl): array
    {
        $payload = [
            'amount' => intval($order->amount),
            'shop_name' => config('app.name'),
            'message' => "Order for training: {$training->title} - Amount: {$order->amount} CDF",
            'success_url' => $successUrl,
            'failure_url' => $failureUrl,
            'order_id' => $order->payment_reference
        ];

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'api-key' => $this->apiKey
            ])->post($this->apiUrl . 'gateway', $payload);

            if ($response->failed()) {
                Log::error('Lygos API Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                throw new Exception('Payment initialization failed');
            }

            return $response->json();
        } catch (Exception $e) {
            Log::error('Payment initialization error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Verify payment status
     *
     * @param string $paymentReference
     * @return array
     * @throws Exception
     */
    public function verifyPayment(string $paymentReference): array
    {
        try {
            $response = Http::withHeaders([
                'api-key' => $this->apiKey
            ])->get($this->apiUrl . "gateway/payin/{$paymentReference}");

            if ($response->failed()) {
                Log::error('Payment verification failed', [
                    'reference' => $paymentReference,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                throw new Exception('Payment verification failed');
            }

            return $response->json();
        } catch (Exception $e) {
            Log::error('Payment verification error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update order status based on payment verification
     *
     * @param OrderTraining $order
     * @param array $paymentData
     * @return bool
     */
    public function updateOrderStatus(OrderTraining $order, array $paymentData): bool
    {
        if (isset($paymentData['status']) && $paymentData['status'] === 'success') {
            $order->update(['status' => OrderStatus::COMPLETED]);

            // Trigger event for successful purchase
            \App\Events\TrainingPurchased::dispatch($order);

            Log::info('Order completed successfully', ['order_id' => $order->id]);
            return true;
        }

        Log::warning('Payment verification failed for order', [
            'order_id' => $order->id,
            'payment_data' => $paymentData
        ]);
        return false;
    }

    /**
     * Generate unique payment reference
     *
     * @return string
     */
    private function generatePaymentReference(): string
    {
        return 'TRN_' . uniqid() . '_' . time();
    }
}
