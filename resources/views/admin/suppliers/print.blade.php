@extends('layouts.print')
@section('navbarTitel', 'Print Suppliers')
@section('content')

<div class="form-container">
    <div class="header">
        <div class="form-title">Supplier Information</div>
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
            <p class="field-size"><strong>Company Name:</strong> {{ old('company_name', $suppliers->company_name ?? '') }}</p>
            <p class="field-size"><strong>GST Number:</strong> {{ old('gst_number', $suppliers->gst_number ?? '') }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>GST Type:</strong>  {{ old('gst_type', $suppliers->gst_type ?? '') }}</p>
            <p class="field-size"><strong>Email:</strong> {{ old('email_cmp', $suppliers->email_cmp ?? '') }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Phone no.:</strong> {{ old('contect_cmp', $suppliers->contect_cmp ?? '') }}</p>
            <p class="field-size"><strong>Address:</strong> {{ old('address', $suppliers->address1 ?? '') }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Pincode:</strong> {{ old('pincode', $suppliers->pincode ?? '') }}</p>
            <p class="field-size"><strong>Country:</strong> {{ optional($countries->find($suppliers->country))->name }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>State:</strong> {{ optional($states->find($suppliers->state))->name }}</p>    
            <p class="field-size"><strong>City:</strong> {{ optional($cities->find($suppliers->city))->name }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Material Sub Category:</strong> {{ optional($materials->find($suppliers->material))->material_name ?? 'N/A' }}</p>
        </div>
    </div>
    <div class="personal-info">
        <div class="section-title">Contact Person Details</div>
        <div class="row first-section">
            <p class="field-size"><strong>Name:</strong> {{ old('name', $suppliers->name ?? '') }}</p>
            <p class="field-size"><strong>Email:</strong> {{ old('email', $suppliers->email ?? '') }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Phone no.:</strong> {{ old('contect', $suppliers->contect ?? '') }}</p>
        </div>
    </div>
</div>
<!--  END CONTENT AREA  -->
@endsection
@section('js')
<script>
    setTimeout(function() {
            window.print();
        }, 1000);
</script>
@endsection