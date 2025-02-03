
@extends('layouts.app')
@section('navbarTitel', 'Add Materials')
@section('content')

<div class="main-outer">
    <div class="outer card">
        <form class="form_mn">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Material Information</span>
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
                        <div class="col-md-6 mb-3">
                            <label class="heading-content"  for="name">Material Category</label>
                            <select class="custom-select d-block w-100 form-select-grp form-control" name="" id="">
                                <option value="Product Name">Product Name</option>
                            </select>
                            <span class="input-title">Plastic Roll/Paper Roll/ Paper Sheet</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="heading-content"  for="name">Material Type</label>
                            <select class="custom-select d-block w-100 form-select-grp form-control" name="" id="">
                                <option value="Product Name">Material select</option>
                            </select>
                            <span class="input-title">Packing Material/Raw Material/ Others</span>
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-md-6 mb-3">
                            <label class="heading-content"  for="text">Size</label>
                            <input type="text" class="form-control input-form-content" id="address" placeholder="">
                            <span class="input-title">Material Size</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="heading-content"  for="text">Unit</label>
                            <select class="custom-select d-block w-100 form-select-grp form-control" name="" id="">
                                <option value="Product Name">FEET</option>
                            </select>
                        </div>
                    </div>
                    
                                
                    <div class="upload--file-section">
                        <div class="btn-sec btn_group"></div>
                        <div class="order-btn-grp">
                            <div class="btn-sec btn_group">
                                <div class="button-1 cta_btn">
                                    <a href="javascript:void(0)" class="primary-button stock-btn">Add Material</a>
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