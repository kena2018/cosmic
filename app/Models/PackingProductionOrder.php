<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingProductionOrder extends Model
{
    use HasFactory;

    protected $table = 'packing_production_orders';

    protected $fillable = [
        'production_order_id',
        'rewinding_id',
        'customer_order_id',
        'customer_id',
        'product_id',
        'labour_name',
        'date',
        'bags_per_box_qty',
        'steping_required',
        'status'
    ];
}
