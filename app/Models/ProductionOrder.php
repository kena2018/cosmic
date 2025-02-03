<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionOrder extends Model
{
    use HasFactory;

    protected $table = 'production_order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'production_varient_name',
        'product_type',
        'order_type',
        'company_name',
        'sales_order',
        'qty_required',
        'remark',
        'pending_bundle_qty',
        'bundle_quantity',
        'sku',
        'extrusion_gauge',
        'extrusion_internal_notes',
        'extrusion_colour',
        'extrusion_size',
        'extrusion_recipe',
        'extrusion_qty_of_packing',
        'rewinding_pipe',
        'rewinding_bharti',
        'rewinding_material_name',
        'rewinding_internal_notes',
        'rewinding_sticker',
        'rewinding_qty_in_rolls',
        'rewinding_colour',
        'rewinding_width',
        'rewinding_qty_in_bundle',
        'rewinding_length',
        'start_date',
        'internal_notes',
        'packing_gauge',
        'packing_colour',
        'packing_width',
        'packing_length',
        'packing_bharti',
        'packing_name',
        'packing_sticker',
        'packing_carton',
        'packing_pipe',
        'packing_outer_name',
        'packing_qty_rolls',
        'packing_qty_bundle',
        'packing_internal_notes',
        'sticching_product_name',
        'sticching_colour',
        'sticching_packing_name',
        'sticching_packing_type',
        'sticching_qty_bundle',
        'sticching_bharti',
        'sticching_qty_rolls',
        'sticching_bag',
        'Stitching_internal_notes',
        'lamination_paper_name',
        'lamination_name',
        'lamination_gun_name',
        'lamination_type',
        'lamination_internal_notes',
    ];
    public function company()
    {
        return $this->belongsTo(Customer::class, 'company_name');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_type'); 
    }

    public function customerOrder()
{
    return $this->belongsTo(CustomerOrder::class, 'sales_order', 'id');
}
}
