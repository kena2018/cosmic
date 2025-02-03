<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewindingOrderHistory extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'rewinding_order_history';

    // Define the fields that are mass assignable
    protected $fillable = [
        'rewinding_production_order_id',
        'contractor',
        'date',
        'rolls',
        'remark',
        'this_orders_completed_quantity',
    ];

    // Define relationships if needed
    public function rewindingProductionOrder()
    {
        return $this->belongsTo(RewindingProductionOrder::class, 'rewinding_production_order_id');
    }
}
