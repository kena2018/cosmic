
@extends('layouts.app')
@section('navbarTitel', 'Supplier List')
@section('content')
<div class="main-outer">
    <div class="outer card">
        <div class="upload-file-sec list-sec">
            <span class="addsupplier-section-heading">List of Suppliers</span>
            <div class="btn-sec btn_group">
                <div class="search-sec">
                    <form class="input-group">
                        <div class="form-outline" data-mdb-input-init>
                            <input id="search-supplier" type="text" class="form-control form-control-inp"
                                placeholder="Search">
                            <span class="search-icons search-icon-tag"></span>
                        </div>
                    </form>
                </div>
                <div class="button-1 cta_btn icon-btn">
                    <a href="{{ route('suppliers.create') }}" class="primary-button confirm-leave-link" disabled>Add Suppliers</a>
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
            <table class="table cstm-table table-bordered supplier-datatable" id="suppliers">
                <thead>
                    <tr>   
                        <th>Id</th>            
                        <th>Company</th>
                        <th>Contact Name</th>
                        <th>City</th>
                        <th>Material Sub Category</th>
                        <th>Phone no.</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function () {
        var supplierId;
        var table = $('.supplier-datatable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                    url: "{{ route('suppliers.index') }}",
                data: function(d) {
                        d.SearchData = $('#search-supplier').val();
              
                },
            },
            columns: [
                { data: 'id', name: 'id', orderable: true, searchable: true, visible: false },
	            {data: 'company_name', name: 'company_name' , class: 'left_data tooltip-tabledata' ,
                    render: function (data, type, row) {
                        return '<span title="' + data + '">' + data + '</span>';}
                },
	            {data: 'name', name: 'name'},
	            {data: 'city', name: 'city'},
	            {data: 'material', name: 'material'},
	            {data: 'contect_cmp', name: 'contect_cmp'},
	            {data: 'action', name: 'action', orderable: false, searchable: false, "width": "10%"},
            ],
            order: [[0, 'desc']],
            // "language": {
            //     "emptyTable": "No permissions found."
            // },
            // language: {
            //     info: "Showing _START_ to _END_ of _TOTAL_ Entries".replace(/\b\w/g, c => c.toUpperCase()),
            //     // You can customize other language options similarly if needed
            // },

        });
        $('.supplier-datatable').on('click', '.delete-supplier', function() {
            supplierId = $(this).data('id');
            $("#supplierModal").modal("show");

        });
        $('.Cancel-supplier').click( function(){
            $("#supplierModal").modal("hide");
        });
        $( '.delete-supplier').click( function(){
            $.ajax({
                    url: '{{ route('suppliers.destroy', ['supplier' => ':supplierId']) }}'.replace(':supplierId', supplierId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Item deleted successfully!');
                            location.reload();
                            // $("#supplierModal").modal("hide");
                            // $('.supplier-datatable').DataTable().ajax.reload();
                        } else {
                            toastr.error('An error occurred while deleting the item.');
                            // alert(response.error);
                        }
                    },
                    error: function(response) {
                        alert('Error deleting Staff Management.');
                    }
                });

        });
        $('#search-supplier').keyup(function(){
            var searchdata = $('#search-supplier').val();
            // console.log(searchdata);
            table.search($('#search-supplier').val()).draw();
        });
    });
    </script>
@endsection
@section('modul')
<div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Supllier ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this Supllier ?</p>
            </div>
            <div class="modal-footer cstmr-odr-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                        <a href="javascript:void(0)" class="delete-customer delete-supplier" id="role_id" data-id="">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection