<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'recipe_master_id',
        'material_id',
        'submaterial_id',
        'up',
        'downs',
        'percentage'
    ];

    public function recipeMaster()
    {
        return $this->belongsTo(RecipeMaster::class, 'recipe_master_id');
    }

}
