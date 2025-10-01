<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    protected $fillable = [
        'name',
        'description',
        'amount',
        'transaction_amount',
        'currency',
        'source',
        'status',
        'user_id',
        'training_id',
    ];

    /**
     * Get the user that owns the subscription.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the training that owns the subscription.
     */
    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }
}
