<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'role' => $this->role,
            'status' => $this->status,
            'created_at' => optional($this->created_at)->format('d/m/Y'),
            'updated_at' => optional($this->updated_at)->format('d/m/Y'),
            'orders' => Order::collection($this->whenLoaded('orders')),
        ];
    }
}
