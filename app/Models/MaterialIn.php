<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialIn extends Model
{
    use HasFactory;
    protected $table = 'material_in';

    protected $fillable = [
        'user_id',
        'date',
        'machine',
        'material_category_type',
        'material_sub_category',
        'material_name',
        'unit1',
        'unit1_value',
        'unit2',
        'unit2_value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(MaterialCategory::class, 'material_category_type');
    }

    public function materialSubCategory()
    {
        return $this->belongsTo(MaterialSubCategory::class, 'material_sub_category', 'id');
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_name', 'id');
    }
}
