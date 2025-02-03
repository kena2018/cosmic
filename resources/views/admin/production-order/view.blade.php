@extends('layouts.app')
@section('navbarTitel', 'Work Order')
@section('content')

<div class="main-outer">  
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">View the Work Order</span>
                <div class="prd-order-data">
                <!-- <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button> -->
                    <button type="button" id="Button" class="orderList" ><span class="back-icons back-tab-icon"></span></button>
                </div>
            </div>
            <hr class="addsupplier-section-border">
            <?php $categoryValue =  optional($category->find(optional($products->find($productionOrder->product_type))->category))->name ?? '' ?>
            <div class="upload-file-sec">
                <div class="row customer-files-sec"> 
                    <div class="row form-inp-group">
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="order_type">Order Type<span style="color: red;">*</span></label>
                            <span class="form-control">{{$productionOrder->order_type ?? ' '}}</span>
                        </div>
                        <?php if ($productionOrder->order_type != 'Make to Stock' ): ?>
                            <div class="col-lg-4 mb-3" id="make_to_order_company_name">
                                <label class="heading-content" for="company_name">Company Name<span style="color: red;">*</span></label>
                                <span class="form-control">{{ optional($customers->find($productionOrder->company_name))->company_name ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-4 mb-3" id="make_to_order_sales_order">
                                <label class="heading-content" for="sales_order">Sales Order<span style="color: red;">*</span></label>
                                <span class="form-control">{{ optional($salesOrders->find($productionOrder->sales_order))->order_id ?? ' ' }}</span>
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="product_type">Product Name<span style="color: red;">*</span></label>
                            <span class="form-control">{{ optional($products->find($productionOrder->product_type))->product_name ?? ' ' }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="sku">SKU<span style="color: red;">*</span></label>
                            <span class="form-control">{{ optional($products->find($productionOrder->product_type))->alias_sku ?? ' ' }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="qty_required">Total Bundle Quantity<span style="color: red;">*</span></label>
                            <span class="form-control">{{ $productionOrder->qty_required ?? ' ' }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="pending_bundle_quantity">Pending Bundle Quantity<span style="color: red;">*</span></label>
                            <span class="form-control">{{ $productionOrder->pending_bundle_quantity ?? ' ' }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="remark">Remark</label>
                            <span class="form-control">{{ $productionOrder->remark ?? ' ' }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="bundle_quantity">Required Bundle Quantity<span style="color: red;">*</span></label>
                            <span class="form-control">{{ $productionOrder->bundle_quantity ?? ' ' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
        <?php if ($categoryValue === 'Paper Roll' ): ?>
            <div class="outer card" id="laminationProduction" >
                <div class="heading-btn">
                    <span class="addsupplier-section-heading">Order Specification</span>
                </div>
                <hr class="addsupplier-section-border">
                <h6 class="prdctn-odr-heading">Step 1 - Lamination</h6>
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="extrusion_gauge">Paper Name<span style="color: red;">*</span></label>
                                <span class="form-control">{{ optional($laminationpapernames->find($productionOrder->lamination_paper_name))->material_name ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content"  for="category">Lamination Name</label>
                                <span class="form-control">{{ optional($laminationnames->find($productionOrder->lamination_name))->material_name ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content"  for="category">Lamination Gum Name</label>
                                <span class="form-control">{{ optional($laminationgums->find($productionOrder->lamination_gun_name))->material_name ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content"  for="lamination_type">Lamination Type</label>
                                <span class="form-control">{{ $productionOrder->lamination_type ?? ' ' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
        
            <div class="outer card" id="extrusionProduction">
                <div class="heading-btn">
                    <span class="addsupplier-section-heading">Order Specification</span>
                </div>
                <hr class="addsupplier-section-border">
                <h6 class="prdctn-odr-heading">Step 1 - Extrusion</h6>
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="extrusion_gauge">Gauge<span style="color: red;">*</span></label>
                                <span class="form-control">{{$productionOrder->extrusion_gauge ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="extrusion_colour">Colour<span style="color: red;">*</span></label>
                                <span class="form-control">{{$productionOrder->extrusion_colour ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="extrusion_size">Size<span style="color: red;">*</span></label>
                                <span class="form-control">{{$productionOrder->extrusion_size ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="extrusion_recipe">Recipe<span style="color: red;">*</span></label>
                                <span class="form-control">{{$productionOrder->extrusion_recipe ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="extrusion_qty_of_packing">Quantity of Packing<span style="color: red;">*</span></label>
                                <span class="form-control">{{$productionOrder->extrusion_qty_of_packing ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="extrusion_internal_notes">Internal Notes<span style="color: red;">*</span></label>
                                <span class="form-control">{{$productionOrder->extrusion_internal_notes ?? ' ' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($categoryValue != 'Plastic Jumbo Roll' ): ?>
            <div class="outer card" id="RewindingProduction">    
                <h6 class="prdctn-odr-heading">Step 2 - Rewinding</h6>
                <hr class="addsupplier-section-border">
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-lg-3 mb-3"id="pipeSize">
                                <label class="heading-content" for="rewinding_pipe">Pipe<span style="color: red;">*</span></label>
                                <span class="form-control">{{ $productionOrder->rewinding_pipe ?? ''}}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="rewinding_sticker">Sticker<span style="color: red;">*</span></label>
                                <span class="form-control">{{ $productionOrder->rewinding_sticker ?? ''}}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="rewinding_qty_in_rolls">Quantity in Rolls<span style="color: red;">*</span></label>
                                <span class="form-control">{{ $productionOrder->rewinding_qty_in_rolls ?? ''}}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="rewinding_colour">Colour<span style="color: red;">*</span></label>
                                <span class="form-control">{{ $productionOrder->rewinding_colour ?? ''}}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="rewinding_width">Width<span style="color: red;">*</span></label>
                                <span class="form-control">{{ $productionOrder->rewinding_width ?? ''}}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="rewinding_length">Length<span style="color: red;">*</span></label>
                                <span class="form-control">{{ $productionOrder->rewinding_length ?? ''}}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="rewinding_internal_notes">Internal Notes<span style="color: red;">*</span></label>
                                <span class="form-control">{{ $productionOrder->rewinding_internal_notes ?? ''}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="outer card" id="stitchingproduction">       
                <h6 class="prdctn-odr-heading">Step 4 - Silai</h6>
                <hr class="addsupplier-section-border">
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="sticching_product_name">Product Name<span style="color: red;">*</span></label>
                                <span class="form-control">{{ $productionOrder->sticching_product_name ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="sticching_colour">Colour<span style="color: red;">*</span></label>
                                <span class="form-control">{{ $productionOrder->sticching_colour ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="sticching_packing_name">Packing Name<span style="color: red;">*</span></label>
                                <span class="form-control">{{ $productionOrder->sticching_packing_name ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="sticching_packing_type">Packing Type<span style="color: red;">*</span></label>
                                <span class="form-control">{{ $productionOrder->sticching_packing_type ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="sticching_bag">Bag/box</label>
                                <span class="form-control">{{ $productionOrder->sticching_bag ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="Stitching_internal_notes">Internal Notes</label>
                                <span class="form-control">{{ $productionOrder->Stitching_internal_notes ?? ' ' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="outer card" id="packingDetails">
                <div class="heading-btn">
                    <span class="addsupplier-section-heading">Make to Order/Make to stock</span>
                </div>
                <hr class="addsupplier-section-border">
                <h6 class="prdctn-odr-heading">Step 5 - Packing</h6>
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="packing_bharti">Bharti<span style="color: red;">*</span></label>
                                <span class="form-control">{{ $productionOrder->packing_bharti ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="packing_name">Packing Name<span style="color: red;">*</span></label>
                                <span class="form-control">{{ $productionOrder->packing_name ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="packing_carton">Carton<span style="color: red;">*</span></label>
                                <span class="form-control">{{ $productionOrder->packing_carton ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="packing_outer_name">Outer Name</span></label>
                                <span class="form-control">{{ $productionOrder->packing_outer_name ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="packing_qty_rolls">QTY Rolls<span style="color: red;">*</span></label>
                                <span class="form-control">{{ $productionOrder->packing_qty_rolls ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="packing_internal_notes">Internal Notes</label>
                                <span class="form-control">{{ $productionOrder->packing_internal_notes ?? ' ' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="outer card">
            <div class="heading-btn"><span class="addsupplier-section-heading">Production Instructions</span></div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="start_date">Start Date<span style="color: red;">*</span></label>
                            <span class="form-control date-input">{{ $productionOrder->start_date ?? ' ' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        $(document).on('click','#Button', function(){
            window.location.href = "{{ route('production_order.index') }}";
        });
    });
</script>
@endsection
