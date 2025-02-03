@extends('layouts.print')
@section('navbarTitel', 'Lamination Print')
@section('content')
<div class="form-container">
    <div class="header">
        <div class="form-title">Lamination Information</div>
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
        <div class="section-title">Lamination List</div>
        <div class="row first-section">
            <p class="field-size"><strong>Paper Name:</strong> {{old('paper_name',$laminnations->paper_name ?? '')}}</p>
            <p class="field-size"><strong>Lamination Name:</strong> {{old('lamination_name',$laminnations->lamination_name ?? '')}}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Gum Name:</strong> {{old('gum_name',$laminnations->gum_name ?? '')}}</p>
            <p class="field-size"><strong>Lamination Type:</strong> {{old('lamination_type',$laminnations->lamination_type ?? '')}}</p>
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