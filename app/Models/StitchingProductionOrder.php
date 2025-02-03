<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StitchingProductionOrder extends Model
{
    use HasFactory;

    protected $table = 'stitching_production_orders';

    protected $fillable = [
        'production_order_id',
        'packing_id',
        'customer_order_id',
        'customer_id',
        'product_id',
        'labour_name',
        'date',
        'bundle_qty',
        'qty_per_bdl',
        'remark',
        'status'
    ];
}
