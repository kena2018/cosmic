<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('cities')){
            Schema::table('cities', function ($table) {
            });
        }else{
            Schema::create('cities', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('state_id')->nullable();
                $table->string('name');
                $table->timestamps();
                $table->foreign('state_id')->references('id')->on('states')
                        ->onDelete('cascade');
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
        Schema::dropIfExists('cities');
    }
}
