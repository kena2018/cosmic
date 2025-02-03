@extends('layouts.app')
@section('navbarTitel', 'Customer Summery')
@section('content')
 
<div class="main-outer">
    <div class="outer card">
        <div class="heading-btn">
            <div class="btn-sec btn_group">
                <div class="button-1 cta_btn">
                    <button type="submit" class="primary-button stock-btn">Add Order</button>
                </div>
            </div>
            <div class="btn-sec btn_group">
                <a href="">
                <span class="back-icons back-tab-icon"></span>
                </a>
            </div>
        </div>
        <div class="upload-file-sec">
            <div class="row customer-files-sec">
                <div class="row form-inp-group">
                    <div class="col-md-4 mb-4">
                        <label class="heading-content"  for="name">From date</label>
                        <input type="date" class="form-control input-form-content" id="name" required>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label class="heading-content"  for="number">To date</label>
                        <input type="date" class="form-control input-form-content" id="gstin">
                    </div>
                </div>
                <div class="row form-inp-group">
                    <div class="col-md-4 mb-5">
                        <label class="heading-content"  for="name">Customer</label>
                        <select class="custom-select d-block w-100 form-select-grp" id="payment"
                                        required>
                            <option value="">Techify solutions</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-5">
                        <label class="heading-content"  for="number">Order No</label>
                        <select class="custom-select d-block w-100 form-select-grp" id="payment"
                                        required>
                            <option value="">1321651</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-5">
                        <label class="heading-content"  for="name">Status</label>
                        <select class="custom-select d-block w-100 form-select-grp" id="payment"
                                        required>
                            <option value="">In-Transit</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="outer card">
        <div class="filee-sec pagination-sec">
            <div class="search-sec">
                <form class="input-group">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" name="searchdata" class="form-control form-control-inp" id="searchdata" placeholder="Search">
                        <span class="search-icons search-icon-tag"></span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive table-designs">
                <table class="table active all">
                    <thead>
                        <th><a class="table-anc-content" href="javascript:void(0);" title=""></a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Order Date">Order Date</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Order">Order</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Customer">Customer</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="City">City</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="State">State</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Amount">Amount</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Total Bundel">Total Bundel</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Actions">Actions</a></th>

                    </thead>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><input type="checkbox"></a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">12-01-24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1321651</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Techify Solution</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Techify Solution</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">In-Transit</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">12,150</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">12,1541</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><input type="checkbox"></a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">12-01-24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1321651</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Techify Solution</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Techify Solution</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">In-Transit</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">12,150</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">12,1541</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title=""><input type="checkbox"></a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">12-01-24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">1321651</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Techify Solution</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Techify Solution</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">In-Transit</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">12,150</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">12,1541</a></td>
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
