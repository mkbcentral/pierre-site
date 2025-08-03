<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTraining extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryTrainingFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
