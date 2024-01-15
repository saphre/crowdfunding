<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserDonation extends Pivot
{
    use HasFactory;

    protected  $table = "users_donations";
    protected $fillable = [
        'id',
        'user_id',
        'donation_id',
        'is_initiator',
        'amount_contributed',
        'created_at',
        'updated_at'
    ];
}
