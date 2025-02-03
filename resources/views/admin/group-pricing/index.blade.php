@extends('layouts.app')
@section('navbarTitle', 'Group Pricing')
@section('content')

<div class="main-outer">
    <div class="outer card">
        <form class="form_mn">
            <div class="heading-btn">
                <h6 class="addsupplier-section-heading">Group Pricing</h6>
                <div class="btn-sec btn_group">
                    <div class="button-1 cta_btn">
                        <a href="{{ route('group_pricing.create') }}" class="">New Pricing</a>
                    </div>
                </div>
            </div>
            <div class="file-sec pagination-sec">
                <div class="file-type">
                    <div class="page-select">
                        <select name="page_size" id="page_size" class="page-selects">
                            <option value="10" class="page-select-option">10</option>
                            <option value="25" class="page-select-option">25</option>
                            <option value="50" class="page-select-option">50</option>
                            <option value="100" class="page-select-option">100</option>
                        </select>
                    </div>
                    <div class="btn-sec btn_group">
                        <button class="product-btn" id="export-btn">Export</button>
                        <button class="product-btn" id="bulk-actions-btn">Bulk Actions</button>
                        <button class="product-btn" id="refresh-btn">
                            <span class="refresh-group-icons refresh-icon-tag"></span>
                        </button>
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
                <table class="table active all" id="groupPricingTable">
                    <thead>
                        <tr>
                            <th><a class="table-anc-content" href="javascript:void(0);" title="ID">ID</a></th>
                            <th><a class="table-anc-content" href="javascript:void(0);" title="Name">Name</a></th>
                            <th><a class="table-anc-content" href="javascript:void(0);" title="Products">Products</a></th>
                            <th><a class="table-anc-content" href="javascript:void(0);" title="Start Date">Start Date</a></th>
                            <th><a class="table-anc-content" href="javascript:void(0);" title="Effective Upto">Effective Upto</a></th>
                            <th><a class="table-anc-content" href="javascript:void(0);" title=""></a></th>
                            <th><a class="table-anc-content" href="javascript:void(0);" title="Actions">Actions</a></th> 
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </form>            
    </div>
</div>

<!-- Modal for Edit or Details -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Group Pricing Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form or content for editing/group details goes here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- Save button or other actions -->
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#groupPricingTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('group_pricing.index') }}',
            method: 'GET',
            data: function(d) {
                d.search = $('#searchdata').val();
                d.page_size = $('#page_size').val();
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'group_id', name: 'group_id' },
            { data: 'start_date', name: 'start_date' },
            { data: 'effective_upto', name: 'effective_upto' },
            { data: 'assign_products', name: 'assign_products', orderable: false, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        order: [[0, 'desc']],
    });

    // Search functionality
    $('#searchdata').on('keyup', function() {
        table.draw();
    });

    // Pagination Size Change
    $('#page_size').on('change', function() {
        table.draw();
    });

    // Button Actions
    $('#export-btn').on('click', function() {
        // Export functionality
    });

    $('#bulk-actions-btn').on('click', function() {
        // Bulk actions functionality
    });

    $('#refresh-btn').on('click', function() {
        table.ajax.reload();
    });
});
$(document).ready(function() {
    // Event delegation for delete button
    $(document).on('click', '.delete-customer', function() {
        var groupPricingId = $(this).data('id'); // Get the ID from data-id attribute
        $("#customerModal").modal("show");

        $('#customerModal').find('.delete-customer').off('click').on('click', function(){
            $.ajax({
                url: '{{ route('group_pricing.destroy', ['group_pricing' => ':group_pricingId']) }}'.replace(':group_pricingId', groupPricingId),
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $("#customerModal").modal("hide");
                        $('#groupPricingTable').DataTable().ajax.reload();
                        toastr.success('Gropu Pricing Deleted successfully.');

                    } else {
                        alert(response.error);
                    }
                },
                error: function(response) {
                    alert('Error deleting group pricing.');
                }
            });
        });
    });

    $('.Cancel-customer').click(function(){
        $("#customerModal").modal("hide");
    });
});
</script>

@endsection
@section('modul')
    <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Group Pricing List ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this list ?</p>
            </div>
            <div class="modal-footer cstmr-odr-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                        <a href="javascript:void(0)" class="delete-customer" id="role_id" data-id="">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
