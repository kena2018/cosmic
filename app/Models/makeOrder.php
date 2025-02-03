<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class makeOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'status',
        'sku',
        'colour',
        'packing',
        'qty_in_bundle',
        'bharti',
        'bag_box',
    ];
}
