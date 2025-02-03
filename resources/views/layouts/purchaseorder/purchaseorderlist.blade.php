
@extends('layouts.app')
@section('navbarTitel', 'Purchase order List')
@section('content')
<div class="main-outer">
    <div class="outer card">
        <form class="form_mn">
            <div class="heading-btn">
                <h6 class="addsupplier-section-heading">List of Purchase Order</h6>
                <div class="btn-sec btn_group">
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
                        <th><a class="table-anc-content" href="javascript:void(0);" title="PO ID">PO ID</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Date">Date</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Supplier name">Supplier name</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Status">Status</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Item count">Item count</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="">Actions</a></th> 
                    </thead>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">19/7/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ready</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><span class="table-data-span">15</span></a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons prints-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons whtspp-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">19/7/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ready</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><span class="table-data-span">13</span></a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons prints-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons whtspp-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">19/7/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">In-Production</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><span class="table-data-span">13</span></a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons prints-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons whtspp-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">19/7/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">In-Production</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><span class="table-data-span">13</span></a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons prints-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons whtspp-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">19/7/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ready</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><span class="table-data-span">13</span></a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons prints-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons whtspp-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">19/7/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ready</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><span class="table-data-span">13</span></a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons prints-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons whtspp-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">19/7/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">In-Production</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><span class="table-data-span">13</span></a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons prints-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons whtspp-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">19/7/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">In-Production</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><span class="table-data-span">13</span></a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons prints-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons whtspp-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">19/7/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ready</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><span class="table-data-span">13</span></a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons prints-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons whtspp-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">19/7/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ready</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><span class="table-data-span">13</span></a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons prints-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons whtspp-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">19/7/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">In-Production</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><span class="table-data-span">13</span></a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons prints-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons whtspp-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">19/7/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">In-Production</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><span class="table-data-span">13</span></a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons prints-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons whtspp-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1210</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">19/7/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ready</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><span class="table-data-span">13</span></a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons prints-icon-tag"></span></a>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons whtspp-icon-tag"></span></a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>            
    </div>
</div>
@endsection