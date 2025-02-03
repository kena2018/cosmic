<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceListsTable extends Migration
{
    public function up()
    {
        Schema::create('price_lists', function (Blueprint $table) {
            $table->id();
            $table->string('list_name');
            $table->string('discount');
            $table->timestamps();
        });

        Schema::create('price_list_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_list_id')->constrained('price_lists')->onDelete('cascade');
            $table->string('product_id');
            $table->string('min_qty');
            $table->string('rate');
            $table->decimal('discount_rate', 10, 2);
            $table->decimal('special_rate', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('price_list_items');
        Schema::dropIfExists('price_lists');
    }
}
