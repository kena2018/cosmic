<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('products')){
            Schema::table('products', function ($table) {
            });
        }else{
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('product_name');
                $table->string('group_name');
                $table->string('alias_sku');
                $table->string('category');
                $table->decimal('width', 8, 2);
                $table->decimal('length', 8, 2);
                $table->integer('gage');
                $table->string('image')->nullable();
                $table->string('master_packing');
                $table->integer('bharti');
                $table->integer('number_of_bags_per_box');
                $table->decimal('pipe_size', 8, 2);
                $table->integer('rolls_in_1_bdl');
                $table->decimal('roll_weight', 8, 2);
                $table->decimal('bdl_kg', 8, 2);
                $table->integer('packing_material_qty');
                $table->string('outer_name');
                $table->string('carton_no');
                $table->integer('number_of_outer');
                $table->string('packing_material_type');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
