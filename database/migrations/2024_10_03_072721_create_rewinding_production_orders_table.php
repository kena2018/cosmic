<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewindingProductionOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewinding_production_orders', function (Blueprint $table) {
            $table->id();
            $table->string('extruder_id')->nullable();
            $table->string('production_order_id')->nullable();
            $table->string('customer_order_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('contractor')->nullable();
            $table->string('date')->nullable(); 
            $table->string('rolls')->nullable();
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
        Schema::dropIfExists('rewinding_production_orders');
    }
}
