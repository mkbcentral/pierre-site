<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tool extends Model
{
    protected $fillable = [
        'name',
        'tool_link',
        'icon',
        'price',
        'category_tool_id'
    ];

    /**
     * Get the categoryTool that owns the Tool
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoryTool(): BelongsTo
    {
        return $this->belongsTo(CategoryTool::class, 'category_tool_id');
    }
}
