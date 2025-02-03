<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingOrderHistory extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'packing_order_histories';

    // Define the fields that are mass assignable
    protected $fillable = [
        'packing_production_order_id',
        'labour_name',
        'date',
        'bags_per_box_qty',
        'steping_required',
        'remark',
        'this_orders_completed_quantity',
    ];

    // Define relationships if needed
    public function packingProductionOrder()
    {
        return $this->belongsTo(PackingProductionOrder::class, 'packing_production_order_id');
    }
}
