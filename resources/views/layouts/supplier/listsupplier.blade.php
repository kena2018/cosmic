@extends('layouts.app')
@section('navbarTitel', 'List of all Suppliers')
@section('content')
<div class="main-outer">
    <div class="outer card">
        <div class="heading-btn">
            <div class="btn-sec btn_group">
                <div class="button-1 cta_btn">
                    <button type="submit" class="primary-button stock-btn">Add New Supplier</button>
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
                        <input type="date" class="form-control input-form-content" id="session-date" required>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label class="heading-content"  for="number">To date</label>
                        <input type="date" class="form-control input-form-content" id="session-date">
                    </div>
                </div>
                <div class="row form-inp-group">
                    <div class="col-md-4 mb-5">
                        <label class="heading-content"  for="name">Company Name</label>
                        <input type="email" class="form-control input-form-content" id="" placeholder="Enter Company Name">
                    </div>
                    <div class="col-md-4 mb-5">
                        <label class="heading-content"  for="number">Email</label>
                        <input type="email" class="form-control input-form-content" id="" placeholder="Enter Email">
                    </div>
                    <div class="col-md-4 mb-5">
                        <label class="heading-content"  for="name">Phone no</label>
                        <input type="text" class="form-control input-form-content" id="" placeholder="Enter phone no">
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
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Supplier ID">Supplier ID</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Company">Company</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Contact Name">Contact Name</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="City">City</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="State">State</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Contact Number">Contact Number</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Added on">Added on</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Actions">Actions</a></th>
                    </thead>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">001</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Surya Demo Supplier</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ahmedabad</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Gujarat</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">+91-8866224411</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">24/10/2024</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">001</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Surya Demo Supplier</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ahmedabad</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Gujarat</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">+91-8866224411</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">24/10/2024</a></td>
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
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">001</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Surya Demo Supplier</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Ahmedabad</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Gujarat</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">+91-8866224411</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">24/10/2024</a></td>
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
       
<script>
 
</script>
@endsection
