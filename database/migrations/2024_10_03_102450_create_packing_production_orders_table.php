<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackingProductionOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packing_production_orders', function (Blueprint $table) {
            $table->id();
            $table->string('stitching_id')->nullable();
            $table->string('production_order_id')->nullable();
            $table->string('customer_order_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('labour_name')->nullable();
            $table->string('date')->nullable();
            $table->string('bags_per_box_qty')->nullable();
            $table->string('steping_required')->nullable();
            $table->string('status')->nullable(); 
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
        Schema::dropIfExists('packing_production_orders');
    }
}
