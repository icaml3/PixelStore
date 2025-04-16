<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Games extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'sale' => $this->sale,
            'image' => $this->image,
            'video' => $this->video,
            'short_description' => $this->short_description,
            'detailed_description' => $this->detailed_description,
            'tags' => $this->tags,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'created_at' => optional($this->created_at)->format('d/m/Y'),
            'updated_at' => optional($this->updated_at)->format('d/m/Y'),
        ];
    }
}
