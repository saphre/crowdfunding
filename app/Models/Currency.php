<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'code',
        'symbol',
        'is_active', 
        'created_at',
        'updated_at'
    ];

     /**
     * hasMany Relations
     */
      /**
     * Get the various donations of a given currency.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
