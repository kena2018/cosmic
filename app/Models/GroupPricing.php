<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPricing extends Model
{
    use HasFactory;

    protected $table = 'group_pricings'; 

    protected $fillable = [
        'name',
        'group_id',
        'start_date',
        'effective_upto',
    ];
}
