<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;

    protected $fillable = ['list_name', 'discount'];

    public function items()
    {
        return $this->hasMany(PriceListItem::class);
    }
    public function priceListItems()
    {
        return $this->hasMany(PriceListItem::class, 'price_list_id', 'id');
    }
    public function orders()
    {
        return $this->hasMany(CustomerOrder::class, 'price_list');
    }
}
