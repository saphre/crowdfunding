<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at'
    ];


      /**
     * hasMany Relations
     */
      /**
     * Get the various donations of a given category.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
