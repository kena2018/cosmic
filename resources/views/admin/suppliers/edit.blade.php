@extends('layouts.app')
@section('navbarTitel', 'Edit Suppliers')
@section('content')
<div class="main-outer">
    <div class="outer card">
        <div class="heading-btn">
            <span class="addsupplier-section-heading">Company Details</span>
            <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
        </div>    
        <form action="{{ route('suppliers.update',$suppliers->id) }}" method="post" id="supplierEditForm">
            @csrf
            @method('PUT')
             
            
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-md-6 mb-3">
                            <label class="heading-content" for="company_name">Company Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content" name="company_name" id="company_name" placeholder="Enter your Company Number" value="{{ old('company_name', $suppliers->company_name ?? '') }}">
                            @error('company_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="heading-content" for="gst_number">GST Number<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content" name="gst_number" id="gstindata" placeholder="Enter your GST Number" value="{{ old('gst_number', $suppliers->gst_number ?? '') }}">
                            <span id="gstError" style="color: red; display: none;">Invalid GST Number</span>
                            @error('gst_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="gst_type">GST Type</label>
                            <select class="custom-select d-block w-100 form-select-grp select2" id="gst_type" name="gst_type">
                                <option value="">Select GST Type</option>
                                    $suppliers->gst_type
                                    @foreach($gstTypes as $gstType)
                                        <option value="{{$gstType}}" {{ old('gst_type', $suppliers->gst_type ?? '') == $gstType ? 'selected' : '' }} >{{$gstType}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="email_cmp">Email</label>
                            <input type="text" class="form-control input-form-content" name="email_cmp" id="email_cmp" placeholder="Enter your email" value="{{ old('email_cmp', $suppliers->email_cmp ?? '') }}">
                            
                            @error('email_cmp')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="contect_cmp">Phone no.<span style="color: red;">*</span></label>
                            <input type="number" class="form-control input-form-content" name="contect_cmp" id="contect_cmp" placeholder="Enter your Phone number" value="{{ old('contect_cmp', $suppliers->contect_cmp ?? '') }}">
                            @error('contect_cmp')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-inp-group">    
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="address1">Address<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content" name="address" id="address" placeholder="Address" value="{{ old('address', $suppliers->address1 ?? '') }}">
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="pincode">Pincode<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content" name="pincode" id="pincode" placeholder="Pincode" value="{{ old('pincode', $suppliers->pincode ?? '') }}">
                            @error('pincode')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                                <label class="heading-content" for="country">Country<span style="color: red;">*</span></label>
                                <select class="custom-select d-block w-100 form-select-grp select2" id="country" name="country_id">
                                <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" {{ old('country_id', $suppliers->country) == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-inp-group">   
                        <div class="col-md-4 mb-3">
                            <label class="heading-content"  for="State">State<span style="color: red;">*</span></label>
                            <select class="custom-select d-block w-100 form-select-grp select2" id="state" name="state_id">
                                <option value="">Select State</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content"  for="City">City<span style="color: red;">*</span></label>
                            <select class="custom-select d-block w-100 form-select-grp select2" id="city" name="city_id" >
                                <option value="">Select City</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="material">Material Sub Category<span style="color: red;">*</span></label>
                            <select class="custom-select d-block w-100 form-select-grp select2" id="material" name="material">
                                <option value="">Select Material</option>
                                @foreach($materials as $material)
                                        <option value="{{$material->id}}" {{ old('material', $suppliers->material) == $material->id ? 'selected' : '' }} >{{$material->sub_cat_name}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="heading-btn">
                <span class="companydetails-section-heading">Contact Person Details</span>
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="name">Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content" name="name" id="name" placeholder="Enter your name" value="{{ old('name', $suppliers->name ?? '') }}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="email">Email</label>
                            <input type="text" class="form-control input-form-content" name="email" id="email" placeholder="Enter your Email" value="{{ old('email', $suppliers->email ?? '') }}">
                                @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="contect">Phone no.</label>
                            <input type="number" class="form-control" name="contect" id="contect" placeholder="Enter your Phone number" value="{{ old('contect', $suppliers->contect ?? '') }}">
                            @error('contect')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="upload--file-section">
                        <div class="btn-sec btn_group"></div>
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
</div>

<!--  END CONTENT AREA  -->
@endsection
@section('js')
<!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#company_name').focus();
    $('.select2').select2();
    $(document).on('focusin', '.select2', function(e) {
        // Select2 handles the focus differently, this ensures the dropdown opens on focus
        $(this).siblings('select').select2('open');
    });
    $('button[type="submit"]').on('focus', function() {
        $(this).addClass('btn-focus');
    }).on('blur', function() {
        $(this).removeClass('btn-focus');
    });
    $('select').on('focus', function() {
        // Only open if it's not a Select2 dropdown
        if (!$(this).hasClass('select2-hidden-accessible')) {
            $(this).prop('size', 5); // Open regular select dropdown with a larger size
        }
    }).on('blur', function() {
        $(this).prop('size', 1); // Reset size when focus is lost
    }).on('change', function() {
        $(this).prop('size', 1); // Close the dropdown after selection
    });

    var countryId = $('#country').val();
    var default_state_id = {{ old('state_id', $suppliers->state) }};
    var default_city_id = {{ old('city_id', $suppliers->city) }};

    function loadStates(countryId, selected_state_id = null) {
        $.ajax({
            url: "{{ route('customers.getstate', ':countryId') }}".replace(':countryId', countryId),
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#state').empty();
                $('#state').append('<option value="">Select State</option>');
                $.each(data, function(key, value) {
                    $('#state').append('<option value="'+ value.id +'"'+ (selected_state_id == value.id ? ' selected' : '') +'>'+ value.name +'</option>');
                });
                if (selected_state_id) {
                    loadCities(selected_state_id, default_city_id);
                }
            }
        });
    }

    function loadCities(stateId, selected_city_id = null) {
        $.ajax({
            url: "{{ route('customers.getcity', ':stateId') }}".replace(':stateId', stateId),
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#city').empty();
                $('#city').append('<option value="">Select City</option>');
                $.each(data, function(key, value) {
                    $('#city').append('<option value="'+ value.id +'"'+ (selected_city_id == value.id ? ' selected' : '') +'>'+ value.name +'</option>');
                });
            }
        });
    }

    $('#country').change(function() {
        var countryId = $(this).val();
        loadStates(countryId);
        $('#city').empty();
        $('#city').append('<option value="">Select City</option>');
    });

    $('#state').change(function() {
        var stateId = $(this).val();
        loadCities(stateId);
    });

    // Load states and cities for the default country
    if (countryId) {
        loadStates(countryId, default_state_id);
    }
});
</script>
<script>
$(document).ready(function () {
    $(document).on('click','#leaveButton', function(){
        window.location.href = "{{ route('suppliers.index') }}";
    });
    $('.orderList').click( function(){
        $("#indexModul").modal("show");
    });
    $("#supplierEditForm").validate({
        errorClass: "is-invalid",
        errorElement: "div", 
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            if (element.hasClass('select2-hidden-accessible')) {
                error.insertAfter(element.next('.select2')); // Place error after the select2 container
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
              
                    company_name: {
                        required: true,
                        maxlength: 255
                    },
                    gst_number: {
                        required: true,
                        maxlength: 255,
                        gstindata: true // Correct method name
                    },
                    material: {
                        required: true,
                        maxlength: 255
                    },
                    contect_cmp: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 13
                    },
                    address: {
                        required: true,
                        maxlength: 255
                    },
                    contect : {  
                        required: true,
                        maxlength: 255,
                        minlength: 10, // Minimum 10 digits
                        maxlength: 13  // Maximum 13 digits
                    },
                    name : {
                        required: true,
                        maxlength: 255
                    },
                    pincode: {
                        required: true,
                        digits: true,
                        minlength: 6,
                        maxlength: 6
                    },
                    country_id: {
                        required: true,
                    },
                    state_id: {
                        required: true,
                    },
                    city_id:{
                        required: true,
                    }
                },
                messages: {
                    company_name: {
                        required: "Please enter Company Name.",
                        maxlength: "Company name cannot exceed 255 characters"
                    },
                    gst_number: {
                        required: "Please enter GST number.",
                        maxlength: "GST number cannot exceed 255 characters"
                    },
                    material: {
                        required: "Please select Material Sub Category.",
                        maxlength: "GST type cannot exceed 255 characters"
                    },
                    contect_cmp: {
                        required: "Please enter Phone No.",
                        digits: "Please enter only digits",
                        minlength: "Contact number must be at least 10 digits",
                        maxlength: "Contact number cannot exceed 13 digits"
                    },
                    name: {
                        required: "Please enter Name.",
                    },
                    address: {
                        required: "Please enter Address.",
                        maxlength: "Address cannot exceed 255 characters"
                    },
                    contect : {
                        required: "Please enter a valid phone number.",
                        digits: "Please enter a valid phone number with only digits.",
                        minlength: "The phone number must be at least 10 digits long.",
                        maxlength: "The phone number cannot be longer than 13 digits."
                    },
                    pincode: {
                        required: "Please enter Pincode.",
                        digits: "Please enter only digits",
                        minlength: "Pincode must be exactly 6 digits",
                        maxlength: "Pincode must be exactly 6 digits"
                    },
                    country_id: {
                        required: "Please select Country.",
                    },
                    state_id: {
                        required: "Please select State.",
                    },
                    city_id: {
                        required: "Please select City.",
                    }
                },
    });

    jQuery.validator.addMethod("filesize", function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param * 1024);
    });
    jQuery.validator.addMethod("gstindata", function(value, element) {
        return this.optional(element) || /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[Z]{1}[0-9A-Z]{1}$/.test(value);
    }, "Please enter a valid GST number");
    // jQuery.validator.addMethod("gstindata", function(value, element) {
    //     return this.optional(element) || /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[Z]{1}[0-9A-Z]{1}$/.test(value);
    // }, "Please enter a valid GST number");
});
</script>

@endsection