@extends('layouts.print')
@section('navbarTitel', 'Role Print')
@section('content')
<div class="form-container">
    <div class="header">
        <div class="form-title">Role Information</div>
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
        <div class="section-title">Role Details</div>
        <div class="row first-section">
            <p class="field-size"><strong>Role Name:</strong> {{ $role->name ?? 'N/A' }}</p>
        </div>
    </div>
    <div class="personal-info">
        <div class="section-title">Permissions</div>
        <div class="row ">
            <div class="permission-content">
                @forelse ($permissions as $permission)
                <div class="permission-sec">
                    <input type="checkbox" name="permissions[]" id="permission{{ $permission->id }}" value="{{ $permission->id }}" class="name" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} disabled>
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
    $(document).ready(function(){
        window.print();
    });
</script>
@endsection