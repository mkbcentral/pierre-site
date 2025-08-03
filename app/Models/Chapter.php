<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    /** @use HasFactory<\Database\Factories\ChapterFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'video_url',
        'training_id',
    ];
    /**
     * Get the training that owns the chapter.
     */
    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }
}
