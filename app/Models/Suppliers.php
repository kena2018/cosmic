<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suppliers extends Model
{
    use HasFactory;
    use SoftDeletes; // For soft deletes

    protected $table = 'suppliers'; // Your database table name

    protected $fillable = [
        'name',
        'email',
        'contect',
        'gst_number',
        'gst_type',
        'company_name',
        'email_cmp',
        'contect_cmp',
        'address1',
        'address2',
        'pincode',
        'city',
        'state',
        'country',
        'material',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function material()
    {
        return $this->belongsTo(Material::class, 'material', 'id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
