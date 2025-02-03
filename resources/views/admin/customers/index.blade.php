@extends('layouts.app')
@section('navbarTitel', 'Customers Summary')
@section('content')
    <div class="main-outer">
        <div class="row customer-section-list">
            <div class="col-sm-4">
                <div class="card-1">
                    <div class="card-content">
                        <span class="card-content-span card_yellow">{{$totalRecords}}</span>
                        <h6>Total Customers</h6>
                    </div>
                    <!-- <div class="card-image">
                        <img src="{{ asset('public/assets/img/vector7.svg')}}" class="card-vector-1" alt="card-vector-1">
                    </div> -->
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-2">
                    <div class="card-content">
                        <span class="card-content-span card_green">{{$activeCustomers}}</span>
                        <h6>Active Customers</h6>
                    </div>
                    <!-- <div class="card-image">
                        <img src="{{ asset('public/assets/img/vector8.svg')}}" class="card-vector-2" alt="card-vector-2">
                    </div> -->
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card-3">
                    <div class="card-content">
                        <span class="card-content-span card_red">{{$inactiveCustomers}}</span>
                        <h6>Inactive Customers</h6>
                    </div>
                    <!-- <div class="card-image">
                        <img src="{{ asset('public/assets/img/vector9.svg')}}" class="card-vector-3" alt="card-vector-3">
                    </div> -->
                </div>
            </div>
        </div>
        <div class="outer card">
            <div class="upload-file-sec customer-list-sec">
                <span class="addsupplier-section-heading">Customer List</span>
                <div class="btn-sec btn_group">
                    <div class="search-sec">
                        <form class="input-group">
                            <div class="form-outline" data-mdb-input-init>
                                <input type="text" name="searchdata" class="form-control form-control-inp" id="searchdata" placeholder="Search">
                                <span class="search-icons search-icon-tag"></span>
                            </div>
                        </form>
                    </div>
                    <div class="button-1 cta_btn icon-btn">
                        <a href="{{route('customers.create')}}" class="primary-button confirm-leave-link ">New Customer</a>
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
                <table class="table active all data">
                    <thead>
                        <th><a href="javascript:void(0);" title="Company ID">Company ID</a></th>
                        <th><a href="javascript:void(0);" title="Company Name">Company Name</a></th>
                        <th><a href="javascript:void(0);" title="Contact Name">Contact Name</a></th>
                        <th><a href="javascript:void(0);" title="Phone no.">Phone no.</a></th>
                        <th><a href="javascript:void(0);" title="City">City</a></th>
                        <th><a href="javascript:void(0);" title="Group">Group</a></th>
                        <th><a href="javascript:void(0);" title="Last order">Last order</a></th>
                        <th><a href="javascript:void(0);" title="Perf. Matrix">Perf. Matrix</a></th>
                        <th><a href="javascript:void(0);" title="Status">Status</a></th>
                        <th><a href="javascript:void(0);" title="Actions">Actions</a></th>
                    </thead>
                </table>
            </div>
        </div>


    </div>

   
    <script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '.toggle-status', function() {
        var customerId = $(this).data('id');
        var status = $(this).is(':checked') ? 'active' : 'inactive';

        $.ajax({
            url: '{{ route('customers.updateStatus') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: customerId,
                status: status
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Customer status updated successfully.');
                } else {
                    toastr.error(response.error);
                }
            },
            error: function(response) {
                toastr.error('Error updating customer status.');
            }
        });
    });
        var customerId;
        var table = $('.data').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                    url: "{{ route('customers.index') }}",
                data: function(d) {
                        d.SearchData = $('#searchdata').val();
              
                },
            },
            columns: [
                { data: 'id', name: 'id', orderable: true, searchable: true, visible: false },
                {data: 'company_name', name: 'company_name' , class: 'left_data tooltip-tabledata' ,
                    render: function (data, type, row) {
                                return '<span title="' + data + '">' + data + '</span>';}
                },
                {data: 'full_name', name: 'full_name' , class: 'left_data'},
                {data: 'contect', name: 'contect'},
                { data: 'city_name', name: 'city_name'},
                {data: 'group', name: 'group'},
                {data: 'last_order', name: 'last_order',orderable: true, searchable: false},
                {data: 'matrix', name: 'matrix',orderable: true},
                {data: 'status', name: 'status',orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'desc']],
            // "language": {
            //     "emptyTable": "No customers found."
            // },
            // language: {
            //     info: "Showing _START_ to _END_ of _TOTAL_ Entries".replace(/\b\w/g, c => c.toUpperCase()),
            //     // You can customize other language options similarly if needed
            // },
            // language: {
            //     info: function() {
            //         // Original string
            //         var originalString = "Showing _START_ to _END_ of _TOTAL_ Entries";
                    
            //         // Custom function to capitalize words except "to" and "of"
            //         return originalString.replace(/\b\w+\b/g, function(word) {
            //             if (word.toLowerCase() === 'to' || word.toLowerCase() === 'of') {
            //                 return word.toLowerCase();
            //             }
            //             return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
            //         });
            //     }()
            // },
        });
        // $('.data').on('click', '.delete-customer', function() {
        //     customerId = $(this).data('id');
        //     $("#customerModal").modal("show");

        // });
        // $('.Cancel-customer').click( function(){
        //     $("#customerModal").modal("hide");
        // });
        // $('.delete-customer').click( function(){
        //     $.ajax({
        //         url: '{{ route('customers.destroy', ['customer' => ':customerId']) }}'.replace(':customerId', customerId),
        //         type: 'DELETE',
        //         data: {
        //             _token: '{{ csrf_token() }}'
        //         },
        //         success: function(response) {
        //             if (response.success) {
        //                 toastr.success('Item deleted successfully!');
        //                 location.reload();
        //                 // $("#customerModal").modal("hide");
        //                 // alert('Customer deleted successfully.');
        //                 // $('.data').DataTable().ajax.reload();
        //             } else {
        //                 toastr.error('An error occurred while deleting the item.');
        //                 // alert(response.error);
        //             }
        //         },
        //         error: function(response) {
        //             alert('Error deleting customer.');
        //         }
        //     });
        // }); 

        // Show the modal when the delete button is clicked
// Show the modal when the delete button is clicked
$('.data').on('click', '.delete-customer', function() {
    customerId = $(this).data('id');
    $("#customerModal").modal("show");
});

// Hide the modal when the Cancel button is clicked
$('.Cancel-customer').click(function() {
    $("#customerModal").modal("hide");
});

// Handle the delete operation
$('.delete-customer').click(function() {
    $.ajax({
        url: '{{ route('customers.destroy', ['customer' => ':customerId']) }}'.replace(':customerId', customerId),
        type: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                toastr.success('Customer deleted successfully!');
                location.reload();
            }
        },
        error: function(xhr) {
            if (xhr.status === 400) {
                // Show the specific error message for pending orders
                toastr.error(xhr.responseJSON.error);
            } else {
                // Generic error message for other errors
                toastr.error('Error deleting customer.');
            }
        }
    });
});


       
        $('#searchdata').keyup(function(){
            var searchdata = $('#searchdata').val();
            table.search($('#searchdata').val()).draw();
        });
    });
    // $('[data-toggle="tooltip"]').tooltip();
</script>              

@endsection
@section('modul')
<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Customer ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this Customer ?</p>
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