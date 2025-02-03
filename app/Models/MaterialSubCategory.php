<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialSubCategory extends Model
{
    use HasFactory;
    protected $table = 'material_sub_category';

    protected $fillable = [
        'sub_cat_name	',
        'parent_category_id',
        'status',
    ];

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'sub_category', 'id');
    }
}
