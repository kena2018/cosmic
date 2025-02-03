<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
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
            Schema::create('customers', function (Blueprint $table) {
                $table->id();
                // Add the user_id column as an unsigned big integer
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email');
                $table->string('contect');
                $table->string('company_name');
                $table->string('group');
                $table->string('gstin');
                $table->string('payment_terms');
                $table->string('address1')->nullable();
                $table->string('address2')->nullable();
                $table->string('country');
                $table->string('state');
                $table->integer('pin');
                $table->string('city');
                // Add foreign key constraint
                $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('cascade'); // If user is deleted, delete corresponding customers
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
        Schema::dropIfExists('customers');

    }
}
