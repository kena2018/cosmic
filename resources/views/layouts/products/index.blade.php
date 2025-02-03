@extends('layouts.app')
@section('content')
<div class="main-outer">
                <div class="outer card">
                    <div class="customer-file-sec add-file-sec">
                        <div class="btn-sec btn_group">
                            <div class="button-1 cta_btn">
                                <a href="javascript:void(0);" class="primary-button add-btn">Add</a>
                            </div>
                        </div>
                    </div>
                    <div class="upload-file-sec">
                        <div class="row customers-filess-section">
                                <form class="form-mn">
                                    <div class="row form-inp-group">
                                        <div class="col-md-3 mb-3">
                                                <select class="custom-select d-block w-100 form-select-grp" id="country">
                                                    <option value="">Product</option>
                                                </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                                <select class="custom-select d-block w-100 form-select-grp" id="country">
                                                    <option value="">Product type</option>
                                                </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                                <select class="custom-select d-block w-100 form-select-grp" id="country">
                                                    <option value="">Gage</option>
                                                </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                                <select class="custom-select d-block w-100 form-select-grp" id="country">
                                                    <option value="">Min Qty</option>
                                                </select>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                    <div class="file-sec">
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
                        <div class="search-sec">
                            <form class="input-group">
                                <div class="form-outline">
                                    <input id="search-sec" type="text" class="form-control form-control-inp"
                                        placeholder="Find Product">
                                    <span class="search-icons search-icon-tag"></span>
                                    <!-- <button class="form-inp-btn" type="submit">
                                        <span class="fa fa-search form-control-feedback"></span>
                                    </button> -->
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="upload-file-sec list-product-sec">
                            <span>List of Products</span>
                        </div>
                        <table class="table active all">
                            <thead>
                                <th><a href="javascript:void(0);" title="Product">Product</a></th>
                                <th><a href="javascript:void(0);" title="Image">Image</a></th>
                                <th><a href="javascript:void(0);" title="Name">Name</a></th>
                                <th><a href="javascript:void(0);" title="Alias">Alias</a></th>
                                <th><a href="javascript:void(0);" title="Packing Type">Packing Type</a></th>
                                <th><a href="javascript:void(0);" title="Min Qty">Min Qty</a></th>
                                <th><a href="javascript:void(0);" title="Bharti">Bharti</a></th>
                                <th><a href="javascript:void(0);" title="Bags/Box">Bags/Box</a></th>
                                <th><a href="javascript:void(0);" title="Gage">Gage</a></th>
                                <th><a href="javascript:void(0);" title="Actions">Actions</a></th>
                            </thead>
                            <tr>
                                <td><a href="javascript:void(0);" title="">1210</a></td>
                                <td><a href="javascript:void(0);" title=""><img class="table-img" src="" alt=""></a></td>
                                <td><a href="javascript:void(0);" title="">File Cover</a></td>
                                <td><a href="javascript:void(0);" title="">COS-123</a></td>
                                <td><a href="javascript:void(0);" title="">Bag</a></td>
                                <td><a href="javascript:void(0);" title="">500 pcs</a></td>
                                <td><a href="javascript:void(0);" title="">130</a></td>
                                <td><a href="javascript:void(0);" title="">200</a></td>
                                <td><a href="javascript:void(0);" title="">200</a></td>
                                <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="javascript:void(0);" title="">1210</a></td>
                                <td><a href="javascript:void(0);" title=""><img class="table-img" src="" alt=""></a></td>
                                <td><a href="javascript:void(0);" title="">File Cover</a></td>
                                <td><a href="javascript:void(0);" title="">COS-123</a></td>
                                <td><a href="javascript:void(0);" title="">Bag</a></td>
                                <td><a href="javascript:void(0);" title="">500 pcs</a></td>
                                <td><a href="javascript:void(0);" title="">130</a></td>
                                <td><a href="javascript:void(0);" title="">2</a></td>
                                <td><a href="javascript:void(0);" title="">200</a></td>
                                <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="javascript:void(0);" title="">1210</a></td>
                                <td><a href="javascript:void(0);" title=""><img class="table-img" src="" alt=""></a></td>
                                <td><a href="javascript:void(0);" title="">File Cover</a></td>
                                <td><a href="javascript:void(0);" title="">COS-123</a></td>
                                <td><a href="javascript:void(0);" title="">Bag</a></td>
                                <td><a href="javascript:void(0);" title="">500 pcs</a></td>
                                <td><a href="javascript:void(0);" title="">130</a></td>
                                <td><a href="javascript:void(0);" title="">2</a></td>
                                <td><a href="javascript:void(0);" title="">200</a></td>
                                <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="javascript:void(0);" title="">1210</a></td>
                                <td><a href="javascript:void(0);" title=""><img class="table-img" src="" alt=""></a></td>
                                <td><a href="javascript:void(0);" title="">File Cover</a></td>
                                <td><a href="javascript:void(0);" title="">COS-123</a></td>
                                <td><a href="javascript:void(0);" title="">Bag</a></td>
                                <td><a href="javascript:void(0);" title="">500 pcs</a></td>
                                <td><a href="javascript:void(0);" title="">130</a></td>
                                <td><a href="javascript:void(0);" title="">2</a></td>
                                <td><a href="javascript:void(0);" title="">200</a></td>
                                <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
@endsection