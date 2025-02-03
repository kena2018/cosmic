<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceListItem extends Model
{
    use HasFactory;

    protected $fillable = ['price_list_id', 'product_id', 'min_qty', 'rate', 'discount_rate', 'special_rate'];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function priceList()
    {
        return $this->belongsTo(priceList::class, 'price_list_id');
    }
}