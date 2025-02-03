<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('suppliers')){
            Schema::table('suppliers', function ($table) {
            });
        }else{
            Schema::create('suppliers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('name');
                $table->string('email');
                $table->string('contect');
                $table->string('gst_number');
                $table->string('gst_type');
                $table->string('company_name');
                $table->string('contect_cmp');
                $table->string('email_cmp');
                $table->string('address1')->nullable();
                $table->string('address2')->nullable();
                $table->integer('pincode');
                $table->string('city');
                $table->string('state');
                $table->string('country');
                $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('cascade'); // If user is deleted, delete corresponding customers
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
        Schema::dropIfExists('suppliers');
    }
}
