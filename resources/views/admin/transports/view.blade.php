@extends('layouts.app')
@section('navbarTitel', 'Transport View')
@section('content')
    <div class="main-outer">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Transport View</span>
                <button type="button" id="Button" class="orderList"><span class="back-icons back-tab-icon"></span></button>
            </div>
            <hr class="addsupplier-section-border">
                <div class="upload-file-sec bottom_sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="name">Name</label>
                                <span class="form-control">{{ $transports->name ?? ' ' }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="name">Phone</label>
                                <span class="form-control">{{ $transports->phone ?? ' ' }}</span>
                            </div>
                        </div>
                        <div class="row form-inp-group">
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="location">Location</label>
                                <span class="form-control">{{ $transports->location ?? ' ' }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="pin">Pin</label>
                                <span class="form-control">{{ $transports->pin ?? ' ' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
 
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $(document).on('click','#Button', function(){
            window.location.href = "{{ route('transport.index') }}";
        });
    });
</script>

@endsection