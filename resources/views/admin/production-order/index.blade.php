@extends('layouts.app')
@section('navbarTitel', 'Work Order')
@section('content')

<div class="main-outer">
    <div class="outer card">
        <div class="upload-file-sec customer-list-sec">
            <span class="addsupplier-section-heading">List of Work Orders</span>
            <div class="btn-sec btn_group">
                <div class="search-sec">
                    <form class="input-group">
                        <div class="form-outline" data-mdb-input-init>
                            <input id="searchProduction" type="text" class="form-control form-control-inp"
                                placeholder="Search">
                            <span class="search-icons search-icon-tag"></span>
                        </div>
                    </form>
                </div>
                <div class="button-1 cta_btn icon-btn">
                    <a href="{{ route('production_order.create') }}" class="primary-button  confirm-leave-link">Add Work Order</a>
                </div>
            </div>
        </div>
        <hr class="addsupplier-section-border">
        <div class="table-responsive table-designs">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <table class="table cstm-table table-bordered yajra-datatable data" id="production_orders">
                <thead>
                    <tr>
                        <th><a href="javascript:void(0);" title="">ID</a></th>
                        <th><a href="javascript:void(0);" title="">Date</a></th>
                        <th><a href="javascript:void(0);" title="">Product Type</a></th>
                        <th><a href="javascript:void(0);" title="">Order Type</a></th>
                        <th><a href="javascript:void(0);" title="">Company Name</a></th>
                        <th><a href="javascript:void(0);" title="">Sales Order</a></th>
                        <th><a href="javascript:void(0);" title="">Required Bundle Quantity</a></th>
                        <th><a href="javascript:void(0);" title="">SKU</a></th>
                        <!-- <th><a href="javascript:void(0);" title="">Extrusion Gauge</a></th> -->
                        <!-- <th><a href="javascript:void(0);" title="">Extrusion Colour</a></th> -->
                        <!-- Add more fields as necessary -->
                        <th><a href="javascript:void(0);" title="">Action</a></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script> -->

<script>
$(".openModalBtn").click(function () {
    $("#confirmModal").modal("show");
});

$(document).ready(function(){
    getProductionOrders(); 
})

// function confirmDelete1(id)
// {
//     $('#confirmModal').modal('show');
//     $("#service_type_id").val(id);
// }

// $(".modal-close").click(function () {
//     $("#confirmModal").modal("hide");
// });

function getProductionOrders(){
    jQuery('#production_orders').dataTable().fnDestroy();
    jQuery('#production_orders tbody').empty();
    var table = jQuery('#production_orders').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        ajax: {
            url: '{{ route('production_order.index') }}',
            data: function(d) {
                d.SearchData = $('#searchProduction').val(); // Pass search data to the server
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'created_at', name: 'created_at'},
            {data: 'product_type', name: 'product_type' , class: 'left_data tooltip-tabledata' ,
                render: function (data, type, row) {
                    return '<span title="' + data + '">' + data + '</span>';}
            },
            {data: 'order_type', name: 'order_type'},
            {data: 'company_name', name: 'company_name' , class: 'left_data tooltip-tabledata' ,
                render: function (data, type, row) {
                    return '<span title="' + data + '">' + data + '</span>';}
            },
            {data: 'sales_order', name: 'sales_order'},
            {data: 'bundle_quantity', name: 'bundle_quantity', orderable: false,},
            {data: 'sku', name: 'sku'},
           // {data: 'extrusion_gauge', name: 'extrusion_gauge'},
            // {data: 'extrusion_colour', name: 'extrusion_colour'},
            // Add more fields as necessary
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [[0, 'desc']],
        // language: {
        //         info: "Showing _START_ to _END_ of _TOTAL_ Entries".replace(/\b\w/g, c => c.toUpperCase()),
        //         // You can customize other language options similarly if needed
        //     },
    });
    $('#searchProduction').keyup(function(){
        table.ajax.reload(); // Reload the table data
    });
    $('.data').on('click', '.delete-production', function() {
        productionId = $(this).data('id');
        $("#productionModal").modal("show");

    });
    // $('.Cancel-product').click( function(){
    //     $("#productionModal").modal("hide");
    // });
    $('.delete-production').click( function(){
        $.ajax({
            url: '{{ route('productions.destroy', ['production' => ':productionId']) }}'.replace(':productionId', productionId),
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Item deleted successfully!');
                    location.reload();
                } else {
                    toastr.error('An error occurred while deleting the item.');
                    
                }
            },
            error: function(response) {
                alert('Error deleting Material.');
            }
        });
    });

} 

</script>
@endsection
@section('modul')
    <div class="modal fade" id="productionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Production Order?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this Production Order ?</p>
            </div>
            <div class="modal-footer cstmr-odr-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                        <a href="javascript:void(0)" class="delete-customer delete-production" id="role_id" data-id="">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
