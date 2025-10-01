<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckTrainingAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $training = $request->route('training');

        if (!$training) {
            abort(404);
        }

        // Check if training is published
        if ($training->status !== \App\Enums\TrainingStatusType::PUBLISHED) {
            abort(403, 'Cette formation n\'est pas disponible.');
        }

        // Check if user has access (has completed order)
        if (Auth::check()) {
            $hasAccess = \App\Models\OrderTraining::where('user_id', Auth::id())
                ->where('training_id', $training->id)
                ->where('status', \App\Enums\OrderStatus::COMPLETED)
                ->exists();

            if (!$hasAccess && $request->route()->named('training.content.*')) {
                return redirect()->route('page.training.create.subscription', $training)
                    ->with('info', 'Vous devez vous inscrire à cette formation pour y accéder.');
            }
        }

        return $next($request);
    }
}
