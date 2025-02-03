@extends('layouts.app')
@section('navbarTitel', 'Staff Management List')

@section('content')
    <div class="main-outer">
        <div class="outer card">
            <div class="upload-file-sec customer-list-sec">
                <span class="addsupplier-section-heading">Staff Management List</span>
                <div class="btn-sec btn_group">
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
                    <div class="button-1 cta_btn">
                        <a href="{{ route('staff-management.create')}}" class="primary-button confirm-leave-link">Add Staff User</a>
                    </div>
                </div>
            </div>
            <hr class="addsupplier-section-border">
            <!-- <div class="file-sec">
                <div class="file-type">
                    <div class="btn-sec btn_group" style="display: none;">
                        <button class="product-btn">Export</button>
                        <button class="product-btn">Bulk Actions</button>
                        <button class="product-btn"><span class="refresh-group-icons refresh-icon-tag"></span></button>
                    </div>
                </div>
            </div> -->
            <div class="table-responsive table-designs">
                <table class="table active all Staffdata">
                    <thead>
                        <th><a href="javascript:void(0);" title="ID">ID</a></th>
                        <th><a href="javascript:void(0);" title="Name">Name</a></th>
                        <th><a class="permission_title" href="javascript:void(0);" title="78987978">Phone no.</a></th>
                        <th><a href="javascript:void(0);" title="Email">Email</a></th>
                        <th><a href="javascript:void(0);" title="Role">Role</a></th>
                        <th><a href="javascript:void(0);" title="Actions">Actions</a></th>
                    </thead>
                </table>
            </div>
        </div>


    </div>
    <script type="text/javascript">
    $(document).ready(function () {
        var staffId;
        var table = $('.Staffdata').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                    url: "{{ route('staff-management.index') }}",
                data: function(d) {
                        d.SearchData = $('#search-sec').val();
              
                },
            },
            columns: [
                { data: 'id', name: 'id', orderable: true, searchable: true, visible: false },
                {data: 'name', name: 'name' , class: 'left_data'},
                {data: 'contect', name: 'contect', orderable: false},
                {data: 'email', name: 'email' , class: 'left_data'},
                {data: 'roles', name: 'roles', orderable: false, searchable: false },
                {data: 'action', name: 'action', orderable: false, searchable: false},
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
        $('.Staffdata').on('click', '.delete-staffs', function() {
            staffId = $(this).data('id');
            $("#staffModal").modal("show");

        });
        $('.Cancel-staff').click( function(){
            $("#staffModal").modal("hide");
        });
        $( '.delete-staff').click( function(){
            $.ajax({
                    url: '{{ route('staff-management.destroy', ['staff_management' => ':staffId']) }}'.replace(':staffId', staffId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Item deleted successfully!');
                            location.reload();
                            // $("#staffModal").modal("hide");
                            // $('.Staffdata').DataTable().ajax.reload();
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
        $('#search-sec').keyup(function(){
            var searchdata = $('#search-sec').val();
            // console.log(searchdata);
            table.search($('#search-sec').val()).draw();
        });
    });
</script>              
@endsection
@section('modul')
<div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Staff Management ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this Staff Management ?</p>
            </div>
            <div class="modal-footer cstmr-odr-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                        <a href="javascript:void(0)" class="delete-customer delete-staff" id="role_id" data-id="">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection