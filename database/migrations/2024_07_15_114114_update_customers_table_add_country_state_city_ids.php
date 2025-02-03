<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCustomersTableAddCountryStateCityIds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if(Schema::hasTable('customers')){
            Schema::table('customers', function ($table) {
            });
        }else{
            Schema::table('customers', function (Blueprint $table) {
                $table->unsignedBigInteger('country_id')->nullable()->after('user_id');
                $table->unsignedBigInteger('state_id')->nullable()->after('user_id');
                $table->unsignedBigInteger('city_id')->nullable()->after('user_id');
                $table->dropColumn(['country', 'state', 'city']);
                $table->foreign('country_id')->references('id')->on('countries')
                        ->onDelete('cascade');
                $table->foreign('state_id')->references('id')->on('states')
                        ->onDelete('cascade');
                $table->foreign('city_id')->references('id')->on('cities')
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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('country')->after('country_id');
            $table->string('state')->after('state_id');
            $table->string('city')->after('city_id');
            $table->dropColumn(['country_id', 'state_id', 'city_id']);
        });
    }
}
