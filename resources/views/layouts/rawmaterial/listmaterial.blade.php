
@extends('layouts.app')
@section('navbarTitel', 'Materials')
@section('content')
<div class="main-outer">
    <div class="outer card">
        <form class="form_mn">
            <div class="heading-btn">
                <h6 class="addsupplier-section-heading">List of Materials</h6>
                <div class="btn-sec btn_group">
                    <div class="btn-sec btn_group">
                        <a href="javascript:void(0)">
                            <span class="print-icon print-icon-tag"></span>
                        </a>
                    </div>
                    <div class="button-1 cta_btn">
                        <a href="javascript:void(0)" class="">Add</a>
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
                            <div class="material-dropdown">
                                <select class="custom-select d-block w-100 form-select-grp form-control" name="" id="">
                                    <option value="Category">Category</option>
                                </select>
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
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Product ID">Product ID</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Material Type">Material Type</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Product Name">Product Name</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Unit">Unit</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Remark">Remark</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="">Actions</a></th> 
                    </thead>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Corrugration Box</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COSMIC GOLD</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">KG</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COS-123</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">STICKER</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COSMIC PLATINUM</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">KG</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COS-123</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">ELECTRIC ITEM</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COSMIC DIAMOND</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">SHEET</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COS-123</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Paper Tube</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COSMIC GOLD</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">KG</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COS-123</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Parchuran</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COSMIC PLATINUM</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">ROLL</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COS-123</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">SINGLE BOX</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COSMIC DIAMOND</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">NOS</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COS-123</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">H.M. Bag & Outer</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COSMIC GOLD</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">KG</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COS-123</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">FEVICOL</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COSMIC PLATINUM</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">BAGS</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COS-123</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">AMAYARA PACKEGIGN</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COSMIC DIAMOND</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">KG</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COS-123</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">HM WEST</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COSMIC GOLD</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">KG</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COS-123</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">YADAV</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COSMIC PLATINUM</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">SHEET</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COS-123</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">INK</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COSMIC DIAMOND</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">BAGS</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COS-123</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">H.M WASTE</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COSMIC GOLD</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">KG</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">COS-123</a></td>
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