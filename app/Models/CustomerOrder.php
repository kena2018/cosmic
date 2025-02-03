<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'serial_number',
        'contact',
        'price_list',
        'shipping_address',
        'packing_name',
        'order_id',
        'product_id',
        'sku',
        'colour',
        'packing',
        'unit_box',
        'qty',
        'rate',
        'city_id',
        'state_id',
        'country_id',
        'sub_total',
        'total',
        'customer_notes',
        'amount',
        'total_bundle',
        'order_date',
        'order_type',
        'dispatched',
        'status',
        'delivery_date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productOrders()
    {
        return $this->hasMany(ProductOrder::class, 'customer_orders_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    // public function transport()
    // {
    //     return $this->belongsTo(Transform::class,'packing_name', 'id');
    // }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
    public function products()
    {
        return $this->hasManyThrough(Product::class, ProductOrder::class, 'customer_orders_id', 'id', 'id', 'product_id');
    }

    public function laminationProductionOrders()
    {
        return $this->hasMany(LaminationProductionOrder::class, 'customer_order_id', 'id');
    }
    public function extruderProductionOrders()
    {
        return $this->hasMany(ExtruderProductionOrder::class, 'customer_order_id', 'id');
    }
    public function rewindingProductionOrders()
    {
        return $this->hasMany(RewindingProductionOrder::class, 'customer_order_id', 'id');
    }
    public function stitchingProductionOrders()
    {
        return $this->hasMany(StitchingProductionOrder::class, 'customer_order_id', 'id');
    }
    public function packingProductionOrders()
    {
        return $this->hasMany(PackingProductionOrder::class, 'customer_order_id', 'id');
    }

}

