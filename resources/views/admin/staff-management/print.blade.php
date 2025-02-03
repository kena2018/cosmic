@extends('layouts.print')
@section('navbarTitel', 'Staff Management Edit')
@section('content')
<style>
    .permission-content {  margin: 15px 0px 0 -16px;}
    .form-container{height: auto;}
    .permission-sec{gap: 2px !important;}
    .permission-sec label { font-size: 11px;}
</style>
<link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
    <div class="form-container">
    <div class="header">
        <div class="form-title">Staff Management Information</div>
        <div class="logo">
            @if(str_contains(url('/'), '127.0.0.1'))
            <img
            src="{{ asset('public/assets/img/Cosmiclogo.png')}}"
            alt="navbar brand"
            class="navbar-brand"
            />
            @else
            <img
            src="{{ asset('public/assets/img/Cosmiclogo.png')}}"
            alt="navbar brand"
            class="navbar-brand"
            />
            @endif
        </div>
    </div>
    <div class="personal-info">
        <div class="section-title">Personal Details Print</div>
        <div class="row first-section">
            <p class="field-size"><strong>Name:</strong> {{ $user->name ?? 'N/A' }}</p>
            <p class="field-size"><strong>Email:</strong> {{ $user->email??'N/A' }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Phone no.:</strong> {{ $user->contect ?? 'N/A' }}</p>
            <p class="field-size"><strong>Role:</strong> {{ optional($user->roles->first())->name ?? 'N/A' }}</p> 
        </div>
    </div>
    <div class="personal-info">
        <div class="section-title">Permissions</div>
        <div class="row">
            <div class="permission-content">
                @forelse ($permissions as $permission)
                <div class="permission-sec">
                    <input type="checkbox" name="permissions[]" id="permission{{ $permission->id }}" value="{{ $permission->id }}" class="name permission-checkbox" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} disabled>
                    <label for="permission{{ $permission->id }}">{{ $permission->name }}</label><br>
                </div>
                @empty
                    <p>No permissions available</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
    @endsection
    @section('js')
<script>
    setTimeout(function() {
            window.print();
        }, 1000);
</script>
@endsection