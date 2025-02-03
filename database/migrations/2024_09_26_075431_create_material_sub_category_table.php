<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialSubCategoryTable extends Migration
{
    public function up()
    {
        Schema::create('material_sub_category', function (Blueprint $table) {
            $table->id();
            $table->string('parent_category_id');
            $table->string('sub_cat_name'); 
            $table->string('status')->default('active'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('material_sub_category');
    }
}

