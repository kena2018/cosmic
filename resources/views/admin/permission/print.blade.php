@extends('layouts.print')
@section('navbarTitel', 'Permission Print')

@section('content')
<div class="form-container">
    <div class="header">
        <div class="form-title">Permission Information</div>
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
        <div class="section-title">Permission Details</div>
        <div class="row first-section">
            <p class="field-size"><strong>Permission Name :</strong> {{ $permission->name ?? 'N/A' }}</p>
        </div>
</div>
    
 
@endsection
@section('js')
<script>
    $(document).ready(function(){
        window.print();
    });
</script>
@endsection