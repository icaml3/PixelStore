<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'customer' => $this->customer,
            'email' => $this->email,
            'total_amount' => $this->total_amount,
            'payment_method' => $this->payment_method,
            'note' => $this->note,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'created_at' => optional($this->created_at)->format('d/m/Y'),
            'updated_at' => optional($this->updated_at)->format('d/m/Y'),
        ];
    }
}
