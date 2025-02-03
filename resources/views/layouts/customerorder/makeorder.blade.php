
@extends('layouts.app')
@section('navbarTitel', 'Make Order')
@section('content')
<div class="main-outer">
    <div class="outer card">
        <form class="form_mn">
            <div class="heading-btn">
                <h6 class="addsupplier-section-heading">Manufacturing order</h6>
                <div class="btn-sec btn_group">
                    <div class="button-1 cta_btn">
                        <a href="javascript:void(0)" class="">Add Order</a>
                    </div>
                </div>
            </div>
            <div class="filee-sec pagination-sec">
                <div class="search-sec">
                        <div class="form-outline" data-mdb-input-init="">
                            <input type="text" name="searchdata" class="form-control form-control-inp" id="searchdata" placeholder="Search">
                            <span class="search-icons search-icon-tag"></span>
                        </div>
                </div>
            </div>
            <div class="table-responsive table-designs">
                <table class="table active all">
                    <thead>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="">Product Name</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="">SKU</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="">Color</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="">Packing</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="">QTY in Bundel</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="">Bharti</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="">Bag/Box</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="">Status</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="">Actions</a></th> 
                    </thead>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Paper Files - Plastic</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">SKU-1034</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Orange</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Box</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1500pcs</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Box</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">10</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ready</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Paper Files - Plastic</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">SKU-1034</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Orange</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Box</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1500pcs</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Box</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">10</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ready</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Paper Files - Plastic</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">SKU-1034</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Orange</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Box</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1500pcs</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Box</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">10</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">In-Production</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Paper Files - Plastic</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">SKU-1034</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Orange</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Box</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1500pcs</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Box</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">10</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">In-Production</a></td>
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
        </form>            
    </div>
</div>
@endsection