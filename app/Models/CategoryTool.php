<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryTool extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Get all of the tools for the CategoryTool
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tools(): HasMany
    {
        return $this->hasMany(Tool::class);
    }
}
