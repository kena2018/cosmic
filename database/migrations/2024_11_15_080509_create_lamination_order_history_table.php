<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaminationOrderHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lamination_order_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lamination_production_order_id')->nullable();
            $table->string('machine')->nullable();
            $table->string('date')->nullable();
            $table->integer('meter')->nullable();
            $table->integer('this_orders_completed_quantity')->nullable();
            $table->timestamps();

            $table->foreign('lamination_production_order_id')
                  ->references('id')
                  ->on('lamination_production_orders')
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
