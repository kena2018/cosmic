@extends('layouts.app')
@section('navbarTitel', 'Customers Create')
@section('content')

<div class="main-outer">
    <div class="outer card">
        <form id ="customerCreateForm" class="needs-validation" action="{{ route('customers.store')}}" method="post" novalidate id="form1">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Company and Billing Information</span>
                <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
                <!-- <div class="btn-sec btn_group">
                    <a href="{{route('customers.index')}}">
                    <span class="back-icons back-tab-icon"></span>
                    </a>
                </div> -->
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    @csrf
                    <div class="row form-inp-group">
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="company_name">Company Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('company_name') is-invalid @enderror" name="company_name" id="company_name" placeholder="Enter company name" value="{{ old('company_name') }}" >
                            @error('company_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="GSTIN">GSTIN<span style="color: red;">*</span></label>
                            <input type="text" name="gstin" class="form-control input-form-content @error('gstin') is-invalid @enderror" id="gstindata" placeholder="22AAAAA0000A1Z5" required value="{{ old('gstin') }}">
                            <span id="gstError" style="color: red; display: none;">Invalid GST Number</span>
                            @error('gstin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-4 mb-3 payment-sec-inp">
                            <label class="heading-content"  for="paymentterms">Payment Terms<span style="color: red;">*</span></label>
                            <select class="custom-select d-block w-100 form-select-grp select2 @error('payment_terms') is-invalid @enderror" id="payment_terms" name="payment_terms">
                                <option value="">Select Payment</option>
                                <option value="Advance"{{ old('payment_terms') == 'Advance' ? 'selected' : '' }}>Advance</option>
                                <option value="7 days"{{ old('payment_terms') == '7 days' ? 'selected' : '' }}>7 days</option>
                                <option value="30 days"{{ old('payment_terms') == '30 days' ? 'selected' : '' }}>30 days</option>
                                <option value="45 days"{{ old('payment_terms') == '45 days' ? 'selected' : '' }}>45 days</option>
                            </select>
                            @error('payment_terms')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="address">Billing Address Line 1<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content tooltip-data billing-inps input_form_cntrl @error('address1') is-invalid @enderror" id="address1" name="address1" placeholder="4140 Parker Rd. Allentown, New Mexico 31134"required title="{{ old('address1') }}" value="{{ old('address1') }}">
                            @error('address1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="number">Billing Address Line 2</label>
                            <input type="text" class="form-control input-form-content " name="address2" id="address2"placeholder="6391 Elgin St. Celina, Delaware 10299" value="{{ old('address2') }}">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="name">Pin<span style="color: red;">*</span></label>
                            <input type="pin" class="form-control input-form-content @error('pin') is-invalid @enderror" id="pin" name="pin" value="{{ old('pin') }}" placeholder="352218">
                            @error('pin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="name">Country<span style="color: red;">*</span></label>
                            <select class="custom-select d-block w-100 form-select-grp select2" id="country" name="country_id"required>
                                <option value="">Select Country</option>
                                    
                                    @foreach($countrys as $country)
                                        <option value="{{$country->id}}" {{ old('country_id', '101') == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
                                    @endforeach
                            </select>

                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="State">State<span style="color: red;">*</span></label>
                            <select class="custom-select d-block w-100 form-select-grp select2" id="state" name="state_id" required >
                                <option value="">Select State</option>
                            </select>
                            
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="name">City<span style="color: red;">*</span></label>
                            <select class="custom-select d-block w-100 form-select-grp select2" id="city" name="city_id" required>
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-lg-6 mb-6 transport_details">
                            <div class="col-lg-10 mb-3">
                                <label class="heading-content"  for="name">Group</label>
                                <select class="custom-select d-block w-100 form-select-grp select2" id="group" name="group">
                                    <option value="">Select Group</option>
                                    @foreach( $groups as $group )
                                        <option value="{{$group->id}}"{{ old('group') == $group->id ? 'selected' : '' }}>{{$group->name}}</option>
                                    @endforeach
                                </select>
                                @error('group')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="add-icon-btn grp-icon-center-btn" id="groupaddModul">
                                <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff" class="bi bi-plus" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg>
                            </div>
                        </div>    
                        <div class="col-lg-6 mb-3">
                            <label class="heading-content"  for="name">Perf. Matrix<span style="color: red;">*</span></label>
                            <input type="test" name="matrix" class="form-control @error('matrix') is-invalid @enderror" value="{{old('matrix')}}">
                            @error('matrix')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                    </div>
                    <div class="heading-btn">
                        <span class="companydetails-section-heading">Personal Information</span>
                    </div>
                    <hr class="addsupplier-section-border">
                    <div class="upload-file-sec">
                        <div class="row customer-files-sec">
                                    <div class="row form-inp-group">
                                        <div class="col-lg-6 mb-3">
                                            <label class="heading-content"  for="name">First Name<span style="color: red;">*</span></label>
                                            <input type="text" class="form-control input-form-content @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="John" value="{{ old('first_name') }}" required>
                                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="heading-content"  for="name">Last Name</label>
                                            <input type="text" class="form-control input-form-content @error('last_name') is-invalid @enderror" id="last_name"
                                            placeholder="William" value="{{ old('last_name') }}" name="last_name" required>
                                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="row form-inp-group">
                                        <div class="col-lg-6 mb-3">
                                            <label class="heading-content"  for="name">Phone Number<span style="color: red;">*</span></label>
                                            <input type="number" class="form-control input-form-content @error('contect') is-invalid @enderror" id="number"placeholder="+123456789 " name="contect" value="{{old('contect')}}">
                                            @error('contect')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="heading-content"  for="name">Alternate Phone Number</label>
                                            <input type="number" class="form-control input-form-coentent @error('alt_phone') is-invalid @enderror" id="alt_phone"placeholder="+123456789 " name="alt_phone" value="{{old('alt_phone')}}">
                                            @error('alt_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>   
                                    </div>
                                    <div class="row form-inp-group">
                                        <div class="col-lg-6 mb-3">
                                            <label class="heading-content"  for="email">Email</label>
                                            <input type="email" class="form-control input-form-content @error('email') is-invalid @enderror" id="address"placeholder="john@gmail.com" required name="email" value="{{old('email')}}">
                                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                <div class="upload--file-section">
                                    <div class="btn-sec btn_group">
                                        
                                    </div>
                                    <div class="order-btn-grp">
                                    <div class="btn-sec btn_group">
                                        <div class="button-1 cta_btn">
                                            <button id ="saveButton" type="submit" class="">Save</button>
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
<script>
    $(document).ready(function () {
        $('#company_name').focus();
        $('#groupformForm').validate({
            rules: {
                name: {
                    required: true,
                }
            },
            messages: {
                name: 'Please enter Group.'
            }
        });
        $(document).on('click','#leaveButton', function(){
            window.location.href = "{{ route('customers.index') }}";
        });
        $('.orderList').click( function(){
            $("#indexModul").modal("show");
        });
        // Initialize form validation on the form
        $('#customerCreateForm').validate({
            rules: {
                company_name: {
                    required: true,
                    maxlength: 255,
                    // noSpecialChars: true,
                },
                gstin: {
                    required: true,
                    maxlength: 255,
                    gstindata: true // Correct method name
                },
                payment_terms: {
                    required: true,
                },
                address1: {
                    required: true,
                    maxlength: 255
                },
                address2: {
                    required: false,
                    maxlength: 255
                },
                country_id: {
                    required: true,
                    // digits: true
                },
                state_id: {
                    required: true,
                    // digits: true
                },
                pin: {
                    required: true,
                    digits: true
                },
                city_id: {
                    required: true,
                    // digits: true,
                },
                matrix: {
                    required: true,
                    number: true  // Ensures that only numeric values are allowed
                },
                first_name: {
                    required: true,
                    maxlength: 255,
                    noSpecialChars: true,
                },
                last_name: {
                    required: false,
                    maxlength: 255,
                    noSpecialChars: true,
                },
                email: {
                    required: false,
                    email: true,
                    maxlength: 255
                },
                contect: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 13
                },
                alt_phone: {
                    required: false,
                    digits: true,
                    minlength: 10,
                    maxlength: 13
                },
            },
            messages: {
                company_name: {
                    required: "Please enter Company Name.",
                    
                },
                gstin: {
                    required: "Please enter GST Number.",
                    minlength: "GSTIN cannot be less than 1 character.",
                    maxlength: "GSTIN cannot exceed 255 characters.",
                    remote: "GSTIN already exists." // Customize this message as needed
                },
                payment_terms: {
                    required: "Please select Payment Terms.",
                },
                address1: {
                    required: "Please enter Billing Address.",
                    maxlength: "Address 1 cannot exceed 255 characters."
                },
                address2: {
                    maxlength: "Address 2 cannot exceed 255 characters."
                },
                country_id: {
                    required: "Please select Country.",
                    // digits: "Country ID must be an integer."
                },
                state_id: {
                    required: "Please select State.",
                    // digits: "State ID must be an integer."
                },
                pin: {
                    required: "Please enter Pin.",
                    digits: "PIN code must be an integer."
                },
                city_id: {
                    required: "Please select City.",
                    // digits: "City ID must be an integer."
                },
                matrix: {
                    required: "Please enter Perf. Matrix.",
                    number: "Please enter number for the perf. matrix."
                },
                first_name: {
                    required: "Please enter First Name.",
                    maxlength: "First name cannot exceed 255 characters."
                },
                last_name: {
                    maxlength: "Last name cannot exceed 255 characters."
                },
                email: {
                    email: "Please enter email address.",
                    maxlength: "Email cannot exceed 255 characters."
                },
                contect: {
                    required: "Please enter Phone number.",
                    digits: "Phone number must be digits.",
                    minlength: "Phone number must be at least 10 digits.",
                    maxlength: "Phone number cannot exceed 13 digits."
                },
                alt_phone: {
                    digits: "Alternate phone number must be digits.",
                    minlength: "Alternate phone number must be at least 10 digits.",
                    maxlength: "Alternate phone number cannot exceed 13 digits."
                },
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                if (element.hasClass('select2')) {
                    error.insertAfter(element.next('span.select2'));
                    element.next('span.select2').find('.select2-selection__rendered').addClass('error-border');
                } else {
                    error.insertAfter(element);
                    // element.addClass('error'); 
                }

            },
            // highlight: function (element) {
            //     $(element).addClass('is-invalid').removeClass('is-valid');
            // },
            // unhighlight: function (element) {
            //     $(element).addClass('is-valid').removeClass('is-invalid');
            // }
        });
        jQuery.validator.addMethod("gstindata", function(value, element) {
            return this.optional(element) || /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[Z]{1}[0-9A-Z]{1}$/.test(value);
        }, "Please enter a valid GST number");
        $.validator.addMethod("noSpecialChars", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9\s]+$/.test(value); 
            // This regex allows letters, numbers, and spaces only
        }, "Name should not contain special characters.");
    });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
        $(document).on('focusin', '.select2', function(e) {
            // Select2 handles the focus differently, this ensures the dropdown opens on focus
            $(this).siblings('select').select2('open');
        });
        $('#group').on('select2:close', function(e) {
            if ($('#group').val() === "") {
                $("#groupaddModulData").modal("show");
                // console.log('fsd');
                $('#groupaddModul').focus(); // Focus on "+" button when Select2 is closed with no selection
            }
        });
        $('#groupaddModulData').on('hidden.bs.modal', function () {
            $('input[name="matrix"]').focus(); // Move focus to the next field (Perf. Matrix) after modal closes
        });
        $('button[type="submit"]').on('focus', function() {
            $(this).addClass('btn-focus');
        }).on('blur', function() {
            $(this).removeClass('btn-focus');
        });
        
        // $('#gstindata').on('keyup', function() {
        //     var gstNumber = $(this).val();
        //     var showError = false;
        //     var errorMessage = '';

        //     // Ensure the GST number is exactly 15 characters long
        //     // if (gstNumber.length !== 15) {
        //     //     showError = true;
        //     //     errorMessage = "GST number must be exactly 15 characters long.";
        //     // } else {
        //         // Check if the first two characters are digits
        //         if (gstNumber.length == 1) {
       
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
                        $('#group').append(new Option(response.newOption.text, response.newOption.value, true, true));
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

        var countryId = $('#country').val();
        var default_state_id = {{ old('state_id', 12) }};
        var default_city_id = {{ old('city_id', 783) }};

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

@endsection
@section('modul')
<div class="modal fade" id="groupaddModulData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog color-model-popup">
        <div class="modal-content model-data trasport-ppp">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Group Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('customers.groupadd') }}" method="POST" id="groupformForm">
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