<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeMaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'recipe_name',
        'status',
        'top_layer',
        'middle_layer'
    ];

    public function recipeMaterials()
    {
        return $this->hasMany(RecipeMaterial::class, 'recipe_master_id');
    }
}
