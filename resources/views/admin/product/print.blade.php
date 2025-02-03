@extends('layouts.print')
@section('navbarTitel', 'Product Print')
@section('content')
<style>
.master_packing{position: relative;}
.form-check { position: absolute; left: 123px; top: 0; font-size: 15px; display: flex; align-items: center;}
.form-container {height: auto !important;}
input[type="radio"] {display: grid;}

</style>
<div class="form-container">
    <div class="header">
        <div class="form-title">Product Information</div>
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
        <div class="section-title">Product Details</div>
        <div class="row">
            <p class="field-size categoryValue"><strong>Category:</strong> {{ optional($productCategory->find($product->category))->name ?? 'N/A' }}</p>
            <p class="field-size"><strong>Product Name:</strong> {{ old('product_name', $product->product_name ?? '') }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Group Name:</strong> {{ optional($groups->find($product->group_name))->name ?? 'N/A' }}</p>
            <p class="field-size"><strong>Alias / SKU:</strong>  {{old('alias_sku', $product->alias_sku ?? '')}}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Width in inches:</strong> {{old('width', $product->width ?? '')}}</p>
            <p class="field-size"id="lengthInMeters"><strong>Length in meters:</strong> {{old('length', $product->length ?? '')}}</p>
        </div>
        <div class="row">
            <p class="field-size" id="gsm-field"><strong>GSM:</strong> {{ old( 'gsm', $product->gsm ?? '' ) }}</p>
            <p class="field-size" id="gauge-field"><strong>Gauge:</strong> {{ old( 'gage', $product->gage ?? '' ) }}</p>
        </div>
        <div class="col-lg-6 mb-3 master_packing">
            <p><strong>Master Packing:</strong> {{ old('master_packing', $product->master_packing ?? '') }}</p>
    </div>
    <div class="personal-info">
        <div class="section-title">Product Specifications</div>
        <div class="row first-section">
            <p class="field-size"><strong>Bharti:</strong> {{ old( 'bharti', $product->bharti ?? '' ) }}</p>
            <p class="field-size"><strong>Bags/Box:</strong> {{ old( 'number_of_bags_per_box', $product->number_of_bags_per_box ?? '' )}}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Pipe size:</strong> {{ old( 'pipe_size', $product->pipe_size ?? '' ) }}</p>
            <p class="field-size"><strong>Roll in 1 BDL:</strong> {{ old( 'rolls_in_1_bdl', $product->rolls_in_1_bdl ?? '' ) }}</p>
        </div>
        <div class="row">
            <p class="field-size" id="rollWeight"><strong>Roll Weight:</strong>  {{ old( 'roll_weight', $product->roll_weight ?? '' ) }}</p>
            <p class="field-size" id="sheetWeight"><strong>Sheet Weight:</strong> {{ old( 'sheet_weight', $product->sheet_weight ?? '' ) }}</p>
        </div>
        <div class="row">
            <p class="field-size"id="rollWegithtoSheetweight"><strong>Roll Weight to Sheet Weight:</strong>  {{ old( 'roll_weight', $product->roll_weight_to_sheet_weight ?? '' ) }}</p>
            <p class="field-size"><strong>BDL K.G.:</strong> {{ old( 'bdl_kg', $product->bdl_kg ?? '' )}}</p>
        </div>
        <div class="row">
            <p class="field-size"id="paperSheetPacking"><strong>Packing Material QTY:</strong>  {{ old( 'packing_material_qty', $product->packing_material_qty ?? '' ) }}</p>
            <p class="field-size"><strong>Outer Name:</strong> {{ optional($materials->find($product->outer_name))->material_name ?? 'N/A' }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>No. of Outer:</strong>  {{ old( 'number_of_outer', $product->number_of_outer ?? 'N/A' )}}</p>
            <p class="field-size"id="paperSheetCarton"><strong>Carton Name:</strong> {{ optional($materials->find($product->carton_no))->material_name ?? 'N/A' }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Rate:</strong> {{ old( 'rate', $product->rate ?? '' )}}</p>
            <!-- <p class="field-size"><strong>Packing Material Category:</strong> {{ optional($category->find($product->packing_material_category))->name ?? 'N/A' }}</p> -->
        </div>
        <div class="row">
            <p class="field-size"><strong>Packing Material Sub Category:</strong> {{$subcategoriesname->first()->sub_cat_name ??'N/A'}}</p>
            <p class="field-size"><strong>Packing Material Name:</strong> {{ optional($materials->find($product->packing_material_name))->material_name ?? 'N/A' }}</p>
        </div>
    </div>
</div>
 
@endsection
@section('js')
<script>
    $(document).ready(function() {
        window.print();
        // $('.category').text();
        var categoryValue = $('.categoryValue').text().trim();
        if (categoryValue === 'Category: Plastic Roll' || categoryValue === 'Category: Plastic Jumbo Roll') {
            $('#rollWegithtoSheetweight').attr('style', 'display:none;');
            $('#gauge-field').removeAttr('style');
        } else {
            $('#gauge-field').attr('style', 'display:none;');
            $('#rollWegithtoSheetweight').removeAttr('style');
        }
        if (categoryValue === 'Category: Paper Roll' || categoryValue === 'Category: Paper Sheet') {
            $('#gsm-field').removeAttr('style');
            
        } else {
            $('#gsm-field').attr('style', 'display:none;');
            
        }
        if(categoryValue === 'Category: Plastic Jumbo Roll'){
            $('#lengthInMeters').attr('style', 'display:none;');
            
        }else{
            $('#lengthInMeters').removeAttr('style');
            
        }
        if(categoryValue === 'Category: Paper Sheet'){
            $('#paperSheetPacking').attr('style', 'display:none;');
            $('#paperSheetCarton').attr('style', 'display:none;');
            $('#rollWegithtoSheetweight').removeAttr('style');
            $('#sheetWeight').removeAttr('style');
            $('#rollWeight').attr('style', 'display:none;');
        }else{
            $('#sheetWeight').attr('style', 'display:none;');
            $('#rollWeight').removeAttr('style');
            $('#paperSheetPacking').removeAttr('style');
            $('#paperSheetCarton').removeAttr('style');
            $('#rollWegithtoSheetweight').attr('style', 'display:none;');
        }
        if ($('#master_packing_bag').is(':checked')) {
            $('#master_packing_box').closest('.form-check').hide();  // Hide the Box option
        } else if ($('#master_packing_box').is(':checked')) {
            $('#master_packing_bag').closest('.form-check').hide();  // Hide the Bag option
        }
    });
</script>
@endsection