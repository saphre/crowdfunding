<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CurrencyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,
            'attributes' => [
                'name' => $this->name,
                'code' => $this->code,
                'symbol' => $this->symbol,
                'is_active' => $this->is_active,
                'created_at' => $this->created_at, 
            ],
            'relationships' => [
                'donations' => $this->donations
            ]
        ];
    }
}
