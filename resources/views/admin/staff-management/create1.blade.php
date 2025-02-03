@extends('layouts.app')
@section('navbarTitel', 'Staff Management Create')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <div class="main-outer">
        <div class="outer card">
            <form class="needs-validation" action="{{ route('staff-management.store')}}" method="post" novalidate id="form1">
                <div class="heading-btn">
                    <span class="addsupplier-section-heading">Personal Details</span>
                    <div class="btn-sec btn_group">
                        <a href="{{route('staff-management.index')}}">
                            <span class="back-icons back-tab-icon"></span>
                        </a>
                    </div>
                </div>
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
                                <label class="heading-content" for="contect">Phone<span style="color: red;">*</span></label>
                                <input type="number" class="contact-content form-control @error('contect') is-invalid @enderror" name="contect" id="contect" placeholder="Phone" value="{{ old('contect') }}">
                                @error('contect')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3 role-drop">   
                                    <label class="heading-content" for="roles">Role<span style="color: red;">*</span></label>
                                    <select id="role-select" data-placeholder="Select Role" name="roles[]" class="chosen-select form-control @error('roles') is-invalid @enderror">
                                        <option value="" ></option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" data-permissions="{{ json_encode($role->permissions->pluck('id')->toArray()) }}" {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    
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
                                    <input type="checkbox" name="permissions[]" id="permission{{ $permission->id }}" value="{{ $permission->id }}" class="name permission-checkbox">
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
                                        <button type="submit" class="primary-button stock-btn">Save Staff User</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        jQuery(document).ready(function($) {
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
          });
        });
    </script>
   <script>
   const phoneInputField = document.querySelector("#contect");
   const phoneInput = window.intlTelInput(phoneInputField, {
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
       initialCountry: "IN" ,
       separateDialCode: true
   });

 </script>
 <script>
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
            const selectedRole = document.querySelector('#role-select').selectedOptions[0];
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


    });
    </script>

@endsection