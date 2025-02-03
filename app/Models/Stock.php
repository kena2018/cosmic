<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stock';

    protected $fillable = [
        'material_name',
        'category_id',
        'sub_category',
        'unit1',
        'unit1_value',
    ];

    public function category()
    {
        return $this->belongsTo(MaterialCategory::class, 'category_id');
    }

    public function materialSubCategory()
    {
        return $this->belongsTo(MaterialSubCategory::class, 'sub_category', 'id');
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_name', 'id');
    }
}
