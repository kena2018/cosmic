
@extends('layouts.app')
@section('content')

<div class="main-outer">
    <div class="outer card">
        <form class="form_mn">
                    <div class="heading-btn">
                        <span class="addsupplier-section-heading">Company and Billing Information</span>
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
                                            <label class="heading-content"  for="name">Company Name</label>
                                            <input type="text" class="form-control input-form-content" id="name"
                                                placeholder="Techify Solutions" readonly
                                                required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="number">GSTIN</label>
                                            <input type="text" class="form-control input-form-content" id="gstin"
                                                placeholder="16516 51611 51" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="name">Payment Terms</label>
                                            <select class="custom-select d-block w-100 form-select-grp" id="payment"
                                                            required>
                                                <option value="">Advance</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-inp-group">
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="address">Billing Address Line 1</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="4140 Parker Rd. Allentown, New Mexico 31134"
                                                required readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="number">Billing Address Line 2</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="6391 Elgin St. Celina, Delaware 10299" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="name">Pin</label>
                                            <input type="number" class="form-control input-form-content" id="pin"
                                                placeholder="352218" readonly>
                                        </div>
                                    </div>
                                    <div class="row form-inp-group">
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="name">Country</label>
                                            <select class="custom-select d-block w-100 form-select-grp" id="country"
                                                            required>
                                                <option value="">India</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="name">State</label>
                                            <select class="custom-select d-block w-100 form-select-grp" id="state"
                                                            required>
                                                <option value="">Gujrat</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="name">City</label>
                                            <select class="custom-select d-block w-100 form-select-grp" id="city"
                                                            required>
                                                <option value="">Ahmedabad</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="heading-btn">
                        <span class="companydetails-section-heading">Personal Information</span>
                        </div>
                        <hr class="addsupplier-section-border">
                            <div class="upload-file-sec">
                                <div class="row customer-files-sec">
                                    <div class="row form-inp-group">
                                        <div class="col-md-6 mb-3">
                                            <label class="heading-content"  for="name">First Name</label>
                                            <input type="text" class="form-control input-form-content" id="name"
                                                placeholder="Taral"
                                                required readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="heading-content"  for="name">Last Name</label>
                                            <input type="text" class="form-control input-form-content" id="name"
                                                placeholder="Shah" readonly>
                                        </div>
                                    </div>
                                    <div class="row form-inp-group">
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="email">Email</label>
                                            <input type="email" class="form-control input-form-content" id="email"
                                                placeholder="trahal@gmail.com" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="name">Additional Contact</label>
                                            <input type="text" class="form-control input-form-content" id="contact"
                                                placeholder="+91 8888 8888 88" readonly
                                                required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="heading-content"  for="name">Group</label>
                                            <select class="custom-select d-block w-100 form-select-grp" id="group"
                                                            required>
                                                <option value="">Group A</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="upload--file-section">
                                        <div class="btn-sec btn_group">
                                        
                                        </div>
                                        <div class="order-btn-grp">
                                        <div class="btn-sec btn_group">
                                        <div class="button-1 cta_btn">
                                            <button type="submit" class="primary-button stock-btn">Save Information</button>
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