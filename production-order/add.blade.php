@extends('layouts.app')
@section('navbarTitel', 'Work Order')
@section('content')

<div class="main-outer">
    <form id="productionOrderAddForm" action="{{ route('production_order.store') }}" method="post">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Create a Work Order</span>
                <div class="prd-order-data">
                    <!-- <div class="button-1 cta_btn prd-odr-btn">
                        <button type="submit" class="primary-button stock-btn">Save</button>
                    </div> -->
                    <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
                    <!-- <div class="btn-sec btn_group">
                        <a href="{{route('production_order.store')}}">
                            <span class="back-icons back-tab-icon"></span>
                        </a>
                    </div> -->
                </div>
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    @csrf
                    <div class="row form-inp-group">
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="order_type">Order Type<span style="color: red;">*</span></label>
                            <select class="custom-select select2 d-block w-100 form-select-grp form-control @error('order_type') is-invalid @enderror @if(old('order_type')) is-valid @endif" name="order_type" id="order_type">
                                <!-- <option value="">Select Order Type</option>     -->
                                <option value="Make to Order">Make to Order</option>
                                <option value="Make to Stock">Make to Stock</option>
                            </select>
                            @error('order_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class= "col-lg-4 mb-3 d-none" id="make_to_order_company_name">
                            <label class="heading-content" for="company_name">Company Name<span style="color: red;">*</span></label>
                            <select class="form-control select2 form-select-grp @error('company_name') is-invalid @enderror @if(old('company_name')) is-valid @endif" name="company_name" id="company_name">
                                <option value="">Select Company Name</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('company_name') == $customer->id ? 'selected' : '' }}>{{ $customer->company_name }}</option>
                                @endforeach
                            </select>
                            @error('company_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3 d-none" id="make_to_order_sales_order">
                            <label class="heading-content" for="sales_order">Sales Order<span style="color: red;">*</span></label>
                            <select class="form-control select2 form-select-grp @error('sales_order') is-invalid @enderror @if(old('sales_order')) is-valid @endif" name="sales_order" id="sales_order">
                                <option value="">Select Sales Order</option>
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
                                    <option class="product_nm_inpp" value="{{ $product->id }}" data-sku="{{ $product->alias_sku }}" data-category="{{$product->category}}" {{ old('product_type') == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
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
                                
                                    <option value="{{ $product->alias_sku }}" data-category="{{ $product->category }}" data-product="{{ $product->id }}" {{ old('sku') == $product->alias_sku ? 'selected' : '' }}>{{ $product->alias_sku }}</option>
                                @endforeach
                            </select>
                            @error('sku')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> -->
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="sku">SKU<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('sku') is-invalid @enderror @if(old('sku')) is-valid @endif" name="sku" id="sku" value="{{ old('sku') }}" placeholder="Enter SKU">
                            @error('sku')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="qty_required">Total Bundle Quantity<span style="color: red;">*</span></label>
                            <input type="number" class="form-control @error('qty_required') is-invalid @enderror @if(old('qty_required')) is-valid @endif" name="qty_required" id="qty_required" placeholder="Quantity Required" value="{{ old('qty_required') }}">
                            @error('qty_required')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="pending_bundle_quantity">Pending Bundle Quantity<span style="color: red;">*</span></label>
                            <input type="number" class="form-control @error('pending_bundle_quantity') is-invalid @enderror @if(old('pending_bundle_quantity')) is-valid @endif" name="pending_bundle_quantity" id="pending_bundle_quantity" placeholder="Pending Bundle Quantity" value="{{ old('pending_bundle_quantity') }}">
                            @error('pending_bundle_quantity')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="hidden" class="form-control @error('roll_in_one_bdl') is-invalid @enderror @if(old('roll_in_one_bdl')) is-valid @endif" name="roll_in_one_bdl" id="roll_in_one_bdl" value="">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="remark">Remark</label>
                            <input type="text" class="form-control @error('remark') is-invalid @enderror @if(old('remark')) is-valid @endif" name="remark" id="remark" placeholder="Remark" value="{{ old('remark') }}">
                            @error('remark')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="bundle_quantity">Required Bundle Quantity<span style="color: red;">*</span></label>
                            <input type="number" class="form-control @error('bundle_quantity') is-invalid @enderror @if(old('bundle_quantity')) is-valid @endif" name="bundle_quantity" id="bundle_quantity" placeholder="Bundle Quantity" value="{{ old('bundle_quantity') }}">
                            @error('bundle_quantity')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="outer card" id="laminationProduction" style="display:none">
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
                            <!-- <input type="text" class="form-control @error('lamination_paper_name') is-invalid @enderror @if(old('lamination_paper_name')) is-valid @endif" name="lamination_paper_name" id="lamination_paper_name" placeholder="Lamination Paper Name" value="{{ old('lamination_paper_name') }}">
                            @error('lamination_paper_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror -->

                            <select name="lamination_paper_name" class="custom-select d-block w-100 form-select-grps form-control select2">
                                <option value="">Select Paper Name</option>
                                @foreach($laminationpapernames as $lamination)
                                    <option value="{{ $lamination->id }}" {{ old('lamination_paper_name') == $lamination->id ? 'selected' : '' }}>{{ $lamination->material_name }}</option>
                                @endforeach    
                            </select>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content"  for="category">Film Name</label>
                            <select name="lamination_name" id="lamination_name" class="custom-select d-block w-100 form-select-grps form-control select2">
                                <option class="option-desgn" value="" hidden>Select Lamination Name</option>
                                @foreach($laminationnames as $lamination)
                                    <option value="{{ $lamination->id }}" {{ old('lamination_name') == $lamination->id ? 'selected' : '' }}>{{ $lamination->material_name }}</option>
                                @endforeach  
                            </select>
                            @error('lamination_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content"  for="category">Lamination Gum Name</label>
                            <select name="lamination_gun_name" id="lamination_gun_name" class="custom-select d-block w-100 form-select-grps form-control select2">
                                <option class="option-desgn" value="" hidden>Select Gum Name</option>
                                @foreach($laminationgums as $lamination)
                                    <option value="{{ $lamination->id }}" {{ old('lamination_gun_name') == $lamination->id ? 'selected' : '' }}>{{ $lamination->material_name }}</option>
                                @endforeach  
                            </select>
                            @error('lamination_gun_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content"  for="lamination_type">Lamination Type</label>
                            <select name="lamination_type" id="lamination_type" class="custom-select d-block w-100 form-select-grps form-control select2">
                                <option class="option-desgn" value="" hidden>Select</option>
                                <option value="Cutter"{{ old('lamination_type') == 'Cutter' ? 'selected' : '' }}>Cutter</option>
                                <option value="Stip"{{ old('lamination_type') == 'Stip' ? 'selected' : '' }}>Stip</option>
                                <option value="Full"{{ old('lamination_type') == 'Full' ? 'selected' : '' }}>Full</option>
                            </select>
                            @error('lamination_gun_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="lamination_internal_notes">Internal Notes</label>
                            <input type="text" class="form-control internal-inp @error('lamination_internal_notes') is-invalid @enderror @if(old('lamination_internal_notes')) is-valid @endif" name="lamination_internal_notes" id="lamination_internal_notes" value="{{ old('lamination_internal_notes') }}" placeholder="Lamination Extrusion Internal Notes">
                            @error('lamination_internal_notes')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="outer card"id="extrusionProduction">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Order Specification</span>
            </div>
            <hr class="addsupplier-section-border">
            <h6 class="prdctn-odr-heading" >Step 1 - Extrusion</h6>
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="extrusion_gauge">Gauge<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('extrusion_gauge') is-invalid @enderror @if(old('extrusion_gauge')) is-valid @endif" name="extrusion_gauge" id="extrusion_gauge" placeholder="Gauge" value="{{ old('extrusion_gauge') }}">
                            @error('extrusion_gauge')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="extrusion_colour">Colour<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('extrusion_colour') is-invalid @enderror @if(old('extrusion_colour')) is-valid @endif" name="extrusion_colour" id="extrusion_colour" placeholder="Colour" value="{{ old('extrusion_colour') }}">
                            @error('extrusion_colour')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="extrusion_size">Size<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('extrusion_size') is-invalid @enderror @if(old('extrusion_size')) is-valid @endif" name="extrusion_size" id="extrusion_size" placeholder="Size" value="{{ old('extrusion_size') }}">
                            @error('extrusion_size')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="extrusion_recipe">Recipe<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('extrusion_recipe') is-invalid @enderror @if(old('extrusion_recipe')) is-valid @endif" name="extrusion_recipe" id="extrusion_recipe" placeholder="Recipe" value="{{ old('extrusion_recipe') }}">
                            @error('extrusion_recipe')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="extrusion_qty_of_packing">Quantity (in KG)<span style="color: red;">*</span></label>
                            <input type="number" class="form-control @error('extrusion_qty_of_packing') is-invalid @enderror @if(old('extrusion_qty_of_packing')) is-valid @endif" name="extrusion_qty_of_packing" id="extrusion_qty_of_packing" placeholder="Quantity of Packing" value="{{ old('extrusion_qty_of_packing') }}">
                            @error('extrusion_qty_of_packing')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="extrusion_internal_notes">Internal Notes</label>
                            <input type="text" class="form-control internal-inp @error('extrusion_internal_notes') is-invalid @enderror @if(old('extrusion_internal_notes')) is-valid @endif" name="extrusion_internal_notes" id="extrusion_internal_notes" value="{{ old('extrusion_internal_notes') }}" placeholder="Extrusion Internal Notes">
                            @error('extrusion_internal_notes')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
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
                        <div class="col-lg-3 mb-3" id="pipeSize">
                            <label class="heading-content" for="rewinding_pipe">Pipe<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('rewinding_pipe') is-invalid @enderror @if(old('rewinding_pipe')) is-valid @endif" name="rewinding_pipe" id="rewinding_pipe" placeholder="Pipe" value="{{ old('rewinding_pipe') }}">
                            @error('rewinding_pipe')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="rewinding_sticker">Sticker<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('rewinding_sticker') is-invalid @enderror @if(old('rewinding_sticker')) is-valid @endif" name="rewinding_sticker" id="rewinding_sticker" placeholder="Sticker" value="{{ old('rewinding_sticker') }}">
                            @error('rewinding_sticker')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="rewinding_qty_in_rolls">Quantity in Rolls<span style="color: red;">*</span></label>
                            <input type="number" class="form-control @error('rewinding_qty_in_rolls') is-invalid @enderror @if(old('rewinding_qty_in_rolls')) is-valid @endif" name="rewinding_qty_in_rolls" id="rewinding_qty_in_rolls" placeholder="Quantity in Rolls" value="{{ old('rewinding_qty_in_rolls') }}">
                            @error('rewinding_qty_in_rolls')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="rewinding_colour">Colour<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('rewinding_colour') is-invalid @enderror @if(old('rewinding_colour')) is-valid @endif" name="rewinding_colour" id="rewinding_colour" placeholder="Colour" value="{{ old('rewinding_colour') }}">
                            @error('rewinding_colour')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="rewinding_width">Width<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('rewinding_width') is-invalid @enderror @if(old('rewinding_width')) is-valid @endif" name="rewinding_width" id="rewinding_width" placeholder="Width" value="{{ old('rewinding_width') }}">
                            @error('rewinding_width')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="rewinding_qty_in_bundle">Quantity in Bundle<span style="color: red;">*</span></label>
                            <input type="number" class="form-control @error('rewinding_qty_in_bundle') is-invalid @enderror @if(old('rewinding_qty_in_bundle')) is-valid @endif" name="rewinding_qty_in_bundle" id="rewinding_qty_in_bundle" placeholder="Quantity in Bundle" value="{{ old('rewinding_qty_in_bundle') }}">
                            @error('rewinding_qty_in_bundle')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> -->
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="rewinding_length">Length<span style="color: red;">*</span></label>
                            <input type="number" class="form-control @error('rewinding_length') is-invalid @enderror @if(old('rewinding_length')) is-valid @endif" name="rewinding_length" id="rewinding_length" placeholder="Length" value="{{ old('rewinding_length') }}">
                            @error('rewinding_length')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="rewinding_internal_notes">Internal Notes</label>
                            <input type="text" class="form-control  internal-inp @error('rewinding_internal_notes') is-invalid @enderror @if(old('rewinding_internal_notes')) is-valid @endif" name="rewinding_internal_notes" id="rewinding_internal_notes" value="{{ old('rewinding_internal_notes') }}"placeholder="Rewinding Internal Notes">
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
            <h6 class="prdctn-odr-heading">Step 4 - Packing</h6>
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="packing_bharti">Bharti<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('packing_bharti') is-invalid @enderror @if(old('packing_bharti')) is-valid @endif" name="packing_bharti" id="packing_bharti" placeholder="Bharti" value="{{ old('packing_bharti') }}">
                            @error('packing_bharti')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="packing_name">Packing Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('packing_name') is-invalid @enderror @if(old('packing_name')) is-valid @endif" name="packing_name" id="packing_name" placeholder="Packing Name" value="{{ old('packing_name') }}">
                            @error('packing_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="hidden" class="form-control @error('packing_weight') is-invalid @enderror @if(old('packing_weight')) is-valid @endif" name="packing_weight" id="packing_weight" value="">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="packing_carton">Carton<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('packing_carton') is-invalid @enderror @if(old('packing_carton')) is-valid @endif" name="packing_carton" id="packing_carton" placeholder="Packing Carton" value="{{ old('packing_carton') }}">
                            @error('packing_carton')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="packing_outer_name">Outer Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('packing_outer_name') is-invalid @enderror @if(old('packing_outer_name')) is-valid @endif" name="packing_outer_name" id="packing_outer_name" placeholder="Packing Outer Name" value="{{ old('packing_outer_name') }}">
                            @error('packing_outer_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="packing_qty_rolls">QTY Rolls<span style="color: red;">*</span></label>
                            <input type="number" class="form-control @error('packing_qty_rolls') is-invalid @enderror @if(old('packing_qty_rolls')) is-valid @endif" name="packing_qty_rolls" id="packing_qty_rolls" placeholder="QTY Rolls" value="{{ old('packing_qty_rolls') }}">
                            @error('packing_qty_rolls')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="packing_colour">Colour</label>
                            <input type="text" class="form-control  internal-inp @error('packing_colour') is-invalid @enderror @if(old('packing_colour')) is-valid @endif" name="packing_colour" id="packing_colour" value="{{ old('packing_colour') }}" placeholder="Colour">
                            @error('packing_colour')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="packing_internal_notes">Sticker</label>
                            <input type="text" class="form-control  internal-inp @error('packing_sticker') is-invalid @enderror @if(old('packing_sticker')) is-valid @endif" name="packing_sticker" id="packing_sticker" value="{{ old('packing_sticker') }}" placeholder="Sticker">
                            @error('packing_sticker')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="packing_internal_notes">Internal Notes</label>
                            <input type="text" class="form-control  internal-inp @error('packing_internal_notes') is-invalid @enderror @if(old('packing_internal_notes')) is-valid @endif" name="packing_internal_notes" id="packing_internal_notes" value="{{ old('packing_internal_notes') }}" placeholder="Packing Internal Notes">
                            @error('packing_internal_notes')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="outer card"id="stitchingproduction">       
            <h6 class="prdctn-odr-heading">Step 3 - Silai</h6>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="sticching_product_name">Product Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('sticching_product_name') is-invalid @enderror @if(old('sticching_product_name')) is-valid @endif" name="sticching_product_name" id="sticching_product_name" placeholder="Product Name" value="{{ old('sticching_product_name') }}">
                            @error('sticching_product_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="sticching_colour">Colour<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('sticching_colour') is-invalid @enderror @if(old('sticching_colour')) is-valid @endif" name="sticching_colour" id="sticching_colour" placeholder="Colour" value="{{ old('sticching_colour') }}">
                            @error('sticching_colour')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="sticching_packing_name">Packing Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('sticching_packing_name') is-invalid @enderror @if(old('sticching_packing_name')) is-valid @endif" name="sticching_packing_name" id="sticching_packing_name" placeholder="Packing Name" value="{{ old('sticching_packing_name') }}">
                            @error('sticching_packing_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="sticching_packing_type">Packing Type<span style="color: red;">*</span></label>
                            <!-- <select id="packingTypedata" name="sticching_packing_type" class="form-control">
                                <option value="">Select an option</option>
                            </select> -->
                            <input type="text" class="form-control @error('sticching_packing_type') is-invalid @enderror @if(old('sticching_packing_type')) is-valid @endif" name="sticching_packing_type" id="sticching_packing_type" placeholder="Packing Type" value="{{ old('sticching_packing_type') }}">
                            @error('sticching_packing_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="sticching_bag">Bag/box</label>
                            <input type="text" class="form-control @error('sticching_bag') is-invalid @enderror @if(old('sticching_bag')) is-valid @endif" name="sticching_bag" id="sticching_bag" placeholder="Bag/box" value="{{ old('sticching_bag') }}">
                            @error('sticching_bag')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="sticching_bharti">Bharti</label>
                            <input type="text" class="form-control @error('sticching_bharti') is-invalid @enderror @if(old('sticching_bharti')) is-valid @endif" name="sticching_bharti" id="sticching_bharti" placeholder="Bharti" value="{{ old('sticching_bharti') }}">
                            @error('sticching_bharti')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="Stitching_internal_notes">Internal Notes</label>
                            <input type="text" class="form-control  internal-inp @error('Stitching_internal_notes') is-invalid @enderror @if(old('Stitching_internal_notes')) is-valid @endif" name="Stitching_internal_notes" id="Stitching_internal_notes" value="{{ old('Stitching_internal_notes') }}" placeholder="Stitching Internal Notes">
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
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <!-- <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="start_date">Start Date<span style="color: red;">*</span></label>
                            <input type="date" class="form-control date-input @error('start_date') is-invalid @enderror @if(old('start_date')) is-valid @endif" name="start_date" id="start_date" value="{{ old('start_date') }}">
                            @error('start_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> -->
                        <div class="col-lg-3 mb-3">
                            <label class="heading-content" for="start_date">Start Date<span style="color: red;">*</span></label>
                            <input 
                                type="date" 
                                class="form-control date-input @error('start_date') is-invalid @enderror @if(old('start_date')) is-valid @endif" 
                                name="start_date" 
                                id="start_date" 
                                value="{{ old('start_date', date('Y-m-d')) }}"
                            >
                            @error('start_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- <div class="col-lg-9 mb-3">
                            <label class="heading-content" for="rewinding_internal_notes">Internal Notes</label>
                            <input type="text" class="form-control  internal-inp @error('internal_notes') is-invalid @enderror @if(old('internal_notes')) is-valid @endif" name="internal_notes" id="internal_notes" value="{{ old('internal_notes') }}" placeholder="Production Internal Notes">
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
                                <button id="saveButton" type="submit" class="primary-button stock-btn">Save</button>
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
<!--  END CONTENT AREA  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->
<script>
    $(document).on('focusin', '.select2', function(e) {
        // Select2 handles the focus differently, this ensures the dropdown opens on focus
        $(this).siblings('select').select2('open');
    });
    $('button[type="submit"]').on('focus', function() {
        $(this).addClass('btn-focus');
    }).on('blur', function() {
        $(this).removeClass('btn-focus');
    });
    $(document).ready(function() {
        $(document).on('click','#leaveButton', function(){
            window.location.href = "{{ route('production_order.index') }}";
        });
        $('.orderList').click( function(){
            $("#indexModul").modal("show");
        });
        $('#order_type').focus();
        // $('.select2').select2();
        // $('select').on('focus', function() {
        //     $(this).prop('size', 5); // Use a more reasonable size
        // }).on('blur', function() {
        //     $(this).prop('size', 1); // Reset size when focus is lost
        // }).on('change', function() {
        //     $(this).prop('size', 1); // Close the dropdown after selection
        // });
    //     $('#packing_name').on('input', function() {
    //         var packingNameValue = $(this).val(); // Get the current value of the input field
    //         console.log('Packing Name:', packingNameValue); // Log the value to the console
    //     });
    });
    $(document).ready(function() {
        // Function to update the category input field
        function updateCategory() {
            var selectedOption = $('#product_type option:selected');
            var category = selectedOption.data('category');
           // if (category) {
            // Check the category value and show/hide the appropriate sections
                if (category == '4') {
                    $('#RewindingProduction').attr('style', 'display:none;');
                    $('#packingDetails').attr('style', 'display:none;');
                    $('#stitchingproduction').attr('style', 'display:none;');
                } else {
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

           // }
        }

        // Initial update on page load if a product is already selected
        updateCategory();

        // Update the category field when a new product is selected
        $('#product_type').on('change', updateCategory);
    });
    $(document).ready(function() {
    // Function to update the category input field
    function updateCategory() {
        // Get the selected option from the SKU dropdown
        var selectedOption = $('#sku option:selected');
        var category = selectedOption.data('category');
        

        // Check the category value and show/hide the appropriate sections
        var category = selectedOption.data('category');

        // Check if category is defined and not empty
        if (category) {
            // Check the category value and show/hide the appropriate sections
            if (category == '4') {
                $('#RewindingProduction').attr('style', 'display:none;');
                $('#packingDetails').attr('style', 'display:none;');
                $('#stitchingproduction').attr('style', 'display:none;');
            } else {
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
                $('#extrusionProduction').attr('style', 'display:none;');
                // $('#extrusionProduction h6').text('Step 2 - Extrusion');
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

    }

    // Initial update on page load if a SKU is already selected
    updateCategory();

    // Update the category field when a new SKU is selected
    $('#sku').on('change', updateCategory);
});
    document.addEventListener('DOMContentLoaded', function () {
        var productTypeSelect = document.getElementById('product_type');
        var skuSelect = document.getElementById('sku');
        var extrusionPipeSizeInput = document.getElementById('extrusion_size');
        var gaugeInput = document.getElementById('extrusion_gauge');
        // var remarkInput = document.getElementById('remark');
        var pipeInput = document.getElementById('rewinding_pipe');
        var stickerInput = document.getElementById('rewinding_sticker');
        var widthInput = document.getElementById('rewinding_width');
        var lengthInput = document.getElementById('rewinding_length');
        //var packingQtyRollsInput = document.getElementById('packing_qty_rolls');
        // var extrusionQtyOfPackingInput = document.getElementById('extrusion_qty_of_packing');
        var packingNameInput = document.getElementById('packing_name');
        var packingWeightInput = document.getElementById('packing_weight');
        var rollInOneBDLInput = document.getElementById('roll_in_one_bdl');

        var packingBhartiInput = document.getElementById('packing_bharti');
        var packingOuterNameiInput = document.getElementById('packing_outer_name');
        var packingCartonInput = document.getElementById('packing_carton');
        var packingColourInput = document.getElementById('packing_colour');
        var packingStickerInput = document.getElementById('packing_sticker');
        var SticchingPackingNameInput = document.getElementById('sticching_packing_name');
        var SticchingPackingTypeInput = document.getElementById('sticching_packing_type');
        var SticchingProductNameInput = document.getElementById('sticching_product_name');
        var StitchingBagInput = document.getElementById('sticching_bag');
        var StitchingBhartiInput = document.getElementById('sticching_bharti');
       // var rewindingQtyInRollsInput = document.getElementById('rewinding_qty_in_rolls');
        var dataContainer = document.getElementById('data-container');
        var productsData = JSON.parse(dataContainer.getAttribute('data-products'));
        console.log('pppppppppp');
        console.log(productsData);
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
        // console.log('data');
                    productTypeSelect.addEventListener('change', productTypeChangeHandler);
                    skuSelect.addEventListener('change', skuChangeHandler);

                    if (productTypeSelect.value) {
                        productTypeSelect.dispatchEvent(new Event('change'));
                    }
                    document.getElementById('qty_required').setAttribute('readonly', true);
                    document.getElementById('pending_bundle_quantity').setAttribute('readonly', true);
                } else {
                    document.getElementById('qty_required').removeAttribute('readonly');
                    document.getElementById('pending_bundle_quantity').removeAttribute('readonly');
                    makeToOrderCustomerName.classList.add('d-none');
                    makeToOrderSalesOrder.classList.add('d-none');

                    productTypeSelect.addEventListener('change', productTypeChangeHandler);
                    skuSelect.removeEventListener('change', skuChangeHandler);

                    clearFields();
                }
            }

            function productTypeChangeHandler() {
            var selectedProductId = parseInt(productTypeSelect.value, 10);
            var productData = productDataMap[selectedProductId] || {};
            var materialId = productData.packing_material_name || '';
            if (materialId) {
                $.ajax({
                    url: '{{ route('production-orders.byMaterial', ['materialId' => ':materialId']) }}'.replace(':materialId', materialId),
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            SticchingPackingNameInput.value = response.name;
                            SticchingPackingTypeInput.value = response.category_name;
                            packingNameInput.value = response.name;
                            packingWeightInput.value = response.material_weight;
                            // console.log('*******+*+*+');
                            // console.log(response.material_name);
                            // console.log(pendingBundleQuantity);
                            // console.log(productData.rolls_in_1_bdl);
                            // extrusionQtyOfPackingInput .value = (response.material_weight * productData.rolls_in_1_bdl);
                        } else {
                            console.error('Material not found:', response.message);
                        }   
                    },
                    error: function(response) {
                        console.error('Error fetching orders:', response);
                    }
                });
            }
            // extrusionPipeSizeInput.value = productData.pipe_size || '';
            var sizeId = productData.pipe_size || '';
            if (sizeId) {
                $.ajax({
                    url: '{{ route('production-orders.bySize', ['sizeId' => ':sizeId']) }}'.replace(':sizeId', sizeId),
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            extrusionPipeSizeInput.value = response.name;
                            pipeInput.value = response.name;
                            
                        } else {
                            console.error('Material not found:', response.message);
                        }   
                    },
                    error: function(response) {
                        console.error('Error fetching orders:', response);
                    }
                });
            }
            gaugeInput.value = productData.gage || '';
            //remarkInput.value =productData.remark || '';
            // pipeInput.value = productData.pipe_size || '';
            widthInput.value = productData.width || '';
            lengthInput.value = productData.length || ''
            packingBhartiInput.value = productData.bharti || '';
            var outerId = productData.outer_name || '';
            // var outerId = productData.outer_name || '';
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
            SticchingProductNameInput.value = productData.product_name || '';
            var pendingBundleQuantity = $('#pending_bundle_quantity').val();
            console.log('52525');
            console.log(pendingBundleQuantity);
            // SticchingPackingNameInput.value = productData.packing_material_name || '';
            StitchingBagInput.value = productData.number_of_bags_per_box || '';
            StitchingBhartiInput.value = productData.bharti || '';

            // packingNameInput.value = productData.packing_material_name || '';
            
            console.log('productData');
            console.log(productData.rolls_in_1_bdl);
            // rewindingQtyInRollsInput.value = Number(pendingBundleQuantity) * Number(productData.bharti) * Number(productData.number_of_bags_per_box) || '';
            // packingQtyRollsInput.value = Number(pendingBundleQuantity) * Number(productData.bharti) * Number(productData.number_of_bags_per_box) || '';
            
            // rewindingQtyInRollsInput.value = productData.rolls_in_1_bdl  ||'';
            // packingQtyRollsInput.value = productData.rolls_in_1_bdl || '';
            rollInOneBDLInput.value = productData.rolls_in_1_bdl  ||'';
            
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
            productionKG = Math.round(productionKG);
        }

        function skuChangeHandler() {
            var selectedSku = skuSelect.value;
            var productData = Object.values(productDataMap).find(product => product.alias_sku === selectedSku) || {};
           // remarkInput.value = productData.remark || '';
            extrusionPipeSizeInput.value = productData.pipe_size || '';
            gaugeInput.value = productData.gage || '';
            pipeInput.value = productData.pipe_size || '';
            widthInput.value = productData.width || '';
            lengthInput.value = productData.length || '';
            packingBhartiInput.value = productData.bharti || '';
            packingOuterNameiInput.value = productData.outer_name || '';
            var materialId = productData.packing_material_name || '';
            if (materialId) {
                $.ajax({
                    url: '{{ route('production-orders.byMaterial', ['materialId' => ':materialId']) }}'.replace(':materialId', materialId),
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            console.log('Material Name:9898', response); // Log the material name
                            SticchingPackingNameInput.value = response.name;
                            SticchingPackingTypeInput.value = response.category_name;
                            packingNameInput.value = response.name;
                        } else {
                            console.error('Material not found:', response.message);
                        }   
                    },
                    error: function(response) {
                        console.error('Error fetching orders:', response);
                    }
                });
            }
            // packingNameInput.value = productData.packing_material_name || '';
            // 
            // SticchingPackingNameInput.value = productData.packing_material_name || '';
            SticchingProductNameInput.value = productData.product_name || '';
            StitchingBagInput.value = productData.bharti || '';
            StitchingBhartiInput.value = productData.bharti || '';
        }

        function clearFields() {
            //remarkInput.value = '';
            extrusionPipeSizeInput.value = '';
            gaugeInput.value = '';
            // stickerInput.value = '';
            // pipeInput.value = '';
            // widthInput.value = '';
            // lengthInput.value = '';
           // packagingGuageInput.value = '';
           //packingWidthInput.value = '';
           //packingLengthInput.value = '';
            // packingBhartiInput.value = '';
            // packingOuterNameiInput.value = '';
            //remarkInput.value = '';
            // SticchingProductNameInput.value = '';
           // StitchingBhartiInput.value = '';
            // StitchingBagInput.value = '';
            // SticchingPackingNameInput.value = '';
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
    //         const selectedProductOption = this.options[this.selectedIndex];
    //         const correspondingSku = selectedProductOption.getAttribute('data-sku');

 
    //         // Array.from(skuSelect.options).forEach(option => {
    //         //     if (option.value === correspondingSku) {
    //         //         option.selected = true;
    //         //     } else {
    //         //         option.selected = false;
    //         //     }
    //         // });
    //     });


    //     // skuSelect.addEventListener('change', function () {
    //     //     const selectedSku = this.value;
    //     //     const selectedSkuOption = this.options[this.selectedIndex];
    //     //     const correspondingProductId = selectedSkuOption.getAttribute('data-product');

    //     //     Array.from(productSelect.options).forEach(option => {
    //     //         if (option.value === correspondingProductId) {
    //     //             option.selected = true;
    //     //         } else {
    //     //             option.selected = false;
    //     //         }
    //     //     });
    //     // });

    //     productSelect.dispatchEvent(new Event('change'));
    //     skuSelect.dispatchEvent(new Event('change'));
    // });

    document.addEventListener('DOMContentLoaded', function () {
    const productSelect = document.getElementById('product_type'); // Dropdown for product
    const skuInput = document.getElementById('sku'); // Textbox for SKU

    productSelect.addEventListener('change', function () {
        const selectedProductOption = this.options[this.selectedIndex];
        const correspondingSku = selectedProductOption.getAttribute('data-sku');

        // Set the SKU text box value based on the selected product
        skuInput.value = correspondingSku ? correspondingSku : '';
    });

    // Trigger the change event to populate SKU if a product is preselected
    productSelect.dispatchEvent(new Event('change'));
});

    document.addEventListener('DOMContentLoaded', function () {    
        var companyNameSelect = document.getElementById('company_name');
        var salesOrderSelect = document.getElementById('sales_order');
        var qtyRequiredInput = document.getElementById('qty_required');
        var pendingQtyInput = document.getElementById('pending_bundle_quantity');
        var productTypeSelect = document.getElementById('product_type');
        var extrusionColourInput = document.getElementById('extrusion_colour');
        var remarkInput = document.getElementById('remark');
        var rewindingStickerInput = document.getElementById('rewinding_sticker');
        var packingStickerInput = document.getElementById('packing_sticker');
        var rewindingColourInput = document.getElementById('rewinding_colour');
        var stitchingColourInput = document.getElementById('sticching_colour');
        var packingColourInput = document.getElementById('packing_colour');
        var rewindingPipeInput = document.getElementById('rewinding_pipe');
        var extrusionQtyOfPackingInput = document.getElementById('extrusion_qty_of_packing');
        var packingQtyRollsInput = document.getElementById('packing_qty_rolls');
        var rewindingQtyInRollsInput = document.getElementById('rewinding_qty_in_rolls');
        companyNameSelect.addEventListener('change', function () {
    const selectedCompanyId = companyNameSelect.value;
// console.log('color');
    if (selectedCompanyId) {
        // Fetch orders by customer
        $.ajax({
            url: '{{ route('production-orders.byCustomer', ['customerId' => ':customerId']) }}'.replace(':customerId', selectedCompanyId),
            type: 'GET',
            success: function(response) {
    // Clear previous options in salesOrderSelect and add a default option
    salesOrderSelect.innerHTML = '<option value="">Select Sales Order</option>';

    if (response.orders && response.orders.length > 0) {
        // Populate sales orders based on response
        response.orders.forEach(order => {
            const salesOrderOption = document.createElement('option');
            salesOrderOption.value = order.id;
            salesOrderOption.textContent = order.order_id;
            salesOrderOption.setAttribute('data-total-bundle', order.total_bundle || '');

            if (order.product_orders && order.product_orders.length > 0) {
                const firstProductOrder = order.product_orders[0];
                console.log(firstProductOrder);
                salesOrderOption.setAttribute('data-sticker', firstProductOrder.sticker_name || '');
                salesOrderOption.setAttribute('data-colour', firstProductOrder.colour || '');
                salesOrderOption.setAttribute('data-remark', firstProductOrder.remark || '');
            }

            salesOrderSelect.appendChild(salesOrderOption);
        });
        salesOrderSelect.classList.remove('d-none');
    } else {
        // If no orders found, show a "No records found" option
        const noRecordOption = document.createElement('option');
        noRecordOption.value = "";
        noRecordOption.textContent = "No records found for the selected company";
        noRecordOption.disabled = true; // Disable the option so it can't be selected
        salesOrderSelect.appendChild(noRecordOption);
        salesOrderSelect.classList.remove('d-none');
    }
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
            success: function (response) {
                if (response.pending_bdl_kg == 0) {
                    toastr.error('You cannot process further production orders for this product and sales order because there is no pending quantity.');
                    qtyRequiredInput.value = '';
                    pendingQtyInput.value = '';
                    remarkInput.value = '';
                    return;
                }

                // Populate values if pending_bdl_kg > 0
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
                var rollsInOneBDL = $('#roll_in_one_bdl').val();
                console.log('5689');
                console.log(packingWeightVal);
                console.log(rollsInOneBDL);
                console.log(response.pending_bdl_kg);
                extrusionQtyOfPackingInput.value =(packingWeightVal * rollsInOneBDL *response.pending_bdl_kg);
                rewindingQtyInRollsInput.value =(rollsInOneBDL *response.pending_bdl_kg);
                packingQtyRollsInput.value =(rollsInOneBDL *response.pending_bdl_kg);
                pendingQtyInput.value = response.pending_bdl_kg;
                remarkInput.value = response.remark;
            },
            error: function (response) {
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
            
        //     var totalQuantity = selectedOption ? selectedOption.getAttribute('data-total-bundle') : '';
        //     var stickerName = selectedOption ? selectedOption.getAttribute('data-sticker') : '';
        //     var colour = selectedOption ? selectedOption.getAttribute('data-colour') : '';
        //     var remark = selectedOption ? selectedOption.getAttribute('data-remark') : '';
        //     console.log(remark);
        //     // qtyRequiredInput.value = totalQuantity;
        //     extrusionColourInput.value = colour;
        //     remarkInput.value = remark;
        //     rewindingColourInput.value = colour;
        //     stitchingColourInput.value = colour;
        //     rewindingStickerInput.value = stickerName; 
        // });

        salesOrderSelect.addEventListener('change', function () {
    const selectedSalesOrderId = salesOrderSelect.value;

    // Update input fields based on selected sales order attributes
    const selectedOption = salesOrderSelect.selectedOptions[0];
    const totalQuantity = selectedOption ? selectedOption.getAttribute('data-total-bundle') : '';
    
    const colour = selectedOption ? selectedOption.getAttribute('data-colour') : '';
    const remark = selectedOption ? selectedOption.getAttribute('data-remark') : '';
    const stickerName = selectedOption ? selectedOption.getAttribute('data-sticker') : '';
    var stickerId = stickerName || '';
    if (stickerId) {
        $.ajax({
            url: '{{ route('production-orders.bySticker', ['stickerId' => ':stickerId']) }}'.replace(':stickerId', stickerId),
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    rewindingStickerInput.value = response.name;
                    packingStickerInput.value = response.name;
                    
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
    // packingStickerInput.value = stickerName;

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
        $.validator.addMethod("checkQtyRequiredFilled", function(value, element) {
    var qtyRequired = $('#qty_required').val();
    return qtyRequired !== "";
    }, "Please fill Bundle Quantity first.");
    $.validator.addMethod("checkpendingBundleQtyFilled", function(value, element) {
        var pendingBundleQty = $('#pending_bundle_quantity').val();
        return pendingBundleQty !== "";
    }, "Please fill Pending Bundle Quantity first.");

    $.validator.addMethod("checkBundleQuantityLessThanOrEqualToPending",
    function(value, element) {
        var pendingQty = Number($('#pending_bundle_quantity').val());
        return value <= pendingQty;
    },
    "Bundle quantity must not be greater than pending bundle quantity.");
    $.validator.addMethod("checkPendingBundleQty", function(value, element) {
    return parseFloat(value) > 0;
}, "You cannot create a production order as there is no pending bundle quantity.");
    $("#productionOrderAddForm").validate({
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
                checkPendingBundleQty:true,
            },
            bundle_quantity: {
                required: true,
                digits: true,
                checkBundleQuantityLessThanOrEqualToPending: false, 
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
                checkQtyRequiredFilled: "Please fill Bundle Quantity first.",
                checkPendingBundleLessThanQtyRequired: "Pending bundle quantity must be less than qty required."
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
</script>



@endsection