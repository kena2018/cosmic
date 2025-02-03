<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaminationName extends Model
{
    use HasFactory;
    protected $table = 'lamination_names';

    protected $fillable = ['paper_name', 'lamination_name','gum_name','lamination_type'];
}
