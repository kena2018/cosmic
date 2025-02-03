@extends('layouts.app')
@section('navbarTitel', 'Work Order')
@section('content')

<div class="main-outer">
    <form  id="productionOrderEditForm" action="{{ route('production_order.update', $productionOrder->id) }}" method="post">
        @csrf
        @method('PUT')    
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Edit the Work Order</span>
                <div class="prd-order-data">
                    <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
                </div>
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec"> 
                    <div class="row form-inp-group">
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="order_type">Order Type<span style="color: red;">*</span></label>
                            <select class="form-control select2 form-select-grp @error('order_type') is-invalid @enderror @if(old('order_type')) is-valid @endif" name="order_type" id="order_type">
                                <option value="Make to Order" {{ old('order_type', $productionOrder->order_type) == 'Make to Order' ? 'selected' : '' }}>Make to Order</option>
                                <option value="Make to Stock" {{ old('order_type', $productionOrder->order_type) == 'Make to Stock' ? 'selected' : '' }}>Make to Stock</option>
                            </select>
                            @error('order_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3" id="make_to_order_company_name">
                            <label class="heading-content" for="company_name">Company Name<span style="color: red;">*</span></label>
                            <select class="form-control select2 form-select-grp @error('company_name') is-invalid @enderror @if(old('company_name')) is-valid @endif" name="company_name" id="company_name">
                                <option value="">Select Company Name</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ (old('company_name') ? old('company_name') : $productionOrder->company_name) == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->company_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3" id="make_to_order_sales_order">
                            <label class="heading-content" for="sales_order">Sales Order<span style="color: red;">*</span></label>
                            <select class="form-control select2 form-select-grp @error('sales_order') is-invalid @enderror @if(old('sales_order')) is-valid @endif" name="sales_order" id="sales_order">
                                <option value="">Select Sales Order</option>
                                @foreach($salesOrders as $salesOrder)
                                    <option value="{{ $salesOrder->id }}" {{ (old('sales_order') ? old('sales_order') : $productionOrder->sales_order) == $salesOrder->id ? 'selected' : '' }}>
                                        {{ $salesOrder->order_id }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sales_order')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="product_type">Product Name<span style="color: red;">*</span></label>
                            <select class="form-control product-form select2 form-select-grp @error('product_type') is-invalid @enderror @if(old('product_type')) is-valid @endif" name="product_type" id="product_type">
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-sku="{{ $product->alias_sku }}" data-category="{{$product->category}}" {{ (old('product_type') ? old('product_type') : $productionOrder->product_type) == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                                    @endforeach
                            </select>
                            @error('product_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="sku">SKU<span style="color: red;">*</span></label>
                            <select class="form-control select2 form-select-grp @error('sku') is-invalid @enderror @if(old('sku')) is-valid @endif" name="sku" id="sku">
                                <option value="">Select SKU</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->alias_sku }}" data-category="{{ $product->category }}" data-product="{{ $product->id }}" {{ (old('sku') ? old('sku') : $productionOrder->sku) == $product->alias_sku ? 'selected' : '' }}>{{ $product->alias_sku }}</option>
                                @endforeach
                            </select>
                            @error('sku')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> -->
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="sku">SKU<span style="color: red;">*</span></label>
                            <input type="text" 
                                class="form-control @error('sku') is-invalid @enderror @if(old('sku')) is-valid @endif" 
                                name="sku" 
                                id="sku" 
                                value="{{ old('sku') ? old('sku') : $productionOrder->sku }}" 
                                placeholder="Enter SKU">
                            @error('sku')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="qty_required">Total Bundle Quantity<span style="color: red;">*</span></label>
                            <input type="number" class="form-control @error('qty_required') is-invalid @enderror @if(old('qty_required')) is-valid @endif" name="qty_required" id="qty_required" placeholder="Quantity Required" value="{{ old('qty_required', $productionOrder->qty_required) }}">
                            @error('qty_required')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                                <label class="heading-content" for="pending_bundle_quantity">Pending Bundle Quantity<span style="color: red;">*</span></label>
                                <input 
                                    type="number" 
                                    class="form-control @error('pending_bundle_quantity') is-invalid @enderror @if(old('pending_bundle_quantity')) is-valid @endif" 
                                    name="pending_bundle_quantity" 
                                    id="pending_bundle_quantity" 
                                    placeholder="Pending Bundle Quantity" 
                                    value="{{ old('pending_bundle_quantity', $pendingBundleQty ?? '') }}">
                                    <!-- <input 
                                    type="number" 
                                    class="form-control @error('original_pending_bundle_quantity') is-invalid @enderror @if(old('pending_bundle_quantity')) is-valid @endif" 
                                    name="original_pending_bundle_quantity" 
                                    id="original_pending_bundle_quantity" 
                                    placeholder="Pending Bundle Quantity" 
                                    value="{{ old('pending_bundle_quantity', $pendingBundleQty ?? '') }}"> -->
                                @error('pending_bundle_quantity')
                                    <span class="text-danger">{{ $moriginal_pending_bundle_quantityessage }}</span>
                                @enderror
                            </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="remark">Remark</label>
                            <input type="test" class="form-control @error('remark') is-invalid @enderror @if(old('remark')) is-valid @endif" name="remark" id="remark" placeholder="Remark" value="{{ old('remark', $productionOrder->remark ?? '') }}">
                            @error('remark')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="bundle_quantity">Required Bundle Quantity<span style="color: red;">*</span></label>
                            <input type="number" class="form-control @error('bundle_quantity') is-invalid @enderror @if(old('bundle_quantity')) is-valid @endif" name="bundle_quantity" id="bundle_quantity" placeholder="Bundle Quantity" value="{{ old('bundle_quantity', $productionOrder->bundle_quantity) }}">
                            <input type="hidden" id="current_bundle_quantity" name="current_bundle_quantity" value="{{ $productionOrder->bundle_quantity }}">

                            @error('bundle_quantity')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        <div class="outer card" id="laminationProduction" style="display:none;">
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
                            <select name="lamination_paper_name" class="custom-select d-block w-100 form-select-grps form-control select2">
                                <option value="">Select Outer Name</option>
                                @foreach($laminationpapernames as $laminationpapername)
                                    <option value="{{ $laminationpapername->id }}" {{ old('lamination_paper_name', $productionOrder->lamination_paper_name) == $laminationpapername->id ? 'selected' : '' }}>{{ $laminationpapername->material_name }}</option>
                                @endforeach
                            </select>
                            @error('lamination_paper_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <!-- <input type="text" class="form-control @error('lamination_paper_name') is-invalid @enderror @if(old('lamination_paper_name')) is-valid @endif" name="lamination_paper_name" id="lamination_paper_name" placeholder="Lamination Paper Name" value="{{ old('lamination_paper_name',$productionOrder->lamination_paper_name??'') }}">
                            @error('lamination_paper_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror -->
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content"  for="category">Film Name</label>
                            <!-- <select name="lamination_name" id="lamination_name" class="custom-select d-block w-100 form-select-grps form-control select2">
                                <option class="option-desgn" value="" hidden>Select</option>
                                <option value="Paper Roll"{{ (old('lamination_name', $productionOrder->lamination_name) == 'Paper Roll') ? 'selected' : '' }}>Paper Roll</option>
                                <option value="Paper Sheet"{{ (old('lamination_name', $productionOrder->lamination_name) == 'Paper Sheet') ? 'selected' : '' }}>Paper Sheet</option>
                                <option value="Plastic Roll"{{ (old('lamination_name', $productionOrder->lamination_name) == 'Plastic Roll') ? 'selected' : '' }}>Plastic Roll</option>
                                <option value="Plastic Jumbo Roll"{{ (old('lamination_name', $productionOrder->lamination_name) == 'Plastic Jumbo Roll') ? 'selected' : '' }}>Plastic Jumbo Roll</option>
                            </select> -->
                            <select name="lamination_name" class="custom-select d-block w-100 form-select-grps form-control select2">
                                <option value="">Select Outer Name</option>
                                @foreach($laminationnames as $laminationname)
                                    <option value="{{ $laminationname->id }}" {{ old('lamination_name', $productionOrder->lamination_name) == $laminationname->id ? 'selected' : '' }}>{{ $laminationname->material_name }}</option>
                                @endforeach
                            </select>
                            @error('lamination_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content"  for="category">Lamination Gum Name</label>
                            <!-- <select name="lamination_gun_name" id="lamination_gun_name" class="custom-select d-block w-100 form-select-grps form-control select2">
                                <option class="option-desgn" value="" hidden>Select</option>
                                <option value="Paper Roll" {{ old('lamination_gun_name', $productionOrder->lamination_gun_name) == 'Paper Roll' ? 'selected' : '' }}>Paper Roll</option>
                                <option value="Paper Sheet" {{ old('lamination_gun_name', $productionOrder->lamination_gun_name) == 'Paper Sheet' ? 'selected' : '' }}>Paper Sheet</option>
                                <option value="Plastic Roll" {{ old('lamination_gun_name', $productionOrder->lamination_gun_name) == 'Plastic Roll' ? 'selected' : '' }}>Plastic Roll</option>
                                <option value="Plastic Jumbo Roll" {{ old('lamination_gun_name', $productionOrder->lamination_gun_name) == 'Plastic Jumbo Roll' ? 'selected' : '' }}>Plastic Jumbo Roll</option>
                            </select> -->
                            <select name="lamination_gun_name" class="custom-select d-block w-100 form-select-grps form-control select2">
                                <option value="">Select Outer Name</option>
                                @foreach($laminationgums as $laminationgum)
                                    <option value="{{ $laminationgum->id }}" {{ old('lamination_gun_name', $productionOrder->lamination_gun_name) == $laminationgum->id ? 'selected' : '' }}>{{ $laminationgum->material_name }}</option>
                                @endforeach
                            </select>
                            @error('lamination_gun_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content"  for="lamination_type">Lamination Type</label>
                            <select name="lamination_type" id="lamination_type" class="custom-select d-block w-100 form-select-grps form-control select2">
                                <option class="option-desgn" value="" hidden>Select</option>
                                <option value="Cutter" {{ old('lamination_type', $productionOrder->lamination_type) == 'Cutter' ? 'selected' : '' }}>Cutter</option>
                                <option value="Stip" {{ old('lamination_type', $productionOrder->lamination_type) == 'Stip' ? 'selected' : '' }}>Stip</option>
                                <option value="Full" {{ old('lamination_type', $productionOrder->lamination_type) == 'Full' ? 'selected' : '' }}>Full</option>
                            </select>
                            @error('lamination_gun_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <!-- <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="lamination_internal_notes">Internal Notes</label>
                            <input type="text" class="form-control internal-inp @error('lamination_internal_notes') is-invalid @enderror @if(old('lamination_internal_notes')) is-valid @endif" name="lamination_internal_notes" id="lamination_internal_notes" value="{{ old('lamination_internal_notes',$productionOrder->lamination_internal_notes ?? '') }}" placeholder="Lamination Extrusion Internal Notes">
                            @error('lamination_internal_notes')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
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
                            <input type="number" class="form-control @error('extrusion_gauge') is-invalid @enderror @if(old('extrusion_gauge')) is-valid @endif" name="extrusion_gauge" id="extrusion_gauge" placeholder="Gauge" value="{{   old('extrusion_colour',$productionOrder->extrusion_gauge)}}">
                            @error('extrusion_gauge')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="extrusion_colour">Colour<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('extrusion_colour') is-invalid @enderror @if(old('extrusion_colour')) is-valid @endif" name="extrusion_colour" id="extrusion_colour" placeholder="Colour" value="{{ old('extrusion_colour', $productionOrder->extrusion_colour) }}">
                            @error('extrusion_colour')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="extrusion_size">Size<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('extrusion_size') is-invalid @enderror @if(old('extrusion_size')) is-valid @endif" name="extrusion_size" id="extrusion_size" placeholder="Size" value="{{ old('extrusion_size', $productionOrder->extrusion_size) }}">
                            @error('extrusion_size')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="extrusion_recipe">Recipe<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('extrusion_recipe') is-invalid @enderror @if(old('extrusion_recipe')) is-valid @endif" name="extrusion_recipe" id="extrusion_recipe" placeholder="Recipe" value="{{ old('extrusion_recipe', $productionOrder->extrusion_recipe) }}">
                            @error('extrusion_recipe')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="extrusion_qty_of_packing">Quantity (in KG)<span style="color: red;">*</span></label>
                            <input type="number" class="form-control @error('extrusion_qty_of_packing') is-invalid @enderror @if(old('extrusion_qty_of_packing')) is-valid @endif" name="extrusion_qty_of_packing" id="extrusion_qty_of_packing" placeholder="Quantity of Packing" value="{{ old('extrusion_qty_of_packing', $productionOrder->extrusion_qty_of_packing) }}">
                            @error('extrusion_qty_of_packing')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="extrusion_internal_notes">Internal Notes<span style="color: red;">*</span></label>
                            <input type="text" class="form-control internal-inp @error('extrusion_internal_notes') is-invalid @enderror @if(old('extrusion_internal_notes')) is-valid @endif" name="extrusion_internal_notes" id="extrusion_internal_notes" placeholder="Quantity of Packing" value="{{ old('extrusion_internal_notes', $productionOrder->extrusion_internal_notes) }}">
                            @error('extrusion_internal_notes')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="outer card" id="RewindingProduction">    
            <h6 class="prdctn-odr-heading">Step 2 - Rewinding</h6>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-lg-3 mb-3"id="pipeSize">
                                <label class="heading-content" for="rewinding_pipe">Pipe<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('rewinding_pipe') is-invalid @enderror @if(old('rewinding_pipe')) is-valid @endif" name="rewinding_pipe" id="rewinding_pipe" placeholder="Pipe" value="{{ old('rewinding_pipe', $productionOrder->rewinding_pipe) }}">
                                @error('rewinding_pipe')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="rewinding_sticker">Sticker<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('rewinding_sticker') is-invalid @enderror @if(old('rewinding_sticker')) is-valid @endif" name="rewinding_sticker" id="rewinding_sticker" placeholder="Sticker" value="{{ old('rewinding_sticker', $productionOrder->rewinding_sticker) }}">
                                @error('rewinding_sticker')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="rewinding_qty_in_rolls">Quantity in Rolls<span style="color: red;">*</span></label>
                                <input type="number" class="form-control @error('rewinding_qty_in_rolls') is-invalid @enderror @if(old('rewinding_qty_in_rolls')) is-valid @endif" name="rewinding_qty_in_rolls" id="rewinding_qty_in_rolls" placeholder="Quantity in Rolls" value="{{ old('rewinding_qty_in_rolls', $productionOrder->rewinding_qty_in_rolls) }}">
                                @error('rewinding_qty_in_rolls')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="rewinding_colour">Colour<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('rewinding_colour') is-invalid @enderror @if(old('rewinding_colour')) is-valid @endif" name="rewinding_colour" id="rewinding_colour" placeholder="Colour" value="{{ old('rewinding_colour', $productionOrder->rewinding_colour) }}">
                                @error('rewinding_colour')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="rewinding_width">Width<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('rewinding_width') is-invalid @enderror @if(old('rewinding_width')) is-valid @endif" name="rewinding_width" id="rewinding_width" placeholder="Width" value="{{ old('rewinding_width', $productionOrder->rewinding_width) }}">
                                @error('rewinding_width')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="rewinding_length">Length<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('rewinding_length') is-invalid @enderror @if(old('rewinding_length')) is-valid @endif" name="rewinding_length" id="rewinding_length" placeholder="Length" value="{{ old('rewinding_length', $productionOrder->rewinding_length) }}">
                                @error('rewinding_length')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="rewinding_internal_notes">Internal Notes<span style="color: red;">*</span></label>
                                <input type="text" class="form-control internal-inp @error('rewinding_internal_notes') is-invalid @enderror @if(old('rewinding_internal_notes')) is-valid @endif" name="rewinding_internal_notes" id="rewinding_internal_notes" placeholder="Length" value="{{ old('rewinding_internal_notes', $productionOrder->rewinding_internal_notes) }}">
                                @error('rewinding_internal_notes')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                <h6 class="prdctn-odr-heading">Step 3 - Packing</h6>
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="packing_bharti">Bharti<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('packing_bharti') is-invalid @enderror @if(old('packing_bharti')) is-valid @endif" name="packing_bharti" id="packing_bharti" placeholder="Bharti" value="{{ old('packing_bharti', $productionOrder->packing_bharti) }}">
                                @error('packing_bharti')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="packing_name">Packing Name<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('packing_name') is-invalid @enderror @if(old('packing_name')) is-valid @endif" name="packing_name" id="packing_name" placeholder="Packing Name" value="{{ old('packing_name', $productionOrder->packing_name) }}">
                                @error('packing_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="packing_carton">Carton<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('packing_carton') is-invalid @enderror @if(old('packing_carton')) is-valid @endif" name="packing_carton" id="packing_carton" placeholder="Packing Carton" value="{{ old('packing_carton', $productionOrder->packing_carton) }}">
                                @error('packing_carton')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="packing_outer_name">Outer Name</span></label>
                                <input type="text" class="form-control @error('packing_outer_name') is-invalid @enderror @if(old('packing_outer_name')) is-valid @endif" name="packing_outer_name" id="packing_outer_name" placeholder="Packing Outer Name" value="{{ old('packing_outer_name', $productionOrder->packing_outer_name) }}">
                                @error('packing_outer_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="packing_qty_rolls">QTY Rolls<span style="color: red;">*</span></label>
                                <input type="number" class="form-control  @error('packing_qty_rolls') is-invalid @enderror @if(old('packing_qty_rolls')) is-valid @endif" name="packing_qty_rolls" id="packing_qty_rolls" placeholder="QTY Rolls" value="{{ old('packing_qty_rolls', $productionOrder->packing_qty_rolls) }}">
                                @error('packing_qty_rolls')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="packing_colour">Colour</label>
                                <input type="text" class="form-control  internal-inp @error('packing_colour') is-invalid @enderror @if(old('packing_colour')) is-valid @endif" name="packing_colour" id="packing_colour" value="{{ old('packing_colour', $productionOrder->packing_colour) }}" placeholder="Colour">
                                @error('packing_colour')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="packing_internal_notes">Sticker</label>
                                <input type="text" class="form-control  internal-inp @error('packing_sticker') is-invalid @enderror @if(old('packing_sticker')) is-valid @endif" name="packing_sticker" id="packing_sticker" value="{{ old('packing_sticker', $productionOrder->packing_sticker) }}" placeholder="Sticker">
                                @error('packing_sticker')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="packing_internal_notes">Internal Notes</label>
                                <input type="text" class="form-control internal-inp @error('packing_internal_notes') is-invalid @enderror @if(old('packing_internal_notes')) is-valid @endif" name="packing_internal_notes" id="packing_internal_notes" value="{{ old('packing_internal_notes',$productionOrder->packing_internal_notes??'') }}" placeholder="Packing Internal Notes">
                                @error('packing_internal_notes')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                            <input type="text" class="form-control @error('sticching_product_name') is-invalid @enderror @if(old('sticching_product_name')) is-valid @endif" name="sticching_product_name" id="sticching_product_name" placeholder="Product Name" value="{{ old('sticching_product_name', $productionOrder->sticching_product_name) }}">
                            @error('sticching_product_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control @error('packing_weight') is-invalid @enderror @if(old('packing_weight')) is-valid @endif" name="packing_weight" id="packing_weight" value="">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="sticching_colour">Colour<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('sticching_colour') is-invalid @enderror @if(old('sticching_colour')) is-valid @endif" name="sticching_colour" id="sticching_colour" placeholder="Colour" value="{{ old('sticching_colour', $productionOrder->sticching_colour) }}">
                            @error('sticching_colour')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="sticching_packing_name">Packing Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('sticching_packing_name') is-invalid @enderror @if(old('sticching_packing_name')) is-valid @endif" name="sticching_packing_name" id="sticching_packing_name" placeholder="Packing Name" value="{{ old('sticching_packing_name', $productionOrder->sticching_packing_name) }}">
                            @error('sticching_packing_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="sticching_packing_type">Packing Type<span style="color: red;">*</span></label>
                            <!-- <select id="packingTypedata" name="sticching_packing_type" class="form-control">
                                <option value="">Select an option</option>
                            </select>
                            <input type="hidden" id="hiddenPackingType" value="{{ $productionOrder->sticching_packing_type }}"> -->
                            <!-- <input type="text"  value="{{$productionOrder->sticching_packing_type}}"> -->
                            
                            <input type="text" class="form-control @error('sticching_packing_type') is-invalid @enderror @if(old('sticching_packing_type')) is-valid @endif" name="sticching_packing_type" id="sticching_packing_type" placeholder="Packing Type" value="{{ old('sticching_packing_type', $productionOrder->sticching_packing_type) }}">
                            @error('sticching_packing_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="sticching_bag">Bag/box</label>
                            <input type="text" class="form-control @error('sticching_bag') is-invalid @enderror @if(old('sticching_bag')) is-valid @endif" name="sticching_bag" id="sticching_bag" placeholder="Bag/box" value="{{ old('sticching_bag',$productionOrder->sticching_bag?? '') }}">
                            @error('sticching_bag')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="sticching_bharti">Bharti</label>
                            <input type="text" class="form-control @error('sticching_bharti') is-invalid @enderror @if(old('sticching_bharti')) is-valid @endif" name="sticching_bharti" id="sticching_bharti" placeholder="Bharti" value="{{ old('sticching_bharti',$productionOrder->sticching_bharti?? '') }}">
                            @error('sticching_bharti')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="Stitching_internal_notes">Internal Notes</label>
                            <input type="text" class="form-control internal-inp @error('Stitching_internal_notes') is-invalid @enderror @if(old('Stitching_internal_notes')) is-valid @endif" name="Stitching_internal_notes" id="Stitching_internal_notes" value="{{ old('Stitching_internal_notes',$productionOrder->Stitching_internal_notes??'') }}" placeholder="Stitching Internal Notes">
                            @error('Stitching_internal_notes')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="outer card">
                <div class="heading-btn">
                    <span class="addsupplier-section-heading">Production Instructions</span>
                </div>
                <hr class="addsupplier-section-border">
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="start_date">Start Date<span style="color: red;">*</span></label>
                                <input type="date" class="form-control date-input @error('start_date') is-invalid @enderror @if(old('start_date')) is-valid @endif" name="start_date" id="start_date" value="{{ old('start_date', $productionOrder->start_date) }}">
                                @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- <div class="col-lg-9 mb-3">
                                <label class="heading-content" for="internal_notes">Internal Notes</label>
                                <input type="text" class="form-control internal-inp @error('internal_notes') is-invalid @enderror @if(old('internal_notes')) is-valid @endif" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', $productionOrder->internal_notes) }}">
                                @error('internal_notes')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->
                        </div>
                    </div>
                </div>
        </div>
        <div class="upload-file-sec">
            <div class="row customer-files-sec">
                <div class="upload--file--section">
                    <div class="btn-sec btn_group">
                
                    </div>
                    <div class="order-btn-grp">
                        <div class="btn-sec btn_group">
                            <div class="button-1 cta_btn">
                                <button id="editButton" type="submit" class="primary-button stock-btn">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="data-container"
     data-products="{{ json_encode($products) }}"
></div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->
<script>

    $(document).on('focusin', '.select2', function(e) {
        $(this).siblings('select').select2('open');
    });
    $(document).ready(function(){
        $(document).on('click','#leaveButton', function(){
            window.location.href = "{{ route('production_order.index') }}";
        });
        $('.orderList').click( function(){
            $("#indexModul").modal("show");
        });
        $('#order_type').focus();
        // $('.select2').select2();
        $('button[type="submit"]').on('focus', function() {
            $(this).addClass('btn-focus');
        }).on('blur', function() {
            $(this).removeClass('btn-focus');
        });

    });
    $(document).ready(function() {
        function updateCategory() {
            var selectedOption = $('#product_type option:selected');
            var category = selectedOption.data('category');
            console.log('*-*-*-*-*-*');
            console.log(category);
            if ( category == '4') {
                $('#RewindingProduction').attr('style', 'display:none;');
                $('#packingDetails').attr('style', 'display:none;');
                $('#stitchingproduction').attr('style', 'display:none;');
            }else{
                $('#RewindingProduction').removeAttr('style');
                $('#packingDetails').removeAttr('style');
                $('#stitchingproduction').removeAttr('style');
            }
            if (category == '1') {
                    $('#laminationProduction').show(); // Show lamination section
                    $('#extrusionProduction').attr('style', 'display:none;');
                    // $('#extrusionProduction h6').text('Step 2 - Extrusion');
                    $('#RewindingProduction h6').text('Step 2 - Rewinding');
                    $('#packingDetails h6').text('Step 3 - Packing Details');
                    $('#stitchingproduction h6').text('Step 4 - Silai');
                    $('#pipeSize').attr('style', 'display:none;'); // Hide pipe size
                } else if (category == '2') {
                    // $('#extrusionProduction h6').text('Step 2 - Extrusion');
                    $('#extrusionProduction').attr('style', 'display:none;');
                    $('#RewindingProduction h6').text('Step 2 - Rewinding');
                    $('#packingDetails h6').text('Step 3 - Packing Details');
                    $('#stitchingproduction h6').text('Step 4 - Silai');
                    $('#laminationProduction').show(); // Show lamination section
                } else {
                    $('#extrusionProduction h6').text('Step 1 - Extrusion');
                    $('#extrusionProduction').removeAttr('style');
                    $('#RewindingProduction h6').text('Step 2 - Rewinding');
                    $('#packingDetails h6').text('Step 3 - Packing Details');
                    $('#stitchingproduction h6').text('Step 4 - Silai');
                    $('#laminationProduction').hide(); // Hide lamination section
                    $('#pipeSize').removeAttr('style'); // Show pipe size
                }
            
        }
        updateCategory();
        $('#product_type').on('change', updateCategory);
    });
    $(document).ready(function() {
    function updateCategory() {
        var selectedOption = $('#sku option:selected');
        var category = selectedOption.data('category');

        if ( category == '4') {
                $('#RewindingProduction').attr('style', 'display:none;');
                $('#packingDetails').attr('style', 'display:none;');
                $('#stitchingproduction').attr('style', 'display:none;');
            }else{
                $('#RewindingProduction').removeAttr('style');
                $('#packingDetails').removeAttr('style');
                $('#stitchingproduction').removeAttr('style');
            }
            if (category == '1') {
                    $('#laminationProduction').show(); // Show lamination section
                    $('#extrusionProduction').attr('style', 'display:none;');
                    // $('#extrusionProduction h6').text('Step 2 - Extrusion');
                    $('#RewindingProduction h6').text('Step 2 - Rewinding');
                    $('#packingDetails h6').text('Step 3 - Packing Details');
                    $('#stitchingproduction h6').text('Step 4 - Silai');
                    $('#pipeSize').attr('style', 'display:none;'); // Hide pipe size
                } else if (category == '2') {
                    // $('#extrusionProduction h6').text('Step 2 - Extrusion');
                    $('#extrusionProduction').attr('style', 'display:none;');
                    $('#RewindingProduction h6').text('Step 2 - Rewinding');
                    $('#packingDetails h6').text('Step 3 - Packing Details');
                    $('#stitchingproduction h6').text('Step 4 - Silai');
                    $('#laminationProduction').show(); // Show lamination section
                } else {
                    $('#extrusionProduction h6').text('Step 1 - Extrusion');
                    $('#extrusionProduction').removeAttr('style');
                    $('#RewindingProduction h6').text('Step 2 - Rewinding');
                    $('#packingDetails h6').text('Step 3 - Packing Details');
                    $('#stitchingproduction h6').text('Step 4 - Silai');
                    $('#laminationProduction').hide(); // Hide lamination section
                    $('#pipeSize').removeAttr('style'); // Show pipe size
                }
    }

    updateCategory();

    $('#sku').on('change', updateCategory);
});
document.addEventListener('DOMContentLoaded', function () {
    var productTypeSelect = document.getElementById('product_type');
    var skuSelect = document.getElementById('sku');
    var gaugeInput = document.getElementById('extrusion_gauge');
    var widthInput = document.getElementById('rewinding_width');
    var lengthInput = document.getElementById('rewinding_length');
    var packingQtyRollsInput = document.getElementById('packing_qty_rolls');
    //var extrusionQtyOfPackingInput = document.getElementById('extrusion_qty_of_packing');
    var packingNameInput = document.getElementById('packing_name');
    // var packingWidthInput = document.getElementById('packing_width');
    // var packingLengthInput = document.getElementById('packing_length');
    var packingWeightInput = document.getElementById('packing_weight');
    var packingBhartiInput = document.getElementById('packing_bharti');
    var packingOuterNameiInput = document.getElementById('packing_outer_name');
    var packingCartonInput = document.getElementById('packing_carton');
    var packingColourInput = document.getElementById('packing_colour');
    var SticchingPackingNameInput = document.getElementById('sticching_packing_name');
    var SticchingPackingTypeInput = document.getElementById('sticching_packing_type');
    var StitchingBhartiInput = document.getElementById('sticching_bharti');
    var StitchingBagInput = document.getElementById('sticching_bag');
    var rewindingQtyInRollsInput = document.getElementById('rewinding_qty_in_rolls');
    var dataContainer = document.getElementById('data-container');
    var productsData = JSON.parse(dataContainer.getAttribute('data-products'));

    var productDataMap = productsData.reduce(function (acc, product) {
        acc[product.id] = product;
        return acc;
    }, {});

    const orderTypeSelect = document.getElementById('order_type');
    const makeToOrderCustomerName = document.getElementById('make_to_order_company_name');
    const makeToOrderSalesOrder = document.getElementById('make_to_order_sales_order');

    function toggleFields() {
        if (orderTypeSelect.value === 'Make to Order') {
            makeToOrderCustomerName.classList.remove('d-none');
            makeToOrderSalesOrder.classList.remove('d-none');

            productTypeSelect.addEventListener('change', productTypeChangeHandler);
          //  skuSelect.addEventListener('change', skuChangeHandler);

            if (productTypeSelect.value) {
                productTypeSelect.dispatchEvent(new Event('change'));
            }
            document.getElementById('qty_required').setAttribute('readonly', true);
            document.getElementById('pending_bundle_quantity').setAttribute('readonly', true);
        } else if (orderTypeSelect.value === 'Make to Stock') {
            document.getElementById('qty_required').removeAttribute('readonly');
            document.getElementById('pending_bundle_quantity').removeAttribute('readonly');
            makeToOrderCustomerName.classList.add('d-none');
            makeToOrderSalesOrder.classList.add('d-none');

            productTypeSelect.addEventListener('change', productTypeChangeHandler);
            //skuSelect.removeEventListener('change', skuChangeHandler);

    
        }
    }

    function productTypeChangeHandler() {
        var selectedProductId = parseInt(productTypeSelect.value, 10);
        var productData = productDataMap[selectedProductId] || {};
        var materialId = productData.packing_material_name || '';
       // var masterPacking = productData.master_packing || '';
        var selectedPackingTypeId = $('#hiddenPackingType').val();
        // var sticcing_packing_typeID = productData.sticcing_packing_type || '';
        // console.log('sticcing_packing_typeID');
        // console.log(selectedPackingTypeId);
            // $.ajax({
            //     url: '{{ route('production-orders.masterPacking') }}', // Define your new route here
            //     type: 'GET',
            //     data: { 
            //         master_packing: masterPacking // Pass the masterPacking value
            //     },
            //     success: function(response) {
            //         if (response.success) {
            //             console.log('Master Packing Data:', response.data);
            //             var dropdown = $('#packingTypedata'); // Replace with your dropdown ID
            //             dropdown.empty();
            //             dropdown.append('<option value="">Select an option</option>');
            //             response.data.forEach(function(item) {
            //                 var isSelected = item.id == selectedPackingTypeId ? 'selected' : '';
            //                 dropdown.append(`<option value="${item.id}"${isSelected}>${item.material_name}</option>`);
            //             });
            //         } else {
            //             console.error('Master packing not found:', response.message);
            //         }
            //     },
            //     error: function(response) {
            //         console.error('Error fetching master packing data:', response);
            //     }
            // });
        if (materialId) {
            $.ajax({
                url: '{{ route('production-orders.byMaterial', ['materialId' => ':materialId']) }}'.replace(':materialId', materialId),
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        console.log('Material Name9:', response); // Log the material name
                        SticchingPackingNameInput.value = response.name;
                        SticchingPackingTypeInput.value = response.category_name;
                        packingNameInput.value = response.name;
                        packingWeightInput.value = response.material_weight;
                    } else {gaugeInput
                        console.error('Material not found:', response.message);
                    }   
                },
                error: function(response) {
                    console.error('Error fetching orders:', response);
                }
            });
        }

        gaugeInput.value = productData.gage || '';
        widthInput.value = productData.width || '';
        lengthInput.value = productData.length || '';
        // packagingGuageInput.value = productData.gage || '';
        // packingWidthInput.value = productData.width || '';
        // packingLengthInput.value = productData.length || '';
        packingBhartiInput.value = productData.bharti || '';
        // packingColourInput.value = productData.bharti || '';
        var outerId = productData.outer_name || '';
            if (outerId) {
                $.ajax({
                    url: '{{ route('production-orders.byouters', ['outerId' => ':outerId']) }}'.replace(':outerId', outerId),
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            packingOuterNameiInput.value = response.name;
                        } else {
                            console.error('Material not found:', response.message);
                        }   
                    },
                    error: function(response) {
                        console.error('Error fetching orders:', response);
                    }
                });
            }
            var cartonId = productData.carton_no || '';
            // packingCartonInput.value = productData.carton_no || '';
            if (cartonId) {
                $.ajax({
                    url: '{{ route('production-orders.bycartons', ['cartonId' => ':cartonId']) }}'.replace(':cartonId', cartonId),
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            packingCartonInput.value = response.name;
                        } else {
                            console.error('Material not found:', response.message);
                        }   
                    },
                    error: function(response) {
                        console.error('Error fetching orders:', response);
                    }
                });
            }
        // packingOuterNameiInput.value = productData.outer_name || '';
        // packingCartonInput.value = productData.carton_no || '';
        StitchingBhartiInput.value = productData.bharti || '';
        StitchingBagInput.value = productData.bharti || '';
        var pendingBundleQuantity = $('#pending_bundle_quantity').val();
        // rewindingQtyInRollsInput.value = Number(pendingBundleQuantity) * Number(productData.bharti) * Number(productData.number_of_bags_per_box) || '';
        // packingQtyRollsInput.value = Number(pendingBundleQuantity) * Number(productData.bharti) * Number(productData.number_of_bags_per_box) || '';
        rewindingQtyInRollsInput.value = productData.rolls_in_1_bdl  || '';
        packingQtyRollsInput.value = productData.rolls_in_1_bdl || '';
        var salesOrderSelect = document.getElementById('sales_order');
        var selectedOption = salesOrderSelect.options[salesOrderSelect.selectedIndex];
        var bdlQty = selectedOption.getAttribute('data-bdl') || 0;
        
        var bharti = productData.bharti || 0;
        var bag = productData.number_of_bags_per_box || 0;
        var length = productData.length || 0;
        var gage = productData.gage || 0;
        var width = productData.width || 0;
        
        var totalMeters = bdlQty * bharti * bag * length;

        var productionKG = (totalMeters * 100) / (gage * width / 39.37);
        //extrusionQtyOfPackingInput .value = productionKG;
    }

    function clearFields() {
        gaugeInput.value = '';
        // widthInput.value = '';
        // lengthInput.value = '';
        // packagingGuageInput.value = '';
        // packingWidthInput.value = '';
        // packingLengthInput.value = '';
        packingBhartiInput.value = '';
        packingOuterNameiInput.value = '';
        // StitchingBhartiInput.value = '';
        // StitchingBagInput.value = '';
    }

    toggleFields();
    orderTypeSelect.addEventListener('change', toggleFields);
});
</script>
<script>
    // document.addEventListener('DOMContentLoaded', function () {
    //     const productSelect = document.getElementById('product_type');
    //     const skuSelect = document.getElementById('sku');

    //     productSelect.addEventListener('change', function () {
    //         const selectedProductId = this.value;
    //         alert(selectedProductId);
    //         const selectedProductOption = this.options[this.selectedIndex];
    //         console.log('88888');
    //         console.log(selectedProductOption);
    //         const correspondingSku = selectedProductOption.getAttribute('data-sku');

 
    //         Array.from(skuSelect.options).forEach(option => {
    //             if (option.value === correspondingSku) {
    //                 option.selected = true;
    //             } else {
    //                 option.selected = false;
    //             }
    //         });
    //     });


    //     skuSelect.addEventListener('change', function () {
    //         const selectedSku = this.value;
    //         const selectedSkuOption = this.options[this.selectedIndex];
    //         console.log(selectedSkuOption);
    //         const correspondingProductId = selectedSkuOption.getAttribute('data-product');
    //         Array.from(productSelect.options).forEach(option => {
    //             if (option.value === correspondingProductId) {
    //                 option.selected = true;
    //             } else {
    //                 option.selected = false;
    //             }
    //         });
    //     });

    //     productSelect.dispatchEvent(new Event('change'));
    //     skuSelect.dispatchEvent(new Event('change'));
    // });
    document.addEventListener('DOMContentLoaded', function () {
    const productSelect = document.getElementById('product_type');
    const skuInput = document.getElementById('sku'); // Textbox for SKU

    productSelect.addEventListener('change', function () {
        const selectedProductId = this.value;
        const selectedProductOption = this.options[this.selectedIndex];
        const correspondingSku = selectedProductOption.getAttribute('data-sku');
        skuInput.value = correspondingSku ? correspondingSku : '';
        // Array.from(skuSelect.options).forEach(option => {
        //     if (option.value === correspondingSku) {
        //         option.selected = true;
        //     } else {
        //         option.selected = false;
        //     }
        // });
    });

    // skuSelect.addEventListener('change', function () {
    //     const selectedSku = this.value;
    //     const selectedSkuOption = this.options[this.selectedIndex];
    //     const correspondingProductId = selectedSkuOption.getAttribute('data-product');
        
    //     Array.from(productSelect.options).forEach(option => {
    //         if (option.value === correspondingProductId) {
    //             option.selected = true;
    //         } else {
    //             option.selected = false;
    //         }
    //     });
    // });
});

document.addEventListener('DOMContentLoaded', function () {
    var companyNameSelect = document.getElementById('company_name');
    // var salesOrderSelect = document.getElementById('sales_order');
    // var qtyRequiredInput = document.getElementById('qty_required');
    var salesOrderSelect = document.getElementById('sales_order');
    var qtyRequiredInput = document.getElementById('qty_required');
    var pendingQtyInput = document.getElementById('pending_bundle_quantity');
    var productTypeSelect = document.getElementById('product_type');
    var remarkInput = document.getElementById('remark');
    var extrusionColourInput = document.getElementById('extrusion_colour');
    var rewindingStickerInput = document.getElementById('rewinding_sticker');
    var rewindingColourInput = document.getElementById('rewinding_colour');
    var stitchingColourInput = document.getElementById('sticching_colour');
    var packingColourInput = document.getElementById('packing_colour');
    var remarkInput = document.getElementById('remark');
    var extrusionQtyOfPackingInput = document.getElementById('extrusion_qty_of_packing');

    companyNameSelect.addEventListener('change', function () {
    const selectedCompanyId = companyNameSelect.value;

    if (selectedCompanyId) {
        // Fetch orders by customer
        $.ajax({
            url: '{{ route('production-orders.byCustomer', ['customerId' => ':customerId']) }}'.replace(':customerId', selectedCompanyId),
            type: 'GET',
            success: function(response) {
                // Clear previous options in salesOrderSelect and add a default option
                salesOrderSelect.innerHTML = '<option value="">Select Sales Order</option>';

                // Populate sales orders based on response
                response.orders.forEach(order => {
                    const salesOrderOption = document.createElement('option');
                    salesOrderOption.value = order.id;
                    salesOrderOption.textContent = order.order_id;
                    salesOrderOption.setAttribute('data-total-bundle', order.total_bundle || '');
                    
                    if (order.product_orders && order.product_orders.length > 0) {
                        const firstProductOrder = order.product_orders[0];
                        salesOrderOption.setAttribute('data-sticker', firstProductOrder.sticker_name || '');
                        salesOrderOption.setAttribute('data-colour', firstProductOrder.colour || '');
                        salesOrderOption.setAttribute('data-remark', firstProductOrder.remark || '');
                    }
                    
                    salesOrderSelect.appendChild(salesOrderOption);
                });
                salesOrderSelect.classList.remove('d-none');
            },
            error: function(response) {
                console.error('Error fetching orders:', response);
            }
        });
    } else {
        salesOrderSelect.innerHTML = '<option value="">Select Sales Order</option>';
        salesOrderSelect.classList.add('d-none');
    }
});
        productTypeSelect.addEventListener('change', function () {
            var selectedProductId = productTypeSelect.value;
            var selectedCompanyId = companyNameSelect.value;
            var salesOrderSelect = document.getElementById('sales_order');
            var salesOrderValue = salesOrderSelect.value;

            if (selectedProductId) {
                $.ajax({
                    url: '{{ route('production-orders.byProduct', ['productId' => ':productId', 'salesOrderValue' => ':salesOrderValue']) }}'
            .replace(':productId', selectedProductId)
            .replace(':salesOrderValue', salesOrderValue),
                    type: 'GET',
                    success: function(response) {
                        if (response.pending_bdl_kg == 0) {
                            toastr.error('You cannot process further production orders for this product and sales order because there is no pending quantity.');
                            qtyRequiredInput.value = '';
                            pendingQtyInput.value = '';
                            remarkInput.value = '';
                            return;
                        }
                        if (!selectedCompanyId) {
                            companyNameSelect.innerHTML = '<option value="">Select Company</option>';
                            response.companies.forEach(company => {
                                var companyOption = document.createElement('option');
                                companyOption.value = company.id;
                                companyOption.textContent = company.company_name;
                                companyNameSelect.appendChild(companyOption);
                            });
                            companyNameSelect.classList.remove('d-none');
                        }
                        qtyRequiredInput.value = response.bdl_kg;
                        var packingWeightVal = $('#packing_weight').val();
                var qty_in_rolls = $('#rewinding_qty_in_rolls').val();
                console.log('5689');
                console.log(packingWeightVal);
                console.log(qty_in_rolls);
                console.log(response.pending_bdl_kg);
                extrusionQtyOfPackingInput.value =(packingWeightVal * qty_in_rolls *response.pending_bdl_kg);
                        pendingQtyInput.value = response.pending_bdl_kg;
                        remarkInput.value = response.remark;
                    },
                    error: function(response) {
                        console.error('Error fetching companies:', response);
                    }
                });
            } else {

                companyNameSelect.innerHTML = '<option value="">Select Company</option>';
                companyNameSelect.classList.add('d-none');
            }
        });
        productTypeSelect.addEventListener('change', function () {
            var selectedProductId = productTypeSelect.value;
            var selectedCompanyId = companyNameSelect.value;
            var salesOrderSelect = document.getElementById('sales_order');
            var salesOrderValue = salesOrderSelect.value;

            if (selectedProductId) {
                $.ajax({
                    url: '{{ route('production-orders.byProduct', ['productId' => ':productId', 'salesOrderValue' => ':salesOrderValue']) }}'
            .replace(':productId', selectedProductId)
            .replace(':salesOrderValue', salesOrderValue),
                    type: 'GET',
                    success: function(response) {
                        if (!selectedCompanyId) {
                            companyNameSelect.innerHTML = '<option value="">Select Company</option>';
                            response.companies.forEach(company => {
                                var companyOption = document.createElement('option');
                                companyOption.value = company.id;
                                companyOption.textContent = company.company_name;
                                companyNameSelect.appendChild(companyOption);
                            });
                            companyNameSelect.classList.remove('d-none');
                        }
                    },
                    error: function(response) {
                        console.error('Error fetching companies:', response);
                    }
                });
            } else {

                companyNameSelect.innerHTML = '<option value="">Select Company</option>';
                companyNameSelect.classList.add('d-none');
            }
        });

        // salesOrderSelect.addEventListener('change', function () {
        //     var selectedOption = salesOrderSelect.selectedOptions[0];
        //     var totalQuantity = selectedOption ? selectedOption.getAttribute('data-bdl') : '';
        //     var stickerName = selectedOption ? selectedOption.getAttribute('data-sticker') : '';
        //     var colour = selectedOption ? selectedOption.getAttribute('data-colour') : '';
        //     var remark = selectedOption ? selectedOption.getAttribute('data-remark') : '';
        //     // qtyRequiredInput.value = totalQuantity;
        //     extrusionColourInput.value = colour;
        //     rewindingColourInput.value = colour;
        //     stitchingColourInput.value = colour;
        //     remarkInput.value = remark;
        //     rewindingStickerInput.value = stickerName; 
        // });

        salesOrderSelect.addEventListener('change', function () {
    const selectedSalesOrderId = salesOrderSelect.value;

    // Update input fields based on selected sales order attributes
    const selectedOption = salesOrderSelect.selectedOptions[0];
    const totalQuantity = selectedOption ? selectedOption.getAttribute('data-total-bundle') : '';
    const stickerName = selectedOption ? selectedOption.getAttribute('data-sticker') : '';
    const colour = selectedOption ? selectedOption.getAttribute('data-colour') : '';
    const remark = selectedOption ? selectedOption.getAttribute('data-remark') : '';
    var stickerId = stickerName || '';
    if (stickerId) {
        $.ajax({
            url: '{{ route('production-orders.bySticker', ['stickerId' => ':stickerId']) }}'.replace(':stickerId', stickerId),
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    rewindingStickerInput.value = response.name;
                    // packingStickerInput.value = response.name;
                    
                } else {
                    console.error('Material not found:', response.message);
                }   
            },
            error: function(response) {
                console.error('Error fetching orders:', response);
            }
        });
    }

    // Set input fields with data from selected sales order
    extrusionColourInput.value = colour;
    remarkInput.value = remark;
    rewindingColourInput.value = colour;
    stitchingColourInput.value = colour;
    packingColourInput.value = colour;
    // rewindingStickerInput.value = stickerName;

    if (selectedSalesOrderId) {
        // Fetch products related to the selected sales order
        $.ajax({
            url: '{{ route('production-orders.bySalesOrder', ['salesOrderId' => ':salesOrderId']) }}'.replace(':salesOrderId', selectedSalesOrderId),
            type: 'GET',
            success: function(response) {
                // Clear previous options in productTypeSelect and add a default option
                productTypeSelect.innerHTML = '<option value="">Select Product</option>';

                // Populate products based on response
                response.products.forEach(product => {
                    const productOption = document.createElement('option');
                    productOption.value = product.id;
                    productOption.textContent = product.product_name;
                    productOption.setAttribute('data-sku', product.alias_sku);
                    productOption.setAttribute('data-category', product.category);

                    productTypeSelect.appendChild(productOption);
                });
            },
            error: function(response) {
                console.error('Error fetching products:', response);
            }
        });
    } else {
        productTypeSelect.innerHTML = '<option value="">Select Product</option>';
    }
});
    });

    $(document).ready(function () {

        $(document).ready(function () {
    var previousBundleQty = Number($('#bundle_quantity').val());

    $('#bundle_quantity').on('input', function () {
        var currentBundleQty = Number($('#current_bundle_quantity').val());
        var pendingQty = Number($('#pending_bundle_quantity').val());
        var newBundleQty = Number($(this).val());
        var difference = newBundleQty - previousBundleQty;
        var updatedPendingQty = pendingQty - difference;

        console.log('updatedPendingQty', updatedPendingQty);

        $('#pending_bundle_quantity').val(updatedPendingQty);

        $('#pending_qty_display').text('Pending Quantity: ' + updatedPendingQty);
        previousBundleQty = newBundleQty;
    });
});


    $.validator.addMethod("checkpendingBundleQtyFilled", function(value, element) {
        var pendingBundleQty = $('#pending_bundle_quantity').val();
        return pendingBundleQty !== "";
    }, "Please fill Pending Bundle Quantity first.");

    $.validator.addMethod("checkBundleQuantityLessThanOrEqualToPending", function(value, element) {
    var pendingQty = Number($('#pending_bundle_quantity').val());
    var currentBundleQty = Number($('#current_bundle_quantity').val());
    return Number(value) <= (pendingQty + currentBundleQty);
}, "The bundle quantity exceeds the allowable pending quantity.");

//     $.validator.addMethod("checkPendingBundleQty", function(value, element) {
//     return parseFloat(value) > 0;
// }, "You cannot create a production order as there is no pending bundle quantity.");
$.validator.addMethod("checkPendingBundleQty", function(value, element) {
    var quantity = parseFloat(value);
    return !isNaN(quantity) && quantity >= 0; 
}, "Pending bundle quantity cannot be negative.");

    $("#productionOrderEditForm").validate({
        rules: {
            production_varient_name: {
                maxlength: 255,
            },
            product_type: {
                required: true,
                maxlength: 255,
            },
            order_type: {
                required: true,
                maxlength: 255,
            },
            company_name: {
                maxlength: 255,
                required: function(element) {
                    return $("#order_type").val() === "Make to Order";
                }
            },
            sales_order: {
                maxlength: 255,
                required: function(element) {
                    return $("#order_type").val() === "Make to Order";
                }
            },
            qty_required: {
            required: true,
            // digits: true,
            },
            pending_bundle_quantity: {
                required: true,
                checkPendingBundleQty : true,
            },
            bundle_quantity: {
                required: true,
                digits: true,
                //checkBundleQuantityLessThanOrEqualToPending: true,
            },
            sku: {
                required: true,
                maxlength: 255,
            },
            extrusion_gauge: {
                required: true,
                maxlength: 255,
            },
            extrusion_colour: {
                required: true,
                maxlength: 255,
            },
            extrusion_size: {
                required: true,
                maxlength: 255,
            },
            extrusion_recipe: {
                required: true,
                maxlength: 255,
            },
            extrusion_qty_of_packing: {
                required: true,
                number: true,
            },
            rewinding_pipe: {
                required: true,
                maxlength: 255,
            },
            rewinding_sticker: {
                required: true,
                maxlength: 255,
            },
            rewinding_qty_in_rolls: {
                required: true,
                digits: true,
                checkpendingBundleQtyFilled: true,
            },
            rewinding_colour: {
                required: true,
                maxlength: 255,
            },
            rewinding_width: {
                required: true,
                maxlength: 255,
            },
            rewinding_length: {
                required: true,
                maxlength: 255,
            },
            start_date : {
                    required: true,
                    date: true,  
                    greaterThanToday: true,
                },
            // internal_notes: {
            //     maxlength: 500,
            // },
            packing_bharti: {
                required: true,
                maxlength: 255,
            },
            packing_name: {
                required: true,
                maxlength: 255,
            },
            packing_carton: {
                required: true,
                maxlength: 255,
            },
            packing_outer_name: {
                required: true,
                maxlength: 255,
            },
            packing_qty_rolls: {
                required: true,
                digits: true,
                checkpendingBundleQtyFilled: true,
            },
            sticching_product_name: {
                required: true,
                maxlength: 255,
            },
            sticching_colour: {
                required: true,
                maxlength: 255,
            },
            sticching_packing_name: {
                required: true,
                maxlength: 255,
            },
            sticching_packing_type: {
                required: true,
                maxlength: 255,
            },
            sticching_bag: {
                required: true,
                maxlength: 255,
            },
        },
        messages: {
            production_varient_name: {
                maxlength: "Production Varient Name cannot exceed 255 characters.",
            },
            product_type: {
                required: "Please select Product Name.",
                maxlength: "Product Type cannot exceed 255 characters.",
            },
            order_type: {
                required: "Please select Order Type.",
                maxlength: "Order Type cannot exceed 255 characters.",
            },
            company_name: {
                required: "Please select Company Name.",
                maxlength: "Company Name cannot exceed 255 characters.",
            },
            sales_order: {
                required: "Please select Sales Order.",
                maxlength: "Sales Order cannot exceed 255 characters.",
            },
            qty_required: {
                required: "Please enter Total Bundle Quantity.",
                digits: "Please enter a valid integer.",
            },
            pending_bundle_quantity: {
                required: "Please enter Pending Bundle Quantity.",
                digits: "Please enter a valid number.",
                // checkQtyRequiredFilled: "Please fill Bundle Quantity first.",
            },
            bundle_quantity: {
                required: "Please enter Bundle Quantity.",
                digits: "Please enter a valid number.",
            },
            sku: {
                required: "Please select SKU.",
                maxlength: "SKU cannot exceed 255 characters.",
            },
            extrusion_gauge: {
                required: "Please enter Extrusion Gauge.",
                maxlength: "Extrusion Gauge cannot exceed 255 characters.",
            },
            extrusion_colour: {
                required: "Please enter Extrusion Colour.",
                maxlength: "Extrusion Colour cannot exceed 255 characters.",
            },
            extrusion_size: {
                required: "Please enter Extrusion Size.",
                maxlength: "Extrusion Size cannot exceed 255 characters.",
            },
            extrusion_recipe: {
                required: "Please enter Extrusion Recipe.",
                maxlength: "Extrusion Recipe cannot exceed 255 characters.",
            },
            extrusion_qty_of_packing: {
                required: "Please enter Extrusion Quantity of Packing.",
                digits: "Please enter integer.",
            },
            rewinding_pipe: {
                required: "Please enter Rewinding Pipe.",
                maxlength: "Rewinding Pipe cannot exceed 255 characters.",
            },
            rewinding_sticker: {
                required: "Please enter Rewinding Sticker.",
                maxlength: "Rewinding Sticker cannot exceed 255 characters.",
            },
            rewinding_qty_in_rolls: {
                required: "Please enter Rewinding Quantity in Rolls.",
                digits: "Please enter a valid integer.",
            },
            rewinding_colour: {
                required: "Please enter Rewinding Colour.",
                maxlength: "Rewinding Colour cannot exceed 255 characters.",
            },
            rewinding_width: {
                required: "Please enter Rewinding Width.",
                maxlength: "Rewinding Width cannot exceed 255 characters.",
            },
            rewinding_length: {
                required: "Please enter Rewinding Length.",
                maxlength: "Rewinding Length cannot exceed 255 characters.",
            },
            start_date : {
                    required: "Please enter Start Date.",
                    date: "Please enter a valid date."
                },
            // internal_notes: {
            //     maxlength: "Internal Notes cannot exceed 500 characters.",
            // },
            packing_bharti: {
                required: "Please enter Packing Details Bharti.",
                maxlength: "Packing Bharti cannot exceed 255 characters.",
            },
            packing_name: {
                required: "Please enter Packing Details name.",
                maxlength: "Packing Name cannot exceed 255 characters.",
            },
            packing_carton: {
                required: "Please enterPacking Details Carton.",
                maxlength: "Packing Carton cannot exceed 255 characters.",
            },
            packing_outer_name: {
                required: "Please enter Packing Details Outer Name.",
                maxlength: "Packing Outer Name cannot exceed 255 characters.",
            },
            packing_qty_rolls: {
                required: "Please enter Packing Details QTY Rolls.",
                digits: "Please enter a valid integer.",
            },
            sticching_product_name: {
                required: "Please enter Stitching Product Name.",
                maxlength: "Stitching Product Name cannot exceed 255 characters.",
            },
            sticching_colour: {
                required: "Please enter Stitching Colour.",
                maxlength: "Stitching Colour cannot exceed 255 characters.",
            },
            sticching_packing_name: {
                required: "Please enter Stitching Packing Name.",
                maxlength: "Stitching Packing Name cannot exceed 255 characters.",
            },
            sticching_packing_type: {
                required: "Please enter Stitching Packing Type.",
                maxlength: "Stitching Packing Type cannot exceed 255 characters.",
            },
            sticching_bag: {
                required: "Please enter Stitching Bag/box.",
                maxlength: "Stitching Bag cannot exceed 255 characters.",
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });

    jQuery.validator.addMethod("filesize", function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param * 1024);
    });
    $.validator.addMethod("greaterThanToday", function(value, element) {
            var today = new Date();
            today.setHours(0, 0, 0, 0); // Remove time part to compare only date
            var inputDate = new Date(value);
            return this.optional(element) || inputDate > today;
        }, "The Start date must be greater than or equal to today's date.");
});
// $(document).ready(function () {
//     $("#productionOrderEditForm").validate({
//         rules: {
//             production_varient_name: {
//                 maxlength: 255,
//             },
//             product_type: {
//                 required: true,
//                 maxlength: 255,
//             },
//             order_type: {
//                 required: true,
//                 maxlength: 255,
//             },
//             company_name: {
//                 maxlength: 255,
//                 required: function(element) {
//                     return $("#order_type").val() === "Make to Order";
//                 }
//             },
//             sales_order: {
//                 maxlength: 255,
//                 required: function(element) {
//                     return $("#order_type").val() === "Make to Order";
//                 }
//             },
//             qty_required: {
//                 required: true,
//                 digits: true,
//             },
//             sku: {
//                 required: true,
//                 maxlength: 255,
//             },
//             extrusion_gauge: {
//                 required: true,
//                 maxlength: 255,
//             },
//             extrusion_colour: {
//                 required: true,
//                 maxlength: 255,
//             },
//             extrusion_size: {
//                 required: true,
//                 maxlength: 255,
//             },
//             extrusion_recipe: {
//                 required: true,
//                 maxlength: 255,
//             },
//             extrusion_qty_of_packing: {
//                 required: true,
//                 digits: true,
//             },
//             rewinding_pipe: {
//                 required: true,
//                 maxlength: 255,
//             },
//             rewinding_sticker: {
//                 required: true,
//                 maxlength: 255,
//             },
//             rewinding_qty_in_rolls: {
//                 required: true,
//                 digits: true,
//             },
//             rewinding_colour: {
//                 required: true,
//                 maxlength: 255,
//             },
//             rewinding_width: {
//                 required: true,
//                 maxlength: 255,
//             },
//             rewinding_qty_in_bundle: {
//                 required: true,
//                 digits: true,
//             },
//             rewinding_length: {
//                 required: true,
//                 maxlength: 255,
//             },
//             start_date: {
//                 required: true,
//                 date: true,
//             },
//             internal_notes: {
//                 maxlength: 500, 
//             },
//             packing_gauge: {
//                 required: true,
//                 maxlength: 255,
//             },
//             packing_colour: {
//                 required: true,
//                 maxlength: 255,
//             },
//             packing_width: {
//                 required: true,
//                 maxlength: 255,
//             },
//             packing_length: {
//                 required: true,
//                 maxlength: 255,
//             },
//             packing_bharti: {
//                 required: true,
//                 maxlength: 255,
//             },
//             packing_name: {
//                 required: true,
//                 maxlength: 255,
//             },
//             packing_sticker: {
//                 required: true,
//                 maxlength: 255,
//             },
//             packing_carton: {
//                 required: true,
//                 maxlength: 255,
//             },
//             packing_pipe: {
//                 required: true,
//                 maxlength: 255,
//             },
//             packing_outer_name: {
//                 required: true,
//                 maxlength: 255,
//             },
//             packing_qty_rolls: {
//                 required: true,
//                 digits: true,
//             },
//             packing_qty_bundle: {
//                 required: true,
//                 digits: true,
//             },
//             sticching_product_name: {
//                 required: true,
//                 maxlength: 255,
//             },
//             sticching_colour: {
//                 required: true,
//                 maxlength: 255,
//             },
//             sticching_packing_name: {
//                 required: true,
//                 maxlength: 255,
//             },
//             sticching_packing_type: {
//                 required: true,
//                 maxlength: 255,
//             },
//             sticching_qty_bundle: {
//                 required: true,
//                 digits: true,
//             },
//             sticching_bharti: {
//                 required: true,
//                 maxlength: 255,
//             },
//             sticching_qty_rolls: {
//                 required: true,
//                 digits: true,
//             },
//             sticching_bag: {
//                 required: true,
//                 maxlength: 255,
//             },
//         },
//         messages: {
//             production_varient_name: {
//                 maxlength: "Production Varient Name cannot exceed 255 characters.",
//             },
//             product_type: {
//                 required: "Product Type is required.",
//                 maxlength: "Product Type cannot exceed 255 characters.",
//             },
//             order_type: {
//                 required: "Order Type is required.",
//                 maxlength: "Order Type cannot exceed 255 characters.",
//             },
//             company_name: {
//                 maxlength: "Company Name cannot exceed 255 characters.",
//             },
//             sales_order: {
//                 maxlength: "Sales Order cannot exceed 255 characters.",
//             },
//             qty_required: {
//                 required: "Quantity Required is required.",
//                 digits: "Please enter a valid integer.",
//             },
//             sku: {
//                 required: "SKU is required.",
//                 maxlength: "SKU cannot exceed 255 characters.",
//             },
//             extrusion_gauge: {
//                 required: "Extrusion Gauge is required.",
//                 maxlength: "Extrusion Gauge cannot exceed 255 characters.",
//             },
//             extrusion_colour: {
//                 required: "Extrusion Colour is required.",
//                 maxlength: "Extrusion Colour cannot exceed 255 characters.",
//             },
//             extrusion_size: {
//                 required: "Extrusion Size is required.",
//                 maxlength: "Extrusion Size cannot exceed 255 characters.",
//             },
//             extrusion_recipe: {
//                 required: "Extrusion Recipe is required.",
//                 maxlength: "Extrusion Recipe cannot exceed 255 characters.",
//             },
//             extrusion_qty_of_packing: {
//                 required: "Extrusion Quantity of Packing is required.",
//                 digits: "Please enter a valid integer.",
//             },
//             rewinding_pipe: {
//                 required: "Rewinding Pipe is required.",
//                 maxlength: "Rewinding Pipe cannot exceed 255 characters.",
//             },
//             rewinding_sticker: {
//                 required: "Rewinding Sticker is required.",
//                 maxlength: "Rewinding Sticker cannot exceed 255 characters.",
//             },
//             rewinding_qty_in_rolls: {
//                 required: "Rewinding Quantity in Rolls is required.",
//                 digits: "Please enter a valid integer.",
//             },
//             rewinding_colour: {
//                 required: "Rewinding Colour is required.",
//                 maxlength: "Rewinding Colour cannot exceed 255 characters.",
//             },
//             rewinding_width: {
//                 required: "Rewinding Width is required.",
//                 maxlength: "Rewinding Width cannot exceed 255 characters.",
//             },
//             rewinding_qty_in_bundle: {
//                 required: "Rewinding Quantity in Bundle is required.",
//                 digits: "Please enter a valid integer.",
//             },
//             rewinding_length: {
//                 required: "Rewinding Length is required.",
//                 maxlength: "Rewinding Length cannot exceed 255 characters.",
//             },
//             start_date: {
//                 required: "Start Date is required.",
//                 date: "Please enter a valid date.",
//             },
//             internal_notes: {
//                 maxlength: "Internal Notes cannot exceed 500 characters.",
//             },
//             packing_gauge: {
//                 required: "Packing Gauge is required.",
//                 maxlength: "Packing Gauge cannot exceed 255 characters.",
//             },
//             packing_colour: {
//                 required: "Packing Colour is required.",
//                 maxlength: "Packing Colour cannot exceed 255 characters.",
//             },
//             packing_width: {
//                 required: "Packing Width is required.",
//                 maxlength: "Packing Width cannot exceed 255 characters.",
//             },
//             packing_length: {
//                 required: "Packing Length is required.",
//                 maxlength: "Packing Length cannot exceed 255 characters.",
//             },
//             packing_bharti: {
//                 required: "Packing Bharti is required.",
//                 maxlength: "Packing Bharti cannot exceed 255 characters.",
//             },
//             packing_name: {
//                 required: "Packing Name is required.",
//                 maxlength: "Packing Name cannot exceed 255 characters.",
//             },
//             packing_sticker: {
//                 required: "Packing Sticker is required.",
//                 maxlength: "Packing Sticker cannot exceed 255 characters.",
//             },
//             packing_carton: {
//                 required: "Packing Carton is required.",
//                 maxlength: "Packing Carton cannot exceed 255 characters.",
//             },
//             packing_pipe: {
//                 required: "Packing Pipe is required.",
//                 maxlength: "Packing Pipe cannot exceed 255 characters.",
//             },
//             packing_outer_name: {
//                 required: "Packing Outer Name is required.",
//                 maxlength: "Packing Outer Name cannot exceed 255 characters.",
//             },
//             packing_qty_rolls: {
//                 required: "Packing Quantity in Rolls is required.",
//                 digits: "Please enter a valid integer.",
//             },
//             packing_qty_bundle: {
//                 required: "Packing Quantity in Bundle is required.",
//                 digits: "Please enter a valid integer.",
//             },
//             sticching_product_name: {
//                 required: "Sticching Product Name is required.",
//                 maxlength: "Sticching Product Name cannot exceed 255 characters.",
//             },
//             sticching_colour: {
//                 required: "Sticching Colour is required.",
//                 maxlength: "Sticching Colour cannot exceed 255 characters.",
//             },
//             sticching_packing_name: {
//                 required: "Sticching Packing Name is required.",
//                 maxlength: "Sticching Packing Name cannot exceed 255 characters.",
//             },
//             sticching_packing_type: {
//                 required: "Sticching Packing Type is required.",
//                 maxlength: "Sticching Packing Type cannot exceed 255 characters.",
//             },
//             sticching_qty_bundle: {
//                 required: "Sticching Quantity in Bundle is required.",
//                 digits: "Please enter a valid integer.",
//             },
//             sticching_bharti: {
//                 required: "Sticching Bharti is required.",
//                 maxlength: "Sticching Bharti cannot exceed 255 characters.",
//             },
//             sticching_qty_rolls: {
//                 required: "Sticching Quantity in Rolls is required.",
//                 digits: "Please enter a valid integer.",
//             },
//             sticching_bag: {
//                 required: "Sticching Bag is required.",
//                 maxlength: "Sticching Bag cannot exceed 255 characters.",
//             },
//         },
//         errorElement: 'span',
//         errorPlacement: function (error, element) {
//             error.addClass('text-danger');
//             error.insertAfter(element);
//         },
//         highlight: function (element, errorClass, validClass) {
//             $(element).addClass('is-invalid').removeClass('is-valid');
//         },
//         unhighlight: function (element, errorClass, validClass) {
//             $(element).removeClass('is-invalid').addClass('is-valid');
//         }
//     });

//     jQuery.validator.addMethod("filesize", function (value, element, param) {
//         return this.optional(element) || (element.files[0].size <= param * 1024);
//     });
// });
</script>
@endsection
