<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_out', function (Blueprint $table) {
            $table->id();
            $table->string('step_name')->nullable();
            $table->string('step_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('production_order_id')->nullable();
            $table->string('customer_id')->nullable();
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
        Schema::dropIfExists('material_out');
    }
}

