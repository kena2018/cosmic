@extends('layouts.app')
@section('navbarTitel', 'Role View')
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
                <div class="heading-btn">
                    <span class="addsupplier-section-heading">Role View</span>
                    <button type="button" id="Button" class="orderList"><span class="back-icons back-tab-icon"></span></button>
                </div>
                <hr class="addsupplier-section-border">
                <div class="row form-inp-groups">
                    <div class="col-md-4 mb-3">
                        <label class="heading-content"  for="name">Role Name</label>
                        <span class="form-control">{{$role->name ?? ' '}}</span>
                    </div>
                </div>
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-groupss">
                            <span class="addsupplier-section-heading">Permissions</span>
                            <div class="permission-content">
                                @forelse ($permissions as $permission)
                                    @if (in_array($permission->id, $rolePermissions)) 
                                        <div class="permission-sec">
                                            <input type="hidden" name="permissions[]" value="{{ $permission->id }}" class="name" checked>
                                            <label>{{ $permission->name }}</label><br>
                                        </div>
                                    @endif
                                @empty
                                    <p>No permissions available</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(document).on('click','#Button', function(){
                window.location.href = "{{ route('roles.index') }}";
            });
        });
    </script>
 
@endsection