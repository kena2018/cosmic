<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if(Schema::hasTable('countries')){
            Schema::table('countries', function ($table) {
            });
        }else{
            Schema::create('countries', function (Blueprint $table) {
                $table->id();
                $table->string('sortname', 2)->unique();
                $table->string('name');
                $table->integer('phonecode')->nullable();
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
        Schema::dropIfExists('countries');
    }
}
