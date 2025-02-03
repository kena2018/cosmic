@extends('layouts.app')
@section('navbarTitel', 'Materials')
@section('content')
<div class="main-outer">
    <div class="outer card">
        <div class="heading-btn heading-print-btn">
            <h6 class="addsupplier-section-heading">List of Materials</h6>
            <div class="btn-sec btn_group">
                <div class="btn-sec btn_group">
                    <a href="javascript:void(0)">
                        <span class="print-icon print-icon-tag"></span>
                    </a>
                </div>
                <div class="search-sec">
                    <form class="input-group">
                        <div class="form-outline" data-mdb-input-init>
                            <input id="searchdata" type="text" class="form-control form-control-inp"
                                placeholder="Search">
                            <span class="search-icons search-icon-tag"></span>
                            <!-- <button class="form-inp-btn" type="submit">
                                <span class="fa fa-search form-control-feedback"></span>
                            </button> -->
                        </div>
                    </form>
                </div>
                <div class="button-1 cta_btn">
                    <a href="{{ route('material.create') }}" class=" confirm-leave-link">Add Material</a>
                </div>
            </div>
        </div>
        <hr class="addsupplier-section-border">
        <div class="table-responsive table-designs">
            <table class="table cstm-table table-bordered yajra-datatable data" id="materials">
                <thead>
                    <tr>
                        <th><a href="javascript:void(0);" title="Id">ID</a></th>
                        <th><a href="javascript:void(0);" title="Material Name">Material Name</a></th>
                        <th><a href="javascript:void(0);" title="Category Name">Category Name</a></th>
                        <th><a href="javascript:void(0);" title="Category Name">Sub Category Name</a></th>
                        <th><a href="javascript:void(0);" title="Unit 1">Unit 1</a></th>
                        <th><a href="javascript:void(0);" title="Unit 1">Unit 2</a></th>
                        <th><a href="javascript:void(0);" title="Remark">Remark</a></th>
                        <th><a href="javascript:void(0);" title="Action">Action</a></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(function () {
    
    var table = $('#materials').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
                    url: "{{ route('material.index') }}",
                data: function(d) {
                    d.SearchData = $('#searchdata').val();
                
                },
            },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'material_name', name: 'material_name' , class: 'left_data tooltip-tabledata' ,
                render: function (data, type, row) {
                    return '<span title="' + data + '">' + data + '</span>';}
            },
            {data: 'category_id', name: 'category_id' , class: 'left_data tooltip-tabledata' ,
                render: function (data, type, row) {
                    return '<span title="' + data + '">' + data + '</span>';}
            },
            {data: 'sub_category', name: 'sub_category'},
            {data: 'quantity', name: 'quantity'},
            {data: 'unit', name: 'unit'},
            {data: 'remark', name: 'remark'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [[0, 'desc']],
        // language: {
        //         info: "Showing _START_ to _END_ of _TOTAL_ Entries".replace(/\b\w/g, c => c.toUpperCase()),
        //         // You can customize other language options similarly if needed
        //     },
    });
    $('#searchdata').on('input', function() {
        table.ajax.reload(null, false); // Reload the table without resetting pagination
    });
    $('.data').on('click', '.delete-material', function() {
        MaterialId = $(this).data('id');
        $("#materiyalModal").modal("show");

    });
    $('.delete-material').click( function(){
        $.ajax({
            url: '{{ route('material.destroy', ['material' => ':MaterialId']) }}'.replace(':MaterialId', MaterialId),
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
                alert('Error deleting Material.');
            }
        });
    });
    
  });
  
</script>
@endsection
@section('modul')
    <div class="modal fade" id="materiyalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Materials ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this Materials ?</p>
            </div>
            <div class="modal-footer cstmr-odr-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                        <a href="javascript:void(0)" class="delete-customer delete-material" id="role_id" data-id="">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection