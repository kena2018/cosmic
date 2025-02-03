<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaminationProductionOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lamination_production_orders', function (Blueprint $table) {
            $table->id();
            $table->string('production_order_id')->nullable();
            $table->string('customer_order_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('product_id')->nullable(); 
            // $table->string('orders_total_bundle_qty')->nullable(); 
            // $table->string('orders_total_pending_bundle_qty')->nullable(); 
            // $table->string('production_order_required_bundle_qty')->nullable(); 
            $table->string('machine')->nullable();
            $table->string('date')->nullable(); 
            $table->string('meter')->nullable();
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
        Schema::dropIfExists('lamination_production_orders');
    }
}
