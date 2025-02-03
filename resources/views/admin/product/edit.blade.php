@extends('layouts.app')
@section('navbarTitel', 'Product Edit')

@section('content')

    <div class="main-outer">
        <div class="outer card">
            <form id="productForm" class="needs-validation" novalidate action="{{ route('products.update', $product->id)}}" method="post" enctype="multipart/form-data">
                <div class="heading-btn">
                    <span class="addsupplier-section-heading">Product Information</span>
                    <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
                </div>
                <hr class="addsupplier-section-border">        
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        @csrf 
                        @method('PUT')
                        <div class="row form-inp-group">
                            <div class="col-lg-6 mb-1">
                                <label class="heading-content"  for="category">Category</label>
                                <select name="category" id="category" class="custom-select d-block w-100 form-select-grps form-control select2">
                                    <option class="option-desgn" value="" hidden>Select Category</option>
                                    @foreach($productCategory as $categories)
                                        <option value="{{$categories->id}}"{{ old('category', $product->category ?? '') == $categories->id ? 'selected' : '' }}>{{$categories->name}}</option>
                                    @endforeach
                                </select>
                                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content" for="Name">Product Name<span style="color: red;">*</span></label>
                                <input type="text" class="form-control input-form-content @error('product_name') is-invalid @enderror @if(!empty(old('product_name'))) is-valid @endif" name="product_name" id="product_name"  value="{{old('product_name', $product->product_name ?? '')}}" required >
                                @error('product_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-6 mb-3 transport-kk_details" id="group_name_wrapper">
                                <div class="col-10 mb-3 group-nm">
                                    <label class="heading-content" for="group_name">Group Name<span style="color: red;">*</span></label>
                                        <select class="form-control select2 form-select-grp input-form-content @error('name') is-invalid @enderror @if(!empty(old('name'))) is-valid @endif" id="group_name_select" name="group_name" required>
                                            <option value="">Select Group Name</option>
                                            @foreach($groups as $group)
                                                <option value="{{ $group->id }}" {{ old('group_name', $product->group_name) == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('group_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="add-icon-btn grp-icon-center-btn" id="groupaddModul">
                                    <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff" class="bi bi-plus" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3 transport-kk_details d-none" id="new_group_name_wrapper">
                                <div class="col-10 mb-3 group-nm">
                                    <label class="heading-content" for="new_group_name">Group Name <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control input-form-content @error('new_group_name') is-invalid @enderror" id="new_group_name">
                                </div>
                                <div class="button-1 add-btnn" id="save_new_group_button">
                                    <button type="button" class="add-btn-grp">Add</button>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="AliasSku">Alias / SKU<span style="color: red;">*</span></label>
                                <input type="text" class="form-control input-form-content @error('alias_sku') is-invalid @enderror @if(!empty(old('alias_sku'))) is-valid @endif" id="alias_sku"  required name="alias_sku" value="{{old('alias_sku', $product->alias_sku ?? '')}}">
                                @error('alias_sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content"  for="width">Width in inches<span style="color: red;">*</span></label>
                                <input type="text" class="decimal-input form-control input-form-content @error('width') is-invalid @enderror @if(!empty(old('width'))) is-valid @endif" id="width" name="width" value="{{old('width', $product->width ?? '')}}">
                                @error('width')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-3 mb-3" id="lengthInMeters">
                                <label class="heading-content"  for="length">Length in meters<span style="color: red;">*</span></label>
                                <input type="text" class="decimal-input form-control input-form-content @error('length') is-invalid @enderror @if(!empty(old('length'))) is-valid @endif" id="length" name="length" value="{{old('length', $product->length ?? '')}}">
                                @error('length')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-3 mb-3" id="gsm-field" style="display:none;">
                                <label class="heading-content"  for="GSM">GSM</label>
                                <input type="text" class="decimal-input form-control input-form-content @error('gsm') is-invalid @enderror @if(!empty(old('gsm'))) is-valid @endif" id="gsm" name="gsm" value="{{ old( 'gsm', $product->gsm ?? '' ) }}">
                                @error('gsm')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-3 mb-3" id="gauge-field" style="display:none;">
                                <label class="heading-content"  for="Gauge">Gauge</label>
                                <input type="text" class="decimal-input form-control input-form-content @error('gage') is-invalid @enderror @if(!empty(old('gage'))) is-valid @endif" id="gage" name="gage" value="{{ old( 'gage', $product->gage ?? '' ) }}">
                                @error('gage')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="name">Master Packing</label>
                                <div class="form-radio-sec">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input custom-radio" name="master_packing" id="master_packing_bag" value="Bag" {{ old('master_packing', $product->master_packing) == 'Bag' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="master_packing_bag">Bag</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input custom-radio" name="master_packing" id="master_packing_box" value="Box"  {{ old('master_packing', $product->master_packing) == 'Box' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="master_packing_box">Box</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                      
                </div>
                <div class="heading-btn">
                    <span class="companydetails-section-heading">Product Specifications</span>
                </div>
                <hr class="addsupplier-section-border">
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="BhartiContact">Bharti<span style="color: red;">*</span></label>
                                <input type="number" class="decimal-input form-control input-form-content @error('bharti') is-invalid @enderror @if(!empty(old('bharti'))) is-valid @endif" name="bharti" value="{{ old( 'bharti', $product->bharti ?? '' ) }}" id="bharti">
                                @error('bharti')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title"></span>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="number">Bags/Box<span style="color: red;">*</span></label>
                                <input type="number" class="decimal-input form-control input-form-content @error('number_of_bags_per_box') is-invalid @enderror @if(!empty(old('number_of_bags_per_box'))) is-valid @endif" id="number_of_bags_per_box" name="number_of_bags_per_box" value="{{ old( 'number_of_bags_per_box', $product->number_of_bags_per_box ?? '' )}}">
                                @error('number_of_bags_per_box')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title">Per Bundle</span>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="name">Paper Tube</label>
                                <select name="pipe_size" class="custom-select d-block w-100 form-select-grps form-control select2">
                                    <option value="">Select Paper Tube</option>
                                    @foreach($pipeSizes as $size)
                                        <option data-weight="{{$size->material_weight}}" value="{{ $size->id }}" {{ old('pipe_size', $product->pipe_size) == $size->id ? 'selected' : '' }}>{{ $size->material_name }}</option>
                                    @endforeach
                                </select>
                                @error('pipe_size')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-6 mb-3" id="rollWegithtoSheetweight">
                                <label class="heading-content"  for="number">Roll Weight to Sheet Weight</label>
                                <input type="number" class="decimal-input form-control input-form-content @error('roll_weight_to_sheet_weight') is-invalid @enderror @if(!empty(old('roll_weight_to_sheet_weight'))) is-valid @endif" id="roll_weight_to_sheet_weight" name="roll_weight_to_sheet_weight" value="{{ old( 'roll_weight', $product->roll_weight_to_sheet_weight ?? '' ) }}" readonly>
                                @error('roll_weight_to_sheet_weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title">(width*length*(GSM+6)/1550000)</span>
                            </div>
                            <div class="col-lg-6 mb-3"id="gramPerMeter">
                                <label class="heading-content"  for="number">Gram Per Meter</label>
                                <input type="number" class="decimal-input form-control input-form-content @error('gram_per_meter') is-invalid @enderror @if(!empty(old('gram_per_meter'))) is-valid @endif" id="gram_per_meter" name="gram_per_meter" value="{{ old( 'gram_per_meter', $product->gram_per_meter ?? '' )}}">
                                @error('gram_per_meter')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title">((gage/4 )* 0.95 ) * (width/39.37)</span>
                            </div>
                            <div class="col-lg-6 mb-3"id="paperSheetPacking">
                                <label class="heading-content"  for="number">Packing Material QTY/<span class="label-title">Used per box/bag</span></label>
                                <input type="number" class="decimal-input form-control input-form-content @error('packing_material_qty') is-invalid @enderror @if(!empty(old('packing_material_qty'))) is-valid @endif" id="packing_material_qty" name="packing_material_qty" value="{{ old( 'packing_material_qty', $product->packing_material_qty ?? '' ) }}">
                                @error('packing_material_qty')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title">Bharti/Packing Type</span>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="name">Outer Name</label>
                                <select name="outer_name" class="custom-select d-block w-100 form-select-grps form-control select2">
                                    <option value="">Select Outer Name</option>
                                    @foreach($outers as $outer)
                                        <option data-weight="{{ $outer->material_weight }}" value="{{ $outer->id }}" {{ old('outer_name', $product->outer_name) == $outer->id ? 'selected' : '' }}>{{ $outer->material_name }}</option>
                                    @endforeach
                                </select>
                                @error('outer_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="number">No. of Outer/<span class="label-title">Used per Master</span></label>
                                <input type="number" class="decimal-input form-control input-form-content @error('number_of_outer') is-invalid @enderror @if(!empty(old('number_of_outer'))) is-valid @endif" name="number_of_outer" value="{{ old( 'number_of_outer', $product->number_of_outer ?? '' )}}" id="number_of_outer">
                                @error('number_of_outer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title"></span>
                            </div>
                            <div class="col-lg-6 mb-3" id="paperSheetCarton">
                                <label class="heading-content"  for="number">Carton Name.</label>
                                <select name="carton_no" class="custom-select d-block w-100 form-select-grps form-control select2">
                                    <option value="">Select Carton Name</option>
                                    @foreach($cartons as $carton)
                                        <option data-weight="{{$carton->material_weight}}" value="{{ $carton->id }}" {{ old('carton_no', $product->carton_no) == $carton->id ? 'selected' : '' }}>{{ $carton->material_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="name">Packing Material Sub Category<span style="color: red;">*</span></label>
                                <select class="form-control select2 input-form-content form-select-grp @error('packing_material_type') is-invalid @enderror @if(!empty(old('packing_material_type'))) is-valid @endif" id="packing_material_type" name="packing_material_type">
                                    <option value="">Select Material Category</option>
                                    @foreach($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}" {{ old('packing_material_type', $product->packing_material_type) == $subCategory->id ? 'selected' : '' }}>{{ $subCategory->sub_cat_name}}</option>
                                    @endforeach
                                </select>
                                @error('packing_material_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content" for="name">Packing Material Name<span style="color: red;">*</span></label>
                                <select class="form-control select2 input-form-content form-select-grp @error('packing_material_name') is-invalid @enderror @if(!empty(old('packing_material_name'))) is-valid @endif" id="packing_material_name" name="packing_material_name">
                                    <option value="">Select material Name</option>
                                    @foreach($materials as $material)
                                            <option data-weight = "{{ $material->material_weight }}" value="{{ $material->id }}" {{ old('packing_material_name', $product->packing_material_name) == $material->id ? 'selected' : '' }}>{{ $material->material_name }}</option>
                                    @endforeach
                                </select>
                                @error('packing_material_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="number">Roll in 1 BDL</label>
                                <input type="number" class="decimal-input form-control input-form-content @error('rolls_in_1_bdl') is-invalid @enderror @if(!empty(old('rolls_in_1_bdl'))) is-valid @endif" id="rolls_in_1_bdl" name="rolls_in_1_bdl" value="{{ old( 'rolls_in_1_bdl', $product->rolls_in_1_bdl ?? '' ) }}" readonly>
                                @error('rolls_in_1_bdl')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title">Bharti* Bags/Box=Bdl</span>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="number">BDL K.G.</label>
                                <input type="number" class="decimal-input form-control input-form-content @error('bdl_kg') is-invalid @enderror @if(!empty(old('bdl_kg'))) is-valid @endif" id="bdl_kg" name="bdl_kg" value="{{ old( 'bdl_kg', $product->bdl_kg ?? '' )}}" readonly>
                                @error('bdl_kg')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title">Rolls In 1 Bdle*Roll Weight</span>
                            </div>
                            <div class="col-lg-6 mb-3" id="rollWeight">
                                <label class="heading-content"  for="">Roll Weight</label>
                                <input type="text" class="decimal-input form-control input-form-content @error('roll_weight') is-invalid @enderror @if(!empty(old('roll_weight'))) is-valid @endif" id="roll_weight" name="roll_weight" value="{{ old( 'roll_weight', $product->roll_weight ?? '' ) }}" >
                                @error('roll_weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title" id="rollWeightText">(Length/(1000/(GSM+6)*39.37/Width)+0.57/Roll in 1 Bdl)</span>
                            </div>
                        </div>
                        <div class="upload--file-section">
                            <div class="btn-sec btn_group"></div>
                                <div class="order-btn-grp">
                                    <div class="btn-sec btn_group">
                                        <div class="button-1 cta_btn">
                                            <button id="editButton" type="submit" class="primary-button stock-btn">Update</button>
                                            <!-- <a href="javascript:void(0)" class="primary-button stock-btn">Create a New Product</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
 
@endsection
@section('js')
<!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click','#leaveButton', function(){
            window.location.href = "{{ route('products.index') }}";
        });
        $('.orderList').click( function(){
            $("#indexModul").modal("show");
        });
        $('#category').focus();
        $('#group_name_select').on('select2:close', function(e) {

            if ($('#group_name_select').val() === "") {
                $("#groupaddModulData").modal("show");
                $('#groupformForm')[0].reset();
                $('#groupaddModul').focus(); // Focus on "+" button when Select2 is closed with no selection
            }
            });
            $('#groupaddModulData').on('hidden.bs.modal', function () {
            $('input[name="alias_sku"]').focus(); // Move focus to the next field (Perf. Matrix) after modal closes
            });
            $('#groupaddModul').click( function(){
            $('#groupformForm')[0].reset();
            $("#groupaddModulData").modal("show");
            });
            $('#groupformForm').on('submit', function(event) {
            event.preventDefault();

            var formData = $(this).serialize();
            console.log(formData);
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success response
                    $('#groupaddModulData').modal('hide');
                    if (response.newOption) {
                        $('#group_name_select').append(new Option(response.newOption.text, response.newOption.value, true, true));
                    }
                    // Optionally, update the table or other parts of the page with the new data
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        var generalMessage = xhr.responseJSON.message || 'Validation error occurred.';
                        console.log("Validation errors received:", errors);

                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                console.log(`Error for ${key}: ${errors[key][0]}`);
                                if (key === 'name') {
                                    $('#groupname').addClass('is-invalid');
                                    $('#groupname').next('.invalid-feedback').text(errors[key][0]);
                                }
                            }
                        }
                    } else {
                        console.error('An error occurred:', xhr.responseText);
                    }
                }
            });
        });
        $('button[type="submit"]').on('focus', function() {
            $(this).addClass('btn-focus');
        }).on('blur', function() {
            $(this).removeClass('btn-focus');
        });
        $(document).on('focusin', '.select2', function(e) {
            // Select2 handles the focus differently, this ensures the dropdown opens on focus
            $(this).siblings('select').select2('open');
        });
        
        $('#category').trigger('change');
        $('.select2').select2();
        var bhartidata = $('#bharti').val(); 
        var bagBox = $('#number_of_bags_per_box').val();
        var roll_weight = $('#roll_weight').val();
        var width = $('#width').val();
        var length = $('#length').val();
        var gsm = $('#gsm').val();
        var gage = $('#gage').val();
        var numberOfOuter = $('#number_of_outer').val();
        function updateRollsInBdl() {
            bhartidata = parseFloat(bhartidata);
            bagBox = parseFloat(bagBox);
              width = parseFloat(width);
               length = parseFloat(length);
                gsm = parseFloat(gsm);
                gage = parseFloat(gage);
                numberOfOuter = parseFloat(numberOfOuter);
                console.log('gage');
                console.log(gage);
                let gramPerMeter = (((gage/4 )* 0.95 ) * (width/39.37)).toFixed(3);
            let rollIn1 = (bhartidata * bagBox);
            console.log('testing');
            console.log(bhartidata);
            console.log(bagBox);
            let selectedOption = $('select[name="pipe_size"] option:selected');
let materialWeight = parseFloat(selectedOption.data('weight')) || 0;

let selectedMaterial = $('select[name="packing_material_name"] option:selected');
let materialNameWeight = parseFloat(selectedMaterial.data('weight')) || 0;

let selectedouter = $('select[name="outer_name"] option:selected');
let outernameWeight = parseFloat(selectedouter.data('weight')) || 0;

let selectedcarton_no = $('select[name="carton_no"] option:selected');
let selectedcartonweight = parseFloat(selectedcarton_no.data('weight')) || 0;

//let numberOfOuter = document.getElementById('number_of_outer').value;
let number_of_bags_per_box = document.getElementById('number_of_bags_per_box').value;

let masterPacking = document.querySelector('input[name="master_packing"]:checked').value;
console.log('selectedMaterial:', selectedMaterial);
console.log('materialNameWeight:', materialNameWeight);

            var selectedCat = $('#category').find('option:selected').text();
            let sheetwigth = (width && length && gsm) 
        ? (width * length * (gsm + 6) / 1550000).toFixed(3) 
        : 0;
            // let sheetwigth = (width * length*(parseFloat(gsm) + 6)/1550000).toFixed(3);
            // let rollweight = ( (length  /  ( ( 1000/(gsm+6)  ) * (width / 39.37) )  ) +  0.570 / rollIn1 ).toFixed(3);
            //let rollweight = (length/(1000/(gsm+6)*39.37/width)+0.57/rollIn1).toFixed(3);
            let rollweight = (width && length && gsm && rollIn1) 
        ? (length / (1000 / (gsm + 6) * 39.37 / width) + 0.57 / rollIn1).toFixed(3) 
        : 0;
            let bdl_kg1 = (rollIn1 * rollweight).toFixed(3);
            $('#rolls_in_1_bdl').val(rollIn1);
            // $('#bdl_kg').val(bdl_kg1);
            //alert((rollIn1 * (length/(1000/(gsm+6)*39.37/width)+0.57/rollIn1)).toFixed(3));
            $('#bdl_kg').val((rollIn1 * (length/(1000/(gsm+6)*39.37/width)+0.57/rollIn1).toFixed(3)).toFixed(3));
            $('#gram_per_meter').val(gramPerMeter);
            // if(selectedCat == 'Paper Sheet'){
            $('#roll_weight_to_sheet_weight').val(sheetwigth);
            $('#sheet_weight').val(sheetwigth);
            // }else{
                // $('#sheet_weight').val(sheetwigth);
                $('#roll_weight').val(rollweight);
            // }
            let test1 = (materialWeight *rollIn1)
            let materilnameWeight1 = (materialNameWeight *rollIn1)
            let numberOfOuterval = (outernameWeight *numberOfOuter*number_of_bags_per_box)
            let masterpacking = '';
            if(masterPacking == 'Box'){
              masterpacking = (selectedcartonweight*number_of_bags_per_box)
            }else{
                masterpacking = (0.120*number_of_bags_per_box)
            }
            if(selectedCat == 'Plastic Roll'){
                $('#rollWeightText').text(
                    '((((Gauge/4)*0.95*Width/39.37/1000)*Length * Rolls in 1 Bdl) + (Paper Tube material weight from the material master * Rolls in 1 BDL) + (Packing materila name material weight from the material master * Rolls in 1 bdl) + (Outer name material weight from the material master * number of outer used per box * Bag/Box per bundle) + (If Box(Carton name material weight from the material master* Bags/Box) or if Bag(0.120* Bag/Box)) + (Kantan weight))/Rolls in 1 BDL'
                );
               // $('#roll_weight').val((((gage / 4) * 0.95 * width / 39.37 / 1000) * length * rollIn1).toFixed(3) + ' + ' + (test1.toFixed(3)) + ' + ' + (materilnameWeight1.toFixed(3))+ ' + ' + (numberOfOuterval.toFixed(3))+ ' + ' + (masterpacking.toFixed(3))+ ' + ' + 0.15);
               console.log((((gage / 4) * 0.95 * width / 39.37 / 1000) * length * rollIn1).toFixed(3) + ' + ' + (test1.toFixed(3)) + ' + ' + (materilnameWeight1.toFixed(3))+ ' + ' + (numberOfOuterval.toFixed(3))+ ' + ' + (masterpacking.toFixed(3))+ ' + ' + 0.15);
               var plasticRollWeight = (
                (parseFloat((gage / 4) * 0.95 * width / 39.37 / 1000 * length) / rollIn1 +
                parseFloat(test1) / rollIn1 +
                parseFloat(materilnameWeight1) / rollIn1 +
                parseFloat(numberOfOuterval) / rollIn1 +
                parseFloat(masterpacking) / rollIn1 +
                0.15 / rollIn1).toFixed(3)
                ); 
                console.log('22222');
                console.log(plasticRollWeight);
               $('#roll_weight').val(plasticRollWeight);
               $('#bdl_kg').val((plasticRollWeight*rollIn1).toFixed(3));
            }else{
                $('#rollWeightText').text('(Length/(1000/(GSM+6)*39.37/Width)+0.57/Roll in 1 Bdl)');
            }
            if(selectedCat == 'Paper Sheet'){
                $('#bdl_kg').val(sheetwigth*rollIn1);
            }
        }
        $('#roll_weight').on('input', function () {
            let rollWeight = parseFloat($(this).val());
            let rollsIn1Bdl = parseFloat($('#rolls_in_1_bdl').val());

            if (!isNaN(rollWeight) && !isNaN(rollsIn1Bdl)) {
                let bdlKg = (rollsIn1Bdl * rollWeight).toFixed(3);
                $('#bdl_kg').val(bdlKg);
            } else {
                $('#bdl_kg').val('');bharti
            }
        });
        // let bhartidata, bagBox, rollIn1;
        
        $('#number_of_bags_per_box').keyup(function(){
            bagBox = $(this).val();
            updateRollsInBdl();
            
        });
        $('#bharti').keyup(function(){
            bhartidata = $(this).val();
            updateRollsInBdl();
            
        });
        $('input[name="master_packing"]').change(function () {
            if ($(this).is(':checked')) {
                let masterPacking = $(this).val();

                updateRollsInBdl(masterPacking);
            }
        });
        $('select[name="pipe_size"]').change(function() {
            updateRollsInBdl();
        });
        $('select[name="outer_name"]').change(function() {
            updateRollsInBdl();
        });
        $('select[name="carton_no"]').change(function() {
            updateRollsInBdl();
        });
        $('select[name="category"]').change(function() {
            updateRollsInBdl();
        });
$('select[name="packing_material_name"]').off('change').on('change', function() {
    updateRollsInBdl(); // Call the function on change
});
$('#number_of_outer').keyup(function(){
            numberOfOuter = $(this).val();
            updateRollsInBdl();
            
        });
        $('#number_of_bags_per_box').keyup( function(){
            bagBox = $(this).val();
            console.log(bagBox);
            updateRollsInBdl();
            
        });
        // $('#roll_weight').keyup( function(){
        //     roll_weight = $(this).val();
        //     updateRollsInBdl();
            
        // });
        $('#width').keyup( function(){
            
            width = $(this).val();
            updateRollsInBdl();
        });
        $('#length').keyup( function(){
            length = $(this).val();
            updateRollsInBdl();
        });
        $('#gsm').keyup( function(){
            gsm = $(this).val();
            updateRollsInBdl();
        });
        $('#gage').keyup( function(){
            gage = $(this).val();
            updateRollsInBdl();
        });
    });
</script>
<script>
$(document).ready(function () {
        $('#category').on('change', function() {
            // var selectedCategory = $(this).val();
            var selectedCategory = $(this).find("option:selected").text();
            if (selectedCategory === 'Plastic Roll' || selectedCategory === 'Plastic Jumbo Roll') {
                $('#rollWegithtoSheetweight').attr('style', 'display:none;');
                $('#gauge-field').show();
            } else {
                // console.log(selectedCategory);
                $('#gauge-field').hide();
                $('#rollWegithtoSheetweight').removeAttr('style');
                $('#rollWeight').attr('style', 'display:none;');
            }
            if (selectedCategory === 'Paper Roll' || selectedCategory === 'Paper Sheet') {
                $('#gsm-field').show();
                
            } else {
                $('#gsm-field').hide();
                
            }
            if(selectedCategory === 'Plastic Jumbo Roll'){
                $('#lengthInMeters').attr('style', 'display:none;');
                
            }else{
                $('#lengthInMeters').removeAttr('style');
                
            }
            if(selectedCategory === 'Paper Sheet'){
                $('#rollWeight').attr('style', 'display:none;');
                $('#sheetWeight').removeAttr('style');
                // $('#sheetWeight').attr('style', 'display:none;');
                $('#paperSheetPacking').attr('style', 'display:none;');
                $('#paperSheetCarton').attr('style', 'display:none;');
                $('#rollWegithtoSheetweight').removeAttr('style');
            }else{
                $('#rollWeight').removeAttr('style');
                $('#sheetWeight').attr('style', 'display:none;');
                // $('#sheetWeight').removeAttr('style');
                $('#paperSheetPacking').removeAttr('style');
                $('#paperSheetCarton').removeAttr('style');
                $('#rollWegithtoSheetweight').attr('style', 'display:none;');
            }
            // if( selectedCategory === 'Paper Roll'){
            //     $('#pipesize').attr('style', 'display:none;');
            // }else{
            //     $('#pipesize').removeAttr('style');
            // }
            if( selectedCategory === 'Plastic Roll'){
                // $('#pipe_size').val('');
                $('#pipe_size').prop('readonly', false);
                $('#gramPerMeter').removeAttr('style');
            }else{
                $('#pipe_size').val(0); 
                $('#pipe_size').prop('readonly', true);
                $('#gramPerMeter').attr('style', 'display:none;');
            }
        });

        // Trigger the change event on page load to set the correct visibility
        $('#category').trigger('change');
    
    $("#productForm").validate({
        errorClass: "is-invalid",
        errorElement: "div", 
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            // error.insertAfter(element);
            if (element.hasClass('select2')) {
                    error.insertAfter(element.next('span.select2'));
                    element.next('span.select2').find('.select2-selection__rendered').addClass('error-border');
                } else {
                    error.insertAfter(element);
                    // element.addClass('error'); 
                }
        },
        rules: {
            product_name: {
                required: true,
                maxlength: 225
            },
            group_name: {
                required: true
            },
            alias_sku: {
                required: true
            },
            width: {
                required: true,
                number: true
            },
            length: {
                required: true,
                number: true
            },
            gage: {
                digits: true
            },
            master_packing: {
                required: true
            },
            bharti: {
                required: true,
                digits: true
            },
            number_of_bags_per_box: {
                required: true,
                digits: true
            },
            pipe_size: {
                number: true
            },
            packing_material_qty: {
                digits: true
            },
            outer_name: {
                maxlength: 255
            },
            carton_no: {
                maxlength: 255
            },
            number_of_outer: {
                digits: true
            },
            packing_material_type: {
                maxlength: 255
            },
            // rate: {
            //     required: true,
            //     number: true
            // },
            // packing_material_category: {
            //     required: true,
            // },
            packing_material_type: {
                    required: true,
                    // maxlength: 255
                },
            packing_material_name: {
                required: true,
            },
        },
        messages: {
            product_name: "Please enter Product Name",
            group_name: "Please select  Group Name",
            alias_sku: "Please enter Alias / SKU",
            width: {
                required: "Please enter Width in inches",
                number: "Please enter number"
            },
            length: {
                required: "Please enter Length in meters",
                number: "Please enter number"
            },
            gage: {
                digits: "Please enter integer"
            },
            master_packing: "Please enter Master Packing",
            bharti: {
                required: "Please enter Bharti",
                digits: "Please enter integer"
            },
            number_of_bags_per_box: {
                required: "Please enter Bags/Box",
                digits: "Please enter integer"
            },
            pipe_size: {
                number: "Please enter  number"
            },
            packing_material_qty: {
                digits: "Please enter  integer"
            },
            outer_name: {
                maxlength: "Please enter no more than 255 characters"
            },
            carton_no: {
                maxlength: "Please enter no more than 255 characters"
            },
            number_of_outer: {
                digits: "Please enter  integer"
            },
            packing_material_type: {
                    required: "Please select Packing Material Sub Category.",
                    // maxlength: "Please enter no more than 255 characters"
                },
            // rate: {
            //     required: "Please enter Rate",
            //     number: "Please enter  number"
            // },
            packing_material_name: {
                    required: "Please select packing material name.",
                },
        }
    });

    jQuery.validator.addMethod("filesize", function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param * 1024);
    });
});
document.addEventListener('DOMContentLoaded', function () {
        const addGroupButton = document.getElementById('add_group_button');
        const saveNewGroupButton = document.getElementById('save_new_group_button');
        const groupNameWrapper = document.getElementById('group_name_wrapper');
        const newGroupNameWrapper = document.getElementById('new_group_name_wrapper');
        const groupNameSelect = document.getElementById('group_name_select');
        const newGroupNameInput = document.getElementById('new_group_name');

        addGroupButton.addEventListener('click', function () {
            groupNameWrapper.classList.add('d-none');
            newGroupNameWrapper.classList.remove('d-none');
        });

        saveNewGroupButton.addEventListener('click', function () {
            const newGroupName = newGroupNameInput.value.trim();
            if (newGroupName) {
                $.ajax({
                    url: '{{ route('product.storeGroup') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: newGroupName
                    },
                    success: function (response) {
                        if (response.success) {
                            const newOption = document.createElement('option');
                            newOption.value = response.group.id;
                            newOption.textContent = response.group.name;
                            newOption.selected = true;
                            groupNameSelect.appendChild(newOption);

                            newGroupNameInput.value = '';
                            groupNameWrapper.classList.remove('d-none');
                            newGroupNameWrapper.classList.add('d-none');
                            toastr.success('Group name added successfully!');
                            } else {
                                toastr.error(response.error);
                            }
                        },
                        error: function (response) {
                            toastr.error('Error adding new group name.');
                        }
                });
            } else {
                toastr.error('Please enter a group name.');
            }
        });
    });

    $(document).ready(function() {
    $('#packing_material_category').on('change', function() {
        var selectedCategoryId = $(this).val();
        var packingMaterialTypeDiv = $('#packing_material_type_div');
        var packingMaterialTypeSelect = $('#packing_material_type');
        var packingMaterialNameSelect = $('#packing_material_name');

        packingMaterialTypeSelect.empty().append('<option value="">Select material Type</option>');
        packingMaterialNameSelect.empty().append('<option value="">Select material Name</option>');

        if (selectedCategoryId) {
            $.ajax({
                url: '{{ route("material.getSubcategories", ":id") }}'.replace(':id', selectedCategoryId),
                type: 'GET',
                success: function(data) {
                    if (data.subcategories.length > 0) {
                        packingMaterialTypeSelect.empty().append('<option value="">Select subcategory</option>');
                        $.each(data.subcategories, function(index, subcategory) {
                            packingMaterialTypeSelect.append('<option value="' + subcategory.id + '">' + subcategory.sub_cat_name + '</option>');
                        });
                        packingMaterialTypeSelect.find('option:eq(1)').prop('selected', true);
                        packingMaterialTypeDiv.show();

                        var selectedSubCategoryId = packingMaterialTypeSelect.val();
                        loadMaterialNames(selectedCategoryId, selectedSubCategoryId);
                        packingMaterialTypeSelect.off('change').on('change', function() {
                            var selectedSubCategoryId = $(this).val();
                            if (selectedSubCategoryId) {
                                loadMaterialNames(selectedCategoryId, selectedSubCategoryId);
                            } else {
                                packingMaterialNameSelect.empty().append('<option value="">Select material Name</option>');
                            }
                        });
                    } else {
                        packingMaterialTypeDiv.hide();
                        loadMaterialNames(selectedCategoryId, null);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        } else {
            packingMaterialTypeDiv.hide();
            packingMaterialNameSelect.empty().append('<option value="">Select material Name</option>');
        }
    });

    // $('#packing_material_type').on('change', function() {
    //     var selectedSubCategoryId = $(this).val();
    //     var packingMaterialTypeDiv = $('#packing_material_type_div');
    //     var packingMaterialTypeSelect = $('#packing_material_type');
    //     var packingMaterialNameSelect = $('#packing_material_name');

    //     //packingMaterialTypeSelect.empty().append('<option value="">Select material Type</option>');
    //     packingMaterialNameSelect.empty().append('<option value=""></option>');

    //     if (selectedSubCategoryId) {
    //         $.ajax({
    //         url: '{{ route("material.getMaterialsBySubCat", ":id") }}'.replace(':id', selectedSubCategoryId),
    //         type: 'GET',
    //         success: function(materials) {
    //             // var materials = response.materials;
    //             console.log('Materials:', materials.materials.length);
    //             var packingMaterialNameSelect = $('#packing_material_name');
    //             packingMaterialNameSelect.empty().append('<option value=""></option>');

    //             // if (materials.materials.length > 0) {
    //             //     $.each(materials.materials, function(index, material) {
    //             //         // Append each material to the select dropdown
    //             //         packingMaterialNameSelect.append('<option value="' + material.id + '">' + material.material_name + '</option>');
    //             //     });
    //             //     packingMaterialNameSelect.find('option:eq(1)').prop('selected', true);
    //             // } else {
    //             //     // Show a message if no materials are available
    //             //     packingMaterialNameSelect.append('<option value="">No materials available</option>');
    //             // }
    //             if (materials.materials.length > 0) {
    //                 console.log('555555');
    //                 packingMaterialNameSelect.empty(); // Clear previous options
    //                 $.each(materials.materials, function(index, material) {
    //                     packingMaterialNameSelect.append(
    //                         '<option value="' + material.id + '" data-weight="' + material.material_weight + '">' + 
    //                         material.material_name + 
    //                         '</option>'
    //                     );
    //                 });
    //                 packingMaterialNameSelect.find('option:eq(1)').prop('selected', true);
    //             } else {
    //                 console.log('6666666');
    //                 packingMaterialNameSelect.empty(); // Clear previous options
    //                 packingMaterialNameSelect.append('<option value="">No materials available</option>');
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('AJAX error:', error);
    //         }
    //     });
    //     } else {
    //         packingMaterialTypeDiv.hide();
    //         packingMaterialNameSelect.empty().append('<option value="">Select material Name</option>');
    //     }
    // });
    $('#packing_material_type').on('change', function () {
    var selectedSubCategoryId = $(this).val();
    var packingMaterialNameSelect = $('#packing_material_name');

    // Clear and add the default "Select Material Name" option
    packingMaterialNameSelect.empty().append('<option value="">Select Material Name</option>');

    if (selectedSubCategoryId) {
        $.ajax({
            url: '{{ route("material.getMaterialsBySubCat", ":id") }}'.replace(':id', selectedSubCategoryId),
            type: 'GET',
            success: function (materials) {
                console.log('Materials:', materials.materials.length);

                if (materials.materials.length > 0) {
                    $.each(materials.materials, function (index, material) {
                        packingMaterialNameSelect.append(
                            '<option value="' + material.id + '" data-weight="' + material.material_weight + '">' +
                            material.material_name +
                            '</option>'
                        );
                    });
                } else {
                    packingMaterialNameSelect.append('<option value="">No materials available</option>');
                }

                if (packingMaterialNameSelect.hasClass('select2')) {
                    packingMaterialNameSelect.select2('destroy').select2();
                }
                packingMaterialNameSelect.trigger('change');
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    } else {
        packingMaterialNameSelect.append('<option value="">Select Material Name</option>').trigger('change');
    }
});

    function loadMaterialNames(categoryId, subcategoryId = null) {
        $.ajax({
            url: '{{ route("material.getMaterials", ["categoryId" => ":categoryId", "subcategoryId" => ":subcategoryId"]) }}'
                    .replace(':categoryId', categoryId)
                    .replace(':subcategoryId', subcategoryId ? subcategoryId : ''),
            type: 'GET',
            success: function(materials) {
                var packingMaterialNameSelect = $('#packing_material_name');
                packingMaterialNameSelect.empty().append('<option value="">Select material Name</option>');

                if (materials.materials.length > 0) {
                    $.each(materials.materials, function(index, material) {
                        packingMaterialNameSelect.append('<option value="' + material.id + '">' + material.material_name + '</option>');
                    });
                    packingMaterialNameSelect.find('option:eq(1)').prop('selected', true);
                } else {
                    packingMaterialNameSelect.append('<option value="">No materials available</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }
});
</script>
<!-- <script>
    $(document).ready(function() {
        var selectedCategoryId = '{{ $selectedCategory }}';
        var selectedSubCategoryId = '{{ $selectedSubCategory }}';

        if (selectedCategoryId) {
            $('#packing_material_category').val(selectedCategoryId).trigger('change');
            
            $.ajax({
                url: '{{ route("material.getSubcategories", ":id") }}'.replace(':id', selectedCategoryId),
                type: 'GET',
                success: function(data) {
                    var packingMaterialTypeSelect = $('#packing_material_type');
                    packingMaterialTypeSelect.empty();
                    packingMaterialTypeSelect.append('<option value="">Select material Type</option>');

                    if (data.subcategories && data.subcategories.length > 0) {
                        $.each(data.subcategories, function(index, subcategory) {
                            packingMaterialTypeSelect.append('<option value="' + subcategory.id + '">' + subcategory.sub_cat_name + '</option>');
                        });

                        if (selectedSubCategoryId) {
                            packingMaterialTypeSelect.val(selectedSubCategoryId);
                        }

                        $('#packing_material_type_div').show(); 
                    } else {
                        $('#packing_material_type_div').hide();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        }
    });
</script> -->
<script>
    $(document).ready(function() {
        var selectedCategoryId = '{{ $selectedCategory }}';
        var selectedSubCategoryId = '{{ $selectedSubCategory }}';
        var selectedMaterialId = '{{ $selectedMaterial }}'; // This is now defined

        if (selectedCategoryId) {
            $('#packing_material_category').val(selectedCategoryId).trigger('change');

            $.ajax({
                url: '{{ route("material.getSubcategories", ":id") }}'.replace(':id', selectedCategoryId),
                type: 'GET',
                success: function(data) {
                    var packingMaterialTypeSelect = $('#packing_material_type');
                    packingMaterialTypeSelect.empty();
                    packingMaterialTypeSelect.append('<option value="">Select material Type</option>');

                    if (data.subcategories && data.subcategories.length > 0) {
                        $.each(data.subcategories, function(index, subcategory) {
                            packingMaterialTypeSelect.append('<option value="' + subcategory.id + '">' + subcategory.sub_cat_name + '</option>');
                        });

                        if (selectedSubCategoryId) {
                            packingMaterialTypeSelect.val(selectedSubCategoryId).trigger('change');
                        }

                        $('#packing_material_type_div').show();
                    } else {
                        $('#packing_material_type_div').hide();
                    }

                    // Fetch materials based on category and subcategory (if any)
                    fetchMaterials(selectedCategoryId, selectedSubCategoryId, selectedMaterialId);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        }

        function fetchMaterials(categoryId, subCategoryId, selectedMaterialId) {
            $.ajax({
                url: '{{ route("material.getMaterials", [":categoryId", ":subCategoryId"]) }}'
                    .replace(':categoryId', categoryId)
                    .replace(':subCategoryId', subCategoryId ? subCategoryId : 'null'),
                type: 'GET',
                success: function(data) {
                    var packingMaterialNameSelect = $('#packing_material_name');
                    packingMaterialNameSelect.empty();
                    packingMaterialNameSelect.append('<option value="">Select material Name</option>');

                    $.each(data.materials, function(index, material) {
                        packingMaterialNameSelect.append('<option value="' + material.id + '">' + material.material_name + '</option>');
                    });

                    if (selectedMaterialId) {
                        packingMaterialNameSelect.val(selectedMaterialId);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        }
    });
</script>

<script>
    const decimalInputs = document.querySelectorAll('.decimal-input');

    decimalInputs.forEach(input => {
        input.addEventListener('input', function () {
            const parts = this.value.split('.');
            if (parts.length > 2) {
                this.value = parts[0] + '.' + parts.slice(1).join('');
            }
            if (parts[1] && parts[1].length > 3) {
                this.value = parts[0] + '.' + parts[1].slice(0, 3);
            }
        });
    });

    function validateInputs() {
        let valid = true;
        decimalInputs.forEach(input => {
            const regex = /^\d+(\.\d{1,3})?$/; 
            if (!regex.test(input.value)) {
                alert(`Please enter a valid number with up to three decimal places in ${input.placeholder}.`);
                valid = false; 
            }
        });
        return valid;
    }
</script>
@endsection
@section('modul')
<div class="modal fade" id="groupaddModulData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog color-model-popup">
        <div class="modal-content model-data trasport-ppp">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Group Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('products.productgroupadd') }}" method="POST" id="groupformForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <label class="heading-content" for="name">Name</label>
                            <input type="text" class="form-control input-form-content @error('name') is-invalid @enderror @if(!empty(old('name'))) is-valid @endif" id="groupname" name="name" placeholder="Enter name" value="{{ old('name') }}">
                            <div class="invalid-feedback"></div>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer group-popup-footer">
                    <div class="button-1">
                        <button type="submit" class="delete-customer">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

