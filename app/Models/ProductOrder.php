<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_orders_id',
        'sku',
        'product_id',
        'colour',
        'packing',
        'unit_box',
        'qty',
        'rate',
        'sub_total',
        'total',
        'packing_material_type',
        'bdl_kg',
        'bharti',
        'roll_counte',
        'remark',
        'sticker_name'
                
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
