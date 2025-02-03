@extends('layouts.app')
@section('navbarTitel', 'Role List')

@section('content')
    <div class="main-outer">
        <div class="outer card">
            <div class="upload-file-sec customer-list-sec">
                <span class="addsupplier-section-heading">Role List</span>
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
                        <a href="{{route('roles.create')}}" class="primary-button confirm-leave-link ">New Role</a>
                    </div>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <hr class="addsupplier-section-border">
            <div class="table-responsive table-designs">
                <table class="table active all data">
                    <thead>
                        <th class="permission-table-contnt"><a href="javascript:void(0);" title="">ID</a></th>
                        <th class="permission-table-contnt"><a href="javascript:void(0);" title="">Role Name</a></th>
                        <th class="permission-table-contnt"><a href="javascript:void(0);" title="">Actions</a></th>
                    </thead>
                </table>
            </div>
        </div>
        

    </div>

    <script type="text/javascript">

    $(document).ready(function () {
        var roleId;
        var table = $('.data').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                    url: "{{ route('roles.index') }}",
                data: function(d) {
                        d.SearchData = $('#searchdata').val();
              
                },
            },
            columns: [
                { data: 'id', name: 'id', orderable: true, searchable: true, visible: false },
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'desc']],
            // "language": {
            //     "emptyTable": "No roles found."
            // },
            // language: {
            //     info: "Showing _START_ to _END_ of _TOTAL_ Entries".replace(/\b\w/g, c => c.toUpperCase()),
            //     // You can customize other language options similarly if needed
            // },
        });
        $('#searchdata').on('input', function() {
                table.ajax.reload(null, false); // Reload the table without resetting pagination
            });
        $('.data').on('click', '.delete-role', function() {
            roleId = $(this).data('id');
            $("#rolesModal").modal("show");

        });
        $('.Cancel-role').click( function(){
            $("#rolesModal").modal("hide");
        });
        $('.delete-role').click( function(){
            $.ajax({
                    url: '{{ route('roles.destroy', ['role' => ':roleId']) }}'.replace(':roleId', roleId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // $("#rolesModal").modal("hide");
                            toastr.success('Item deleted successfully!');
                            location.reload();
                        } else {
                            toastr.error('An error occurred while deleting the item.');
                            // alert(response.error);
                        }
                    },
                    error: function(response) {
                        alert('Error deleting role.');
                    }
                });
        });
        
    });
</script>              
@endsection
@section('modul')
<div class="modal fade" id="rolesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Role ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this Role ?</p>
            </div>
            <div class="modal-footer cstmr-odr-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                        <a href="javascript:void(0)" class="delete-customer delete-role" id="role_id" data-id="">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection