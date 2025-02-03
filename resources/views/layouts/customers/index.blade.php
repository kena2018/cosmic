@extends('layouts.app')
@section('content')

    <div class="main-outer">
        <div class="row customer-section-list">
            <div class="col-sm-4">
                <div class="card-1">
                    <div class="card-content">
                        <h6>Total Customers</h6>
                        <span class="card-content-span">536</span>
                    </div>
                    <!-- <div class="card-image">
                        <img src="/assets/img/vector7.svg" class="card-vector-1" alt="card-vector-1">
                    </div> -->
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-2">
                    <div class="card-content">
                        <h6>Active Customers</h6>
                        <span class="card-content-span">256</span>
                    </div>
                    <!-- <div class="card-image">
                        <img src="/assets/img/vector8.svg" class="card-vector-2" alt="card-vector-2">
                    </div> -->
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-3">
                    <div class="card-content">
                        <h6>Inactive Customers</h6>
                        <span class="card-content-span">299</span>
                    </div>
                    <!-- <div class="card-image">
                        <img src="/assets/img/vector9.svg" class="card-vector-3" alt="card-vector-3">
                    </div> -->
                </div>
            </div>
        </div>
        <div class="outer card">
            <div class="upload-file-sec customer-list-sec">
                <span>Customer List</span>
                <div class="btn-sec btn_group">
                    <div class="button-1 cta_btn icon-btn">
                        <a href="javascript:void(0)" class="primary-button ">New Customer</a>
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
                        <th><a href="javascript:void(0);" title="Company Name">Company Name</a></th>
                        <th><a href="javascript:void(0);" title="Contact Name">Contact Name</a></th>
                        <th><a href="javascript:void(0);" title="Phone">Phone</a></th>
                        <th><a href="javascript:void(0);" title="City">City</a></th>
                        <th><a href="javascript:void(0);" title="State">State</a></th>
                        <th><a href="javascript:void(0);" title="Group">Group</a></th>
                        <th><a href="javascript:void(0);" title="Last order">Last order</a></th>
                        <th><a href="javascript:void(0);" title="Perf. Matrix">Perf. Matrix</a></th>
                        <th><a href="javascript:void(0);" title="Actions">Actions</a></th>

                    </thead>
                    <tr>
                        <td><a href="javascript:void(0);" title="">Techify Solutions</a></td>
                        <td><a href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a href="javascript:void(0);" title=""> +91 8888 8888 88</a></td>
                        <td><a href="javascript:void(0);" title="">Ahmedabad</a></td>
                        <td><a href="javascript:void(0);" title="">Gujarat</a></td>
                        <td><a href="javascript:void(0);" title="">Group A</a></td>
                        <td><a href="javascript:void(0);" title="">10 Days ago</a></td>
                        <td><a href="javascript:void(0);" title="">2</a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" title="">Techify Solutions</a></td>
                        <td><a href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a href="javascript:void(0);" title=""> +91 8888 8888 88</a></td>
                        <td><a href="javascript:void(0);" title="">Ahmedabad</a></td>
                        <td><a href="javascript:void(0);" title="">Gujarat</a></td>
                        <td><a href="javascript:void(0);" title="">Group A</a></td>
                        <td><a href="javascript:void(0);" title="">10 Days ago</a></td>
                        <td><a href="javascript:void(0);" title="">2</a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" title="">Techify Solutions</a></td>
                        <td><a href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a href="javascript:void(0);" title=""> +91 8888 8888 88</a></td>
                        <td><a href="javascript:void(0);" title="">Ahmedabad</a></td>
                        <td><a href="javascript:void(0);" title="">Gujarat</a></td>
                        <td><a href="javascript:void(0);" title="">Group A</a></td>
                        <td><a href="javascript:void(0);" title="">10 Days ago</a></td>
                        <td><a href="javascript:void(0);" title="">2</a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" title="">Techify Solutions</a></td>
                        <td><a href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a href="javascript:void(0);" title=""> +91 8888 8888 88</a></td>
                        <td><a href="javascript:void(0);" title="">Ahmedabad</a></td>
                        <td><a href="javascript:void(0);" title="">Gujarat</a></td>
                        <td><a href="javascript:void(0);" title="">Group A</a></td>
                        <td><a href="javascript:void(0);" title="">10 Days ago</a></td>
                        <td><a href="javascript:void(0);" title="">2</a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" title="">Techify Solutions</a></td>
                        <td><a href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a href="javascript:void(0);" title=""> +91 8888 8888 88</a></td>
                        <td><a href="javascript:void(0);" title="">Ahmedabad</a></td>
                        <td><a href="javascript:void(0);" title="">Gujarat</a></td>
                        <td><a href="javascript:void(0);" title="">Group A</a></td>
                        <td><a href="javascript:void(0);" title="">10 Days ago</a></td>
                        <td><a href="javascript:void(0);" title="">2</a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" title="">Techify Solutions</a></td>
                        <td><a href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a href="javascript:void(0);" title=""> +91 8888 8888 88</a></td>
                        <td><a href="javascript:void(0);" title="">Ahmedabad</a></td>
                        <td><a href="javascript:void(0);" title="">Gujarat</a></td>
                        <td><a href="javascript:void(0);" title="">Group A</a></td>
                        <td><a href="javascript:void(0);" title="">10 Days ago</a></td>
                        <td><a href="javascript:void(0);" title="">2</a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" title="">Techify Solutions</a></td>
                        <td><a href="javascript:void(0);" title="">Taral Shah</a></td>
                        <td><a href="javascript:void(0);" title=""> +91 8888 8888 88</a></td>
                        <td><a href="javascript:void(0);" title="">Ahmedabad</a></td>
                        <td><a href="javascript:void(0);" title="">Gujarat</a></td>
                        <td><a href="javascript:void(0);" title="">Group A</a></td>
                        <td><a href="javascript:void(0);" title="">10 Days ago</a></td>
                        <td><a href="javascript:void(0);" title="">2</a></td>
                        <td>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons eye-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1">
                                        <span class="table-group-icons share-icon-tag"></span>
                                    <a href="javascript:void(0);" title="" class="btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <span class="table-group-icons edit-icon-tag"></span></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>        
 
</div>


</script>
@endsection