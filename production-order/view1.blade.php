@extends('layouts.app')
@section('navbarTitel', 'Work Order')
@section('content')

<div class="main-outer">  
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Edit the Work Order</span>
                <div class="prd-order-data">
                    <button type="button" id="Button" class="orderList"><span class="back-icons back-tab-icon"></span></button>
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
                                <option value="">Select Product Type</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-sku="{{ $product->alias_sku }}" data-category="{{$product->category}}" {{ (old('product_type') ? old('product_type') : $productionOrder->product_type) == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                                    @endforeach
                            </select>
                            @error('product_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
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
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content"  for="category">Lamination Name</label>
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
                            <label class="heading-content" for="extrusion_qty_of_packing">Quantity of Packing<span style="color: red;">*</span></label>
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
                        </div>
                    </div>
                </div>
        </div>
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
        $(document).on('click','#Button', function(){
            window.location.href = "{{ route('production_order.index') }}";
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
                    $('#packingDetails h6').text('Step 4 - Packing Details');
                    $('#stitchingproduction h6').text('Step 3 - Silai');
                    $('#pipeSize').attr('style', 'display:none;'); // Hide pipe size
                } else if (category == '2') {
                    // $('#extrusionProduction h6').text('Step 2 - Extrusion');
                    $('#extrusionProduction').attr('style', 'display:none;');
                    $('#RewindingProduction h6').text('Step 2 - Rewinding');
                    $('#packingDetails h6').text('Step 4 - Packing Details');
                    $('#stitchingproduction h6').text('Step 3 - Silai');
                    $('#laminationProduction').show(); // Show lamination section
                } else {
                    $('#extrusionProduction h6').text('Step 1 - Extrusion');
                    $('#extrusionProduction').removeAttr('style');
                    $('#RewindingProduction h6').text('Step 2 - Rewinding');
                    $('#packingDetails h6').text('Step 4 - Packing Details');
                    $('#stitchingproduction h6').text('Step 3 - Silai');
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
                    $('#packingDetails h6').text('Step 4 - Packing Details');
                    $('#stitchingproduction h6').text('Step 3 - Silai');
                    $('#pipeSize').attr('style', 'display:none;'); // Hide pipe size
                } else if (category == '2') {
                    // $('#extrusionProduction h6').text('Step 2 - Extrusion');
                    $('#extrusionProduction').attr('style', 'display:none;');
                    $('#RewindingProduction h6').text('Step 2 - Rewinding');
                    $('#packingDetails h6').text('Step 4 - Packing Details');
                    $('#stitchingproduction h6').text('Step 3 - Silai');
                    $('#laminationProduction').show(); // Show lamination section
                } else {
                    $('#extrusionProduction h6').text('Step 1 - Extrusion');
                    $('#extrusionProduction').removeAttr('style');
                    $('#RewindingProduction h6').text('Step 2 - Rewinding');
                    $('#packingDetails h6').text('Step 4 - Packing Details');
                    $('#stitchingproduction h6').text('Step 3 - Silai');
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
    var extrusionQtyOfPackingInput = document.getElementById('extrusion_qty_of_packing');
    var packingNameInput = document.getElementById('packing_name');
    // var packingWidthInput = document.getElementById('packing_width');
    // var packingLengthInput = document.getElementById('packing_length');
    var packingBhartiInput = document.getElementById('packing_bharti');
    var packingOuterNameiInput = document.getElementById('packing_outer_name');
    var packingCartonInput = document.getElementById('packing_carton');
    var SticchingPackingNameInput = document.getElementById('sticching_packing_name');
    var SticchingPackingTypeInput = document.getElementById('sticching_packing_type');
    // var StitchingBhartiInput = document.getElementById('sticching_bharti');
    // var StitchingBagInput = document.getElementById('sticching_bag');
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

            productTypeSelect.removeEventListener('change', productTypeChangeHandler);
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
        packingOuterNameiInput.value = productData.outer_name || '';
        packingCartonInput.value = productData.carton_no || '';
        // StitchingBhartiInput.value = productData.bharti || '';
        // StitchingBagInput.value = productData.bharti || '';
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
        extrusionQtyOfPackingInput .value = productionKG;
    }

    function clearFields() {
        gaugeInput.value = '';
        widthInput.value = '';
        lengthInput.value = '';
        packagingGuageInput.value = '';
        packingWidthInput.value = '';
        packingLengthInput.value = '';
        packingBhartiInput.value = '';
        packingOuterNameiInput.value = '';
        StitchingBhartiInput.value = '';
        StitchingBagInput.value = '';
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
    var extrusionColourInput = document.getElementById('extrusion_colour');
    var rewindingStickerInput = document.getElementById('rewinding_sticker');
    var rewindingColourInput = document.getElementById('rewinding_colour');
    var stitchingColourInput = document.getElementById('sticching_colour');
    var remarkInput = document.getElementById('remark');

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
                        pendingQtyInput.value = response.pending_bdl_kg;
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

    // Set input fields with data from selected sales order
    extrusionColourInput.value = colour;
    remarkInput.value = remark;
    rewindingColourInput.value = colour;
    stitchingColourInput.value = colour;
    rewindingStickerInput.value = stickerName;

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
});
</script>
@endsection
