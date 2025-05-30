
@extends('layouts.app')
@section('content')

<div class="main-outer">
    <div class="outer card">
        <form class="form_mn">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Contact Person Details</span>
                <div class="btn-sec btn_group">
                <a href="javascript:void(0)">
                <span class="back-icons back-tab-icon"></span>
                </a>
                </div>
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-md-4 mb-3">
                            <label class="heading-content"  for="name">Name</label>
                            <input type="text" class="form-control input-form-content" id="address"
                                placeholder="Taral Shah " readonly
                                required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content"  for="email">Email</label>
                            <input type="email" class="form-control input-form-content" id="address"
                                placeholder="trahal@gmail.com" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content"  for="number">Phone</label>
                            <input type="number" class="form-control input-form-content" id="address"
                                placeholder="+91 888 888 8888" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="heading-btn">
                <span class="companydetails-section-heading">Company Details</span>
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                                    <div class="row form-inp-group">
                                        <div class="col-md-6 mb-3">
                                            <label class="heading-content"  for="name">Company Name</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="Enter your Company Name"
                                                required readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="heading-content"  for="number">GST Number</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="Enter your GST Number"
                                                required readonly>
                                        </div>
                                        
                                    </div>
                                    <div class="row form-inp-group">
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="text">GST Type</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="Select SGT" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="email">Email</label>
                                            <input type="email" class="form-control input-form-content" id="address"
                                                placeholder="Enter your email" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="number">Phone</label>
                                            <input type="number" class="form-control input-form-content" id="address"
                                                placeholder="Enter your Phone number" readonly>
                                        </div>
                                    </div>
                                    <div class="row form-inp-group">
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="address">Address line 1</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="Address line 1" readonly
                                                required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="number">Pin Code</label>
                                            <input type="number" class="form-control input-form-content" id="address"
                                                placeholder="Pin Code" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="name">Country</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="Select country" readonly>
                                        </div>
                                    </div>
                                    <div class="row form-inp-group">
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="name">State</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="Select State" readonly
                                                required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="name">City</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="Select city" readonly>
                                        </div>
                                    </div>

                                <div class="upload--file-section">
                                    <div class="btn-sec btn_group">
                                        
                                    </div>
                                    <div class="order-btn-grp">
                                    <div class="btn-sec btn_group">
                                        <div class="button-1 cta_btn">
                                            <a href="javascript:void(0)" class="primary-button stock-btn">Add Supplier</a>
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