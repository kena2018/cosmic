@extends('layouts.app')
@section('navbarTitel', 'Make Order')

@section('content')
    <div class="main-outer">
        <div class="outer card">
            <div class="upload-file-sec customer-list-sec">
                <span class="addsupplier-section-heading">Manufacturing order</span>
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
                        <a href="{{route('make_order.create')}}" class="primary-button ">Add Order</a>
                    </div>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            
            <div class="table-responsive table-designs">
                <table class="table active all make_data">
                    <thead>
                        <th><a href="javascript:void(0);" title="">Product Name</a></th>
                        <th><a href="javascript:void(0);" title="">SKU</a></th>
                        <th><a href="javascript:void(0);" title="">Colour</a></th>
                        <th><a href="javascript:void(0);" title="">Pcking</a></th>
                        <th><a href="javascript:void(0);" title="">QTY in Bundle</a></th>
                        <th><a href="javascript:void(0);" title="">Bharti</a></th>
                        <th><a href="javascript:void(0);" title="">Bag/Box</a></th>
                        <th><a href="javascript:void(0);" title="">Status</a></th>
                        
                        <th><a href="javascript:void(0);" title="">Actions</a></th>
                    </thead>
                </table>
            </div>
        </div>
        

    </div>

    <script type="text/javascript">

    $(document).ready(function () {
        var makeOrderId;
        var table = $('.make_data').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                    url: "{{ route('make_order.index') }}",
            },
            columns: [
                {data: 'product_id', name: 'product_id'},
                {data: 'sku', name: 'sku'},
                {data: 'colour', name: 'colour'},
                {data: 'packing', name: 'packing'},
                {data: 'qty_in_bundle', name: 'qty_in_bundle'},
                {data: 'bharti', name: 'bharti'},
                {data: 'bag_box', name: 'bag_box'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            // "language": {
            //     "emptyTable": "No Order found."
            // },
            // language: {
            //     info: "Showing _START_ to _END_ of _TOTAL_ Entries".replace(/\b\w/g, c => c.toUpperCase()),
            //     // You can customize other language options similarly if needed
            // },
        });
        $('.make_data').on('click', '.delete-makeOrder', function() {
            makeOrderId = $(this).data('id');
            // console.log(makeOrderId);
            $("#makeOrderModal").modal("show");

        });
        $('.Cancel-makeOrder').click( function(){
            $("#makeOrderModal").modal("hide");
        });
        $('.delete-makeOrder').click( function(){
            $.ajax({
                url: '{{ route('make_order.destroy', ['make_order' => ':makeOrderId']) }}'.replace(':makeOrderId', makeOrderId),
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $("#makeOrderModal").modal("hide");
                        // alert('Customer deleted successfully.');
                        $('.make_data').DataTable().ajax.reload();
                    } else {
                        alert(response.error);
                    }
                },
                error: function(response) {
                    alert('Error deleting customer.');
                }
            });
        }); 
        
    });
</script>              

@endsection
@section('modul')
<div class="modal fade" id="makeOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Customer List ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this list ?</p>
            </div>
            <div class="modal-footer cstmr-odr-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                        <a href="javascript:void(0)" class="delete-customer delete-makeOrder" id="role_id" data-id="">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection