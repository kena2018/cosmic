<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaminationNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lamination_names', function (Blueprint $table) {
            $table->id();
            $table->string('paper_name')->nullable();
            $table->string('lamination_name')->nullable();
            $table->string('gum_name')->nullable();
            $table->string('lamination_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lamination_names');
    }
}
