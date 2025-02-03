<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'group_name',
        'alias_sku',
        'category',
        'width',
        'length',
        'gage',
        'gsm',
        'image',
        'master_packing',
        'bharti',
        'number_of_bags_per_box',
        'pipe_size',
        'rolls_in_1_bdl',
        'roll_weight',
        'sheet_weight',
        'roll_weight_to_sheet_weight',
        'bdl_kg',
        'gram_per_meter',
        'packing_material_qty',
        'outer_name',
        'carton_no',
        'number_of_outer',
        'packing_material_type',
        'packing_material_category',
        'packing_material_name',
        'rate',
        'min_quantity',
    ];
    public function productionOrders()
    {
        return $this->hasMany(ProductionOrder::class, 'product_type');
    }
    public function priceListItems()
    {
        return $this->hasMany(PriceListItem::class, 'product_id');
    }

    public function packingMaterial()
    {
        return $this->belongsTo(Material::class, 'packing_material_name', 'id');
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'packing_material_type');
    }
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_name');
    }
    public function pipeSizeMaterial()
    {
        return $this->belongsTo(Material::class, 'pipe_size');
    }
    
    public function outerNameMaterial()
    {
        return $this->belongsTo(Material::class, 'outer_name');
    }
    
    public function cartonMaterial()
    {
        return $this->belongsTo(Material::class, 'carton_no');
    }

}
