@extends('layouts.app')
@section('navbarTitel', 'Laminatiom View')

@section('content')

    <div class="main-outer">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Lamination View</span>
            <button type="button" id="Button" class="orderList" ><span class="back-icons back-tab-icon"></span></button>
            </div>
            <hr class="addsupplier-section-border">
                <div class="upload-file-sec bottom_sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="paper_name">Paper Name<span style="color: red;">*</span></label>
                                <span class="form-control">{{$laminnations->paper_name ?? ' '}}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="lamination_name">Lamination Name<span style="color: red;">*</span></label>
                                <span class="form-control">{{$laminnations->lamination_name ?? ' '}}</span>
                            </div>
                        </div>
                        <div class="row form-inp-group">
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="gum_name">Gum Name<span style="color: red;">*</span></label>
                                <span class="form-control">{{$laminnations->gum_name ?? ' '}}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="lamination_type">Lamination Type<span style="color: red;">*</span></label>
                                <span class="form-control">{{$laminnations->lamination_type ?? ' '}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
 
@endsection
@section('js')
<!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->
<script>
    $(document).ready(function () {
        $(document).on('click','#Button', function(){
            window.location.href = "{{ route('laminations.index') }}";
        });
    });
</script>

@endsection