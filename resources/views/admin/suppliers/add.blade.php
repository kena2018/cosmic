@extends('layouts.app')
@section('navbarTitel', 'Add Suppliers')
@section('content')

<div class="main-outer">
    <div class="outer card">
        <form action="{{ route('suppliers.submit') }}" method="post" id="supplierAdd">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Contact Person Details</span>
                <div class="btn-sec btn_group">
                    <a href="{{route('suppliers.index')}}">
                        <span class="back-icons back-tab-icon"></span>
                    </a>
                </div>
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-md-6 mb-3">
                            <label class="heading-content" for="company_name">Company Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content" name="company_name" id="company_name" placeholder="Enter your Company Number" value="{{ old('company_name') }}">
                            @error('company_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="heading-content" for="gst_number">GST Number<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content" name="gst_number" id="gst_number" placeholder="Enter your GST Number" value="{{ old('gst_number') }}">
                            @error('gst_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="gst_type">GST Type<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content" name="gst_type" id="gst_type" placeholder="GST Type" value="{{ old('gst_type') }}">
                            @error('gst_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="email_cmp">Email<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content" name="email_cmp" id="email_cmp" placeholder="Enter your email" value="{{ old('email_cmp') }}">
                            
                            @error('email_cmp')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="contact_cmp">Phone<span style="color: red;">*</span></label>
                            <input type="phone" class="form-control input-form-content" name="contect_cmp" id="contect_cmp" placeholder="Enter your Phone number" value="{{ old('contect_cmp') }}">
                            @error('contect_cmp')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-inp-group">    
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="address1">Address Line 1<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content" name="address1" id="address1" placeholder="Address line 1" value="{{ old('address1') }}">
                            @error('address1')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="pincode">Pincode<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content" name="pincode" id="pincode" placeholder="Pincode" value="{{ old('pincode') }}">
                            @error('pincode')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                                <label class="heading-content" for="country">Country<span style="color: red;">*</span></label>
                                <input type="text" class="form-control input-form-content" name="country" id="country" placeholder="Select Country" value="{{ old('country') }}">
                            @error('country')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-inp-group">   
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="state">State<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content" name="state" id="state" placeholder="Select State" value="{{ old('state') }}">
                            @error('state')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="city">City<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content" name="city" id="city" placeholder="Select City" value="{{ old('city') }}">
                            @error('city')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>    
                    <div class="upload--file-section">
                        <div class="btn-sec btn_group"></div>
                        <div class="order-btn-grp">
                            <div class="btn-sec btn_group">
                                <div class="button-3 cta_btn">
                                    <button type="submit" class="primary-button stock-btn">Add Price List</button>
                                </div>
                            </div>
                            <div class="btn-sec btn_group">
                                <div class="button-1 cta_btn">
                                    <button type="submit" class="primary-button stock-btn">Add Supplier</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             
            <div class="heading-btn">
                <span class="companydetails-section-heading">CompanyDetails</span>
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    @csrf
                    <div class="row form-inp-group">
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="name">Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content" name="name" id="name" placeholder="Enter your name" value="{{ old('name') }}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="email">Email<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content" name="email" id="email" placeholder="Enter your Email" value="{{ old('email') }}">
                                @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="contect">Phone<span style="color: red;">*</span></label>
                            <input type="number" class="form-control" name="contact" id="contect" placeholder="Enter your Phone number" value="{{ old('contect') }}">
                            @error('contect')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>                        
                </div>
            </div>
        </form>
    </div>
</div>

<!--  END CONTENT AREA  -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click','#leaveButton', function(){
            window.location.href = "{{ route('suppliers.index') }}";
        });
        $('.orderList').click( function(){
            $("#indexModul").modal("show");
        });
        $('#company_name').focus();
        $('button[type="submit"]').on('focus', function() {
            $(this).addClass('btn-focus');
        }).on('blur', function() {
            $(this).removeClass('btn-focus');
        });
    });

    //     $("#supplierAdd").validate({
    //         ignore: ":hidden", // Ignore hidden fields
    //         rules: {
    //             name: {
    //                 // required: true,
    //             },
    //             email: {
    //                 // required: true,
    //                 email: true
    //             },
    //             contect: {
    //                 //required: true,
    //                 digits: true,
    //                 minlength: 10,
    //                 maxlength: 10
    //             },
    //             gst_number: {
    //                 //required: true,
    //             },
    //             gst_type: {
    //                 //required: true,
    //             },
    //             company_name: {
    //                 //required: true,
    //             },
    //             email_cmp: {
    //                 //required: true,
    //                 email: true
    //             },
    //             contect_cmp: {
    //                 //required: true,
    //                 digits: true,
    //                 minlength: 10,
    //                 maxlength: 10
    //             },
    //             address1: {
    //                 //required: true,
    //             },
    //             address2: {
    //                 //required: true,
    //             },
    //             pincode: {
    //                 //required: true,
    //                 digits: true
    //             },
    //             city: {
    //                 //required: true,
    //             },
    //             state: {
    //                 //required: true,
    //             },
    //             country: {
    //                 //required: true,
    //             },
    //         },
    //         messages: {
    //             // Custom error messages for each field (optional)
    //             name: {
    //                 required: "Please enter your name",
    //             },
    //             email: {
    //                 required: "Please enter your email",
    //                 email: "Please enter a valid email address"
    //             },
    //             contect: {
    //                 required: "Please enter your phone number",
    //                 digits: "Please enter a valid phone number",
    //                 minlength: "Phone number should be 10 digits",
    //                 maxlength: "Phone number should be 10 digits"
    //             },
    //             gst_number: {
    //                 required: "Please enter your GST number",
    //             },
    //             gst_type: {
    //                 required: "Please enter your GST type",
    //             },
    //             company_name: {
    //                 required: "Please enter your company name",
    //             },
    //             email_cmp: {
    //                 required: "Please enter company email",
    //                 email: "Please enter a valid email address"
    //             },
    //             contect_cmp: {
    //                 required: "Please enter company phone number",
    //                 digits: "Please enter a valid phone number",
    //                 minlength: "Phone number should be 10 digits",
    //                 maxlength: "Phone number should be 10 digits"
    //             },
    //             address1: {
    //                 required: "Please enter address 1",
    //             },
    //             address2: {
    //                 required: "Please enter address 2",
    //             },
    //             pincode: {
    //                 required: "Please enter your pincode",
    //                 digits: "Please enter a valid pincode"
    //             },
    //             city: {
    //                 required: "Please enter your city",
    //             },
    //             state: {
    //                 required: "Please enter your state",
    //             },
    //             country: {
    //                 required: "Please enter your country",
    //             }
    //         },
    //         errorPlacement: function(error, element) {
    //             error.appendTo(element.parent());
    //         },
    //         errorClass: 'text-danger',
    //     });
    // });
</script>
<!-- END MAIN CONTAINER -->
@endsection