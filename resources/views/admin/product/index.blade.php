@extends('layouts.app')
@section('navbarTitel', 'Product Manufacture')
@section('content')
<div class="main-outer">
    <div class="outer card">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="upload-file-sec customer-list-sec">
            <span class="addsupplier-section-heading">List of Products</span>
            <div class="btn-sec btn_group">
                <div class="search-sec">
                    <form class="input-group">
                        <div class="form-outline" data-mdb-input-init>
                            <input id="search-sec" type="text" class="form-control form-control-inp"
                                placeholder="Search">
                            <span class="group-icons search-icon-tag"></span>
                        </div>
                    </form>
                </div>
                <div class="button-1 cta_btn icon-btn">
                    <div class="button-1 cta_btn">
                        <a href="{{route('products.create')}}" class="primary-button add-btn  confirm-leave-link">Add Product</a>
                    </div>
                </div>   
            </div>
        </div>
        <hr class="addsupplier-section-border">
        <div class="upload-file-sec customer-list-sec">
            <div class="product_fields">
                <form class="needs-validation" novalidate>
                    <div class="row form-inp-group">
                        <div class="col-md-4 mb-3">
                            <select name="" id="ProductsNames" class="custom-select d-block w-100 form-select-grp">
                                <option value="">Product</option>
                                @foreach($ProductsName as $name)
                                <option name="pName" id="ProductsNames" value="{{$name->product_name}}">{{$name->product_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <select name="" id="Productstype" class="custom-select d-block w-100 form-select-grp">
                                <option value="">Packing Material</option>
                                @foreach($materials as $name)
                                <option name="pType" value="{{$name->id}}">{{$name->material_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <select name="" id="ProductsGaye" class="custom-select d-block w-100 form-select-grp">
                                <option value="">Gauge</option>
                                @foreach($ProductsGaye as $name)
                                <option name="gaye" value="{{$name->gage}}">{{$name->gage}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="table-responsive table-designs">
            <table class="table active all data">
                <thead>
                    <th><a href="javascript:void(0);" title="ID">ID</a></th>
                    <th><a href="javascript:void(0);" title="Product">Product Name</a></th>
                    <!-- <th><a href="javascript:void(0);" title="Image">Image</a></th> -->
                    <th><a href="javascript:void(0);" title="Name">Group Name</a></th>
                    <th><a href="javascript:void(0);" title="Alias">Alias / SKU</a></th>
                    <th><a href="javascript:void(0);" title="Packing Type">Packing Material</a></th>
                    <th><a href="javascript:void(0);" title="Min Qty">Packing Material QTY</a></th>
                    <th><a href="javascript:void(0);" title="Bharti">Bharti</a></th>
                    <th><a href="javascript:void(0);" title="Bags/Box">Bags/Box</a></th>
                    <th><a href="javascript:void(0);" title="Gauge">Gauge</a></th>
                    <th><a href="javascript:void(0);" title="Actions">Actions</a></th>
                </thead>
                
            </table>
        </div>
    </div>
</div>
            <script type="text/javascript">
                $(document).ready(function () {
                    var productId;
                    var table = $('.data').DataTable({
                        processing: true,
                        serverSide: true,
                        searching: false,
                        // ajax: "{{ route('products.index') }}",
                        ajax: {
                        url: '{{ route("products.index") }}',
                            data: function(d) {
                                d.pname = $('#ProductsNames').val();
                                d.ptype = $('#Productstype').val();
                                d.pgage = $('#ProductsGaye').val();
                                d.MinQty = $('#MinQty').val();
                                d.SearchData = $('#search-sec').val();
                            }
                        },
                        columns: [
                            { data: 'id', name: 'id', orderable: true, searchable: true, visible: false },
                            {data: 'product_name', name: 'product_name' , class: 'left_data tooltip-tabledata' , 
                                render: function (data, type, row) {
                                return '<span title="' + data + '">' + data + '</span>';}
                            },
                            // {data: 'image', name: 'image'},
                            {data: 'group_name', name: 'group_name' , class: 'left_data group_nm'},
                            {data: 'alias_sku', name: 'alias_sku'},
                            {data: 'packing_material_type', name: 'packing_material_type', orderable: false},
                            {data: 'packing_material_qty', name: 'packing_material_qty', orderable: false},
                            {data: 'bharti', name: 'bharti', orderable: false},
                            {data: 'number_of_bags_per_box', name: 'number_of_bags_per_box', orderable: false},
                            {data: 'gage', name: 'gage', orderable: false},
                            {data: 'action', name: 'action', orderable: false, searchable: false},
                        ],
                        order: [[0, 'desc']],
                        // "language": {
                        //     "emptyTable": "No products found."
                        // },
                        // language: {
                        //     info: "Showing _START_ to _END_ of _TOTAL_ Entries".replace(/\b\w/g, c => c.toUpperCase()),
                        //     // You can customize other language options similarly if needed
                        // },
                    });
                    $('.data').on('click', '.delete-product', function() {
                        productId = $(this).data('id');
                        $("#productModal").modal("show");

                    });
                    $('.Cancel-product').click( function(){
                        $("#productModal").modal("hide");
                    });
                    $('.delete-product').click( function(){
                        $.ajax({
                            url: '{{ route('products.destroy', ['product' => ':productId']) }}'.replace(':productId', productId),
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    toastr.success('Item deleted successfully!');
                                    location.reload();
                                    // $("#productModal").modal("hide");
                                    // $('.data').DataTable().ajax.reload();
                                } else {
                                    toastr.error('An error occurred while deleting the item.');
                                    
                                }
                            },
                            error: function(response) {
                                alert('Error deleting product.');
                            }
                        });
                    });
                    $('#ProductsNames').click(function(){
                        var pname = $('#ProductsNames').val();
                        table.search($('#ProductsNames').val()).draw();
                    });
                    $('#Productstype').click(function(){
                        var ptype = $('#Productstype').val();
                        table.search($('#Productstype').val()).draw();
                    });
                    $('#ProductsGaye').click(function(){
                        var pgage = $('#ProductsGaye').val();
                        table.search($('#ProductsGaye').val()).draw();
                    });
                    $('#MinQty').keyup(function(){
                        var MinQty = $('#MinQty').val();
                        // console.log(serch);
                        table.search($('#MinQty').val()).draw();
                    });
                    $('#search-sec').keyup(function(){
                        var searchdata = $('#search-sec').val();
                        // console.log(searchdata);
                        table.search($('#search-sec').val()).draw();
                    });
                });
            </script>
            
@endsection
@section('modul')
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Product ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this Product ?</p>
            </div>
            <div class="modal-footer cstmr-odr-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                        <a href="javascript:void(0)" class="delete-customer delete-product" id="role_id" data-id="">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection