<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Requests\SubscriptionRequest;
use App\Models\OrderTraining;
use App\Models\Training;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

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
     * @param SubscriptionRequest $request
     * @param Training $training
     * @param PaymentService $paymentService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SubscriptionRequest $request, Training $training, PaymentService $paymentService)
    {
        try {
            // Check if user already has an active order for this training
            $existingOrder = OrderTraining::where('user_id', Auth::id())
                ->where('training_id', $training->id)
                ->where('status', OrderStatus::PENDING)
                ->first();

            if ($existingOrder) {
                return redirect()->route('page.training.create.subscription', $training)
                    ->withErrors(['error' => 'Vous avez déjà une commande en cours pour cette formation.']);
            }

            DB::beginTransaction();

            // Create the order
            $order = $paymentService->createOrder($training, Auth::id());

            // Initialize payment
            $successUrl = route('page.order.verify', ['orderId' => $order->payment_reference]);
            $failureUrl = route('page.training.create.subscription', $training);

            $paymentData = $paymentService->initializePayment($order, $training, $successUrl, $failureUrl);

            DB::commit();

            if (isset($paymentData['link'])) {
                return redirect()->away($paymentData['link']);
            }

            throw new Exception('Payment link not received from gateway');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Subscription creation failed', [
                'user_id' => Auth::id(),
                'training_id' => $training->id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('page.training.create.subscription', $training)
                ->withErrors(['error' => 'Une erreur est survenue lors de la création de votre commande. Veuillez réessayer.']);
        }
    }


    /**
     * Verify payment and update order status.
     *
     * @param string $orderId
     * @param PaymentService $paymentService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyPayment(string $orderId, PaymentService $paymentService)
    {
        try {
            $order = OrderTraining::where('payment_reference', $orderId)->first();

            if (!$order) {
                Log::warning('Order not found for verification', ['order_id' => $orderId]);
                return redirect()->route('home')->withErrors(['error' => 'Commande non trouvée.']);
            }

            // Verify payment with gateway
            $paymentData = $paymentService->verifyPayment($orderId);

            if ($paymentService->updateOrderStatus($order, $paymentData)) {
                // Payment successful - redirect to success page or training dashboard
                return redirect()->route('user.dashboard')
                    ->with('success', 'Paiement vérifié avec succès. Vous avez maintenant accès à la formation.');
            }

            // Payment failed
            return redirect()->route('page.training.create.subscription', $order->training)
                ->withErrors(['error' => 'La vérification du paiement a échoué. Veuillez contacter le support.']);
        } catch (Exception $e) {
            Log::error('Payment verification failed', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('home')
                ->withErrors(['error' => 'Une erreur est survenue lors de la vérification du paiement.']);
        }
    }

    /**
     * Show user's orders.
     *
     * @return \Illuminate\View\View
     */
    public function orders()
    {
        $orders = OrderTraining::with('training')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.user-orders', compact('orders'));
    }
}
