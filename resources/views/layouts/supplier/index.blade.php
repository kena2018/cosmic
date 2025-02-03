
@extends('layouts.app')
@section('content')


<div class="main-outer">
                <div class="outer card">
                    <div class="upload-file-sec list-sec">
                        <span class="upload-file-list-heading">List of Suppliers</span>
                        <div class="btn-sec btn_group">
                            <div class="button-1 cta_btn icon-btn">
                                <a href="javascript:void(0);" class="primary-button ">Add Suppliers</a>
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
                                <div class="button-1 cta_btn icon-btn">
                                    <a href="javascript:void(0);" class="primary-button view-all-btn">View all</a>
                                </div>
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
                        <table class="table active all">
                            <thead>
                                <th><a href="javascript:void(0);" title="Supplier ID">Supplier ID</a></th>
                                <th><a href="javascript:void(0);" title="Company">Company</a></th>
                                <th><a href="javascript:void(0);" title="Contact Name">Contact Name</a></th>
                                <th><a href="javascript:void(0);" title="City">City</a></th>
                                <th><a href="javascript:void(0);" title="State">State</a></th>
                                <th><a href="javascript:void(0);" title="Contact Number">Contact Number</a></th>
                                <th><a href="javascript:void(0);" title="Added on">Added on</a></th>
                                <th><a href="javascript:void(0);" title="Actions">Actions</a></th>

                            </thead>
                            <tr>
                                <td><a href="javascript:void(0);" title="">001</a></td>
                                <td><a href="javascript:void(0);" title="">Surya Demo Supplier</a></td>
                                <td><a href="javascript:void(0);" title="">Taral Shah</a></td>
                                <td><a href="javascript:void(0);" title="">Ahmedabad</a></td>
                                <td><a href="javascript:void(0);" title="">Gujarat</a></td>
                                <td><a href="javascript:void(0);" title="">+91-8866224411</a></td>
                                <td><a href="javascript:void(0);" title="">24/10/2024</a></td>
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
                                <td><a href="javascript:void(0);" title="">001</a></td>
                                <td><a href="javascript:void(0);" title="">Surya Demo Supplier</a></td>
                                <td><a href="javascript:void(0);" title="">Taral Shah</a></td>
                                <td><a href="javascript:void(0);" title="">Ahmedabad</a></td>
                                <td><a href="javascript:void(0);" title="">Gujarat</a></td>
                                <td><a href="javascript:void(0);" title="">+91-8866224411</a></td>
                                <td><a href="javascript:void(0);" title="">24/10/2024</a></td>
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
                                <td><a href="javascript:void(0);" title="">001</a></td>
                                <td><a href="javascript:void(0);" title="">Surya Demo Supplier</a></td>
                                <td><a href="javascript:void(0);" title="">Taral Shah</a></td>
                                <td><a href="javascript:void(0);" title="">Ahmedabad</a></td>
                                <td><a href="javascript:void(0);" title="">Gujarat</a></td>
                                <td><a href="javascript:void(0);" title="">+91-8866224411</a></td>
                                <td><a href="javascript:void(0);" title="">24/10/2024</a></td>
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
                                <td><a href="javascript:void(0);" title="">001</a></td>
                                <td><a href="javascript:void(0);" title="">Surya Demo Supplier</a></td>
                                <td><a href="javascript:void(0);" title="">Taral Shah</a></td>
                                <td><a href="javascript:void(0);" title="">Ahmedabad</a></td>
                                <td><a href="javascript:void(0);" title="">Gujarat</a></td>
                                <td><a href="javascript:void(0);" title="">+91-8866224411</a></td>
                                <td><a href="javascript:void(0);" title="">24/10/2024</a></td>
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