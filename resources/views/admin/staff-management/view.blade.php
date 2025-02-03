@extends('layouts.app')
@section('navbarTitel', 'Staff Management view')
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
<link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
    <div class="main-outer">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Personal Details View</span>
                <button type="button" id="Button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
            </div>
                <hr class="addsupplier-section-border">
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-md-6 mb-3">
                                <label class="heading-content" for="name">Name</label>
                                <span class="form-control">{{ $user->name ?? ' '}}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="heading-content" for="email">Email</label>
                                <span class="form-control">{{ $user->email ?? ' '}}</span>
                            </div>
                        </div>
                        <div class="row form-inp-group">
                            <div class="col-md-6 mb-3 phone-content">
                                <label class="heading-content" for="contect">Phone no.</label>
                                <span class="form-control">{{ $user->contect ?? ' '}}</span>
                            </div>
                            <div class="col-md-6 mb-3 role-drop">   
                                <label class="heading-content" for="roles">Role</label>
                                <span class="form-control">{{ $user->roles->pluck('name')->implode(', ') }}</span> 
                            </div>
                        </div>
                        <div class="row form-inp-groupss">
                            <span class="addsupplier-section-heading">Permissions</span>
                            <div class="permission-content">
                                @foreach ($permissions as $permission)
                                    @if (in_array($permission->id, old('permissions', $user->permissions->pluck('id')->toArray())))
                                        <div class="permission-sec">
                                            <input type="hidden" name="permissions[]" id="permission{{ $permission->id }}" value="{{ $permission->id }}" class="name permission-checkbox" checked>
                                            <label for="permission{{ $permission->id }}">{{ $permission->name }}</label><br>
                                        </div>
                                    @endif
                                @endforeach
                                @if (empty($permissions->intersect($user->permissions)))
                                    <p>No permissions available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @endsection
@section('js')
<!--  END CONTENT AREA  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->
    <script>
        $(document).ready(function() {
            $(document).on('click','#Button', function(){
                window.location.href = "{{ route('staff-management.index') }}";
            });
            
            $('.select2').select2();
        });
    </script>
@endsection