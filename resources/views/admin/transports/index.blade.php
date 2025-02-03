@extends('layouts.app')
@section('navbarTitel', 'Transport List')
@section('content')
    <div class="main-outer">
        <div class="outer card">
            <div class="upload-file-sec customer-list-sec">
                <span class="addsupplier-section-heading">Transport List</span>
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
                        <a href="{{route('transport.create')}}" class="primary-button confirm-leave-link">New Transport</a>
                    </div>
                </div>
            </div>
            <hr class="addsupplier-section-border">
            <!-- <div class="filee-sec pagination-sec">
                
            </div> -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

            <div class="table-responsive table-designs">
                <table class="table active all dataTransport">
                    <thead>
                        <th><a class="permission_title" href="javascript:void(0);" title="Name">Name</a></th>
                        <th><a class="permission_title" href="javascript:void(0);" title="Phone">Phone</a></th>
                        <th><a class="permission_title" href="javascript:void(0);" title="Location">Location</a></th>
                        <th><a class="permission_title" href="javascript:void(0);" title="Pin">Pin</a></th>
                        
                        <th><a href="javascript:void(0);" title="Actions">Actions</a></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
        var transportId;
        var table = $('.dataTransport').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                    url: "{{ route('transport.index') }}",
                    data: function(d) {
                        d.SearchData = $('#searchdata').val();
                    
                    },
            },
            columns: [
                {data: 'name', name: 'name' , class: 'left_data tooltip-tabledata' ,
                    render: function (data, type, row) {
                        return '<span title="' + data + '">' + data + '</span>';}
                },
                {data: 'phone', name: 'phone'},
                {data: 'location', name: 'location'},
                {data: 'pin', name: 'pin'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            // "language": {
            //     "emptyTable": "No Trans Port found."
            // },
           // language: {
            //     info: "Showing _START_ to _END_ of _TOTAL_ Entries".replace(/\b\w/g, c => c.toUpperCase()),
            //     // You can customize other language options similarly if needed
            // },
        });
        $('#searchdata').on('input', function() {
            table.ajax.reload(null, false); // Reload the table without resetting pagination
        });
        $('.dataTransport').on('click', '.delete-transport', function() {
            transportId = $(this).data('id');
            $("#transportModal").modal("show");

        });
        $('.Cancel-transport').click( function(){
            $("#transportModal").modal("hide");
        });
        $('.delete-transport').click( function(){
            $.ajax({
                    url: '{{ route('transport.destroy', ['transport' => ':transportId']) }}'.replace(':transportId', transportId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    
                    success: function(response) {
                        if (response.success) {
                            $("#transportModal").modal("hide");
                            $('.dataTransport').DataTable().ajax.reload();
                        } else {
                            alert(response.error);
                        }
                    },
                    error: function(response) {
                        alert('Error deleting transport.');
                    }
                });
            
        });
        
    });
</script>              
@endsection
@section('modul')
<div class="modal fade" id="transportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Transport ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this Transport ?</p>
            </div>
            <div class="modal-footer cstmr-odr-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                        <a href="javascript:void(0)" class="delete-customer delete-transport" id="role_id" data-id="">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
