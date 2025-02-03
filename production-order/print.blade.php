@extends('layouts.print')
@section('navbarTitel', 'Production Order Print')
@section('content')
<style>
    .form-container {height: auto !important;}
    .section-title { font-size: 17px !important; padding: 10px 0 !important;}
    .prdctn-odr-heading { font-size: 16px !important; color: #6B4023 !important;}
    .personal-info { margin: 15px 0;}
    .last-section { margin: 0px 0 30px 0;}
</style>
<div class="form-container">
    <div class="header">
        <div class="form-title">Production Information</div>
        <div class="logo">
            @if(str_contains(url('/'), '127.0.0.1'))
            <img
            src="{{ asset('public/assets/img/Cosmiclogo.png')}}"
            alt="navbar brand"
            class="navbar-brand"
            />
            @else
            <img
            src="{{ asset('public/assets/img/Cosmiclogo.png')}}"
            alt="navbar brand"
            class="navbar-brand"
            />
            @endif
        </div>
    </div>
    <div class="personal-info">
        <div class="section-title">Production Details</div>
        <div class="row first-section">
            <p class="field-size"><strong>Order Type:</strong> {{ old('order_type', $productionOrder->order_type ?? 'N/A') }}</p>
            <p class="field-size"><strong>Company Name:</strong> {{ optional($customers->find($productionOrder->company_name))->company_name ?? 'N/A' }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Sales Order:</strong>  {{ optional($salesOrders->find($productionOrder->sales_order))->order_id ?? 'N/A' }}</p>
            <p class="field-size"><strong>Product Name:</strong> {{ optional($products->find($productionOrder->product_type))->product_name ?? 'N/A' }}</p>
            <p class="field-size" id="productCategory" style="display:none;">{{ optional($products->find($productionOrder->product_type))->category ?? 'N/A' }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>SKU:</strong> {{ old('sku', $productionOrder->sku ?? 'N/A') }}</p>
            <p class="field-size"><strong>Total Bundle Quantity:</strong> {{ old('qty_required', $productionOrder->qty_required) }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Pending Bundle Quantity:</strong> {{ old('pending_bundle_quantity', $productionOrder->pending_bundle_qty ?? '') }}</p>
            <p class="field-size"><strong>Remark:</strong> {{ old('remark', $productionOrder->remark ?? '') }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Bundle Quantity:</strong> {{ old('bundle_quantity', $productionOrder->bundle_quantity??'N/A') }}</p>
        </div>
    </div>
    <div class="section-title">Order Specification</div>
    <div class="personal-info details-space" id="laminationProduction">
        <h6 class="prdctn-odr-heading">Step 1 - Lamination</h6>
        <div class="row first-section">
            <p class="field-size"><strong>Paper Name:</strong> {{ old('lamination_paper_name',$productionOrder->lamination_paper_name??'N/A') }}</p>
            <p class="field-size"><strong>Lamination Name:</strong> {{ old('lamination_name', $productionOrder->lamination_name ?? 'N/A') }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Lamination Gum Name:</strong> {{ old('lamination_gun_name', $productionOrder->lamination_gun_name ?? 'N/A') }}</p>
            <p class="field-size"><strong>Lamination Type:</strong> {{old('lamination_type',$productionOrder->lamination_type ?? 'N/A')}}</p>
        </div>
        <div class="row last-section">
            <p class="field-size"><strong>Internal Notes:</strong> {{ old('lamination_internal_notes',$productionOrder->lamination_internal_notes ?? 'N/A') }}</p>
        </div>
    </div>
    <div class="personal-info details-space" id="extrusionProduction">
        <h6 class="prdctn-odr-heading">Step 2 - Extrusion</h6>
        <div class="row first-section">
            <p class="field-size"><strong>Gauge:</strong> {{   old('extrusion_colour',$productionOrder->extrusion_gauge??'N/A')}}</p>
            <p class="field-size"><strong>Colour:</strong> {{ old('extrusion_colour', $productionOrder->extrusion_colour?? 'N/A') }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Size:</strong> {{ old('extrusion_size', $productionOrder->extrusion_size??'N/A') }}</p>
            <p class="field-size"><strong>Recipe:</strong> {{ old('extrusion_recipe', $productionOrder->extrusion_recipe??'N/A') }}</p>
        </div>
        <div class="row last-section">
            <p class="field-size"><strong>Quantity of Packing:</strong> {{ old('extrusion_qty_of_packing', $productionOrder->extrusion_qty_of_packing??'N/A') }}</p>
            <p class="field-size"><strong>Internal Notes:</strong> {{ old('extrusion_internal_notes', $productionOrder->extrusion_internal_notes??'N/A') }}</p>
        </div>
    </div>
    <div class="personal-info details-space" id="RewindingProduction">
        <h6 class="prdctn-odr-heading">Step 3 - Rewinding</h6>
        <div class="row first-section">
            <p class="field-size"><strong>Pipe:</strong> {{ old('rewinding_pipe', $productionOrder->rewinding_pipe??'N/A') }}</p>
            <p class="field-size"><strong>Sticker:</strong> {{ old('rewinding_sticker', $productionOrder->rewinding_sticker??'N/A') }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Quantity in Rolls:</strong> {{ old('rewinding_qty_in_rolls', $productionOrder->rewinding_qty_in_rolls??'N/A') }}</p>
            <p class="field-size"><strong>Colour:</strong> {{ old('rewinding_colour', $productionOrder->rewinding_colour??'N/A') }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Width:</strong> {{ old('rewinding_width', $productionOrder->rewinding_width??'N/A') }}</p>
            <p class="field-size"><strong>Length:</strong> {{ old('rewinding_length', $productionOrder->rewinding_length??'N/A') }}</p>
        </div>
        <div class="row last-section">
            <p class="field-size"><strong>Internal Notes:</strong> {{ old('rewinding_internal_notes', $productionOrder->rewinding_internal_notes??'N/A') }}</p>
        </div>
    </div>
    <div class="personal-info details-space" id="packingDetails">
        <div class="section-title">Make to Order/Make to stock</div>
        <h6 class="prdctn-odr-heading">Step 4 - Packing</h6>
        <div class="row first-section">
            <p class="field-size"><strong>Bharti:</strong> {{ old('rewinding_pipe', $productionOrder->rewinding_pipe??'N/A') }}</p>
            <p class="field-size"><strong>Packing Name:</strong> {{ old('rewinding_sticker', $productionOrder->rewinding_sticker??'N/A') }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Carton:</strong> {{ old('packing_carton', $productionOrder->packing_carton??'N/A') }}</p>
            <p class="field-size"><strong>Outer Name:</strong> {{ old('packing_outer_name', $productionOrder->packing_outer_name ?? 'N/A') }}</p>
        </div>
        <div class="row last-section">
            <p class="field-size"><strong>QTY Rolls:</strong> {{ old('packing_qty_rolls', $productionOrder->packing_qty_rolls?? 'N/A') }}</p>
            <p class="field-size"><strong>Internal Notes:</strong> {{ old('packing_internal_notes',$productionOrder->packing_internal_notes??'N/A') }}</p>
        </div>
    </div>
    <div class="personal-info details-space" id="stitchingproduction">
        <h6 class="prdctn-odr-heading">Step 5 - Silai</h6>
        <div class="row first-section">
            <p class="field-size"><strong>Product Name:</strong> {{ old('sticching_product_name', $productionOrder->sticching_product_name??'N/A') }}</p>
            <p class="field-size"><strong>Colour:</strong> {{ old('sticching_colour', $productionOrder->sticching_colour??'N/A') }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Packing Name:</strong> {{ old('sticching_packing_name', $productionOrder->sticching_packing_name??'N/A') }}</p>
            <p class="field-size"><strong>Packing Type:</strong> {{ old('sticching_packing_type', $productionOrder->sticching_packing_type??'N/A')}}</p>
        </div>
        <div class="row last-section">
            <p class="field-size"><strong>Bag/box:</strong> {{ old('sticching_bag',$productionOrder->sticching_bag?? 'N/A') }}</p>
            <p class="field-size"><strong>Internal Notes:</strong> {{ old('Stitching_internal_notes',$productionOrder->Stitching_internal_notes??'N/A') }}</p>
        </div>
    </div>
    <div class="personal-info">
        <div class="section-title">Production Instructions</div>
        <div class="row">
            <p class="field-size"><strong>Start Date:</strong> {{ old('start_date', $productionOrder->start_date??'N/A') }}</p>
            <p class="field-size"><strong>Internal Notes:</strong> {{ old('internal_notes', $productionOrder->internal_notes ??'N/A') }}</p>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    window.print();
    var category = $('#productCategory').text().trim();
    if ( category == '4') {
                $('#RewindingProduction').attr('style', 'display:none;');
                $('#packingDetails').attr('style', 'display:none;');
                $('#stitchingproduction').attr('style', 'display:none;');
            }else{
                $('#RewindingProduction').removeAttr('style');
                $('#packingDetails').removeAttr('style');
                $('#stitchingproduction').removeAttr('style');
            }
            if(category == '1'){
                $('#extrusionProduction h6').text('Step 2 - Extrusion');
                $('#RewindingProduction h6').text('Step 3 - Rewinding');
                $('#packingDetails h6').text('Step 4 - packing Details');
                $('#stitchingproduction h6').text('Step 5 - Stitching');
                $('#laminationProduction').show();
            }else{
                $('#extrusionProduction h6').text('Step 1 - Extrusion');
                $('#RewindingProduction h6').text('Step 2 - Rewinding');
                $('#packingDetails h6').text('Step 3 - Packing Details');
                $('#stitchingproduction h6').text('Step 4 - Stitching');
                $('#laminationProduction').hide();
            }
            if(category == '2'){
                $('#extrusionProduction h6').text('Step 2 - Extrusion');
                $('#RewindingProduction h6').text('Step 3 - Rewinding');
                $('#packingDetails h6').text('Step 4 - Packing Details');
                $('#stitchingproduction h6').text('Step 5 - Stitching');
                $('#laminationProduction').show();
            }else{
                $('#extrusionProduction h6').text('Step 1 - Extrusion');
                $('#RewindingProduction h6').text('Step 2 - Rewinding');
                $('#packingDetails h6').text('Step 3 - Packing Details');
                $('#stitchingproduction h6').text('Step 4 - Stitching');
                $('#laminationProduction').hide();
            }
    // console.log(categoryValue);
</script>    


@endsection