<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewindingOrderHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewinding_order_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rewinding_production_order_id')->nullable();
            $table->string('contractor')->nullable();
            $table->string('date')->nullable();
            $table->integer('rolls')->nullable();
            $table->text('remark')->nullable();
            $table->integer('this_orders_completed_quantity')->nullable();
            $table->timestamps();

            $table->foreign('rewinding_production_order_id')
                ->references('id')
                ->on('rewinding_production_orders')
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
        Schema::dropIfExists('rewinding_order_history');
    }
}

