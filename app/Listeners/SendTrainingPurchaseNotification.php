<?php

namespace App\Listeners;

use App\Events\TrainingPurchased;
use App\Mail\TrainingPurchaseConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendTrainingPurchaseNotification
{
    /**
     * Handle the event.
     */
    public function handle(TrainingPurchased $event): void
    {
        try {
            // Send confirmation email to user
            Mail::to($event->order->user->email)
                ->send(new TrainingPurchaseConfirmation($event->order));

            Log::info('Training purchase notification sent', [
                'user_id' => $event->order->user_id,
                'training_id' => $event->order->training_id,
                'order_id' => $event->order->id
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send training purchase notification', [
                'user_id' => $event->order->user_id,
                'training_id' => $event->order->training_id,
                'order_id' => $event->order->id,
                'error' => $e->getMessage()
            ]);
        }
    }
}
