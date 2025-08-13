<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\OrderTraining;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{

    /**
     * Display the training subscription page.
     *
     * @param Training $training
     * @return \Illuminate\View\View
     */
    public function create(Training $training)
    {
        return view('pages.training-subscription-page', compact('training'));
    }
    /**
     * Store a new training subscription.
     *
     * @param Training $training
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Training $training)
    {

        $convertedPrice = $training->price * 2850; // Assuming price is in USD and needs conversion
        $order = OrderTraining::create([
            'training_id' => $training->id,
            'user_id' => Auth::id(),
            'status' => OrderStatus::PENDING,
            'amount' => $convertedPrice,
            'payment_method' => 'lygos',
            'payment_reference' => uniqid(),
        ]);
        $amount = intval($convertedPrice);
        $shop_name = config('app.name');
        $order_id = $order->payment_reference;
        $message = "Order for training: {$training->title} - Amount: {$amount} CDF";
        $success_url = route('page.order.verify', ['orderId' => $order_id]);
        $failure_url = route('page.training.create.subscription', $training);


        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => env('LYGOS_API_URL') . 'gateway',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount' => $amount,
                'shop_name' => $shop_name,
                'message' => $message,
                'success_url' => $success_url,
                'failure_url' => $failure_url,
                'order_id' => $order_id
            ]),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "api-key: " . env('LYGOS_API_KEY')
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            Log::error('cURL Error: ' . $err);
            return redirect()->route('page.training.create.subscription', $training)->withErrors(['error' => "cURL Error #:" . $err]);
        } else {
            $responseData = json_decode($response, true);
            Log::info('cURL Response: ' . $response);
            return redirect()->away($responseData['link']);
        }
    }


    public function verifyPayment(Training $training, string $order_id)
    {
        // Logic to verify payment using the order_id
        $order = OrderTraining::where('payment_reference', $order_id)->first();
        if (!$order) {
            return redirect()->route('page.training.create.subscription', $training)->withErrors(['error' => 'Order not found.']);
        }
        // This could involve checking the payment status from the payment gateway
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => env('LYGOS_API_URL') . "gateway/payin/{$order_id}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "api-key: " . env('LYGOS_API_KEY')
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            Log::error('cURL Error: ' . $err);
            return redirect()->route('page.training.create.subscription', $training)->withErrors(['error' => "cURL Error #:" . $err]);
        } else {
            Log::info('cURL Response: ' . $response);
            $responseData = json_decode($response, true);
            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                // Update the order status to completed
                $order->status = OrderStatus::COMPLETED;
                $order->save();
                return redirect()->route('page.training.create.subscription', $training)->with('success', 'Payment verified successfully.');
            } else {
                return redirect()->route('page.training.create.subscription', $training)->withErrors(['error' => 'Payment verification failed.']);
            }
        }
    }
}
