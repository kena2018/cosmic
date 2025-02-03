<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtruderOrderHistory extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'extruder_order_history';

    // Define the fields that are mass assignable
    protected $fillable = [
        'extruder_production_order_id',
        'machine',
        'shift',
        'qty',
        'this_orders_completed_quantity',
        'size',
        'date',
    ];

    // Define relationships if needed
    public function extruderProductionOrder()
    {
        return $this->belongsTo(ExtruderProductionOrder::class, 'extruder_production_order_id');
    }
}
