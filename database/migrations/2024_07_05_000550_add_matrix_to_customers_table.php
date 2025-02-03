<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMatrixToCustomersTable extends Migration
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
                $table->string('matrix')->nullable(); // Adjust the data type as needed
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
            $table->dropColumn('matrix');
        });
    }
}
