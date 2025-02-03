<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_in', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('machine')->nullable();
            $table->string('material_category_type')->nullable();
            $table->string('material_sub_category')->nullable(); 
            $table->string('material_name')->nullable();
            $table->string('unit1')->nullable();
            $table->string('unit2')->nullable(); 
            $table->integer('quantity')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_in');
    }
}

