@extends('layouts.app')
@section('navbarTitel', 'View Suppliers')
@section('content')
<div class="main-outer">
    <div class="outer card">
        <div class="heading-btn">
            <span class="addsupplier-section-heading">Company Details</span>
            <button type="button"  id="Button" class="orderList"><span class="back-icons back-tab-icon"></span></button>
        </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-md-6 mb-3">
                            <label class="heading-content" for="company_name">Company Name</label>
                            <span class="form-control">{{$suppliers->company_name ?? ''}}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="heading-content" for="gst_number">GST Number</label>
                            <span class="form-control">{{$suppliers->gst_number ?? ''}}</span>
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="gst_type">GST Type</label>
                            <span class="form-control">{{ $suppliers->gst_type ?? ''}}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="email_cmp">Email</label>
                            <span class="form-control">{{ $suppliers->email_cmp ?? ''}}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="contect_cmp">Phone no.</label>
                            <span class="form-control">{{ $suppliers->contect_cmp ?? ''}}</span>
                        </div>
                    </div>
                    <div class="row form-inp-group">    
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="address1">Address</label>
                            <span class="form-control">{{ $suppliers->address1 ?? ''}}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="pincode">Pincode</label>
                            <span class="form-control">{{ $suppliers->pincode ?? ''}}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="country">Country</label>
                            <span class="form-control">{{ optional($countries->find($suppliers->country))->name }}</span>
                        </div>
                    </div>
                    <div class="row form-inp-group">   
                        <div class="col-md-4 mb-3">
                            <label class="heading-content"  for="State">State</label>
                            <span class="form-control">{{ optional($states->find($suppliers->state))->name }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content"  for="City">City</label>
                            <span class="form-control">{{ optional($cities->find($suppliers->city))->name }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="material">Material Sub Category</label>
                            <span class="form-control">{{ optional($materials->find($suppliers->material))->sub_cat_name }}</span>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="heading-btn">
                <span class="companydetails-section-heading">Contact Person Details</span>
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="name">Name</label>
                            <span class="form-control">{{ $suppliers->name ?? ' ' }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="email">Email</label>
                            <span class="form-control">{{ $suppliers->email ?? ' ' }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content" for="contect">Phone no.</label>
                            <span class="form-control">{{ $suppliers->contect ?? ' ' }}</span>
                        </div>
                    </div>                      
                </div>
            </div>
    </div>
</div>

<!--  END CONTENT AREA  -->
@endsection
@section('js')
<script>
$(document).ready(function () {
    $(document).on('click','#Button', function(){
        window.location.href = "{{ route('suppliers.index') }}";
    });
});
</script>

@endsection