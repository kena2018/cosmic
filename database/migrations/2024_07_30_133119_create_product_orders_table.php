<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('product_orders')){
            Schema::table('product_orders', function ($table) {
            });
        }else{
            Schema::create('product_orders', function (Blueprint $table) {
                $table->id();
                $table->string('customer_orders_id');
                $table->string('product_id')->nullable();
                $table->string('colour')->nullable();
                $table->string('packing')->nullable();
                $table->string('unit_box')->nullable();
                $table->string('qty')->nullable();
                $table->string('rate')->nullable();
                $table->string('sub_total')->nullable();
                $table->string('total')->nullable();
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
        Schema::dropIfExists('product_orders');
    }
}
