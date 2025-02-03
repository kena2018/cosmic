<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewindingProductionOrder extends Model
{
    use HasFactory;

    protected $table = 'rewinding_production_orders';

    protected $fillable = [
        'production_order_id',
        'extruder_id',
        'customer_order_id',
        'customer_id',
        'product_id',
        'contractor',
        'date',
        'rolls',
        'remark',
        'status'
    ];
}
