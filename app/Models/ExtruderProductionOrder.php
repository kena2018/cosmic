<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtruderProductionOrder extends Model
{
    use HasFactory;

    protected $table = 'extruder_production_orders';

    protected $fillable = [
        'lamination_id',
        'production_order_id',
        'customer_order_id',
        'customer_id',
        'product_id',
        'orders_total_bundle_qty',
        'orders_total_pending_bundle_qty',
        'production_order_required_bundle_qty',
        'machine',
        'date',
        'shift',
        'qty',
        'size',
        'status'
    ];
}
