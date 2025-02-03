<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStitchingOrderHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stitching_order_histories', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('stitching_production_order_id')->constrained('stitching_production_orders')->onDelete('cascade'); // Foreign key
            $table->string('labour_name', 191)->nullable(); // Labour name
            $table->string('date',191)->nullable(); // Date
            $table->integer('bdl_qty')->nullable(); // Bundle quantity
            $table->integer('qty_per_bdl')->nullable(); // Quantity per bundle
            $table->string('remark', 191)->nullable(); // Remarks
            $table->integer('this_orders_completed_quantity')->default(0)->nullable(); // Completed quantity
            $table->timestamps(); // Created at and Updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stitching_order_histories');
    }
}
