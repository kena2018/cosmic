<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRemarkToProductionOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production_order', function (Blueprint $table) {
            $table->string('remark')->nullable()->after('qty_required');
            $table->string('lamination_internal_notes')->nullable()->after('lamination_type');
            $table->string('packing_internal_notes')->nullable()->after('packing_qty_bundle');
            $table->string('Stitching_internal_notes')->nullable()->after('sticching_bag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('production_order', function (Blueprint $table) {
            $table->dropColumn('remark');
            $table->dropColumn('lamination_internal_notes');
            $table->dropColumn('packing_internal_notes');
            $table->dropColumn('Stitching_internal_notes');
        });
    }
}
