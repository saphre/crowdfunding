<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DonationCollection extends ResourceCollection
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
                'category_id' => $this->category_id,
                'currency_id' => $this->currency_id,
                'title' =>  $this->title,
                'description' => $this->description,
                'donation_img' => $this->donation_img,
                'additional_ressources' => $this->additional_ressources,
                'type' => $this->type,
                'target_amount' => $this->target_amount,
                'contributed_amount' => $this->contributed_amount,
                'is_complete' => $this->is_complete,
                'created_at' => $this->created_at,
            ],
            'relationships' => [
                'category' => $this->category,
                'currency' => $this->currency,
                'users' => $this->users
            ]
        ];
    }
}
