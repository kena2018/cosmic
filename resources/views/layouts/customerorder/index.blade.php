@extends('layouts.app')
@section('navbarTitel', 'Orders')
@section('content')
    <div class="main-outer">
        <div class="row col-12 customer-section-listss">
            <div class="col-lg-4 col-md-4 ">
                <div class="card-sm-1">
                    <div class="cstmr-ordr-content">
                        <span class="table-group-icons share-icon-tag"></span>
                        <label class="card-title">Total Orders</label>
                        <span class="card-data">536/1000</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar w-75 progress-totalorder" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 ">
                <div class="card-sm-1">
                    <div class="cstmr-ordr-content">
                        <span class="table-group-icons share-icon-tag"></span>
                        <label class="card-title">Active Orders</label>
                        <span class="card-data">256/536</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar w-25 progress-activeorder" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 ">
                <div class="card-sm-1">
                    <div class="cstmr-ordr-content">
                        <span class="table-group-icons share-icon-tag"></span>
                        <label class="card-title">Total Dispatched</label>
                        <span class="card-data">200/536</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar w-75 progress-totaldispached" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 ">
                <div class="card-sm-1">
                    <div class="cstmr-ordr-content">
                        <span class="table-group-icons share-icon-tag"></span>
                        <label class="card-title">Partially Dispatched</label>
                        <span class="card-data">151/536</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar w-50 progress-partially" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 ">
                <div class="card-sm-1">
                    <div class="cstmr-ordr-content">
                        <span class="table-group-icons share-icon-tag"></span>
                        <label class="card-title">Delivered</label>
                        <span class="card-data">536/1000</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar w-25 progress-delivered" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="outer card">
            <div class="upload-file-sec customer-list-sec">
                <h6 class="addsupplier-section-heading">Order list</h6>
                <div class="btn-sec btn_group">
                    <div class="button-1 cta_btn icon-btn">
                        <a href="" class="">Add Order</a>
                    </div>
                </div>
            </div>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ahmedabad</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">In-Transit</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">GST-123</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">121541</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ahmedabad</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">In-Transit</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">GST-123</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">121541</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ahmedabad</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">In-Transit</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">GST-123</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">121541</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ahmedabad</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">In-Transit</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">GST-123</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">121541</a></td>
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
@section('modul')
    <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Customer List ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this list ?</p>
            </div>
            <div class="modal-footer">
                <div class="btn-sec btn_group">
                    <div class="button-3 cta_btn icon-btn">
                        <a href="javascript:void(0)" class="primary-button Cancel-customer">Cancel</a>
                    </div>
                </div>
                <div class="btn-sec btn_group">
                    <div class="button-3 cta_btn icon-btn">
                        <a href="javascript:void(0)" class="primary-button delete-customer" id="role_id" data-id="">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection