<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
class CreateProductionOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
                Schema::create('production_order', function (Blueprint $table) {
                $table->id();
                $table->string('production_varient_name')->nullable();
                $table->string('product_type')->nullable();
                $table->string('order_type')->nullable();
                $table->string('company_name')->nullable();
                $table->string('sales_order')->nullable();
                $table->string('qty_required')->nullable();
                $table->integer('pending_bundle_qty')->nullable();
                $table->string('sku')->nullable();
                $table->string('extrusion_gauge')->nullable();
                $table->string('extrusion_colour')->nullable();
                $table->string('extrusion_size')->nullable();
                $table->string('extrusion_recipe')->nullable();
                $table->string('extrusion_qty_of_packing')->nullable();
                $table->string('extrusion_internal_notes')->nullable();
                $table->string('lamination_paper_name')->nullable();
                $table->string('lamination_name')->nullable();
                $table->string('lamination_gun_name')->nullable();
                $table->string('lamination_type')->nullable();
                $table->string('rewinding_pipe')->nullable();
                $table->string('rewinding_sticker')->nullable();
                $table->string('rewinding_qty_in_rolls')->nullable();
                $table->string('rewinding_colour')->nullable();
                $table->string('rewinding_width')->nullable();
                $table->string('rewinding_qty_in_bundle')->nullable();
                $table->string('rewinding_length')->nullable();
                $table->string('rewinding_internal_notes')->nullable();
                $table->string('start_date')->nullable();
                $table->text('internal_notes')->nullable();
                $table->string('packing_gauge')->nullable();
                $table->string('packing_colour')->nullable();
                $table->string('packing_width')->nullable();
                $table->string('packing_length')->nullable();
                $table->string('packing_bharti')->nullable();
                $table->string('packing_name')->nullable();
                $table->string('packing_sticker')->nullable();
                $table->string('packing_carton')->nullable();
                $table->string('packing_pipe')->nullable();
                $table->string('packing_outer_name')->nullable();
                $table->string('packing_qty_rolls')->nullable();
                $table->string('packing_qty_bundle')->nullable();
                $table->string('sticching_product_name')->nullable();
                $table->string('sticching_colour')->nullable();
                $table->string('sticching_packing_name')->nullable();
                $table->string('sticching_packing_type')->nullable();
                $table->string('sticching_qty_bundle')->nullable();
                $table->string('sticching_bharti')->nullable();
                $table->string('sticching_qty_rolls')->nullable();
                $table->string('sticching_bag')->nullable();
                $table->string('machine')->nullable();
                $table->date('date')->nullable();
                $table->string('shift')->nullable();
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
        Schema::dropIfExists('production_order');
    }
}