<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'cover_image' => $this->cover_image ? asset('storage/' . $this->cover_image) : null,
            'author' => $this->author,
            'price' => $this->price,
            'level' => $this->level,
            'status' => $this->status,
            'category' => [
                'id' => $this->categoryTraining->id,
                'name' => $this->categoryTraining->name,
            ],
            'chapters_count' => $this->chapters_count ?? $this->chapters->count(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
