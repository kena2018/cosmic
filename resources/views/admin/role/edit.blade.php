@extends('layouts.app')
@section('navbarTitel', 'Role Edit')
@section('content')
<style>
    button:focus {
        outline: none; /* Remove the default focus outline */
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.5); /* Add a glowing effect around the button */
        border-color: #007bff; /* Change the border color when focused */
        background-color: #007bff; /* Optionally change the background color */
        color: white; /* Ensure the text remains visible */
    }
</style>
    <div class="main-outer">
        <div class="outer card">
            <form class="needs-validation" action="{{ route('roles.update',$role->id)}}" method="post" novalidate id="editRole">
                <div class="heading-btn">
                    <span class="addsupplier-section-heading">Role Edit</span>
                    <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
                </div>
                <hr class="addsupplier-section-border">
            
                @csrf
                @method('PUT')
                <div class="row form-inp-groups">
                    <div class="col-md-4 mb-3">
                        <label class="heading-content"  for="name">Role Name<span style="color: red;">*</span></label>
                        <input type="text" class="form-control input-form-content @error('name') is-invalid @enderror @if(!empty(old('name'))) is-valid @endif" name="name" id="name" placeholder="Admin" value="{{ old('name', $role->name ?? '') }}" required >
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-groupss">
                            <span class="addsupplier-section-heading">Permissions</span>
                            <div class="permission-content">
                                @forelse ($permissions as $permission)
                                <div class="permission-sec">
                                    <input type="checkbox" name="permissions[]" id="permission{{ $permission->id }}" value="{{ $permission->id }}" class="name" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                    <label for="permission{{ $permission->id }}">{{ $permission->name }}</label><br>
                                </div>
                                @empty
                                    <p>No permissions available</p>
                                @endforelse
                            </div>
                        </div>
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
    <!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->
    <script>
        $(document).ready(function() {
            $('#name').focus();
            // Focus the first permission checkbox when the role name input loses focus
            $('#name').on('blur', function() {
                $('.permission-checkbox:first').focus();
            });

            // Handle keydown events for permission checkboxes
            $('.permission-checkbox').on('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();

                    if ($(this).prop('checked')) {
                        $(this).prop('checked', false);
                    } else {
                        $(this).prop('checked', true);
                    }
                    
                    // Move to the next checkbox if the current one is already checked
                    var nextCheckbox = $(this).closest('.permission-sec').next().find('.permission-checkbox');
                    if (nextCheckbox.length) {
                        nextCheckbox.focus();
                    } else {
                        // No more checkboxes, move focus to the Save button
                        $('button[type="submit"]').focus();
                    }
                } else if (e.key === 'Tab') {
                    // Move to the next checkbox on Tab key
                    e.preventDefault();
                    var nextCheckbox = $(this).closest('.permission-sec').next().find('.permission-checkbox');
                    if (nextCheckbox.length) {
                        nextCheckbox.focus();
                    } else {
                        // No more checkboxes, move focus to the Save button
                        $('button[type="submit"]').focus();
                    }
                }
            });
            // Add focus and blur events for the checkboxes to increase size and change color
            $('.permission-checkbox').on('focus', function() {
                $(this).closest('.permission-sec').css({
                    'background-color': '#f0f8ff', // Change the background color
                    'transform': 'scale(1)' // Increase size
                });
            }).on('blur', function() {
                $(this).closest('.permission-sec').css({
                    'background-color': '', // Reset the background color
                    'transform': 'scale(1)' // Reset size
                });
            });

            // Add focus/blur event for the Save button to add/remove CSS class
            $('button[type="submit"]').on('focus', function() {
                $(this).addClass('btn-focus');
            }).on('blur', function() {
                $(this).removeClass('btn-focus');
            });
        });
        $(document).ready(function () {
            $(document).on('click','#leaveButton', function(){
                window.location.href = "{{ route('roles.index') }}";
            });
            $('.orderList').click( function(){
                $("#indexModul").modal("show");
            });
            $("#editRole").validate({
                
                rules: {
                    name: {
                        required: true,
                        maxlength: 255,
                        noSpecialChars: true,
                    }
                },
                messages: {
                    name: {
                        required: "Please enter Role Name.",
                        
                    }
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
            
            $.validator.addMethod("noSpecialChars", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9\s]+$/.test(value); 
                // This regex allows letters, numbers, and spaces only
            }, "Role name should not contain special characters.");
        });
    </script>
 
@endsection