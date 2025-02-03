<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'contect',
        'alt_phone',
        'company_name',
        'group',
        'gstin',
        'payment_terms',
        'address1',
        'address2',
        'country_id',
        'state_id',
        'pin',
        'city_id',
        'status',
        'matrix',
        
    ];

    /**
     * Get the user that owns the customer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function productionOrders()
    {
        return $this->hasMany(ProductionOrder::class, 'company_name');
    }
    public function orders()
    {
        return $this->hasMany(CustomerOrder::class, 'customer_id');
    }
}
