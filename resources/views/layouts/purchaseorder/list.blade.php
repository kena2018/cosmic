@extends('layouts.app')
@section('navbarTitel', 'Purchase Order')
@section('content')
<div class="main-outer">
    <div class="outer card">
        <form class="form_mn">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-md-6 mb-3">
                            <label class="heading-content" for="name">Order ID</label>
                            <input type="text" class="form-control input-form-content" id="" placeholder="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="heading-content" for="name">Purchase Order Date</label>
                            <input type="text" class="form-control input-form-content" id="" placeholder="">
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-md-6 mb-3">
                            <label class="heading-content" for="text">Supplier Name</label>
                            <select class="custom-select d-block w-100 form-select-grp form-control" name="" id="">
                                <option value="Product Name"></option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="heading-content" for="text">Shipping Address</label>
                            <input type="text" class="form-control input-form-content" id="address" placeholder="">
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
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Sr.">Sr.</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Product Code">Product Code</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Product Name">Product Name</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Rate ">Rate </a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Unit">Unit</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Amount">Amount</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Remark">Remark</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="">Actions</a></th> 
                    </thead>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">131G5240</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">KH.VPM GOLD 21”5MTR BAG-240 <br><span class="pkg-content">PKG: (80x3x25)= 6000 NOS.</span></a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">24.70</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">NO</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1,48,200.00</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><input class="pkg-input" type="text" name="" id=""></a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">131E+5240</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">KH.VPM GOLD 15.50” 5MTR BAG+CARTON -240<br><span class="pkg-content">PKG: (240x1x25)= 6000 NOS.</span></a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">19.38</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">MTR</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1,16,280.00</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><input class="pkg-input" type="text" name="" id=""></a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">131C4450</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">KH.VPM GOLD 13.50” 4MTR BAG -450<br><span class="pkg-content">PKG: (150x3x25)= 11250 NOS.</span></a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">17.10</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">NO</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1,92,375.00</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><input class="pkg-input" type="text" name="" id=""></a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">4</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">404G5300</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">S. ANDHRA STANDARD 21” 5MTR BAG-300<br><span class="pkg-content">PKG: (100x3x25)= 7500 NOS.</span></a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">21.81</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">ROLLS</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1,63,582.50</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><input class="pkg-input" type="text" name="" id=""></a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">5</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">404E5450</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">S. ANDHRA STANDARD 15” 5MTR BAG-450<br><span class="pkg-content">PKG: (150x3x25)= 11250 NOS.</span></a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">15.58</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">MTR</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1,75,275.00</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><input class="pkg-input" type="text" name="" id=""></a></td>
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
            <div class="upload-file-sec">
                <div class="row customer-files-sec">     
                    <div class="upload--file-section">
                        <div class="btn-sec btn_group"></div>
                        <div class="order-btn-grp">
                            <div class="btn-sec btn_group">
                                <div class="button-3 cta_btn">
                                    <a href="javascript:void(0)" class="">Save as pricelist</a>
                                </div>
                            </div>
                            <div class="btn-sec btn_group">
                                <div class="button-1 cta_btn">
                                    <a href="javascript:void(0)" class="">Add</a>
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