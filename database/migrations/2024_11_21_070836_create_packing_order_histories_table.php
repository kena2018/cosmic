<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackingOrderHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packing_order_histories', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('packing_production_order_id')->constrained('packing_production_orders')->onDelete('cascade'); // Foreign key
            $table->string('labour_name', 191)->nullable();
            $table->string('date',191)->nullable();
            $table->string('bags_per_box_qty', 191)->nullable();
            $table->string('steping_required', 191)->nullable();
            $table->string('remark', 191)->nullable();
            $table->integer('this_orders_completed_quantity')->default(0);
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
        Schema::dropIfExists('packing_order_histories');
    }
}

