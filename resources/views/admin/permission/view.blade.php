@extends('layouts.app')
@section('navbarTitel', 'Permission View')

@section('content')
    <div class="main-outer">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Permission View</span>
                <button type="button" id="Button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
            </div>
            <hr class="addsupplier-section-border">
            <div class="row permission-inp">
                <div class="col-lg-4 mb-3">
                    <label class="heading-content"  for="name">Permission Name<span style="color: red;">*</span></label>
                    <span class="form-control">{{ $permission->name ?? ' ' }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $(document).on('click','#Button', function(){
            window.location.href = "{{ route('permissions.index') }}";
        });
    });
</script>
@endsection
