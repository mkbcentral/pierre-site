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
}
