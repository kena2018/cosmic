@extends('layouts.app')
@section('navbarTitel', 'Staff Management Create')
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <div class="main-outer">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Personal Details</span>
                <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
                
            </div>
            <form class="needs-validation" action="{{ route('staff-management.store')}}" method="post" novalidate id="stafmanagement">
                
                <hr class="addsupplier-section-border">
                @csrf
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                                <div class="col-md-6 mb-3">
                                        <label class="heading-content" for="name">Name<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror @if(!empty(old('name'))) is-valid @endif" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
                                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                        <label class="heading-content" for="email">Email<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror @if(!empty(old('email'))) is-valid @endif" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                        </div>
                        <div class="row form-inp-group">
                            <div class="col-md-6 mb-3 phone-content">
                                <label class="heading-content" for="contect">Phone no.<span style="color: red;">*</span></label>
                                <input type="number" class="contact-content form-control @error('contect') is-invalid @enderror" name="contect" id="contect" placeholder="Phone" value="{{ old('contect') }}">
                                @error('contect')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3 role-drop">   
                                    <label class="heading-content" for="roles">Role<span style="color: red;">*</span></label>
                                    <select id="role-select" data-placeholder="Select Role" name="roles[]" class="chosen-select select2 form-control form-select-grp @error('roles') is-invalid @enderror">
                                        <option value="" >Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" data-permissions="{{ json_encode($role->permissions->pluck('id')->toArray()) }}" {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('roles')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row form-inp-group">        
                                <div class="col-md-6 mb-3 eye-slash">
                                    <label class="heading-content" for="gst_type">Password<span style="color: red;">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" value="{{ old('gst_type') }}" autocomplete="new-password">
                                    <i id="togglePassword" class="fas fa-eye-slash eye-slash-icon"></i>
                                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    @error('gst_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3 eye-slash">
                                        <label class="heading-content" for="password_confirmation">Confirm Password<span style="color: red;">*</span></label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                                        <i id="togglePasswords" class="fas fa-eye-slash eye-slash-icon"></i>
                                </div>
                        </div>
                        <div class="row form-inp-groupss">
                            <span class="addsupplier-section-heading">Permissions</span>
                            <div class="permission-content">
                                @forelse ($permissions as $permission)
                                <div class="permission-sec">
                                    <input type="checkbox" name="permissions[]" id="permission{{ $permission->id }}" value="{{ $permission->id }}" class="name permission-checkbox" {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
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
<!--  END CONTENT AREA  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            // Focus the first permission checkbox when the role name input loses focus
            $('#password_confirmation').on('blur', function() {
                $('.permission-checkbox:first').focus();
            });
            $(document).on('focusin', '.select2', function(e) {
                // Select2 handles the focus differently, this ensures the dropdown opens on focus
                $(this).siblings('select').select2('open');
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
            
            $("#stafmanagement").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 255,
                        noSpecialChars: true,
                    },
                    email: {
                        required: true,
                        maxlength: 255,
                        email: true,
                    },
                    contect: {
                        required: true,
                        maxlength: 255,
                        minlength: 10, // Minimum 10 digits 
                        maxlength: 13  // Maximum 13 digits
                    },
                    "roles[]": {
                        required: true, // Ensures that at least one role is selected
                        minlength: 1
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                            required: true,
                            equalTo: "#password" // Ensures the confirmation matches the password
                        }
                },
                messages: {
                    name: {
                        required: "Please enter Name.",
                        
                    },
                    email: {
                        required: "Please enter Email.",
                        maxlength: "Your email must not exceed 255 characters.",
                        email: "Please enter a valid email address."
                    },
                    contect: {
                        required: "Please enter Phone no.",
                        digits: "Please enter a valid phone number with only digits.",
                        minlength: "The phone number must be at least 10 digits long.",
                        maxlength: "The phone number cannot be longer than 13 digits."
                    },
                    "roles[]": {
                        required: "Please select Role.",
                        minlength: "You must select at least one role."
                    },
                    password: {
                        required: "Please enter Password.",
                        minlength: "Your password must be at least 8 characters long."
                    },
                    password_confirmation: {
                        required: "Please enter Confirm Password.",
                        equalTo: "Passwords do not match."
                    }
                },
                errorElement: 'span',
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
                highlight: function (element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                // errorPlacement: function (error, element) {
                //     error.addClass('text-danger');
                //     error.insertAfter(element);
                // },
                // highlight: function (element, errorClass, validClass) {
                //     $(element).addClass('is-invalid').removeClass('is-valid');
                // },
                // unhighlight: function (element, errorClass, validClass) {
                //     $(element).removeClass('is-invalid').addClass('is-valid');
                // }
            });

            jQuery.validator.addMethod("filesize", function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param * 1024);
            });
            $.validator.addMethod("noSpecialChars", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9\s]+$/.test(value); 
                // This regex allows letters, numbers, and spaces only
            }, "Staff Management name should not contain special characters.");
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click','#leaveButton', function(){
                window.location.href = "{{ route('staff-management.index') }}";
            });
            $('.orderList').click( function(){
                $("#indexModul").modal("show");
            });
            $('#role-select').on('change', function() {
                // var selectedOption = $(this).find(':selected');
                // var permissions = selectedOption.data('permissions');
                
                // // if (!permissions || permissions.length === 0) {
                // //     console.log('No permissions available for the selected role.');
                // // }else{
                // //     console.log('Selected Role Permissions:', permissions);
                // // }

                // if (permissions && permissions.length > 0) {
                //     permissions.forEach(function(permissionId) {
                //         $('#permission' + permissionId).prop('checked', true); // Check the checkbox
                //     });
                // } else {
                //     console.log('No permissions available for the selected role.');
                // }

                $('.permission-checkbox').prop('checked', false);

                // Get the selected role option
                var selectedOption = $(this).find(':selected');
                var permissions = selectedOption.data('permissions'); // Retrieve permissions from data attribute

                // Check if permissions exist and check the corresponding checkboxes
                if (permissions && permissions.length > 0) {
                    permissions.forEach(function(permissionId) {
                        $('#permission' + permissionId).prop('checked', true); // Check the checkbox
                    });
                } else {
                    console.log('No permissions available for the selected role.');
                }
            });       
        });

    </script>
 <!-- <script>
    $(document).ready(function () {
        // $('#role-select').on('change', function() {

        //     // document.getElementById('role-select').addEventListener('change', function(){
        //     const selectedRole = this.options[this.selectedIndex];
        //     const permissions = JSON.parse(selectedRole.getAttribute('data-permissions'));
        //     document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
        //         checkbox.checked = permissions.includes(parseInt(checkbox.value));
        //     });
        // });
        function updatePermissionsBasedOnRole() {
            // console.log('updatePermissionsBasedOnRole');
            const selectedRole = document.querySelector('#role-select').selectedOptions[0];
            console.log(selectedRole);
            if (selectedRole) {
                const permissions = JSON.parse(selectedRole.getAttribute('data-permissions'));

                document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
                    checkbox.checked = permissions.includes(parseInt(checkbox.value));
                });
            }
        }
        document.getElementById('role-select').addEventListener('change', updatePermissionsBasedOnRole);
        

        // Call the function once when the page loads to set initial permissions
        updatePermissionsBasedOnRole();


        // function updatePermissionsBasedOnRole() {
        //     const selectedRole = document.querySelector('#role-select').selectedOptions[0];
        //     if (selectedRole) {
        //         const permissions = JSON.parse(selectedRole.getAttribute('data-permissions'));
        //         const deselectedPermissions = JSON.parse(document.getElementById('deselected_permissions').value || '[]');
                
        //         document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
        //             if (!deselectedPermissions.includes(parseInt(checkbox.value))) {
        //                 checkbox.checked = permissions.includes(parseInt(checkbox.value));
        //             }
        //         });
        //     }
        // }



        //  document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
        //     checkbox.addEventListener('change', function() {
        //         const deselectedPermissions = JSON.parse(document.getElementById('deselected_permissions').value || '[]');
        //         const checkboxValue = parseInt(this.value);

        //         if (!this.checked) {
        //             if (!deselectedPermissions.includes(checkboxValue)) {
        //                 deselectedPermissions.push(checkboxValue);
        //             }
        //         } else {
        //             const index = deselectedPermissions.indexOf(checkboxValue);
        //             if (index > -1) {
        //                 deselectedPermissions.splice(index, 1);
        //             }
        //         }

        //         document.getElementById('deselected_permissions').value = JSON.stringify(deselectedPermissions);
        //     });
        // });

        // document.getElementById('role-select').addEventListener('change', updatePermissionsBasedOnRole);

        // document.addEventListener('DOMContentLoaded', (event) => {
        //     updatePermissionsBasedOnRole();
        // });

    });
    </script> -->
   

@endsection