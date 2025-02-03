<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaminationOrderHistory extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'lamination_order_history';

    // Define the fields that are mass assignable
    protected $fillable = [
        'lamination_production_order_id',
        'machine',
        'date',
        'meter',
        'this_orders_completed_quantity',
        'user_id',
    ];

    // Define relationships if needed
    public function laminationProductionOrder()
    {
        return $this->belongsTo(LaminationProductionOrder::class, 'lamination_production_order_id');
    }
}
