@extends('layouts.app')
@section('navbarTitel', 'Laminatiom Edit')

@section('content')

    <div class="main-outer">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Lamination Edit</span>
                <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
            </div>
            <hr class="addsupplier-section-border">
            <form class="needs-validation" action="{{ route('laminations.update',$laminnations->id)}}" method="post" novalidate id="laminationform" >
                @csrf
                @method('PUT')
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="paper_name">Paper Name<span style="color: red;">*</span></label>
                                <input type="text" class="form-control input-form-content @error('paper_name') is-invalid @enderror @if(!empty(old('paper_name'))) is-valid @endif" name="paper_name" id="paper_name" placeholder="Paper Name" value="{{old('paper_name',$laminnations->paper_name ?? '')}}" required >
                                @error('paper_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="lamination_name">Lamination Name<span style="color: red;">*</span></label>
                                <input type="text" class="form-control input-form-content @error('lamination_name') is-invalid @enderror @if(!empty(old('lamination_name'))) is-valid @endif" name="lamination_name" id="lamination_name" placeholder="Lamination Name" value="{{old('lamination_name',$laminnations->lamination_name ?? '')}}" required >
                                @error('lamination_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row form-inp-group">
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="gum_name">Gum Name<span style="color: red;">*</span></label>
                                <input type="text" class="form-control input-form-content @error('gum_name') is-invalid @enderror @if(!empty(old('gum_name'))) is-valid @endif" name="gum_name" id="gum_name" placeholder="Gum Name" value="{{old('gum_name',$laminnations->gum_name ?? '')}}" required >
                                @error('gum_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="lamination_type">Lamination Type<span style="color: red;">*</span></label>
                                <input type="text" class="form-control input-form-content @error('lamination_type') is-invalid @enderror @if(!empty(old('lamination_type'))) is-valid @endif" name="lamination_type" id="lamination_type" placeholder="Lamination Type" value="{{old('lamination_type',$laminnations->lamination_type ?? '')}}" required >
                                @error('lamination_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="upload--file-section">
                            <div class="btn-sec btn_group">
                        
                            </div>
                            <div class="order-btn-grp">
                                <div class="btn-sec btn_group">
                                    <div class="button-1 cta_btn">
                                        <button id="editButton" type="submit" class="primary-button stock-btn">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
 
@endsection
@section('js')
<!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->
<script>
    $(document).ready(function () {
        $(document).on('click','#leaveButton', function(){
            window.location.href = "{{ route('laminations.index') }}";
        });
        $('.orderList').click( function(){
            $("#indexModul").modal("show");
        });
        $('#paper_name').focus();
        $('button[type="submit"]').on('focus', function() {
            $(this).addClass('btn-focus');
        }).on('blur', function() {
            $(this).removeClass('btn-focus');
        });
        // $('.select2').select2();
        $("#laminationform").validate({
            rules: {
                paper_name: {
                    required: true,
                    maxlength: 255
                },
                lamination_name: {
                    required: true,
                    maxlength: 255,
                },
                gum_name: {
                    required: true,
                    maxlength: 255,
                },
                lamination_type: {
                    required: true,
                    maxlength: 255
                }
            },
            messages: {
                paper_name: {
                    required: "Please enter Paper Name.",
                    maxlength: "Paper name cannot exceed 255 characters."
                },
                lamination_name: {
                    required: "Please enter Lamination Name.",
                    maxlength: "Lamination name cannot exceed 255 characters."
                },
                gum_name: {
                    required: "Please enter Gum Name.",
                    maxlength: "Gum name cannot exceed 255 characters."
                },
                lamination_type: {
                    required: "Please enter Lamination Type.",
                    maxlength: "Lamination Type cannot exceed 255 characters."
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('text-danger');
                error.insertAfter(element);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });

        jQuery.validator.addMethod("filesize", function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param * 1024);
        });
    });
</script>

@endsection