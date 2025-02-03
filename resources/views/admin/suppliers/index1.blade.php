
@extends('layouts.app')
@section('navbarTitel', 'Supplier List')
@section('content')
<div class="main-outer">
    <div class="outer card">
        <div class="upload-file-sec list-sec">
            <span class="addsupplier-section-heading">List of Suppliers</span>
            <div class="btn-sec btn_group">
                <div class="button-1 cta_btn icon-btn">
                    <a href="{{ route('suppliers.add') }}" class="primary-button " disabled>Add Suppliers</a>
                </div>
            </div>
        </div>
        <div class="file-sec">
                <div class="file-type">
                    <div class="btn-sec btn_group" style="display: none;">
                        <button class="product-btn">Export</button>
                        <button class="product-btn">Bulk Actions</button>
                        <button class="product-btn"><span class="refresh-group-icons refresh-icon-tag"></span></button>
                    </div>
                </div>
                <div class="search-sec">
                    <form class="input-group">
                        <div class="form-outline" data-mdb-input-init>
                            <input id="search-sec" type="text" class="form-control form-control-inp"
                                placeholder="Search">
                            <span class="search-icons search-icon-tag"></span>
                            <!-- <button class="form-inp-btn" type="submit">
                                <span class="fa fa-search form-control-feedback"></span>
                            </button> -->
                        </div>
                    </form>
                </div>
            </div>
        <div class="table-responsive table-designs">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <table class="table cstm-table table-bordered yajra-datatable" id="suppliers">
                <thead>
                    <tr>                                           
                        <th>Supplier ID</th>
                        <th>Company</th>
                        <th>Contact Name</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Contact Number</th>
                        <th>Added on</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
<!--  END CONTENT AREA  -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation?</h5>
                    <button class="close modal-close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to delete it.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary close modal-close" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('suppliers.destroy') }}"  onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Delete</a>
                    <form id="delete-form" action="{{ route('suppliers.destroy') }}" method="post" class="d-none">
                        @csrf
                        <input type="hidden" id="service_type_id" name="id" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>

<script>
$(".openModalBtn").click(function () {
    $("#confirmModal").modal("show");
});
$(document).ready(function(){
    getClients(); 
})
function confirmDelete1(id)
{
    
    $('#confirmModal').modal('show');
    $("#service_type_id").val(id);
}
$(".modal-close").click(function () {
    $("#confirmModal").modal("hide");
});
function getClients(){
    jQuery('#suppliers').dataTable().fnDestroy();
    jQuery('#suppliers tbody').empty();
    jQuery('#suppliers').DataTable({
      oLanguage: { "sSearch": '<a class="btn searchBtn" id="searchBtn"><i class="fa fa-search"></i></a>' },
        processing: false,
        serverSide: true,
        ajax: {
            url: '{{ route('suppliers.get') }}',
            method: 'POST',
            data:{
                  "_token": "{{ csrf_token() }}"
            },

        },
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50,100,"All"]
        ],
        columns: [
            {data: 'supplier_id', name: 'supplier_id', orderable: false, "width": "12%"},
            {data: 'company_name', name: 'company_name', orderable: false, "width": "12%"},
            {data: 'contect_name', name: 'contect_name', orderable: false, "width": "12%"},
            {data: 'city', name: 'city', orderable: false, "width": "12%"},
            {data: 'state', name: 'state', orderable: false, "width": "12%"},
            {data: 'contect_number', name: 'contect_number', orderable: false, "width": "12%"},
            {data: 'added_on', name: 'added_on', orderable: false, "width": "12%"},
            {data: 'action', name: 'action', orderable: false, searchable: false, "width": "10%"},
        ],
        order: false,
    });
} 

</script>


@endsection