
@extends('layouts.app')
@section('content')

<div class="main-outer">
    <div class="outer card">
        <form class="form_mn">
                    <div class="heading-btn">
                        <span class="addsupplier-section-heading">Product Information</span>
                        <div class="btn-sec btn_group">
                        <a href="javascript:void(0)">
                        <span class="back-icons back-tab-icon"></span>
                        </a>
                        </div>
                    </div>
                    <hr class="addsupplier-section-border">
                    <div class="upload-file-sec product-list-sec">

                            <div class="form-content-part col-8">
                                <div class="row customer-files-sec">
                                        <div class="row form-inp-group">
                                            <div class="col-md-6 mb-3">
                                                <label class="heading-content"  for="name">Product Name</label>
                                                <input type="text" class="form-control input-form-content" id="address"
                                                    placeholder="Cosmic Diamond FG" readonly
                                                    required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="heading-content"  for="email">Group Name</label>
                                                <input type="email" class="form-control input-form-content" id="address"
                                                    placeholder="S Andhra Pearl- FG" readonly>
                                            </div>
                                        </div>
                                        <div class="row form-inp-group">
                                            <div class="col-md-6 mb-3">
                                                <label class="heading-content"  for="name">Alias /SKU</label>
                                                <input type="text" class="form-control input-form-content" id="address"
                                                    placeholder="" readonly
                                                    required>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="heading-content"  for="name">Width</label>
                                                <input type="text" class="form-control input-form-content" id="address"
                                                    placeholder="" readonly
                                                    required>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="heading-content"  for="name">Length</label>
                                                <input type="text" class="form-control input-form-content" id="address"
                                                    placeholder="" readonly
                                                    required>
                                            </div>
                                        </div>
                                        <div class="row form-inp-group">
                                            <div class="col-md-6 mb-3">
                                                <label class="heading-content"  for="name">Category</label>
                                                <input type="text" class="form-control input-form-content" id="address"
                                                    placeholder="" readonly
                                                    required>
                                                <span class="input-title">Plastic Roll/ Paper Roll/Paper Sheet</span>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="heading-content"  for="name">Gage</label>
                                                <input type="text" class="form-control input-form-content" id="address"
                                                    placeholder="" readonly
                                                    required>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="heading-content"  for="name">Master Packing</label>
                                                <div class="form-radio-sec">
                                                <div class="form-check">
                                                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                      <label class="form-check-label" for="flexRadioDefault1">
                                                        Bag
                                                      </label>
                                                    </div>
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                      <label class="form-check-label" for="flexRadioDefault2">
                                                        Box
                                                      </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="upload-part col-4">
                                <label for="file-input"class="file-input-label">
                                    <input id="file-input" type="file" class="file-input-label-section"/>
                                    <img src="{{ asset('assets/img/uploadfile.svg')}}" alt="">
                                    <span>Upload Product Image</span>
                                </label>
                            </div>

                    </div>
                    <div class="heading-btn">
                        <span class="companydetails-section-heading">Product Specifications</span>
                    </div>
                    <hr class="addsupplier-section-border">
                    <div class="upload-file-sec">
                        <div class="row customer-files-sec">
                                    <div class="row form-inp-group">
                                        <div class="col-md-6 mb-3">
                                            <label class="heading-content"  for="number">Bharti</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="130" required readonly>
                                            <span class="input-title"></span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="heading-content"  for="number">Bags/Box</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="2" required readonly>
                                            <span class="input-title">Per Bundle</span>
                                        </div>
                                    </div>
                                    <div class="row form-inp-group">
                                        <div class="col-md-6 mb-3">
                                            <label class="heading-content"  for="number">Pipe Size</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="" readonly>
                                            <span class="input-title">19mm/22mm/25mm</span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="heading-content"  for="text">Rolls in 1 bdl</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="260" required readonly>
                                            <span class="input-title">Bharti* Bags/Box=Bdl</span>
                                        </div>
                                    </div>
                                    <div class="row form-inp-group">
                                        <div class="col-md-6 mb-3">
                                            <label class="heading-content"  for="number">Roll Weight</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="300" required readonly>
                                            <span class="input-title">grms</span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="heading-content"  for="text">Bdl K.G</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="" readonly>
                                            <span class="input-title">Rolls In 1 Bdle*Roll Weight/1000</span>    
                                        </div>
                                    </div>
                                    <div class="row form-inp-group">
                                        <div class="col-md-6 mb-3">
                                            <label class="heading-content"  for="number">Packing Material Qty/Used per box/bag</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="130" required readonly>
                                            <span class="input-title">Bharti/Packing Type</span>   
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="heading-content"  for="text">Quter Name</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="Select SGT" readonly>
                                            <span class="input-title"></span>
                                        </div>
                                    </div>
                                    <div class="row form-inp-group">
                                        <div class="col-md-6 mb-3">
                                            <label class="heading-content"  for="number">No of Outer/Used per Master</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="" required readonly>
                                            <span class="input-title"></span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="heading-content"  for="text">Carton No</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="" readonly>
                                            <span class="input-title"></span>
                                        </div>
                                    </div>
                                    <div class="row form-inp-group">
                                        <div class="col-md-6 mb-3">
                                            <label class="heading-content"  for="number">Packing Material Type</label>
                                            <input type="text" class="form-control input-form-content" id="address"
                                                placeholder="" required readonly>
                                            <span class="input-title">Box/Bag/5Pcs/4 Pcs/Outer/Null</span>
                                        </div>
                                    </div>
                                
                                <div class="upload--file-section">
                                    <div class="btn-sec btn_group">
                                        
                                    </div>
                                    <div class="order-btn-grp">
                                    <div class="btn-sec btn_group">
                                        <div class="button-1 cta_btn">
                                            <a href="javascript:void(0)" class="primary-button stock-btn">Create a New Product</a>
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