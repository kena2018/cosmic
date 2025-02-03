<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StitchingOrderHistory extends Model
{
    use HasFactory;

    protected $table = 'stitching_order_histories';

    protected $fillable = [
        'stitching_production_order_id',
        'labour_name',
        'date',
        'bdl_qty',
        'qty_per_bdl',
        'remark',
        'this_orders_completed_quantity',
    ];

    public function stitchigProductionOrder()
    {
        return $this->belongsTo(stitchigProductionOrder::class, 'stitching_production_order_id');
    }
}
