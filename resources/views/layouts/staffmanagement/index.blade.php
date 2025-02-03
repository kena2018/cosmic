@extends('layouts.app')
@section('content')
<div class="main-outer">
                <div class="outer card">
                    <div class="customer-file-sec staff-manage-sec">
                        <div class="btn-sec btn_group">
                            <div class="button-1 cta_btn">
                                <a href="javascript:void(0);" class="primary-button add-btn">Add Staff User</a>
                            </div>
                        </div>
                        <div class="row form-inp-group col-lg-6">
                                <div class="col-lg-6 mb-3">
                                        <select class="custom-select d-block w-100 form-select-grp" id="country"required>
                                            <option value="">Name of staff</option>
                                        </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                        <select class="custom-select d-block w-100 form-select-grp" id="state"required>
                                            <option value="">State</option>
                                        </select>
                                </div>
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
                                <div class="form-outline" data-mdb-input-init>
                                    <input id="search-sec" type="text" class="form-control form-control-inp"
                                        placeholder="Find Customer">
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
                            <span>Staff Users List</span>
                        </div>
                        <table class="table active all">
                            <thead>
                                <th><a href="javascript:void(0);" title="Name">Name</a></th>
                                <th><a href="javascript:void(0);" title="Phone No.">Phone No.</a></th>
                                <th><a href="javascript:void(0);" title="Email">Email</a></th>
                                <th><a href="javascript:void(0);" title="Role">Role</a></th>
                                <th><a href="javascript:void(0);" title="Action">Action</a></th>
                            </thead>
                            <tr>
                                <td><a href="javascript:void(0);" title="">RAJGURU SONATA</a></td>
                                <td><a href="javascript:void(0);" title="">+91 8888 8888 88</a></td>
                                <td><a href="javascript:void(0);" title="">jeff@tokee.ai</a></td>
                                <td><a href="javascript:void(0);" title="">Admin</a></td>
                                <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="javascript:void(0);" title="">RAJGURU SONATA</a></td>
                                <td><a href="javascript:void(0);" title="">+91 8888 8888 88</a></td>
                                <td><a href="javascript:void(0);" title="">jeff@tokee.ai</a></td>
                                <td><a href="javascript:void(0);" title="">Admin</a></td>
                                <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="javascript:void(0);" title="">RAJGURU SONATA</a></td>
                                <td><a href="javascript:void(0);" title="">+91 8888 8888 88</a></td>
                                <td><a href="javascript:void(0);" title="">jeff@tokee.ai</a></td>
                                <td><a href="javascript:void(0);" title="">Admin</a></td>
                                <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="javascript:void(0);" title="">RAJGURU SONATA</a></td>
                                <td><a href="javascript:void(0);" title="">+91 8888 8888 88</a></td>
                                <td><a href="javascript:void(0);" title="">jeff@tokee.ai</a></td>
                                <td><a href="javascript:void(0);" title="">Admin</a></td>
                                <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="javascript:void(0);" title="">RAJGURU SONATA</a></td>
                                <td><a href="javascript:void(0);" title="">+91 8888 8888 88</a></td>
                                <td><a href="javascript:void(0);" title="">jeff@tokee.ai</a></td>
                                <td><a href="javascript:void(0);" title="">Admin</a></td>
                                <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
@endsection