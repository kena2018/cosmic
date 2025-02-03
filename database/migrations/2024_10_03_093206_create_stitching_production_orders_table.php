<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStitchingProductionOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stitching_production_orders', function (Blueprint $table) {
            $table->id();
            $table->string('rewinding_id')->nullable();
            $table->string('production_order_id')->nullable();
            $table->string('customer_order_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('labour_name')->nullable();
            $table->string('date')->nullable();
            $table->string('bundle_qty')->nullable();
            $table->string('qty_per_bdl')->nullable();
            $table->string('remark')->nullable(); 
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
        Schema::dropIfExists('stitching_production_orders');
    }
}
