@extends('layouts.app')
@section('navbarTitel', 'Permission List')
@section('content')
    <div class="main-outer">
        <div class="outer card">
            <div class="upload-file-sec customer-list-sec">
                <span class="addsupplier-section-heading">Permission List</span>
                <div class="btn-sec btn_group">
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
                    <div class="button-1 cta_btn icon-btn">
                        <a href="{{route('permissions.create')}}" class="primary-button  confirm-leave-link ">New Permission</a>
                    </div>
                </div>
            </div>
            <hr class="addsupplier-section-border">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

            <div class="table-responsive table-designs">
                <table class="table active all dataPermission">
                    <thead>
                        <th class="permission-table-contnt"><a class="permission_title" href="javascript:void(0);" title="Permission Id">Id</a></th>
                        <th class="permission-table-contnt"><a class="permission_title" href="javascript:void(0);" title="Permission Name">Permission</a></th>
                        
                        <th class="permission-table-contnt"><a href="javascript:void(0);" title="Actions">Actions</a></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
    $(document).ready(function () {
        var permissionId;
        var table = $('.dataPermission').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                    url: "{{ route('permissions.index') }}",
                data: function(d) {
                        d.SearchData = $('#searchdata').val();
                
                },
            },
            columns: [
                { data: 'id', name: 'id', orderable: true, searchable: true, visible: false },
                { data: 'name', name: 'name', orderable: true, searchable: true },
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
        $('#searchdata').on('input', function() {
            table.ajax.reload(null, false); // Reload the table without resetting pagination
        });
        $('.dataPermission').on('click', '.delete-permission', function() {
            permissionId = $(this).data('id');
            $("#permissionsModal").modal("show");

        });
        $('.Cancel-permission').click( function(){
            $("#permissionsModal").modal("hide");
        });
        $('.delete-permission').click( function(){
            $.ajax({
                    url: '{{ route('permissions.destroy', ['permission' => ':permissionId']) }}'.replace(':permissionId', permissionId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Item deleted successfully!');
                            location.reload();
                            // $("#permissionsModal").modal("hide");
                            // $('.dataPermission').DataTable().ajax.reload();

                        } else {
                            toastr.error('An error occurred while deleting the item.');
                            // alert(response.error);
                        }
                    },
                    error: function(response) {
                        alert('Error deleting permission.');
                    }
                });
            
        });
        
    });
</script>              
@endsection
@section('modul')
<div class="modal fade" id="permissionsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Permission ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this Permission ?</p>
            </div>
            <div class="modal-footer cstmr-odr-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                        <a href="javascript:void(0)" class="delete-customer delete-permission" id="role_id" data-id="">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
