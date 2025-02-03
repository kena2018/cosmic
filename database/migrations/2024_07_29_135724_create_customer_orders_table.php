<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('customer_orders')){
            Schema::table('customer_orders', function ($table) {
            });
        }else{
            Schema::create('customer_orders', function (Blueprint $table) {
                $table->id();
                $table->string('customer_id');
                $table->string('contact')->nullable();
                $table->string('price_list')->nullable();
                $table->string('shipping_address')->nullable();
                $table->string('packing_name')->nullable();
                $table->string('order_id')->nullable();
                $table->string('city_id')->nullable();
                $table->string('state_id')->nullable();
                $table->string('country_id')->nullable();
                $table->string('customer_notes')->nullable();
                $table->string('amount')->nullable();
                $table->string('total_bundle')->nullable();
                $table->date('order_date')->nullable();
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
        Schema::dropIfExists('customer_orders');
    }
}
