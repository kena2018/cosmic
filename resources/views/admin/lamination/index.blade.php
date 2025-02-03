@extends('layouts.app')
@section('navbarTitel', 'Lamination List')
@section('content')
    <div class="main-outer">
        <div class="outer card">
            <div class="upload-file-sec customer-list-sec">
                <span class="addsupplier-section-heading">Lamination List</span>
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
                        <a href="{{route('laminations.create')}}" class="primary-button confirm-leave-link ">New Lamination</a>
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
                <table class="table active all dataLamination">
                    <thead>
                        <th><a class="lamination_title" href="javascript:void(0);" title="Id">ID</a></th>    
                        <th><a class="lamination_title" href="javascript:void(0);" title="Paper Name">Paper Name</a></th>
                        <th><a class="lamination_title" href="javascript:void(0);" title="Lamination Name">Lamination Name</a></th>
                        <th><a class="lamination_title" href="javascript:void(0);" title="Gum Name">Gum Name</a></th>
                        <th><a class="lamination_title" href="javascript:void(0);" title="Lamination Type">Lamination Type</a></th>
                        <th><a href="javascript:void(0);" title="Actions">Actions</a></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
        var transportId;
        var table = $('.dataLamination').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                    url: "{{ route('laminations.index') }}",
                data: function(d) {
                    d.SearchData = $('#searchdata').val();
                
                },
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'paper_name', name: 'paper_name' , class: 'left_data tooltip-tabledata' ,
                    render: function (data, type, row) {
                        return '<span title="' + data + '">' + data + '</span>';}
                },
                {data: 'lamination_name', name: 'lamination_name' , class: 'left_data tooltip-tabledata' , 
                    render: function (data, type, row) {
                        return '<span title="' + data + '">' + data + '</span>';}
                },
                {data: 'gum_name', name: 'gum_name' , class: 'left_data tooltip-tabledata', 
                    render: function (data, type, row) {
                        return '<span title="' + data + '">' + data + '</span>';}
                },
                {data: 'lamination_type', name: 'lamination_type'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'desc']],
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
        $('.dataLamination').on('click', '.delete-transport', function() {
            laminationId = $(this).data('id');
            $("#laminationModal").modal("show");

        });
        $('.Cancel-lamination').click( function(){
            $("#laminationModal").modal("hide");
        });
        $('.delete-lamination').click( function(){
            $.ajax({
                    url: '{{ route('laminations.destroy', ['lamination' => ':laminationId']) }}'.replace(':laminationId', laminationId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Item deleted successfully!');
                            location.reload();
                            // $("#laminationModal").modal("hide");
                            // $('.dataLamination').DataTable().ajax.reload();
                        } else {
                            toastr.error('An error occurred while deleting the item.');
                            // alert(response.error);
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
<div class="modal fade" id="laminationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Lamination ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this lamination ?</p>
            </div>
            <div class="modal-footer cstmr-odr-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                        <a href="javascript:void(0)" class="delete-customer delete-lamination" id="role_id" data-id="">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
