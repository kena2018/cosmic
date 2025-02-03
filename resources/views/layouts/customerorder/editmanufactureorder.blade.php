
@extends('layouts.app')
@section('navbarTitel', 'Edit Manufacturing Order')
@section('content')
<div class="main-outer">
    <div class="outer card">
        <form class="form_mn">
            <div class="heading-btn">
                <h6 class="addsupplier-section-heading">Order Details</h6>
                <div class="btn-sec btn_group">
                    <a href="">
                    <span class="back-icons back-tab-icon"></span>
                    </a>
                </div>
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row col-12 customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-md-6 mb-4">
                            <label class="heading-content"  for="name">Product Name</label>
                            <input type="text" class="form-control input-form-content" id="name" placeholder="Paper Files - Plastic" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="heading-content"  for="name">Status</label>
                            <input type="text" class="form-control input-form-content" id="name" placeholder="In-Production" required>
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-md-4 mb-4">
                            <label class="heading-content"  for="name">SKU</label>
                            <input type="text" class="form-control input-form-content" id="name" placeholder="SKU-1034" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="heading-content"  for="number">Colour</label>
                            <input type="text" class="form-control input-form-content" id="name" placeholder="Orange" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="heading-content"  for="number">Packing</label>
                            <select name="" id="ProductsNames" class="custom-select d-block w-100 form-select-grp">
                                <option value="">Box</option>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-md-4 mb-4">
                            <label class="heading-content"  for="name">QTY in Bundle</label>
                            <input type="text" class="form-control input-form-content" id="name" placeholder="1500pcs" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="heading-content"  for="number">Bhartu</label>
                            <input type="text" class="form-control input-form-content" id="name" placeholder="Box" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="heading-content"  for="number">Bag/Box</label>
                            <input type="text" class="form-control input-form-content" id="name" placeholder="1000" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="upload--file-section">
                        <div class="btn-sec btn_group"></div>
                        <div class="order-btn-grp">
                            <div class="btn-sec btn_group">
                                <div class="button-1 cta_btn">
                                    <button type="submit" class="">Add Order</button>
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