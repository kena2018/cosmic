@extends('layouts.app')
@section('navbarTitel', 'Orders')
@section('content')
    <div class="main-outer">
        <div class="row customer-section-listss">
            <div class="col-md-4 col-lg-4 col-xl-3 card-w-data">
                <div class="card-sm-1">
                    <div class="cstmr-ordr-content">
                        <span class="table-group-icons share-icon-tag"></span>
                        <label class="card-title">Total Orders</label>
                        <span class="card-data">{{$totalOrders}}</span>
                    </div>
                    <div class="progress">
                        <?php $progressPercentage = $totalOrders ? ($totalOrders / $totalOrders) * 100 : 0;?>
                        <!-- <div class="progress-bar w-75 progress-totalorder" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> -->
                        <!-- </div>  -->
                        <div class="progress-bar progress-total-bar" role="progressbar" style="width: {{$progressPercentage}}%;" aria-valuenow="{{$progressPercentage}}" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-3 card-w-data">
                <div class="card-sm-1">
                    <div class="cstmr-ordr-content">
                        <span class="table-group-icons share-icon-tag"></span>
                        <label class="card-title">Active Orders</label>
                        <span class="card-data">{{$customerOrder}}/{{$totalOrders}}</span>
                    </div>
                    <div class="progress">
                    <?php $progressPercentage = ($totalOrders > 0) ? ($customerOrder / $totalOrders) * 100 : 0; ?>
                        <div class="progress-bar progress-active-bar" role="progressbar" style="width: {{$progressPercentage}}%;"  aria-valuenow="{{$progressPercentage}}" aria-valuemin="0" aria-valuemax="100">
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-3 card-w-data">
                <div class="card-sm-1">
                    <div class="cstmr-ordr-content">
                        <span class="table-group-icons share-icon-tag"></span>
                        <label class="card-title">Total Dispatched</label>
                        <span class="card-data">{{$dispatchedOrder}}/{{$totalOrders}}</span>
                    </div>
                    <div class="progress">
                    
                        <?php $progressPercentage = ($totalOrders > 0) ? ($dispatchedOrder / $totalOrders) * 100 : 0; ?>
                        <div class="progress-bar progress-dispatch-bar" role="progressbar" style="width: {{$progressPercentage}}%;" aria-valuenow="{{$progressPercentage}}" aria-valuemin="0" aria-valuemax="100">
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-3 card-w-data">
                <div class="card-sm-1">
                    <div class="cstmr-ordr-content">
                        <span class="table-group-icons share-icon-tag"></span>
                        <label class="card-title">Partially Dispatched</label>
                        <span class="card-data">{{$pertiallydispatchedOrder}}/{{$totalOrders}}</span>
                    </div>
                    <div class="progress">
                    
                        <?php $progressPercentage = ($totalOrders > 0) ? ($pertiallydispatchedOrder / $totalOrders) * 100 : 0; ?>
                        <div class="progress-bar progress-partially-bar" role="progressbar" style="width: {{$progressPercentage}}%;" aria-valuenow="{{$progressPercentage}}" aria-valuemin="0" aria-valuemax="100">
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-3 card-w-data">
                <div class="card-sm-1">
                    <div class="cstmr-ordr-content">
                        <span class="table-group-icons share-icon-tag"></span>
                        <label class="card-title">Delivered</label>
                        <span class="card-data">{{$deliverddispatchedOrder}}/{{$totalOrders}}</span>
                    </div>
                    <div class="progress">
                        <?php $progressPercentage = ($totalOrders > 0) ? ($deliverddispatchedOrder / $totalOrders) * 100 : 0; ?>
                        <div class="progress-bar progress-delivered-bar" role="progressbar" style="width: {{$progressPercentage}}%;" aria-valuenow="{{$progressPercentage}}" aria-valuemin="0" aria-valuemax="100">
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="outer card">
            <div class="upload-file-sec customer-list-sec">
                <span class="addsupplier-section-heading">Order list</span>
                <div class="btn-sec btn_group">
                    <div class="search-sec">
                        <form class="input-group">
                            <div class="form-outline" data-mdb-input-init>
                                <input type="text" name="searchdata" class="form-control form-control-inp" id="searchdata" placeholder="Search">
                                <span class="search-icons search-icon-tag"></span>
                            </div>
                        </form>
                        <!-- <form class="input-group">
                            <div class="form-outline" data-mdb-input-init>
                                <input type="text" name="searchdata" class="form-control form-control-inp" id="searchdata" placeholder="Search">
                                <span class="search-icons search-icon-tag"></span>
                            </div>
                        </form> -->
                    </div>
                    <div class="button-1 cta_btn icon-btn">
                        <a href="{{route('customerOrder.create')}}" class="primary-button confirm-leave-link">Add Order</a>
                    </div>
                </div>
            </div>
            <hr class="addsupplier-section-border">
            <div class="table-responsive table-designs">
                <table class="table active all orderData">
                    <thead>
                        <!-- <th><a href="javascript:void(0);" title="ID" class="hidden">ID</a></th> -->
                        <!-- <th><a href="javascript:void(0);" title="Order">Order</a></th> -->
                        <th><a href="javascript:void(0);" title="Order">Order</a></th>
                        <th><a href="javascript:void(0);" title="Order Date">Order Date</a></th>
                        <th><a href="javascript:void(0);" title="Company Name">Company Name</a></th>
                        <th><a href="javascript:void(0);" title="Company Name">Customer Name</a></th>
                        <th><a href="javascript:void(0);" title="City">City</a></th>
                        <th><a href="javascript:void(0);" title="State">State</a></th>
                        <th><a href="javascript:void(0);" title="Amount">Amount</a></th>
                        <th><a href="javascript:void(0);" title="Total Bundle">Total Bundle</a></th>
                        <th><a href="javascript:void(0);" title="Total Number">Total added products</a></th>
                        <th><a href="javascript:void(0);" title="Action">Action</a></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @endsection
    @section('js')
    <script type="text/javascript">
    // document.getElementById("printButton").addEventListener("click", function() {
    //     console.log('dasd');
    //     // window.print(); // Print preview ka page open hoga
    // });
    $(document).ready(function () {
        var customerOrderId;
        var table = $('.orderData').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            pageLength: 100,
            ajax: {
                url: "{{ route('customerOrder.index') }}",
                data: function(d) {
                    d.SearchData = $('#searchdata').val();
                },
            },
            columns: [
                // {data: 'id', name: 'id'},
                // {data: 'order_id', name: 'order_id', searchable: false},
                {data: 'serial_number', name: 'serial_number', searchable: false},
                {data: 'order_date', name: 'order_date', searchable: false},
                {data: 'company_name', name: 'company_name', orderable: true, searchable: false , class: 'left_data tooltip-tabledata' ,
                    render: function (data, type, row) {
                        return '<span title="' + data + '">' + data + '</span>';}
                },
                {data: 'full_name', name: 'full_name', orderable: true, searchable: false , class: 'left_data'},
                {data: 'city', name: 'city', orderable: true, searchable: false},
                {data: 'state', name: 'state', orderable: true, searchable: false},
                {data: 'amount', name: 'amount', orderable: true, searchable: false},
                
                {data: 'total_bundle', name: 'total_bundle', orderable: true, searchable: false},
                 {data: 'total_number', name: 'total_number', orderable: true, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [1, 'desc'],
            
            // language: {
            //     info: "Showing _START_ to _END_ of _TOTAL_ Entries".replace(/\b\w/g, c => c.toUpperCase()),
            //     // You can customize other language options similarly if needed
            // },
        });
        $('.orderData').on('click', '.delete-customerOrder', function() {
            // window.print();
            customerOrderId = $(this).data('id');
            $("#customerOrderModal").modal("show");

        });
        $('.orderData').on('click', '.print-customerOrder', function() {
            // window.print();
            console.log('sf');
            // customerOrderId = $(this).data('id');
            // $("#customerOrderModal").modal("show");

        });
        $('.Cancel-customerOrder').click( function(){
            $("#customerOrderModal").modal("hide");
        });
        $('.delete-customerOrder').click( function(){
            $.ajax({
                url: '{{ route('customerOrder.destroy', ['customerOrder' => ':customerOrderId']) }}'.replace(':customerOrderId', customerOrderId),
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success('Item deleted successfully!');
                        location.reload();
                    } else {
                        toastr.error('An error occurred while deleting the item.');
                        // alert(response.error);
                    }
                },
                error: function(response) {
                    alert('Error deleting customer.');
                }
            });
        }); 
       
        $('#searchdata').keyup(function(){
            var searchdata = $('#searchdata').val();
            table.search($('#searchdata').val()).draw();
        });
    });
</script>           

@endsection
@section('modul')
<div class="modal fade" id="customerOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Customer Order?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this order ?</p>
            </div>
            <div class="modal-footer cstmr-odr-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                        <a href="javascript:void(0)" class="delete-customer delete-customerOrder" id="role_id" data-id="">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection