<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('states')){
            Schema::table('states', function ($table) {
            });
        }else{
            Schema::create('states', function (Blueprint $table) {
                $table->id();
                    $table->unsignedBigInteger('country_id')->nullable();
                $table->string('name');
                $table->timestamps();
                $table->foreign('country_id')->references('id')->on('countries')
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
        Schema::dropIfExists('states');
    }
}
