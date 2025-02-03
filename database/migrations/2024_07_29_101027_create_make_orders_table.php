<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMakeOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('make_orders')){
            Schema::table('make_orders', function ($table) {
            });
        }else{
            Schema::create('make_orders', function (Blueprint $table) {
                $table->id();
                $table->string('product_id');
                $table->string('status');
                $table->string('sku');
                $table->string('colour');
                $table->string('packing');
                $table->string('qty_in_bundle');
                $table->string('bharti');
                $table->string('bag_box');
                $table->softDeletes();
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
        Schema::dropIfExists('make_orders');
    }
}
