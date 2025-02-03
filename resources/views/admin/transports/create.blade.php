@extends('layouts.app')
@section('navbarTitel', 'Transport Create')

@section('content')
    <div class="main-outer">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Transport Create</span>
                <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
            </div>
            <hr class="addsupplier-section-border">
            <form class="needs-validation" action="{{ route('transport.store')}}" method="post" novalidate id="transportform">
                @csrf
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="name">Name<span style="color: red;">*</span></label>
                                <input type="text" class="form-control input-form-content @error('name') is-invalid @enderror @if(!empty(old('name'))) is-valid @endif" name="name" id="name" placeholder="Name" value="{{old('name')}}" required >
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="phone">Phone<span style="color: red;">*</span></label>
                                <input type="text" class="form-control input-form-content @error('phone') is-invalid @enderror @if(!empty(old('phone'))) is-valid @endif" name="phone" id="phone" placeholder="Phone" value="{{old('phone')}}" required >
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row form-inp-group">
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="location">Location<span style="color: red;">*</span></label>
                                <input type="text" class="form-control input-form-content @error('location') is-invalid @enderror @if(!empty(old('location'))) is-valid @endif" name="location" id="location" placeholder="Location" value="{{old('location')}}" required >
                                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="pin">Pin<span style="color: red;">*</span></label>
                                <input type="text" class="form-control input-form-content @error('pin') is-invalid @enderror @if(!empty(old('pin'))) is-valid @endif" name="pin" id="pin" placeholder="Pin" value="{{old('pin')}}" required >
                                @error('pin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="upload--file-section">
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
    </div>
 
@endsection
@section('js')
<!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->
<script>
    $(document).ready(function () {
        $(document).on('click','#leaveButton', function(){
            window.location.href = "{{ route('transport.index') }}";
        });
        $('.orderList').click( function(){
            $("#indexModul").modal("show");
        });
        $('#name').focus();
        $('button[type="submit"]').on('focus', function() {
            $(this).addClass('btn-focus');
        }).on('blur', function() {
            $(this).removeClass('btn-focus');
        });
        
        // $('.select2').select2();
        $("#transportform").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255
                },
                phone: {
                    required: true,
                    maxlength: 255,
                    minlength: 10, // Minimum 10 digits
                    maxlength: 13  // Maximum 13 digits
                },
                location: {
                    required: true,
                    maxlength: 255,
                },
                pin: {
                    required: true,
                    maxlength: 255
                }
            },
            messages: {
                name: {
                    required: "Please enter Name.",
                    maxlength: "name cannot exceed 255 characters."
                },
                phone: {
                    required: "Please enter Phone.",
                    digits: "Please enter a valid phone number with only digits.",
                    minlength: "The phone number must be at least 10 digits long.",
                    maxlength: "The phone number cannot be longer than 13 digits."
                },
                location: {
                    required: "Please enter Location.",
                    maxlength: "Location cannot exceed 255 characters."
                },
                pin: {
                    required: "Please enter Pin.",
                    maxlength: "Pin Type cannot exceed 255 characters."
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
    });
</script>
@endsection