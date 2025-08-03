<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'training_id',
        'status',
        'payment_reference',
        'payment_method',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
