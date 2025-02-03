@extends('layouts.print')
@section('navbarTitel', 'Transport Print')
@section('content')
<div class="form-container">
    <div class="header">
        <div class="form-title">Transport Information</div>
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
        <div class="section-title">Transport Details</div>
        <div class="row first-section">
            <p class="field-size"><strong>Name:</strong> {{$transports->name ?? 'N/A'}}</p>
            <p class="field-size"><strong>Phone:</strong> {{$transports->phone ?? 'N/A'}}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Location:</strong> {{$transports->location ?? 'N/A'}}</p>
            <p class="field-size"><strong>Pin:</strong> {{$transports->pin ?? 'N/A'}}</p>
        </div>
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