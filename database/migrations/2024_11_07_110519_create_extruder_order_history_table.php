<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtruderOrderHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extruder_order_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('extruder_production_order_id')->nullable();
            $table->string('machine')->nullable();
            $table->string('shift')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('this_orders_completed_quantity')->nullable();
            $table->string('size')->nullable();
            $table->timestamps();

            $table->foreign('extruder_production_order_id')
                  ->references('id')
                  ->on('extruder_production_orders')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extruder_order_history');
    }
}
