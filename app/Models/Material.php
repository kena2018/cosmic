<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materials';

    protected $fillable = [
        'material_name',
        'material_width',
        'category_id',
        'sub_category',
        'quantity',
        'unit',
        'remark',
        'material_weight',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(MaterialCategory::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(MaterialSubCategory::class, 'sub_category');
    }

    public function stock()
    {
        return $this->hasOne(Stock::class, 'material_name', 'id');
    }

}
