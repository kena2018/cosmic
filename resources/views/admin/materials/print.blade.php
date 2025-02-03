@extends('layouts.print')
@section('navbarTitel', 'Print Materials')
@section('content')
<div class="form-container">
    <div class="header">
        <div class="form-title">Material Information</div>
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
        <div class="section-title">Company Details</div>
        <div class="row first-section">
            <p class="field-size"><strong>Material Category:</strong> {{ $material->category->name ?? 'N/A' }}</p>
            <p class="field-size"><strong>Sub Category:</strong>{{ optional($subCategory->find($material->sub_category))->sub_cat_name }} </p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Material Name:</strong> {{ $material->material_name ?? 'N/A' }}</p>
            <p class="field-size"><strong>Unit 1:</strong> {{ $material->quantity ?? 'N/A' }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Unit 2:</strong> {{ $material->unit ?? 'N/A' }}</p>
            <p class="field-size"><strong>Remark:</strong> {{ $material->remark ?? 'N/A' }}</p>
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