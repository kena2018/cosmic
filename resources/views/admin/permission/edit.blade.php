@extends('layouts.app')
@section('navbarTitel', 'Permission Edit')

@section('content')
    <div class="main-outer">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Permission Edit</span>
                <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
            </div>
            <hr class="addsupplier-section-border">
            <form class="needs-validation" action="{{ route('permissions.update',$permission->id)}}" method="post" novalidate id="permissionadd">
                @csrf
                @method('put')
                <div class="row permission-inp">
                    <div class="col-lg-4 mb-3">
                        <label class="heading-content"  for="name">Permission Name<span style="color: red;">*</span></label>
                        <input type="text" class="form-control input-form-content @error('name') is-invalid @enderror @if(!empty(old('name'))) is-valid @endif" name="name" id="name" placeholder="Permission Name" value="{{ old('name', $permission->name ?? '') }}"  >
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="upload--file-section">
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
    </div>
@endsection
@section('js')
<!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->
<script>
    $(document).ready(function () {
        $(document).on('click','#leaveButton', function(){
            window.location.href = "{{ route('permissions.index') }}";
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
        
    // Initialize form validation on the form
    $('#permissionadd').validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                noSpecialChars: true,
            }
        },
        messages: {
            name: {
                required: "Please enter Permission Name.",
                minlength: "Permission name must be at least 2 characters long"
            }
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent()); // Place error after input group for input-group elements
            } else {
                error.insertAfter(element); // Place error directly after the input element
            }
        },
        highlight: function (element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        }
    });
    $.validator.addMethod("noSpecialChars", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\s]+$/.test(value); 
        // This regex allows letters, numbers, and spaces only
    }, "Permission name should not contain special characters.");
});

</script>

@endsection
