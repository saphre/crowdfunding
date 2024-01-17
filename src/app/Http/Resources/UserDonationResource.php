<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDonationResource extends JsonResource
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
                'user_id' => $this->user_id,
                'donation_id' => $this->donation_id,
                'is_initiator' =>  $this->is_initiator,
                'amount_contributed' => $this->amount_contributed,
                'created_at' => $this->created_at,
            ],
            'relationships' => [
                'donations' => $this->donations,
                'users' => $this->users
            ]
        ];
    }
}
