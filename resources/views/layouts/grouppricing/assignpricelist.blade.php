
@extends('layouts.app')
@section('navbarTitel', 'Assign Price List')
@section('content')
<div class="main-outer">
    <div class="outer card">
        <form class="form_mn">
            <div class="heading-btn left-btn">
                <div class="btn-sec btn_group">
                    <a href="">
                    <span class="back-icons back-tab-icon"></span>
                    </a>
                </div>
            </div>
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="name">Customer</label>
                            <input type="text" class="form-control input-form-content" name="" id="" placeholder="Demo Customer" value="" required="">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="name">List Name</label>
                            <input type="text" name="" class="form-control input-form-content" id="" placeholder="Cosmic product list 16-01-24" value="" required="">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content" for="name">Discount</label>
                            <input type="text" name="" class="form-control input-form-content" id="" placeholder="20%" value="" required="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="file-sec pagination-sec">
                <div class="file-type">
                    <div class="page-select">
                        <select name="" id="" class="page-selects">
                            <option value="" class="page-select-option">1</option>
                            <option value="" class="page-select-option">2</option>
                            <option value="" class="page-select-option">3</option>
                            <option value="" class="page-select-option">4</option>
                        </select>
                    </div>
                    <div class="btn-sec btn_group">
                        <button class="product-btn">Export</button>
                        <button class="product-btn">Bulk Actions</button>
                        <button class="product-btn"><span class="refresh-group-icons refresh-icon-tag"></span></button>
                    </div>
                </div>
                <div class="btn-sec btn_group">
                    <div class="button-1 cta_btn">
                        <a href="javascript:void(0)" class="">Save Price List</a>
                    </div>
                </div>
            </div>
            <div class="upload-file-sec customer-list-sec">
                <span class="addsupplier-section-heading">Price List</span>
                <div class="search-sec">
                    <form class="input-group">
                        <div class="form-outline" data-mdb-input-init="">
                            <input type="text" name="searchdata" class="form-control form-control-inp" id="searchdata" placeholder="Search">
                            <span class="search-icons search-icon-tag"></span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive table-designs">
                <table class="table active all">
                    <thead>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="No">No</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Box Pack">Box Pack</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Meter">Meter</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Min Qty">Min Qty</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Rate">Rate</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Discount Rates">Discount Rates</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Special Rate">Special Rate</a></th> 
                    </thead>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Cosmic Stuff</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">10mtrs</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">131*1</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">75.00 INR</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">60.00 INR</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><input class="table-inpt" type="text" value=""></a></td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">2</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Cosmic Stuff</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">10mtrs</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">131*1</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">75.00 INR</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">60.00 INR</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><input class="table-inpt" type="text" value=""></a></td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">3</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Cosmic Stuff</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">10mtrs</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">131*1</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">75.00 INR</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">60.00 INR</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><input class="table-inpt" type="text" value=""></a></td>
                    </tr>
                </table>
            </div>
        </form>            
    </div>
</div>
@endsection