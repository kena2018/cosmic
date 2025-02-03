
@extends('layouts.app')
@section('navbarTitel', 'Group Pricing')
@section('content')
<div class="main-outer">
    <div class="outer card">
        <form class="form_mn">
            <div class="heading-btn">
                <h6 class="addsupplier-section-heading">Manufacturing order</h6>
                <div class="btn-sec btn_group">
                    <div class="button-1 cta_btn">
                        <a href="javascript:void(0)" class="">New Pricing</a>
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
                        <th><a class="table-anc-content" href="javascript:void(0);" title="ID">ID</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Name">Name</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Products">Products</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Start Date">Start Date</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Effective Upto">Effective Upto</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title=""></a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="">Actions</a></th> 
                    </thead>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Cosmic Stuff</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">10mtrs</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">131*1</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">75.00 INR</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><button class="table-btns">Assign Products</button></a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">2</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Cosmic Grand</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">8mtrs</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">131*1</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">56.00 INR</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><button class="table-btns">Assign Products</button></a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">3</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Diamond</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">4mtrs</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">131*1</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">18.00 INR</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><button class="table-btns">Assign Products</button></a></td>
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