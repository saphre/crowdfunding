<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'category_id',
        'currency_id',
        'title',
        'description',
        'donation_img',
        'additional_ressources',
        'type',
        'target_amount', 
        'contributed_amount',
        'is_complete',
        'created_at',
        'updated_at'

    ];

    /**
    * The donation types 
    * @return array
    */
    static function donationTypes()
    {
        return [
            "self","others"
        ];
    }

    /**
     * belongsTo Relations
     */

    /**
     * Get the category to which the donation belongs.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

      /**
     * Get the currency to which the donation belongs.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }


     /**
     * belongsToMany Relations
     */
      /**
     * The donations that were made by the users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class,'users_donations', 'donation_id', 'user_id')
        ->using(UserDonation::class);
    }

  
}
