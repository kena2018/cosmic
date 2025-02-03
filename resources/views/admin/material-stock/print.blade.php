@extends('layouts.print')
@section('navbarTitel', 'Material Stocks')
@section('content')


<div class="form-container">
    <div class="header">
        <div class="form-title">Stock Information</div>
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
        <div class="section-title">Stock List</div>
        <div class="row first-section">
            <p class="field-size"><strong>Material Name:</strong> {{$stock->material->material_name ?? ''}}</p>
            <p class="field-size"><strong>Category:</strong> {{$stock->category->name ?? ''}}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Sub Category:</strong> {{$stock->materialSubCategory->sub_cat_name ?? ''}}</p>
            <p class="field-size"><strong>In Stock Quantity:</strong> {{$stock->quantity ?? ''}}</p>
            <p class="field-size"><strong>Unit:</strong> {{$stock->unit ?? ''}}</p>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    $(document).ready(function() {
        window.print();
    });
</script>
@endsection

