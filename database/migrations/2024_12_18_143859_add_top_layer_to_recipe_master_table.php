<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTopLayerToRecipeMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipe_masters', function (Blueprint $table) {
            $table->text('top_layer')->nullable()->default(0)->after('status');
            $table->text('middle_layer')->nullable()->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipe_masters', function (Blueprint $table) {
            $table->dropColumn('top_layer');
            $table->dropColumn('middle_layer');
        });
    }
}
