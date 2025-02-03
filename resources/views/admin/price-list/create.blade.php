@extends('layouts.app')
@section('navbarTitel', 'Price List Create ')
@section('content')

    <div class="main-outer">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Price List Create</span>
                <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
            </div>
            <form  id="newPriceCreate" class="form_mn" action="{{ route('price-list.store') }}" method="POST">
            <hr class="addsupplier-section-border">
                @csrf
                
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-md-6 mb-3">
                                <label class="heading-content" for="list_name">List Name<span style="color: red;">*</span></label>
                                <input type="text" name="list_name" class="form-control input-form-content" id="list_name" value="{{ old('list_name') }}" placeholder="Cosmic product list 16-01-24" >
                                @error('list_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3" >
                                <label class="heading-content" for="discount">Discount (%)<span style="color: red;">*</span></label>
                                <input type="text" name="discount" class="form-control input-form-content @error('discount') is-invalid @enderror" id="discount" value="{{ old('discount') }}" placeholder="20" >
                                @error('discount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-designs table-bottom">
                    <table class="table active all">
                        <thead>
                            <th><a href="javascript:void(0);" title="">Product Name<span style="color: red;">*</span></a></th>
                            <th><a href="javascript:void(0);" title="">SKU<span style="color: red;">*</span></a></th>
                            <th><a href="javascript:void(0);" title="">Min QTY<span style="color: red;">*</span></a></th>
                            <th><a href="javascript:void(0);" title="">Rate<span style="color: red;">*</span></a></th>
                            <th><a href="javascript:void(0);" title="">Discount Rate</a></th>
                            <th><a href="javascript:void(0);" title="">Special Rate</a></th>
                            <th><a href="javascript:void(0);" title="">Action</a></th>
                        </thead>
                        <tr class="grouppricing-select-data">
                            <td class="table-data-contents">
                                <select class="custom-select d-block w-100 form-select-grp select2 product-select" id="product_id" name="product_id[]">
                                    <option value="">Select</option>
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}" data-minqty="{{$product->min_quantity}}" data-rate="{{$product->rate}}" data-product="{{$product}}" data-bdl="{{$product->bdl_kg}}" data-bharti="{{$product->bharti}}" data-bagbox="{{$product->number_of_bags_per_box}}"  data-id="{{$product->id}}"{{ old('product.0') == $product->id ? 'selected' : '' }}>{{$product->product_name}}</option>
                                    @endforeach
                                </select>
                                @error('product.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents">
                                <select class="custom-select d-block w-100 form-select-grp select2 sku-select" id="sku_id" name="sku_id[]">
                                    <option value="">Select</option>
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}" data-minqty="{{$product->min_quantity}}" data-rate="{{$product->rate}}" data-product="{{$product}}" data-bdl="{{$product->bdl_kg}}" data-bharti="{{$product->bharti}}" data-bagbox="{{$product->number_of_bags_per_box}}"  data-id="{{$product->id}}"{{ old('product.0') == $product->id ? 'selected' : '' }}>{{$product->alias_sku}}</option>
                                    @endforeach
                                </select>
                                @error('sku.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents">
                                <input type="text" name="min_qty[]" value="{{old('min_qty.0')}}"class="order-input @error('min_qty.0') is-invalid @enderror @if(!empty(old('min_qty.0'))) is-valid @endif">
                                @error('min_qty.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents">
                                <input type="text" name="rate[]" value="{{old('rate.0')}}"class="order-input @error('rate.0') is-invalid @enderror @if(!empty(old('rate.0'))) is-valid @endif">
                                @error('rate.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents">
                                <input type="text" name="discount_rate[]" id="discount_rate" value="{{old('discount_rate.0')}}"class="order-input @error('discount_rate.0') is-invalid @enderror @if(!empty(old('discount_rate.0'))) is-valid @endif"  readonly>
                                @error('discount_rate.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents">
                                <input type="text" name="special_rate[]" id="special_rate" value="{{old('special_rate.0')}}"class="order-input @error('special_rate.0') is-invalid @enderror @if(!empty(old('special_rate.0'))) is-valid @endif">
                                @error('special_rate.0')<div class="invalid-feedback">{{ $message }}</div>@enderror    
                            </td>
                            <td class="table-data-contents"></td>
                        </tr>
                    </table>
                </div>
                <div class="upload-file-sec">
                    <div class="row col-12 customer-files-sec">
                        <div class="group-pricing-btn">
                            <div class="btn-sec btn_group">
                                <div class="button-1 cta_btn">
                                    <a href="javascript:void(0)" class="add_product">Add</a>
                                </div>
                            </div>
                            <div class="btn-sec btn_group">
                                <div class="button-1 cta_btn">
                                    <button id="saveButton" type="submit" class="">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>            
        </div>
    </div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click','#leaveButton', function(){
                window.location.href = "{{ route('price-list.index') }}";
            });
            $('.orderList').click( function(){
                $("#indexModul").modal("show");
            });
            $('#list_name').focus();
            $('.select2').select2();
            $(document).on('focusin', '.select2', function(e) {
                // Select2 handles the focus differently, this ensures the dropdown opens on focus
                $(this).siblings('select').select2('open');
            });
            $('#discount').on('keydown', function(e) {
                // Check if the pressed key is the Tab key
                if (e.key === 'Tab') {
                    e.preventDefault(); // Prevent the default tab behavior
                    // Focus the Select2 product dropdown
                    $('#product_id').select2('focus'); // Move to the first product select field
                }
            });
            $('button[type="submit"]').on('focus', function() {
                $(this).addClass('btn-focus');
            }).on('blur', function() {
                $(this).removeClass('btn-focus');
            });
            var productSelectCounter = 1;
            $('#newPriceCreate').validate({
                rules: {
                    list_name:{
                        required: true,
                        noSpecialChars: true,
                    },
                    discount: {
                        required: true,
                        number: true,
                        min: 0,
                        max: 100
                    },
                    'product_id[]': {  // Rules for product[]
                        required: true  // Ensures an option is selected
                    },
                    'sku_id[]': {  // Rules for product[]
                        required: true  // Ensures an option is selected
                    },
                    'min_qty[]': {
                        required: true,
                        number: true,
                        min: 0,
                    },
                    'rate[]': {
                        required: true,
                        number: true,
                        min: 0,
                    },
                    'discount_rate[]': {
                        required: false,
                        number: true,
                        min: 0,
                    },
                    'special_rate[]': {
                        required: false,
                        number: true,
                        min: 0,
                    }
                },
                messages: {
                    list_name: {
                        required: "Please enter List Name.",
                    },
                    discount: {
                        required: "Please enter Discount.",
                        number: "Please enter  Discount (numbers only).",
                        min: "The Discount cannot be less than 0.",  
                        max: "The Discount cannot exceed 100." 
                    },
                    'product_id[]': {
                        required: "Please select Product Name."
                    },
                    'sku_id[]': {
                        required: "Please select sku Name."
                    },
                    'min_qty[]': {
                        required: "Please enter Min QTY.",
                        number: "Please enter  Min QTY <br/> (numbers only).",
                        min: "The Min QTY cannot be less than 0.",
                    },
                    'rate[]': {
                        required: "Please enter Rate.",
                        number: "Please enter Rate (numbers only).",
                        min: "The Rate cannot be less than 0.",
                    },
                    'discount_rate[]': {
                        required: "Please enter Discount Rate.",
                        number: "Please enter Discount Rate(numbers only).",
                        min: "The Discount Rate cannot be less than 0.",
                    },
                    'special_rate[]': {
                        required: "Please enter Special Rate.",
                        number: "Please enter Special Rate (numbers only).",
                        min: "The special rate cannot be less than 0.",
                    }
                },
                errorElement: 'div',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    if (element.hasClass('select2')) {
                        error.insertAfter(element.next('span.select2'));
                        element.next('span.select2').find('.select2-selection__rendered').addClass('error-border');
                    } else {
                        error.insertAfter(element);
                        // element.addClass('error'); 
                    }

                },
                highlight: function (element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
            });
            $.validator.addMethod("noSpecialChars", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9\s]+$/.test(value); 
                // This regex allows letters, numbers, and spaces only
            }, "Name should not contain special characters.");
            $('table').on('focusout', 'tr:last input', 'tr:last select', function() {
                // Trigger validation for the last row
                $("#newPriceCreate").validate().element($(this));
            });
            $('#newPriceCreate').on('submit', function() {
                console.log('data');
                let isValid = true;
                // Validate each input and select field in the last row
                $('tr:last').find('select[name="product_id[]"]').each(function() {
                    if (!$("#newPriceCreate").validate().element($(this))) {
                        isValid = false;
                    }
                });
                $('tr:last').find('[name="min_qty[]"]').each(function() { 
                    if (!$("#newPriceCreate").validate().element($(this))) {
                        isValid = false;
                    }
                });
                $('tr:last').find('[name="rate[]"]').each(function() { 
                    if (!$("#newPriceCreate").validate().element($(this))) {
                        isValid = false;
                    }
                });
                $('tr:last').find('[name="discount_rate[]"]').each(function() { 
                    if (!$("#newPriceCreate").validate().element($(this))) {
                        isValid = false;
                    }
                });
                $('tr:last').find('[name="special_rate[]"]').each(function() { 
                    if (!$("#newPriceCreate").validate().element($(this))) {
                        isValid = false;
                    }
                });
                 // Prevent form submission if any field in the last row is invalid
                if (!isValid) {
                    event.preventDefault();
                }
            });
            $('.add_product').click( function(){
                var productOptions = '';
                var productskuOptions = '';
                $('tbody select.product-select').first().find('option').each(function() {
                    var productId = $(this).val();
                    var productText = $(this).text();
                    var rate = $(this).data('rate');
                    var minqty = $(this).data('minqty');
                    var product = $(this).data('product');
                    // console.log(minqty);
                    productOptions += `<option value="${productId}" 
                                        data-rate="${rate}"
                                        data-minqty="${minqty}" 
                                        data-product='${JSON.stringify(product)}'>${productText}</option>`;
                });
                $('tbody select.sku-select').first().find('option').each(function() {
                    var skuId = $(this).val();
                    var skuText = $(this).text();
                    var rate = $(this).data('rate');
                    var minqty = $(this).data('minqty');
                    var product = $(this).data('product');
                    // console.log(minqty);
                    productskuOptions += `<option value="${skuId}" 
                                        data-rate="${rate}"
                                        data-minqty="${minqty}" 
                                        data-product='${JSON.stringify(product)}'>${skuText}</option>`;
                });
                // Define new row structure based on the actual table
                var newRow = `<tr class="grouppricing-select-data">
                                <td class="table-data-contents">
                                    <select class="custom-select d-block w-100 form-select-grp select2 product-select" name="product_id[]" id="product_${productSelectCounter}">
                                        ${productOptions}
                                    </select>
                                </td>
                                <td class="table-data-contents">
                                    <select class="custom-select d-block w-100 form-select-grp select2 sku-select" name="sku_id[]" id="sku_${productSelectCounter}">
                                        ${productskuOptions}
                                    </select>
                                </td>
                                <td class="table-data-contents">
                                    <input type="text" name="min_qty[]" class="order-input" id="min_qty${productSelectCounter}">
                                </td>
                                <td class="table-data-contents">
                                    <input type="text" name="rate[]" id="rate${productSelectCounter}" class="order-input">
                                </td>
                                <td class="table-data-contents">
                                    <input type="text" name="discount_rate[]" id="discount_rate${productSelectCounter}" class="order-input" readonly>
                                </td>
                                <td class="table-data-contents">
                                    <input type="text" name="special_rate[]" id="special_rate${productSelectCounter}" class="order-input">
                                </td>
                                <td class="table-data-contents table-delete-icon">
                                    <a href="javascript:void(0)" class="btn-sm m-1 deleteRow"><span class="table-group-icons edit-icon-tag"></span></a>
                                </td>
                            </tr>`;

                $('tbody').append(newRow);

                $('tbody select.product-select').last().select2();
                $('tbody select.sku-select').last().select2();

                $('.deleteRow').click(function() {
                    $(this).closest('tr').remove();
                });
                productSelectCounter++;
            });

            // $('tbody').on('change', '.product-select', function() {
            //     var selectedProduct = $(this).find('option:selected');
            //     var rate = selectedProduct.data('rate');
            //     var min_quantity = selectedProduct.data('minqty');
            
            //     var row = $(this).closest('tr');
            //     row.find('input[name="min_qty[]"]').val(min_quantity);
            //     row.find('input[name="rate[]"]').val(rate);
            //     row.find('.sku-select').val(selectedProduct.val()).trigger('change');
            //     row.find('.sku-select').on('change', skuSelectChangeHandler);
            //     updatediscountRate(row);
            // });
            // $('tbody').on('change', '.sku-select', function() {
            //     var selectedProduct = $(this).find('option:selected');
            //     var rate = selectedProduct.data('rate');
            //     var min_quantity = selectedProduct.data('minqty');
            
            //     var row = $(this).closest('tr');
            //     row.find('input[name="min_qty[]"]').val(min_quantity);
            //     row.find('input[name="rate[]"]').val(rate);
            //     row.find('.product-select').val(selectedProduct.val()).trigger('change');
            //     row.find('.product-select').on('change', skuSelectChangeHandler);
            //     updatediscountRate(row);
            // });
            let isUpdating = false;
            
            $('tbody').on('change', '.product-select', function () {
                if (isUpdating) return; // Exit if already updating
                isUpdating = true;

                var selectedProduct = $(this).find('option:selected');
                var rate = selectedProduct.data('rate');
                var min_quantity = selectedProduct.data('minqty');

                var row = $(this).closest('tr');
                row.find('input[name="min_qty[]"]').val(min_quantity);
                row.find('input[name="rate[]"]').val(rate);
                row.find('.sku-select').val(selectedProduct.val()).trigger('change');

                updatediscountRate(row);
                isUpdating = false; // Reset the flag
            });

            $('tbody').on('change', '.sku-select', function () {
                if (isUpdating) return; // Exit if already updating
                isUpdating = true;

                var selectedProduct = $(this).find('option:selected');
                var rate = selectedProduct.data('rate');
                var min_quantity = selectedProduct.data('minqty');

                var row = $(this).closest('tr');
                row.find('input[name="min_qty[]"]').val(min_quantity);
                row.find('input[name="rate[]"]').val(rate);
                row.find('.product-select').val(selectedProduct.val()).trigger('change');

                updatediscountRate(row);
                isUpdating = false; // Reset the flag
            });
            // Ensure updatediscountRate function exists and is error-free

            var discount = 0; 
            $('#discount').on('blur', function() {
                discount = $(this).val() ? parseFloat($(this).val()) : 0;
                $('tbody tr').each(function() {
                    updatediscountRate($(this)); // Update discount rate for all rows
                });
            });
            $('tbody').on('keyup', 'input[name="special_rate[]"]', function() {
                var row = $(this).closest('tr');
                var enteredQty = $(this).val();
                console.log(enteredQty);
            });
            $('tbody').on('keyup', 'input[name="rate[]"]', function() {
            var row = $(this).closest('tr');
            updatediscountRate(row);
        });
            function updatediscountRate(row) {
                var selectedProduct = row.find('.product-select option:selected');
                var rate = selectedProduct.data('rate') || 0;
                var discountedRate = rate - (rate * discount / 100);
                row.find('input[name="discount_rate[]"]').val(discountedRate.toFixed(2));
            }
        });
        $(document).ready(function () {
    // Function to calculate the discount rate
    function calculateDiscountRate(row) {
        let rate = parseFloat(row.find('input[name="rate[]"]').val()); // Get the rate value
        let discount = parseFloat($('#discount').val()); // Get the overall discount value
        let discountRateField = row.find('input[name="discount_rate[]"]'); // Discount rate field

        if (!isNaN(rate) && !isNaN(discount)) {
            // Calculate the discounted rate
            let discountRate = rate - (rate * discount / 100);
            discountRateField.val(discountRate.toFixed(2)); // Populate the discount rate field
        } else {
            discountRateField.val(''); // Clear the field if values are invalid
        }
    }

    // Keyup event on rate field
    $(document).on('keyup', 'input[name="rate[]"]', function () {
        let row = $(this).closest('tr'); // Get the current row
        calculateDiscountRate(row); // Recalculate the discount rate for this row
    });

    // Keyup event on discount field
    $('#discount').on('keyup change', function () {
        // Loop through all rows and recalculate the discounted rates
        $('table tbody tr').each(function () {
            calculateDiscountRate($(this)); // Recalculate for each row
        });
    });
});


    </script>
@endsection
