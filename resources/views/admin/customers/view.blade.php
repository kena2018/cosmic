@extends('layouts.app')
@section('navbarTitel', $customer->company_name . ' View')
@section('content')
    <div class="main-outer">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Company and Billing Information</span>
                <button type="button" id="Button" class="orderList"><span class="back-icons back-tab-icon"></span></button>
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="name">Company Name</label>
                            <span class="form-control">{{$customer->company_name ?? ' '}}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="GSTIN">GSTIN</label>
                            <span class="form-control">{{$customer->gstin ?? ' '}}</span>
                            <span id="gstError" style="color: red; display: none;">Invalid GST Number</span>
                        </div>
                        
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="paymentterms">Payment Terms</label>
                            <span class="form-control">{{$customer->payment_terms ?? ' '}}</span>
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="address">Billing Address Line 1</label>
                            <span class="form-control input-form-content tooltip-data billing-inps input_form_cntrl" title="{{$customer->address1 ?? ' '}}">{{$customer->address1 ?? ' '}}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="number">Billing Address Line 2</label>
                            <span class="form-control">{{$customer->address2 ?? ' '}}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="name">Pin</label>
                            <span class="form-control">{{$customer->pin ?? ' '}}</span>
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="name">Country</label>
                            <span class="form-control">{{ optional($countries->find($customer->country))->name }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="State">State</label>
                            <span class="form-control">{{ $customer->state->name  ?? ' ' }}</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="heading-content"  for="name">City</label>
                            <span class="form-control">{{ $customer->city->name ?? ' ' }}</span>
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-lg-6 mb-6 transport_details">
                            <div class="col-lg-10 mb-3">
                                <label class="heading-content"  for="name">Group</label>
                                <span class="form-control">{{optional($groups->find($customer->group))->name ?? ' '}}</span>
                            </div>
                        </div>    
                        <div class="col-lg-6 mb-3">
                            <label class="heading-content"  for="name">Perf. Matrix</label>
                            <span class="form-control">{{ $customer->matrix ?? ' ' }}</span>
                        </div>
                    </div>
                </div>
                    </div>
                    <div class="heading-btn">
                        <span class="companydetails-section-heading">Personal Information</span>
                    </div>
                    <hr class="addsupplier-section-border">
                    <div class="upload-file-sec bottom_sec">
                        <div class="row customer-files-sec">
                                    <div class="row form-inp-group">
                                        <div class="col-lg-6 mb-3">
                                            <label class="heading-content"  for="name">First Name</label>
                                            <span class="form-control">{{ $customer->first_name ?? ' ' }}</span>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="heading-content"  for="name">Last Name</label>
                                            <span class="form-control">{{ $customer->last_name ?? ' ' }}</span>
                                        </div>
                                    </div>
                                    <div class="row form-inp-group">
                                        <div class="col-lg-6 mb-3">
                                            <label class="heading-content"  for="name">Phone Number</label>
                                            <span class="form-control">{{ $customer->contect ?? ' ' }}</span>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="heading-content"  for="name">Alternate Phone Number</label>
                                            <span class="form-control">{{ $customer->alt_phone ?? ' ' }}</span>
                                        </div>
                                    </div>
                                    <div class="row form-inp-group">
                                        <div class="col-lg-6 mb-3">
                                            <label class="heading-content"  for="email">Email</label>
                                            <span class="form-control">{{ $customer->email ?? ' ' }}</span>
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
            window.location.href = "{{ route('customers.index') }}";
        });
        
    });

</script>

@endsection