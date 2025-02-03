<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldUpdateToProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_orders', function (Blueprint $table) {
            $table->string('packing_material_type')->nullable()->after('colour');
            $table->string('bdl_kg')->nullable()->after('colour');
            $table->string('bharti')->nullable()->after('colour');
            $table->string('roll_counte')->nullable()->after('colour');
            $table->string('remark')->nullable()->after('colour');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_orders', function (Blueprint $table) {
            $table->dropColumn('packing_material_type');
            $table->dropColumn('bdl_kg');
            $table->dropColumn('bharti');
            $table->dropColumn('roll_counte');
            $table->dropColumn('remark');
        });
    }
}
