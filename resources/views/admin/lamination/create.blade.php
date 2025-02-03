@extends('layouts.app')
@section('navbarTitel', 'Laminatiom Create')

@section('content')
<style>
    .model-config {
    color: #333333 !important;
}
</style>
    <div class="main-outer">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Lamination Create</span>
                <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
                <!-- <div class="btn-sec btn_group">
                    <a href="{{route('laminations.index')}}">
                        <span class="back-icons back-tab-icon"></span>
                    </a>
                </div> -->
            </div>
            <hr class="addsupplier-section-border">
            <form class="needs-validation" action="{{ route('laminations.store')}}" method="post" novalidate id="laminationform" >
                @csrf
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="paper_name">Paper Name<span style="color: red;">*</span></label>
                                <input type="text" class="form-control input-form-content @error('paper_name') is-invalid @enderror @if(!empty(old('paper_name'))) is-valid @endif" name="paper_name" id="paper_name" placeholder="Paper Name" value="{{old('paper_name')}}" required >
                                @error('paper_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="lamination_name">Lamination Name<span style="color: red;">*</span></label>
                                <input type="text" class="form-control input-form-content @error('lamination_name') is-invalid @enderror @if(!empty(old('lamination_name'))) is-valid @endif" name="lamination_name" id="lamination_name" placeholder="Lamination Name" value="{{old('lamination_name')}}" required >
                                @error('lamination_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row form-inp-group">
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="gum_name">Gum Name<span style="color: red;">*</span></label>
                                <input type="text" class="form-control input-form-content @error('gum_name') is-invalid @enderror @if(!empty(old('gum_name'))) is-valid @endif" name="gum_name" id="gum_name" placeholder="Gum Name" value="{{old('gum_name')}}" required >
                                @error('gum_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="heading-content"  for="lamination_type">Lamination Type<span style="color: red;">*</span></label>
                                <input type="text" class="form-control input-form-content @error('lamination_type') is-invalid @enderror @if(!empty(old('lamination_type'))) is-valid @endif" name="lamination_type" id="lamination_type" placeholder="Lamination Type" value="{{old('lamination_type')}}" required >
                                @error('lamination_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="upload--file-section">
                            <div class="btn-sec btn_group">
                        
                            </div>
                            <div class="order-btn-grp">
                                <div class="btn-sec btn_group">
                                    <div class="button-1 cta_btn">
                                        <button id="saveButton" type="submit" class="primary-button stock-btn">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- <div class="modal fade in" id="unloadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h4 class="modal-title">Warning!</h4>
        </div>
        <div class="modal-body">
          Your current session will expire in 5 minutes. Please Save your changes to continue your session, otherwise you will lose all unsaved data and your session will time out.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div> -->
  
    <!-- <div class="modal fade" id="unloadModal" tabindex="-1" aria-labelledby="unloadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title model-config" id="unloadModalLabel">Confirm Navigation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body model-body-data">
          Before leaving the order page, please confirm that you are okay with losing any unsaved order details.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Stay on Page</button>
          <button type="button" class="btn btn-danger" id="leavePageBtn">Leave Page</button>
        </div>
      </div>
    </div>
  </div> -->
@endsection
@section('js')
<!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
  let preventUnload = true;
  let unloadModalShown = false;

  window.addEventListener('beforeunload', function (e) {
    if (preventUnload && !unloadModalShown) {
      e.preventDefault();
      e.returnValue = '';
      showUnloadModal(); // Trigger the modal instead of the native dialog
    }
  });

  function showUnloadModal() {
    const unloadModal = new bootstrap.Modal(document.getElementById('unloadModal'));
    unloadModal.show();
    unloadModalShown = true;

    // Prevent the unload until the user confirms
    const leavePageBtn = document.getElementById('leavePageBtn');
    leavePageBtn.addEventListener('click', function() {
      preventUnload = false;
      window.location.href = window.location.href;  // Simulate page leave
    });
  }
</script> -->

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