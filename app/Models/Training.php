<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    /** @use HasFactory<\Database\Factories\TrainingFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'author',
        'price',
        'level',
        'status',
        'category_training_id',
    ];

    /**
     * Get the category that owns the training.
     */
    public function categoryTraining()
    {
        return $this->belongsTo(CategoryTraining::class, 'category_training_id');
    }

    /**
     * Get the chapters for the training.
     */
    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'training_id');
    }

    /**
     * Get the orders for the training.
     */
    public function orders()
    {
        return $this->hasMany(OrderTraining::class);
    }

    /**
     * Get the subscriptions for the training.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Scope a query to only include published trainings.
     */
    public function scopePublished($query)
    {
        return $query->where('status', \App\Enums\TrainingStatusType::PUBLISHED);
    }

    /**
     * Scope a query to filter by level.
     */
    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_training_id', $categoryId);
    }

    /**
     * Scope a query to search by title or description.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        });
    }
}
