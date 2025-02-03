@extends('layouts.app')
@section('navbarTitel', 'Assign Price List')
@section('content')
<style type="text/css">
         .select2-container--open {
        z-index: 9999;
    }
 </style>
<div class="main-outer">
    <div class="outer card">
        <div class="upload-file-sec customer-list-sec">
            <span class="addsupplier-section-heading">List of Price</span>
            <div class="btn-sec btn_group">
                <!-- <div class="search-sec">
                    <form class="input-group">
                        <div class="form-outline" data-mdb-input-init>
                            <input id="searchProduction" type="text" class="form-control form-control-inp"
                                placeholder="Search">
                            <span class="search-icons search-icon-tag"></span>
                        </div>
                    </form>
                </div> -->
                <form  id="priceListCreateForm" class="form_mn" action="{{ route('price-list.store') }}" method="POST">
                    @csrf
                    <div class="button-1 cta_btn icon-btn heading-btn left-btn">
                        <a href="{{route('price-list.create')}}" class="primary-button  confirm-leave-link ">Add Price</a>
                    </div>
                </form> 
            </div>
        </div>
        <hr class="addsupplier-section-border">
            
        <div class="table-responsive table-designs">
            <table class="table active all" id="price-list-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>List Name</th>
                        <th>Discount</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Product Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>         
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endsection
@section('js')
<script>
        $(document).ready(function() {
        // Initialize Select2 on your select elements
        $('.select2').select2({
            placeholder: 'Select a product',
            allowClear: true
        });
    });
// $(document).ready(function() {
//     $('#add-product').click(function() {
//         const productSection = $('#product-section');

//         const productRow = $('<div>').addClass('row form-inp-group mb-3');
//         const products = @json($products);
//         let productOptions = '<option value="">Select Product</option>';
//         products.forEach(product => {
//             productOptions += <option value="${product.id}">${product.product_name}</option>;
//         });

//         productRow.html(
//             <div class="col-md-9 product-name">

//                 <select name="product_name[]" class="custom-selectw-100 form-select-grp select2 product-select" required>
//                     ${productOptions}
//                 </select>
//             </div>
//             <div class="col-md-2 d-flex align-items-end remove-icon-product">
//                 <button type="button" class="btn btn-danger btn-remove-prdct remove-product">-</button>
//             </div>
//         );

//         productSection.append(productRow);

//         productRow.find('.remove-product').click(function() {
//             productRow.remove();
//         });
//     });
// });
$(document).ready(function() {
    // Function to initialize Select2 on select elements
    function initializeSelect2() {
        $('.select2').select2({
            placeholder: 'Select a product',
            allowClear: true
        });
    }
    
    // Initialize Select2 on page load
    initializeSelect2();

    $('#add-product').click(function() {
        const productSection = $('#product-section');
        const products = @json($products);
        let productOptions = '<option value="">Select Product</option>';
        products.forEach(product => {
            productOptions += `<option value="${product.id}">${product.product_name}</option>`;
        });

        // Create new product row
        const productRow = $('<div>').addClass('row form-inp-group mb-3').html(`
            <div class="col-md-9 product-name">
                <select name="product_name[]" class="custom-selectw-100 form-select-grp select2 product-select" required>
                    ${productOptions}
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end remove-icon-product">
                <button type="button" class="btn btn-danger btn-remove-prdct remove-product">-</button>
            </div>
        `);

        // Append new row to the product section
        productSection.append(productRow);

        // Reinitialize Select2 on the newly added select element
        initializeSelect2();

        // Remove product row
        productRow.find('.remove-product').click(function() {
            productRow.remove();
        });
    });
});

$(document).ready(function() {
        $("#priceListCreateForm").validate({
            ignore: ":hidden", 
            rules: {
                list_name: {
                    required: true,
                },
                discount: {
                    required: true,
                },
            },
            messages: {
                list_name: {
                    required: "Please enter List Name",
                },
                discount: {
                    required: "Please enter Discount",
                },
            },
            errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
        });
    });
</script>
<script>
$(document).ready(function() {
    var table = $('#price-list-table').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        ajax: {
            url: '{{ route("price-list.index") }}',
            data: function(d) {
                        d.SearchData = $('#search').val();
              
                },
        },
        columns: [
            { data: 'id', name: 'id', orderable: true, searchable: true, visible: false },
            { data: 'list_name', name: 'list_name' , class: 'left_data tooltip-tabledata' ,
                render: function (data, type, row) {
                    return '<span title="' + data + '">' + data + '</span>';}
            },
            { data: 'discount', name: 'discount' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'product_count', name: 'product_count' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        order: [[0, 'desc']],
        // language: {
        //         info: "Showing _START_ to _END_ of _TOTAL_ Entries".replace(/\b\w/g, c => c.toUpperCase()),
        //         // You can customize other language options similarly if needed
        //     },
    });
    $('#search').keyup(function(){
            var searchdata = $('#search').val();
            console.log('********************');
             console.log(searchdata);
            table.search($('#search').val()).draw();
        });
});
$(document).on('click', '.delete-product', function() {
    var id = $(this).data('id');
    var url = $(this).data('url');

    $('#role_id').data('id', id).data('url', url);
});

$(document).on('click', '.delete-customer', function() {
    var id = $(this).data('id');
    var url = $(this).data('url');

    $.ajax({
        url: url,
        type: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}' 
        },
        success: function(response) {
            // alert('Item deleted successfully!');
            // location.reload(); 
            toastr.success('Item deleted successfully!');
            location.reload();
        },
        error: function(response) {
            toastr.error('An error occurred while deleting the item.');
            // alert('An error occurred while deleting the item.');
        }
    });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endsection
@section('modul')
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Group price ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this Group price ?</p>
            </div>
            <div class="modal-footer cstmr-odr-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                        <a href="javascript:void(0)" class="delete-customer delete-product" id="role_id" data-id="">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection