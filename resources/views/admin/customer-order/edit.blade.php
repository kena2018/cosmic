@extends('layouts.app')
@section('navbarTitel', 'Edit Order')
@section('content')
<style type="text/css">
         .select2-container--open {
        z-index: 9999;
        
    }
</style>
<div class="main-outer">
    <div class="outer card">
        <div class="heading-btn">
            <span class="addsupplier-section-heading">ORDER INFORMATION</span>
            <div class="btn-sec btn_group">
                <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
            </div>
        </div>
        <hr class="addsupplier-section-border">
        <form method="post" action="{{route('customerOrder.update',$customerOrders->id)}}" id="newOrderCustomer">
            @csrf
            @method('PUT')
            <div class="heading-btn">
                <span class="addsupplier-section-headingg">Order Type</span>
            </div>
            <div class="upload-file-sec">
                <div class="row col-12 customer-files-sec">
                    <div class="btn-sec" style="display:none;">
                        <input type="radio" class="btn-check" name="options" value="Order to make" id="option1" autocomplete="off"  {{ old('options') == 'Order to make' ? 'checked' : '' }} checked>
                        <label class="btn btn-primary button-1 cta_btn" for="option1">Order to make</label>

                        <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" value="Order to Stock"  {{ old('options') == 'Order to Stock' ? 'checked' : '' }}>
                        <label class="btn btn-secondary button-2 cta_btn" for="option2">Order to Stock</label>
                    </div>

                    <div class="options input-dgn">
                        <div class="row form-inp-group">
                            <div class="col-md-4 mb-3">
                                <label class="heading-content"  for="name">Serial Number.<span style="color: red;">*</span></label>
                                <input type="text" name="serial_number" class="form-control input-form-content @error('serial_number') is-invalid @enderror @if(!empty(old('serial_number'))) is-valid @endif" id="serial_number" placeholder="Enter Serial Number" value="{{old('serial_number',$customerOrders->serial_number ?? '')}}" readonly>
                                @error('serial_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="heading-content"  for="name">Company<span style="color: red;">*</span></label>
                                <select class="custom-select d-block w-100 form-select-grp select2 @error('customer') is-invalid @enderror @if(old('customer')) is-valid @endif" name="customer" id="customer_add_data">
                                    <option value="">Select Company</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}" data-no="{{$customer->contect}}" {{ old('customer',$customerOrders->customer_id) == $customer->id ? 'selected' : '' }}>{{$customer->company_name}}</option>
                                        @endforeach
                                </select>
                                @error('customer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-1 add-icon-btn add-icon-center-btn company_data">
                                <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff" class="bi bi-plus company_data" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg>
                            </div>
                        </div>
                        <div class="row form-inp-group">
                            <div class="col-md-4 mb-3">
                                <label class="heading-content"  for="name">Phone no.<span style="color: red;">*</span></label>
                                <input type="number" name="contact" class="form-control input-form-content @error('contact') is-invalid @enderror @if(!empty(old('contact'))) is-valid @endif" id="contactSelect" placeholder="" value="{{old('contact',$customerOrders->contact ?? '')}}" >
                                @error('contact')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <!-- <div class="col-md-4 mb-3">
                                <label class="heading-content"  for="number">Price list</label>
                                <input type="text" name="price_list" class="form-control input-form-content @error('price_list') is-invalid @enderror @if(!empty(old('price_list'))) is-valid @endif" id="price_list" placeholder="" value="{{old('price_list',$customerOrders->price_list ?? '')}}" >
                                @error('price_list')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div> -->
                            <div class="col-md-4 mb-3">
                                <label class="heading-content" for="price_list">Price List</label>
                                <select class="custom-select d-block w-100 form-select-grp select2 @error('price_list') is-invalid @enderror" name="price_list" id="price_list">
                                    <option value="">Select Price List</option>
                                    @foreach($pricelists as $pricelist)
                                        <option value="{{ $pricelist->id }}" {{ (old('price_list') ?? $customerOrders->price_list) == $pricelist->id ? 'selected' : '' }}>
                                            {{ $pricelist->list_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('price_list')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="heading-content"  for="number">Delivery Date<span style="color: red;">*</span></label>
                                <input type="date" name="delivery_date" class="form-control input-form-content @error('delivery_date') is-invalid @enderror @if(!empty(old('delivery_date'))) is-valid @endif" id="delivery_date" placeholder="" value="{{old('delivery_date',$customerOrders->delivery_date ?? '')}}" >
                                @error('delivery_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row form-inp-group">
                            <div class="col-md-4 mb-3">
                                <label class="heading-content"  for="name">Delivery Instructions</label>
                                <input type="text" class="form-control input-form-content @error('shipping_address') is-invalid @enderror @if(!empty(old('shipping_address'))) is-valid @endif" id="shipping_address" name="shipping_address" placeholder="Enter Delivery interaction" value="{{old('shipping_address',$customerOrders->shipping_address ?? '')}}">
                                @error('shipping_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3 transport_detailss">
                                <div class="col-md-9 mb-3">
                                    <label class="heading-content"  for="number">Transport Details<span style="color: red;">*</span></label>
                                    <select class="transform-select d-block w-100 form-select-grp select2 @error('packing_name') is-invalid @enderror @if(old('packing_name')) is-valid @endif" name="packing_name" id="packing_name">
                                        <option value="">Select</option>
                                        @foreach($transforms as $transform)
                                            <option value="{{$transform->id}}" {{ old('packing_name',$customerOrders->packing_name) == $transform->id ? 'selected' : '' }} >{{$transform->name}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <input type="text" class="form-control input-form-content @error('packing_name') is-invalid @enderror @if(!empty(old('packing_name'))) is-valid @endif" id="packing_name" name="packing_name" placeholder="Enter name of packing" value="{{old('packing_name')}}"> -->

                                    @error('packing_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="add-icon-btn transport-icon-btn transport-btn transform_data">
                                    <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff" class="bi bi-plus transform_data" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="heading-content"  for="number">Order ID</label>
                                <input type="text" class="form-control input-form-content @error('order_id') is-invalid @enderror @if(!empty(old('order_id'))) is-valid @endif" id="order_id" name="order_id" placeholder="Advance" value="{{old('order_id',$customerOrders->order_id ?? '')}}"readonly>
                                @error('order_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive table-designs">
                <table class="table active all">
                    <thead>
                        <th><a href="javascript:void(0);" title="">SKU<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title="">Product Name<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title=""></a></th>
                        <th><a href="javascript:void(0);" title="">Colour</a></th>
                        <th><a href="javascript:void(0);" title=""></a></th>
                        <th><a href="javascript:void(0);" title="">Sticker</a></th>
                        <th><a href="javascript:void(0);" title="">Packing Material Name<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title="">BDL<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title="">Bharti<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title="">Bag/Box<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title="">Total Roll<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title="">Rate<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title="">Total<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title="">Remark</a></th>
                        <th><a href="javascript:void(0);" title="">Action</a></th>
                    </thead>
                     @foreach($productsOrders as $index => $productId)
                        <tr class="table-select-data customerorder-table">
                        <td class="table-data-contents">
                                <select class="form-control input-form-content form-select-grp sku-select select2" id="sku_{{$productId->id}}" name="sku[]">
                                    <option value="">Select</option>
                                    @foreach($products as $product)
                                        <!-- <option value="{{$product->id}}" data-pmt="{{$product->packing_material_type}}" data-bdl="{{$product->bdl_kg}}" data-bharti="{{$product->bharti}}" data-bagBox="{{$product->number_of_bags_per_box}}"  data-id="{{$product->id}}"{{ old('sku.0') == $product->id ? 'selected' : '' }}>{{$product->alias_sku}}</option> -->
                                        <option value="{{$product->id}}" data-rolls1bdl="{{$product->rolls_in_1_bdl}}" data-packingmaterialname="{{ optional($product->packingMaterial)->material_name ?? null }}" data-pmt="{{$product->packing_material_type}}" data-bdl="{{$product->bdl_kg}}" data-bharti="{{$product->bharti}}" data-bagBox="{{$product->number_of_bags_per_box}}"  data-id="{{$product->id}}"{{ old('sku.0',$productId->product_id) == $product->id ? 'selected' : '' }}>{{$product->alias_sku}}</option>
                                    @endforeach
                                </select>
                                @error('sku.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents">
                                <select class="custom-select d-block w-100 form-select-grp select2 product-select" id="product_{{$productId->id}}" name="product[]">
                                    <option value="">Select</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}" data-rolls1bdl="{{$product->rolls_in_1_bdl}}" data-packingmaterialname="{{ optional($product->packingMaterial)->material_name ?? null }}" data-rate="{{$product->rate}}" data-product="{{$product}}" data-bdl="{{$product->bdl_kg}}" data-bharti="{{$product->bharti}}" data-bagbox="{{$product->number_of_bags_per_box}}"  data-id="{{$product->id}}"{{ old('product.0',$productId->product_id) == $product->id ? 'selected' : '' }}>{{$product->product_name}}</option>
                                    @endforeach
                                </select>
                                @error('product.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="product-data-tb">
                                <div class="add-icon-btn product_data">
                                    <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff" class="bi bi-plus product_data" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg>
                                </div>
                            </td>
                        <td class="table-data-contents">
                            <div class="d-flex align-items-center dropdown-cursour">
                                <button class="btn color-select dropdown-toggle d-flex align-items-center select_color_btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ old('color.0', $productId->colour ?? 'Select') }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li class="d-flex align-items-center justify-content-between dropdown-item">
                                        <span class="color-name">select</span>
                                    </li>
                                    @foreach($colors as $color)
                                        <li class="d-flex align-items-center justify-content-between dropdown-item">
                                            <span class="color-name">{{ $color->name }}</span>
                                            <span class="table-group-icons edit-icon-tag delete-color"data-color-name="{{ $color->name }}"></span>
                                        </li>
                                    @endforeach
                                </ul>
                                <input type="hidden" name="color[]" class="selected-color"value="{{old('color.0',$productId->colour??'')}}">
                            </div>
                        </td>
                        <td class="color-data-tb">
                            <div class="add-icon-btn color_data">
                                <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff" class="bi bi-plus" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg>
                            </div>
                        </td>
                        <!-- <td class="table-data-contents">
                            <input type="text" name="sticker_name[]" value="{{old('sticker_name.0',$productId->sticker_name ?? '')}}"class="order-input @error('sticker_name.0') is-invalid @enderror @if(!empty(old('sticker_name.0'))) is-valid @endif">
                            @error('sticker_name.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </td> -->
                        <td class="table-data-contents">
                                <select class="custom-select d-block w-100 form-select-grp select2 sticker-select" id="sticker_name_{{$productId->id}}" name="sticker_name[]">
                                    <option value="">Select</option>
                                    @foreach($stickers as $sticker)
                                        <option value="{{$sticker->id}}" data-id="{{$sticker->id}}"{{ old('sticker_name.0',$productId->sticker_name) == $sticker->id ? 'selected' : '' }}>{{$sticker->material_name}}</option>
                                    @endforeach
                                </select>
                                @error('sku.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </td>
                        <td class="table-data-contents">
                            <select class="custom-select d-block w-100 form-select-grp select2 material-select" id="packing_material_type_{{$productId->id}}" name="packing_material_type[]">
                                <option value="">Select</option>
                                @foreach($materials as $material)
                                    <option value="{{$material->material_name}}"  {{ old('packing_material_type.0',$productId->packing_material_type) == $material->material_name ? 'selected' : '' }}>{{$material->material_name}}</option>
                                @endforeach
                            </select>
                            @error('packing_material_type.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </td>
                            
                            <td class="table-data-contents total-input">
                                <input type="text" name="bdl_kg[]" value="{{old('bdl_kg.0',$productId->bdl_kg ?? '')}}"class="order-input @error('bdl_kg.0') is-invalid @enderror @if(!empty(old('bdl_kg.0'))) is-valid @endif">
                                @error('bdl_kg.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents">
                                <input type="text" name="bharti[]" value="{{old('bharti.0',$productId->bharti ?? '')}}"class="order-input @error('bharti.0') is-invalid @enderror @if(!empty(old('bharti.0'))) is-valid @endif" readonly>
                                @error('bharti.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents">
                                <input type="text" name="unit_box[]" value="{{old('unit_box.0',$productId->unit_box ?? '')}}" class="order-input @error('unit_box.0') is-invalid @enderror @if(!empty(old('unit_box.0'))) is-valid @endif"readonly>
                                @error('unit_box.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents">
                                <input type="text" name="roll_counte[]" value="{{old('roll_counte.0',formatIndianCurrencyNumber($productId->roll_counte) ?? '')}}"class="order-input @error('roll_counte.0') is-invalid @enderror @if(!empty(old('roll_counte.0'))) is-valid @endif"readonly>
                                @error('roll_counte.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents total-input">
                                <input type="text" name="rate[]" value="{{old('rate.0',formatIndianCurrencyNumber($productId->rate) ?? '')}}"class="order-input @error('rate.0') is-invalid @enderror @if(!empty(old('rate.0'))) is-valid @endif">
                                @error('rate.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents total-input">
                                <input type="text" name="total[]" value="{{old('total.0',formatIndianCurrencyNumber($productId->total) ?? '')}}"readonly  class="order-input @error('total.0') is-invalid @enderror @if(!empty(old('total.0'))) is-valid @endif">
                                @error('total.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents">
                                <input type="text" name="remark[]" value="{{old('remark.0',$productId->remark ?? '')}}"class="order-input @error('remark.0') is-invalid @enderror @if(!empty(old('remark.0'))) is-valid @endif">
                                @error('remark.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                        @if($loop->index > 0)
                        <td>
                            <a href="javascript:void(0)" class="btn-sm m-1 deleteRow"><span class="table-group-icons edit-icon-tag"></span></a>
                        <td>
                        @endif
                    </tr>
                        @endforeach
                </table>
            </div>
            <div class="filee-sec pagination-sec">
                <div class="btn-sec btn_group">
                    <div class="button-1 cta_btn">
                        <a href="javascript:void(0)" class="add_product">Add</a>
                    </div>
                </div>
            </div>
            <div class="upload-file-sec">
                <div class="row col-12 customer-files-sec">
                    <div class="upload---file-sections custmr-notes-sec">
                        <div class="row form-inp-group">
                            <div class="">
                                <label class="heading-content"  for="name">Customer Notes:</label>
                                <textarea class="notes-area" name="customer_notes" id="" cols="30" rows="10">{{ old('customer_notes', $customerOrders->customer_notes ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="button-grp-custordrr">
                        <div class="btn-sec btn_group">
                            <div class="button-1 cta_btn">
                                <button id="editButton" type="submit" class="">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>   
</div>
<!-- <div id="data-container" data-customers='[{"id":1,"company_name":"Company A"},{"id":2,"company_name":"Company B"}]'></div> -->
<div id="data-container" data-customers="{{ json_encode($customers) }}"></div>
@endsection
@section('js')
<!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->
<script>
    //function updateAllProductRates() {
        // Loop through each .product-select element (the select dropdowns)
        $('tbody .product-select').each(function() {
            var selectedProduct = $(this).find('option:selected');
            var productData = selectedProduct.data('product');
            var sku = selectedProduct.data('id');
            
             var rate = selectedProduct.data('rate');
            // var rate = '';
            // // Loop through productDetailsArray to find matching product_id
            // productDetailsArray.forEach(function(productprice) {
            //     if (sku == productprice.product_id) {
            //         rate = productprice.special_rate !== null ? productprice.special_rate : productprice.discount_rate;
            //     }
            // });

            // Update the respective fields in the row
            var row = $(this).closest('tr');
            //row.find('input[name="rate[]"]').val(formatIndianCurrency(rate));
        });
   // }
    function formatIndianCurrency(number) {
        number = number.toString();

        let [integerPart, decimalPart] = number.split('.');
        integerPart = integerPart.replace(/,/g, '');

        const lastThreeDigits = integerPart.slice(-3);
        let otherDigits = integerPart.slice(0, -3);

        if (otherDigits) {
            otherDigits = otherDigits.replace(/\B(?=(\d{2})+(?!\d))/g, ',');
            integerPart = otherDigits + ',' + lastThreeDigits;
        } else {
            integerPart = lastThreeDigits;
        }

        return decimalPart ? `${integerPart}.${decimalPart}` : `${integerPart}`;
    }
    var productDetailsArray = [];

    // Function to fetch products based on priceListId
    function fetchProductDetails(priceListId) {
        if (priceListId && priceListId !== '') {
            $.ajax({
                url: '{{ route('customerOrder.storeGroup', ':priceListId') }}'.replace(':priceListId', priceListId),
                type: 'GET',
                success: function(response) {
                    productDetailsArray = [];
                    response.forEach(function(product) {
                        productDetailsArray.push({
                            product_id: product.product_id,
                            rate: product.rate,
                            discount_rate: product.discount_rate,
                            special_rate: product.special_rate
                        });
                    });
                   // updateAllProductRates(); // Update UI with new rates
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching products:', error);
                }
            });
        } else {
            productDetailsArray = [];
           // updateAllProductRates(); // Clear UI rates if no priceListId
        }
    }

    $(document).ready(function() {
        var initialPriceListId = $('#price_list').val();
        fetchProductDetails(initialPriceListId);
        $(document).on('click','#leaveButton', function(){
            window.location.href = "{{ route('customerOrder.index') }}";
        });
    $('#packing_material_category').on('change', function() {
        var selectedCategoryId = $(this).val();
        var packingMaterialTypeDiv = $('#packing_material_type_div');
        var packingMaterialTypeSelect = $('#packing_material_type');
        var packingMaterialNameSelect = $('#packing_material_name');

        packingMaterialTypeSelect.empty().append('<option value="">Select material Type</option>');
        packingMaterialNameSelect.empty().append('<option value="">Select material Name</option>');

        if (selectedCategoryId) {
            $.ajax({
                url: '{{ route("material.getSubcategories", ":id") }}'.replace(':id', selectedCategoryId),
                type: 'GET',
                success: function(data) {
                    console.log(data.subcategories);
                    if (data.subcategories.length > 0) {
                        packingMaterialTypeSelect.empty().append('<option value="">Select subcategory</option>');
                        $.each(data.subcategories, function(index, subcategory) {
                            // packingMaterialTypeSelect.append('<option value="' + subcategory.id + '">' + subcategory.sub_cat_name + '</option>');
                            packingMaterialTypeSelect.append('<option value="' + subcategory.id + '">' + subcategory.sub_cat_name + '</option>');
                        });
                        // packingMaterialTypeSelect.find('option:eq(1)').prop('selected', true);
                        packingMaterialTypeSelect.find('option:eq(1)').prop('selected', true);
                        packingMaterialTypeDiv.show();

                        var selectedSubCategoryId = packingMaterialTypeSelect.val();
                        // var selectedSubCategoryId = packingMaterialTypeSelect.val();
                        console.log('Initially selected subcategory ID:', selectedSubCategoryId);
                        loadMaterialNames(selectedCategoryId, selectedSubCategoryId);

                        // Handle subcategory change
                        packingMaterialTypeSelect.off('change').on('change', function() {
                            var selectedSubCategoryId = $(this).val();
                            if (selectedSubCategoryId) {
                                loadMaterialNames(selectedCategoryId, selectedSubCategoryId);
                            } else {
                                packingMaterialNameSelect.empty().append('<option value="">Select material Name</option>');
                            }
                        });
                    } else {

                        packingMaterialTypeDiv.hide();
                        loadMaterialNames(selectedCategoryId, null);
                    }
          
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        } else {
            packingMaterialTypeDiv.hide();
            packingMaterialNameSelect.empty().append('<option value="">Select material Name</option>');
        }
    });

    function loadMaterialNames(categoryId, subcategoryId = null) {
        // console.log(categoryId);
        // console.log(subcategoryId);
        $.ajax({
            url: '{{ route("material.getMaterials", ["categoryId" => ":categoryId", "subcategoryId" => ":subcategoryId"]) }}'
                    .replace(':categoryId', categoryId)
                    .replace(':subcategoryId', subcategoryId ? subcategoryId : ''),
            type: 'GET',
            success: function(materials) {
                console.log('Materials:', materials.materials.length);
                var packingMaterialNameSelect = $('#packing_material_name');
                packingMaterialNameSelect.empty().append('<option value="">Select material Name</option>');

                if (materials.materials.length > 0) {
                    $.each(materials.materials, function(index, material) {
                        packingMaterialNameSelect.append('<option value="' + material.id + '">' + material.material_name + '</option>');
                    });
                    packingMaterialNameSelect.find('option:eq(1)').prop('selected', true);
                } else {
                    packingMaterialNameSelect.append('<option value="">No materials available</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }
    $("#productformForm").validate({
            errorClass: "is-invalid",
        errorElement: "div", 
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            if (element.hasClass('select2')) {
                error.insertAfter(element.next('span.select2'));
                element.next('span.select2').find('.select2-selection__rendered').addClass('error-border');
            } else {
                error.insertAfter(element);
            }

        },
            rules: {
                product_name: {
                    required: true
                },
                group_name: {
                    required: true
                },
                alias_sku: {
                    required: true
                },
                width: {
                    required: true,
                    min: 0,
                    number: true
                },
                length: {
                    required: true,
                    min: 0,
                    number: true
                },
                gage: {
                    min: 0,
                    digits: true
                },
                master_packing: {
                    required: true
                },
                bharti: {
                    required: true,
                    min: 0
                },
                number_of_bags_per_box: {
                    required: true,
                    min: 0
                },
                pipe_size: {
                    number: true
                },
                packing_material_qty: {
                    digits: true
                },
                outer_name: {
                    maxlength: 255
                },
                carton_no: {
                    maxlength: 255
                },
                number_of_outer: {
                    digits: true
                },
                packing_material_type: {
                    maxlength: 255
                },
                rate: {
                    required: true,
                    min: 0,  
                    number: true
                },
                packing_material_category: {
                required: true,
                },
                packing_material_name: {
                    required: true,
                },
            },
            messages: {
                product_name: "Please enter a valid product name.",
                group_name: "Please select a valid group name.",
                alias_sku: "Please enter a valid alias/sku.",
                width: {
                    required: "Please enter a valid width.",
                    number: "Please enter a valid number"
                },
                length: {
                    required: "Please enter a valid length.",
                    number: "Please enter a valid number"
                },
                gage: {
                    digits: "Please enter a valid integer."
                },
                master_packing: "Please select the master packing.",
                bharti: {
                    required: "Please enter a valid bharti.",
                    digits: "Please enter a valid integer"
                },
                number_of_bags_per_box: {
                    required: "Please enter a valid bags per box.",
                    digits: "Please enter a valid integer"
                },
                pipe_size: {
                    number: "Please enter a valid number"
                },
                packing_material_qty: {
                    digits: "Please enter a valid integer"
                },
                outer_name: {
                    maxlength: "Please enter no more than 255 characters"
                },
                carton_no: {
                    maxlength: "Please enter no more than 255 characters"
                },
                number_of_outer: {
                    digits: "Please enter a valid integer"
                },
                packing_material_type: {
                    maxlength: "Please enter no more than 255 characters"
                },
                rate: {
                    required: "Please enter a valid rate.",
                    number: "Please enter a valid number"
                },
                packing_material_category: {
                    required: "Please select a valid packing material category.",
                },
                packing_material_name: {
                    required: "Please select a valid packing material name.",
                },
            }
        });

        jQuery.validator.addMethod("filesize", function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param * 1024);
        });
});
</script>
<script>
    $(document).on('focusin', '.select2', function(e) {
        // Select2 handles the focus differently, this ensures the dropdown opens on focus
        $(this).siblings('select').select2('open');
    });
    $('select').on('focus', function() {
        // Only open if it's not a Select2 dropdown
        if (!$(this).hasClass('select2-hidden-accessible')) {
            $(this).prop('size', 5); // Open regular select dropdown with a larger size
        }
    }).on('blur', function() {
        $(this).prop('size', 1); // Reset size when focus is lost
    }).on('change', function() {
        $(this).prop('size', 1); // Close the dropdown after selection
    });
    $('input[type="date"]').on('focus', function() {
        $(this).trigger('click'); // Trigger the date picker to open
    });
    var productDetailsArray = [];
    // JavaScript Code
    $('#price_list').on('change', function() {
        var priceListId = $(this).val();
        fetchProductDetails(priceListId);
    });
    $(document).ready(function () {
        $('#customersForm').validate({
            rules: {
                company_name: {
                    required: true,
                    maxlength: 255,
                },
                gstin: {
                    required: true,
                    gstindata: true // Correct method name
                },
                payment_terms:{
                    required: true,
                },
                address1: {
                    required: true,
                    maxlength: 255
                },
                country_id: {
                    required: true,
                    // digits: true
                },
                state_id: {
                    required: true,
                    // digits: true
                },
                pin: {
                    required: true,
                    digits: true
                },
                city_id: {
                    required: true,
                    // digits: true,
                },
                matrix: {
                    required: true,
                    number: true  // Ensures that only numeric values are allowed
                },
                first_name: {
                    required: true,
                    maxlength: 255,
                    noSpecialChars: true,
                },
                last_name: {
                    required: false,
                    maxlength: 255,
                    noSpecialChars: true,
                },
                email: {
                    required: false,
                    email: true,
                    maxlength: 255
                },
                contect: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 13
                },
            },
            messages: {
                company_name: {
                    required: "Please enter a valid company name."
                },
                gstin: {
                    required: "Please enter a valid GST number.",
                    remote: "GSTIN already exists." // Customize this message as needed
                },
                payment_terms:{
                    required: "Please select a valid payment terms."
                },
                address1: {
                    required: "Please enter a valid address."
                },
                country_id: {
                    required: "Please select a valid country.",
                    // digits: "Country ID must be an integer."
                },
                state_id: {
                    required: "Please select a valid state.",
                    // digits: "State ID must be an integer."
                },
                pin: {
                    required: "Please enter a valid pin.",
                    digits: "PIN code must be an integer."
                },
                city_id: {
                    required: "Please select a valid city.",
                    // digits: "City ID must be an integer."
                },
                matrix: {
                    required: "Please enter a valid pref. matrix.",
                    number: "Please enter a valid number for the perf. matrix."
                },
                first_name: {
                    required: "Please enter a valid name.",
                    maxlength: "First name cannot exceed 255 characters."
                },
                last_name: {
                    maxlength: "First name cannot exceed 255 characters."
                },
                email: {
                    required: "Please enter a valid email.",
                    email: "Please enter a valid email address.",
                    maxlength: "Email cannot exceed 255 characters."
                },
                contect: {
                    required: "Please enter a phone number.",
                    digits: "Contact number must be digits.",
                    minlength: "Contact number must be at least 10 digits.",
                    maxlength: "Contact number cannot exceed 13 digits."
                },
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
        jQuery.validator.addMethod("gstindata", function(value, element) {
            return this.optional(element) || /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[Z]{1}[0-9A-Z]{1}$/.test(value);
        }, "Please enter a valid GST number");
        $.validator.addMethod("noSpecialChars", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9\s]+$/.test(value); 
            // This regex allows letters, numbers, and spaces only
        }, "Name should not contain special characters.");  
        $("#newOrderCustomer").validate({
            rules: {
                customer:{
                    required: true,
                },
                contact: {
                    required: true,
                    maxlength: 255,
                    minlength: 10, // Minimum 10 digits
                    maxlength: 13  // Maximum 13 digits
                },
                delivery_date : {
                    required: true,
                    date: true,  
                    //greaterThanToday: true,
                },
                shipping_address : {
                    // required: true,
                    maxlength: 255,
                },
                packing_name : {
                    required: true,
                },
                'product[]': {  // Rules for product[]
                    required: true  // Ensures an option is selected
                },
                'sku[]': {  
                    required: true  
                },
                'color[]': {  
                    required: true 
                },
                'sticker_name[]' : {
                   // required: true,
                    maxlength: 255,
                },
                'packing_material_type[]': {  // Correctly reference array field names
                    required: true,
                    maxlength: 255
                },
                'bdl_kg[]': {  // Correctly reference array field names
                    required: true,
                    number: true,  // Ensure the input is a number
                    min: 0,  // Minimum value
                    // max: 10000  // Maximum value, adjust as necessary
                },
                'bharti[]': {  // Rules for bharti[]
                    required: true,
                    number: true  // Ensure the input is a number
                },
                'unit_box[]': {  // Rules for unit_box[]
                    required: true,
                    number: true
                },
                // 'roll_counte[]': {  // Rules for roll_counte[]
                //     required: true,
                //     number: true
                // },
                'rate[]': {  // Rules for rate[]
                    required: true,
                    number: true
                },
                // 'total[]': {  // Rules for total[]
                //     required: true,
                //     number: true
                // },
                
            },
            messages: {
                customer: {
                    required: "Please select Company.",
                },
                 contact: {
                    required: "Please enter Phone no.",
                    digits: "Please enter a valid phone number with only digits.",
                    minlength: "The phone number must be at least 10 digits long.",
                    maxlength: "The phone number cannot be longer than 13 digits."
                },
                delivery_date : {
                    required: "Please select Delivery Date.",
                    date: "Please enter a valid date."
                },
                // shipping_address : {
                //     required: "Please enter Delivery Instructions.",
                // },
                packing_name : {
                   required: "Please select Transport Name."
                },
                'product[]': {
                    required: "Please select Product Name."
                },
                'color[]' : {
                    required: "Please select  Colour.",
                },
                'sticker_name[]' : {
                  //  required: "Please enter Sticker.",
                },   
                'packing_material_type[]' : {
                    required: "Please enter Packing Material Name.",
                },
                'bdl_kg[]': {
                    required: "Please enter BDL.",
                    number: "Please enter a valid number.",
                    min: "The BDL K.G. value must be at least 0."
                },
                'bharti[]': {
                    required: "Please enter Bharti.",
                    number: "Please enter a valid number."
                },
                'unit_box[]': {
                    required: "Please enter Bag/Box.",
                    number: "Please enter a valid number."
                },
                'roll_counte[]': {
                    required: "Please enter Total Roll.",
                    number: "Please enter a valid number."
                },
                'rate[]': {
                    required: "Please enter Rate.",
                    number: "Please enter a valid number."
                },
                'total[]': {
                    required: "Please enter Total.",
                    number: "Please enter a valid number."
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
        
        jQuery.validator.addMethod("filesize", function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param * 1024);
        });
        // $.validator.addMethod("greaterThanToday", function(value, element) {
        //     var today = new Date();
        //     today.setHours(0, 0, 0, 0); // Remove time part to compare only date
        //     var inputDate = new Date(value);
        //     return this.optional(element) || inputDate > today;
        // }, "The delivery date must be greater than or equal to today's date .");
        $('table').on('focusout', 'tr:last input', 'tr:last select', function() {
            // Trigger validation for the last row
            $("#newOrderCustomer").validate().element($(this));
        });
        $('#newOrderCustomer').on('submit', function() { 
            let isValid = true;
            // Validate each input and select field in the last row
            $('tr:last').find('select[name="product[]"]').each(function() {
                if (!$("#newOrderCustomer").validate().element($(this))) {
                    isValid = false;
                }
            });
            $('tr:last').find('[name="sticker_name[]"]').each(function() { 
                if (!$("#newOrderCustomer").validate().element($(this))) {
                    isValid = false;
                }
            });
            $('tr:last').find('[name="packing_material_type[]"]').each(function() {
                if (!$("#newOrderCustomer").validate().element($(this))) {
                    isValid = false;
                }
            });
            $('tr:last').find('[name="bdl_kg[]"]').each(function() {
                console.log('data sa');
                if (!$("#newOrderCustomer").validate().element($(this))) {
                    isValid = false;
                }
            });
            $('tr:last').find('[name="bharti[]"]').each(function() {
                if (!$("#newOrderCustomer").validate().element($(this))) {
                    isValid = false;
                }
            });
            $('tr:last').find('[name="unit_box[]"]').each(function() {
                if (!$("#newOrderCustomer").validate().element($(this))) {
                    isValid = false;
                }
            });
            $('tr:last').find('[name="roll_counte[]"]').each(function() {
                if (!$("#newOrderCustomer").validate().element($(this))) {
                    isValid = false;
                }
            });
            $('tr:last').find('[name="rate[]"]').each(function() {
                if (!$("#newOrderCustomer").validate().element($(this))) {
                    isValid = false;
                }
            });
            $('tr:last').find('[name="total[]"]').each(function() {
                if (!$("#newOrderCustomer").validate().element($(this))) {
                    isValid = false;
                }
            });
            // Prevent form submission if any field in the last row is invalid
            if (!isValid) {
                event.preventDefault();
            }
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).on('click', '.delete-color', function() {
        $("#colorModul").modal("show");
        var colorName = $(this).data('color-name');
        $('.delete-colordata').click( function(){
            $("#colorModul").modal("hide");
            $.ajax({
                url: '{{ route('color.delete') }}', 
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', 
                    color_name: colorName
                },
                success: function(response) {
                    if (response.success) {
                        $('span[data-color-name="' + colorName + '"]').closest('li').remove();
                    } else {
                        alert('Error deleting color.');
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                }
            });
        });
         
    });
    $(document).ready(function() {
        $(document).on('click', '.color-name', function() {
            var selectedColor = $(this).text();
            $(this).closest('td').find('.btn.dropdown-toggle').text(selectedColor);
            $(this).closest('td').find('.selected-color').val(selectedColor); 
        });
        $('.orderList').click( function(){
            $("#indexModul").modal("show");
        });
        
        $('.transform_data').click( function(){
            $("#customerOrderModal").modal("show");
             $('#transformForm')[0].reset();
        });
        $('.company_data').click( function(){
            $("#companyAddModal").modal("show");
             $('#customersForm')[0].reset();
        });
        $('#groupaddModul').click( function(){
            $('#groupformForm')[0].reset();
            $("#groupaddModulData").modal("show");
        });
        $('#groupaddProductModul').click( function(){
            $('#productgroupformForm')[0].reset();
            $("#groupaddProductModulData").modal("show");
        });
        $('tbody').on('click', '.color_data', function(e) {
            e.preventDefault();
            $('#colorformForm')[0].reset();
            $("#coloraddModulData").modal("show");
        });
        $('tbody').on('click', '.product_data', function(e) {
            e.preventDefault();
            console.log('data');
            $('#productformForm')[0].reset();
            $("#productOrderModal").modal("show");
        });
        function appendNewColorOption(text, value) {
            var colorDropdowns = $('tbody ul.dropdown-menu');
            colorDropdowns.each(function() {
                var newListItem = `
                    <li class="d-flex align-items-center justify-content-between dropdown-item" data-color-value="${value}">
                        <span class="color-name">${text}</span>
                        <span class="table-group-icons edit-icon-tag delete-color"data-color-name="${text}"></span>
                    </li>
                `;

                $(this).append(newListItem);
            });
        }
        function appendNewProductOption(text, value, datarolls1bdl, datapackingmaterialname, dataPmt, dataBdl, dataBharti, dataBagbox, dataId, datarate, product, datamaterial) {
            var productDropdowns = $('tbody select.product-select');
            productDropdowns.each(function() {
                // Create a new <option> element
                var newOption = $('<option></option>').val(value).text(text);

                // Set data-* attributes
                $(newOption).attr('data-pmt', dataPmt)
                .attr('data-product', JSON.stringify(product))
                    .attr('data-bdl', dataBdl)
                    .attr('data-bharti', dataBharti)
                    .attr('data-bagbox', dataBagbox)
                    .attr('data-material', datamaterial)
                    .attr('data-rolls1bdl', datarolls1bdl)
                    .attr('data-packingmaterialname', datapackingmaterialname)
                    .attr('data-rate', datarate)
                    .attr('data-id', dataId);

                
                
                // Append the new option to the select element
                $(this).append(newOption);
            });
        }
        function appendNewSKUOption(text, value, datarolls1bdl, datapackingmaterialname, dataPmt, dataBdl, dataBharti, dataBagbox, dataId, datarate, product, datamaterial) {
            var productDropdowns = $('tbody select.sku-select');
            productDropdowns.each(function() {
                // Create a new <option> element
                var newOption = new Option(text, value);
                
                // Set data-* attributes
                $(newOption).attr('data-pmt', dataPmt)
                .attr('data-product', JSON.stringify(product))
                    .attr('data-bdl', dataBdl)
                    .attr('data-bharti', dataBharti)
                    .attr('data-bagbox', dataBagbox)
                    .attr('data-material', datamaterial)
                    .attr('data-rolls1bdl', datarolls1bdl)
                    .attr('data-packingmaterialname', datapackingmaterialname)
                    .attr('data-rate', datarate)
                    .attr('data-id', dataId);

                
                // Append the new option to the select element
                $(this).append(newOption);
            });
        }
        $('#groupformForm').on('submit', function(event) {
            event.preventDefault();
            
            var formData = $(this).serialize();
            console.log(formData);
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success response
                    $('#groupaddModulData').modal('hide');
                    if (response.newOption) {
                        $('#group').append(new Option(response.newOption.text, response.newOption.value, true, true));
                        // $('#groups').append(new Option(response.newOption.text, response.newOption.value, true, true));
                    }
                    // Optionally, update the table or other parts of the page with the new data
                },
                error: function(xhr) {
                    // Handle error response
                    var errors = xhr.responseJSON.errors;
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).next('.invalid-feedback').text(errors[key][0]);
                        }
                    }
                }
            });
        });

        $('#productgroupformForm').on('submit', function(event) {
            event.preventDefault();
            
            var formData = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success response
                    $('#groupaddProductModulData').modal('hide');
                    if (response.newOption) {
                        // $('#group').append(new Option(response.newOption.text, response.newOption.value, true, true));
                        $('#productgroup').append(new Option(response.newOption.text, response.newOption.value, true, true));
                    }
                    // Optionally, update the table or other parts of the page with the new data
                },
                error: function(xhr) {
                    // Handle error response
                    var errors = xhr.responseJSON.errors;
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).next('.invalid-feedback').text(errors[key][0]);
                        }
                    }
                }
            });
        });
        $('#productformForm').on('submit', function(event) {
            event.preventDefault();
            
            var formData = $(this).serialize();
            // console.log(formData);s
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success response
                    $('#productOrderModal').modal('hide');
                    
                    if (response.newOption) {
                        if (response.newOption) {
                            console.log(response.newOption.rate);
                            appendNewProductOption(response.newOption.text, response.newOption.value, response.newOption.rolls1bdl, response.newOption.packingmaterialname, response.newOption.pmt, response.newOption.bdl, response.newOption.bharti, response.newOption.bagbox, response.newOption.id, response.newOption.rate, response.newOption.product, response.newOption.material);
                        }
                        
                    }
                    if (response.newOptionsecound) {
                        if (response.newOptionsecound) {
                            appendNewSKUOption(response.newOptionsecound.text, response.newOptionsecound.value,response.newOptionsecound.rolls1bdl,response.newOptionsecound.packingmaterialname, response.newOptionsecound.pmt, response.newOptionsecound.bdl, response.newOptionsecound.bharti, response.newOptionsecound.bagbox, response.newOptionsecound.id, response.newOptionsecound.rate, response.newOptionsecound.product, response.newOptionsecound.material);
                        }
                        
                    }
                },
                error: function(xhr) {
                    // Handle error response
                    var errors = xhr.responseJSON.errors;
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).next('.invalid-feedback').text(errors[key][0]);
                        }
                    }
                }
            });
        });
        $('#colorformForm').on('submit', function(event) {
            event.preventDefault();
            
            var formData = $(this).serialize();
            // console.log(formData);
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success response
                    $('#coloraddModulData').modal('hide');
                    if (response.newOption) {
                        if (response.newOption) {
                            appendNewColorOption(response.newOption.text, response.newOption.value);
                        }
                        
                    }
                    // Optionally, update the table or other parts of the page with the new data
                },
                error: function(xhr) {
                    // Handle error response
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        var generalMessage = xhr.responseJSON.message || 'Validation error occurred.';
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                console.log(errors[key][0]);
                                if (key === 'name') {
                                    $('#colorname').addClass('is-invalid');
                                    $('#colorname').next('.invalid-feedback').text(errors[key][0]);
                                }
                            }
                        }
                    } else {
                        console.error('An error occurred:', xhr.responseText);
                    }
                }
            });
        });
        $('#customer_add_data').on('change', function(){
            var selectId = $(this).val();function appendNewColorOption(text, value) {
                $('tbody select[name="color[]"]').each(function() {
                    // console.log('tbody select[name="color[]"]');
                    var $this = $(this);
                    var currentId = $this.attr('id');
                    
                    // Append the new option to the select element
                    $this.append(new Option(text, value));
                    // $this.trigger('change.select2');
                    
                    // Reinitialize Select2 for the updated select element
                    if (!$this.hasClass('select2-hidden-accessible')) {
                        $this.select2();
                    }
                });
            }
            var selectedOption = $(this).find('option:selected');
            var contact = selectedOption.data('no');
             $('#contactSelect').val(contact);
        });
        function toggleOptions() {
            var selectedOption = $('input[name="options"]:checked').val();
            if (selectedOption === 'Order to make') {
                $('.options').show();
            } else {
                $('.options').hide();
            }
        }
        toggleOptions();
        $('input[name="options"]').change(toggleOptions);
        $('.select2').select2();
        // var amount = 0;
        
        // function updateRollsInBdl(row,rollsInOneBDL) {
        //     var rate = parseFloat(row.find('input[name="rate[]"]').val()) || 0;
        //     var roll_counte = parseFloat(row.find('input[name="roll_counte[]"]').val()) || 0;
        //     var bdl = parseFloat(row.find('input[name="bdl_kg[]"]').val()) || 0;
        //     var bharti = parseFloat(row.find('input[name="bharti[]"]').val()) || 0;
        //     var unit_box = parseFloat(row.find('input[name="unit_box[]"]').val()) || 0;
        //     console.log('rolls',rollsInOneBDL);
        //     var roll_count = Math.round(bdl*bharti*unit_box);
        //    // var roll_count = Math.round(bdl*bharti*unit_box);
        //     var total =Math.round(rate*roll_count);
        //     console.log('correct roll',roll_count);
        //     row.find('input[name="roll_counte[]"]').val(formatIndianCurrency(roll_count));
        //     row.find('input[name="total[]"]').val(formatIndianCurrency(total));
        // }

        function updateRollsInBdl(row, rollsInOneBDL) {
    var rate = parseFloat(row.find('input[name="rate[]"]').val()) || 0;
    var roll_counte = parseFloat(row.find('input[name="roll_counte[]"]').val()) || 0;
    var bdl = parseFloat(row.find('input[name="bdl_kg[]"]').val()) || 0;
    var bharti = parseFloat(row.find('input[name="bharti[]"]').val()) || 0;
    var unit_box = parseFloat(row.find('input[name="unit_box[]"]').val()) || 0;

    console.log('rollsInOneBDL:', rollsInOneBDL);

    // Calculate roll_count using rollsInOneBDL as part of the formula
    var roll_count = Math.round(bdl * bharti * unit_box * rollsInOneBDL); // Adjust this as per your formula
    var total = Math.round(rate * roll_count);

    console.log('Calculated roll_count:', roll_count);

    // Update the fields with the calculated values
    row.find('input[name="roll_counte[]"]').val(formatIndianCurrency(roll_count));
    row.find('input[name="total[]"]').val(formatIndianCurrency(total));
}

// Event listener to trigger the calculation when input values change
$(document).on('input', 'input[name="bdl_kg[]"], input[name="rate[]"], input[name="bharti[]"], input[name="unit_box[]"]', function() {
    var row = $(this).closest('tr');  // Assumes fields are in a table row
    var rollsInOneBDL = parseFloat(row.data('rolls-in-bdl')) || 1; // Retrieve rollsInOneBDL from data attribute or set a default
    updateRollsInBdl(row, rollsInOneBDL);
});

// Format function for currency
function formatIndianCurrency(amount) {
    return new Intl.NumberFormat('en-IN').format(amount);
}

            var colorSelectCounter = 1;
        $('.add_product').click( function(){
            // var productOptions = $('tbody select.product-select').first().html();
            var productOptions = '';
            $('tbody select.product-select').first().find('option').each(function() {
                var productId = $(this).val();
                var productText = $(this).text();
                var rate = $(this).data('rate');
                var id = $(this).data('id');
                var bdl = $(this).data('bdl');
                var bharti = $(this).data('bharti');
                var bagbox = $(this).data('bagbox');
                var rolls1bdl = $(this).data('rolls1bdl');
                var packingmaterialname = $(this).data('packingmaterialname');
                var product = $(this).data('product');

                productOptions += `<option value="${productId}" 
                                    data-rate="${rate}" 
                                    data-id="${id}" 
                                    data-bdl="${bdl}" 
                                    data-bharti="${bharti}" 
                                    data-bagbox="${bagbox}" 
                                    data-rolls1bdl="${rolls1bdl}"
                                    data-packingmaterialname="${packingmaterialname}"
                                    data-product='${JSON.stringify(product)}'>${productText}</option>`;
            });
            var productSkuOptions = '';
            $('tbody select.sku-select').first().find('option').each(function() {
                var skuId = $(this).val();
                var skuText = $(this).text();
                var rate = $(this).data('rate');
                var id = $(this).data('id');
                var bdl = $(this).data('bdl');
                var bharti = $(this).data('bharti');
                var bagbox = $(this).data('bagbox');
                var rolls1bdl = $(this).data('rolls1bdl');
                var packingmaterialname = $(this).data('packingmaterialname');
                var product = $(this).data('product');

                productSkuOptions += `<option value="${skuId}" 
                                    data-rate="${rate}" 
                                    data-id="${id}" 
                                    data-bdl="${bdl}" 
                                    data-bharti="${bharti}" 
                                    data-bagbox="${bagbox}"
                                    data-rolls1bdl="${rolls1bdl}"
                                    data-packingmaterialname="${packingmaterialname}"  
                                    data-product="${JSON.stringify(product)}">${skuText}</option>`;
            });
            var productMaterialOptions = '';
            $('tbody select.material-select').first().find('option').each(function() {
                var materialText = $(this).text();
                productMaterialOptions += `<option value="${materialText}">${materialText}</option>`;
            });
            // var productSkuOptions = `@foreach($products as $product)<option value="{{$product->id}}"  data-id="{{$product->id}}">{{$product->alias_sku}} </option>@endforeach`;
            var sticerOptions = `@foreach($stickers as $sticker)<option value="{{$sticker->id}}"  data-id="{{$sticker->id}}">{{$sticker->material_name}} </option>@endforeach`;
            // var productSkuOptions = $('tbody select.sku-select').first().html();
            var colorOptions = $('tbody ul.dropdown-menu').first().html();
            var newColorSelectId = 'color_' + colorSelectCounter;
            var newField = `<tr class="table-select-data customerorder-table">
                            <td class="table-data-contents">
                                <select class="custom-select d-block w-100 form-select-grp select2 sku-select" id="alias_sku_${colorSelectCounter}" name="sku[] sku-select">
                                    ${productSkuOptions}
                                </select>
                            </td>
                        <td class="table-data-contents">
                        <select class="custom-select d-block w-100 form-select-grp select2 product-select" id="product_${colorSelectCounter}" name="product[]">
                            ${productOptions}
                        </select></td>
                        <td class="product-data-tb">
                                <div class="add-icon-btn product_data">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff" class="bi bi-plus product_data" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                    </svg>
                                </div>
                            </td>
                            <td class="table-data-contents">
                                <div class="d-flex align-items-center dropdown-cursour">
                                    <button class="btn color-select dropdown-toggle d-flex align-items-center select_color_btn" type="button" id="${newColorSelectId}_button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="${newColorSelectId}_button">
                                        ${colorOptions}
                                    </ul>
                                    
                                    <input type="hidden" name="color[]" class="selected-color"value="">
                                </div>
                            </td>
                            <td class="color-data-tb">
                                <div class="add-icon-btn color_data">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff" class="bi bi-plus color_data" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                    </svg>
                                </div>
                            </td>
                            <td class="table-data-contents">
                                <select class="form-control input-form-content form-select-grp sticker-select" id="sticker_name_${colorSelectCounter}" name="sticker_name[] sticker-select">
                                    ${sticerOptions}
                                </select>
                            </td>
                            <td class="table-data-contents">
                                <select class="custom-select d-block w-100 form-select-grp select2 material-select" id="material_${colorSelectCounter}" name="packing_material_type[] material-select">
                                    ${productMaterialOptions}
                                </select>
                            </td>
                            <td class="table-data-contents"><input class="order-input" type="text" name="bdl_kg[]" id="bdl_kg_${colorSelectCounter}" value=""></td>
                            <td class="table-data-contents"><input class="order-input" type="text" name="bharti[]" id="bharti_${colorSelectCounter}" value=""readonly></td>
                            <td class="table-data-contents"><input class="order-input" type="text" name="unit_box[]" id="unit_box_${colorSelectCounter}" value=""readonly></td>
                            <td class="table-data-contents"><input class="order-input" type="text" name="roll_counte[]" id="roll_counte_${colorSelectCounter}" value=""readonly></td>
                            <td class="table-data-contents"><input class="order-input" type="text" name="rate[]" id="rate_${colorSelectCounter}" value=""></td>
                            <td class="table-data-contents"><input class="order-input" type="text" name="total[]" id="total_${colorSelectCounter}"  value=""readonly></td>
                            <td class="table-data-contents"><input class="order-input" type="text" name="remark[]" id="remark_${colorSelectCounter}" value=""></td>
                            <td class="table-data-contents table-delete-icon"><a href="javascript:void(0)" class="btn-sm m-1 deleteRow"><span class="table-group-icons edit-icon-tag"></span></a></td>
                        </tr>`;
            $('tbody').append(newField);
            $('#' + newColorSelectId).select2(); // Initialize Select2 for the newly added color select field
            $('#alias_sku_' + colorSelectCounter).select2();
            $('#product_' + colorSelectCounter).select2();
            $('#material_' + colorSelectCounter).select2();
            colorSelectCounter++;
            // Loop through and reinitialize Select2 for all color[] select fields
            $('tbody select[name="color[]"]').each(function() {
                if ($(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2('destroy'); // Destroy previous Select2 instance
                }
                $(this).select2(); // Reinitialize Select2
            });

        });
        
        $('tbody').on('change', '.product-select', function() {
        //     var initialPriceListId = $('#price_list').val();
        // var rate = $(this).val('rate');
        // console.log('rate check this', rate)
        // fetchProductDetails(initialPriceListId);
            var selectedProduct = $(this).find('option:selected');
            var productData = selectedProduct.data('product');
            var sku = selectedProduct.data('id');
            // var pmt = selectedProduct.data('pmt');
            var rate = '';
            // console.log('productprice',productprice);
            productDetailsArray.forEach(function(productprice) {
                console.log('rate check');
                     console.log(sku);
                if (sku == productprice.product_id) {
                     rate = productprice.special_rate !== null ? productprice.special_rate : productprice.discount_rate;
                }
            });
            var bdl = selectedProduct.data('bdl');
            bdl = Math.round(bdl);
            var bharti = selectedProduct.data('bharti');
            var bagBox = selectedProduct.data('bagbox');
            var materialsData = selectedProduct.data('material');
            var rollsInOneBDL = selectedProduct.data('rolls1bdl');
            var packingMaterialName = selectedProduct.data('packingmaterialname');
            // var rollsInOneBDL = productData.rolls_in_1_bdl
            // console.log('****---',rollsInOneBDL);
            var row = $(this).closest('tr');
            // console.log(rate);
            // var packingMaterialName = (productData && productData.packing_material) ? (productData.packing_material.material_name || '') : materialsData;
            // var packingMaterialName = productData.packing_material ? productData.packing_material.material_name || '' : '';
            // var packingMaterialName = productData.packing_material ? productData.packing_material.material_name || '' :
            
            row.find('input[name="packing_material_type[]"]').val(packingMaterialName);
            // row.find('input[name="packing_material_type[]"]').val(productData.packing_material.material_name);
           // row.find('input[name="bdl_kg[]"]').val(bdl);
            row.find('input[name="unit_box[]"]').val(bagBox);
            row.find('input[name="bharti[]"]').val(bharti);
           row.find('input[name="rate[]"]').val(formatIndianCurrency(rate));
            // row.find('input[name="roll_counte[]"]').val(roll_count);
            row.find('.sku-select').val(selectedProduct.val()).trigger('change');
            row.find('.material-select').val(packingMaterialName).trigger('change');
             updateRollsInBdl(row,rollsInOneBDL);
        });

        // Update product based on SKU selection
        $('tbody').on('change', '.sku-select', function() {
            var selectedSku = $(this).find('option:selected');
            if (selectedSku.length > 0) {
                // Get the 'data-id' value from the first selected option
                var product = selectedSku.first().data('id') || ''; 
                // If 'product' is valid, execute the logic and stop further execution
                if (product) {
                    // console.log('First Product ID:', product); // Print the first product ID
                    
                    var row = $(this).closest('tr');
                    var currentProduct = row.data('currentProduct');
                    if (product && product !== currentProduct) {
                        // console.log('First Product ID:', product);
                        row.data('currentProduct', product);
                        row.find('.product-select').val(selectedSku.val()).trigger('change');
                        
                    }
                    // row.find('.product-select').val(selectedSku.val()).trigger('change');
                    return;
                }
            }
        });        
        $('tbody').on('click', '.deleteRow', function() {
            // if (confirm('Are you sure you want to delete this row?')) {
                $(this).closest('tr').remove();
                updateTotalAmount();
            // }
        });
        
    });
</script>
<script>
    $(document).ready(function() {
        $('#transformForm').on('submit', function(event) {
            event.preventDefault();
            
            var formData = $(this).serialize();
            console.log(formData);
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    $('#customerOrderModal').modal('hide');
                    if (response.newOption) {
                        $('#packing_name').append(new Option(response.newOption.text, response.newOption.value));
                    }
                    // Optionally, update the table or other parts of the page with the new data
                },
                error: function(xhr) {
                    // Handle error response
                    var errors = xhr.responseJSON.errors;
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).next('.invalid-feedback').text(errors[key][0]);
                        }
                    }
                }
            });
        });

        // Remove invalid feedback on input focus
        $('.input-form-content').on('focus', function() {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').text('');
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#customersForm').on('submit', function(event) {
            event.preventDefault();
            
            var formData = $(this).serialize();
            console.log(formData);
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    $('#companyAddModal').modal('hide');
                    if (response.newOption) {
                        var newOption = $('<option>', {
                            value: response.newOption.value,
                            text: response.newOption.text,
                            'data-no': response.newOption['data-no']
                        });
                        $('#customer_add_data').append(newOption);
                    }
                    // Optionally, update the table or other parts of the page with the new data
                },
                error: function(xhr) {
                    // Handle error response
                    var errors = xhr.responseJSON.errors;
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).next('.invalid-feedback').text(errors[key][0]);
                        }
                    }
                }
            });
        });

        // Remove invalid feedback on input focus
        $('.input-form-content').on('focus', function() {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').text('');
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {   
        $('.select2').select2();
        var countryId = $('#country').val();
        var default_state_id = {{ old('state_id', 12) }};
        var default_city_id = {{ old('city_id', 783) }};

        function loadStates(countryId, selected_state_id = null) {
            $.ajax({
                url: "{{ route('customers.getstate', ':countryId') }}".replace(':countryId', countryId),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#state').empty();
                    $('#state').append('<option value="">Select State</option>');
                    $.each(data, function(key, value) {
                        $('#state').append('<option value="'+ value.id +'"'+ (selected_state_id == value.id ? ' selected' : '') +'>'+ value.name +'</option>');
                    });
                    if (selected_state_id) {
                        loadCities(selected_state_id, default_city_id);
                    }
                }
            });
        }
        function loadCities(stateId, selected_city_id = null) {
            $.ajax({
                url: "{{ route('customers.getcity', ':stateId') }}".replace(':stateId', stateId),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#city').empty();
                    $('#city').append('<option value="">Select City</option>');
                    $.each(data, function(key, value) {
                        $('#city').append('<option value="'+ value.id +'"'+ (selected_city_id == value.id ? ' selected' : '') +'>'+ value.name +'</option>');
                    });
                }
            });
        }

        $('#country').change(function() {
            var countryId = $(this).val();
            loadStates(countryId);
            $('#city').empty();
            $('#city').append('<option value="">Select City</option>');
        });

        $('#state').change(function() {
            var stateId = $(this).val();
            loadCities(stateId);
        });

        // Load states and cities for the default country
        if (countryId) {
            loadStates(countryId, default_state_id);
        }
    });

</script>
<script type="text/javascript">
    $(document).ready(function() {
        // $('#category').on('change', function() {
        //     console.log('data');
        //     var selectedCategory = $(this).val();
        //     if (selectedCategory === 'Plastic Roll' || selectedCategory === 'Plastic Jumbo Roll') {
        //         $('#gauge-field').show();
        //     } else {
        //         // console.log(selectedCategory);
        //         $('#gauge-field').hide();
        //     }
        //     if (selectedCategory === 'Paper Roll' || selectedCategory === 'Paper Sheet') {
        //         $('#gsm-field').show();
        //     } else {
        //         $('#gsm-field').hide();
        //     }
        //     if(selectedCategory === 'Paper Sheet'){
        //         $('#paperSheet').attr('style', 'display:none;');
        //         $('#paperSheetPacking').attr('style', 'display:none;');
        //         $('#paperSheetCarton').attr('style', 'display:none;');
                
        //     }else{
        //         $('#paperSheet').removeAttr('style');
        //         $('#paperSheetPacking').removeAttr('style');
        //         $('#paperSheetCarton').removeAttr('style');
                
        //     }
        //     if( selectedCategory === 'Plastic Roll'){
        //         $('#pipe_size').val('');
        //         $('#pipe_size').prop('readonly', false);
        //     }else{
        //         $('#pipe_size').val(0); 
        //         $('#pipe_size').prop('readonly', true);
        //     }
        // });

        // // Trigger the change event on page load to set the correct visibility
        // $('#category').trigger('change');
        // $('.select2').select2();
        // let bhartidata = 0, bagBox = 0, roll_weight = 0, width = 0, length = 0, gsm = 0;
        // function updateRollsInBdl() {
        //     let rollIn1 = Math.round(bhartidata * bagBox);
            
        //     let sheetwigth = Math.round((width * length*(parseInt(gsm) + 6)/1550000)/1000);
        //     let bdl_kg1 = Math.round(rollIn1 * sheetwigth);
        //     $('#rolls_in_1_bdl').val(rollIn1);
        //     $('#bdl_kg').val(bdl_kg1);
        //     $('#roll_weight').val(sheetwigth);
        // }
        // // let bhartidata, bagBox, rollIn1;
        
        // $('#bharti').keyup(function(){
        //     bhartidata = $(this).val();
        //     updateRollsInBdl();
            
        // });
        // $('#number_of_bags_per_box').keyup( function(){
        //     bagBox = $(this).val();
        //     updateRollsInBdl();
            
        // });
        // $('#roll_weight').keyup( function(){
        //     roll_weight = $(this).val();
        //     updateRollsInBdl();
            
        // });
        // $('#width').keyup( function(){
            
        //     width = $(this).val();
        //     updateRollsInBdl();
        // });
        // $('#length').keyup( function(){
        //     length = $(this).val();
        //     updateRollsInBdl();
        // });
        // $('#gsm').keyup( function(){
        //     gsm = $(this).val();
        //     updateRollsInBdl();
        // });
        $('#category').on('change', function() {
            var selectedCategory = $(this).val();
            if (selectedCategory === 'Plastic Roll' || selectedCategory === 'Plastic Jumbo Roll') {
                $('#gauge-field').show();
            } else {
                $('#gauge-field').hide();
            }
            if (selectedCategory === 'Paper Roll' || selectedCategory === 'Paper Sheet') {
                $('#gsm-field').show();
            } else {
                $('#gsm-field').hide();
            }
            if(selectedCategory === 'Paper Sheet'){
                $('#rollWeight').attr('style', 'display:none;');
                // $('#sheetWeight').attr('style', 'display:none;');
                $('#sheetWeight').removeAttr('style');
                $('#paperSheetPacking').attr('style', 'display:none;');
                $('#paperSheetCarton').attr('style', 'display:none;');
                $('#rollWegithtoSheetweight').removeAttr('style');
            }else{
                $('#rollWeight').removeAttr('style');
                // $('#sheetWeight').removeAttr('style');
                $('#sheetWeight').attr('style', 'display:none;');
                $('#paperSheetPacking').removeAttr('style');
                $('#paperSheetCarton').removeAttr('style');
                $('#rollWegithtoSheetweight').attr('style', 'display:none;');
            }
            // if( selectedCategory === 'Paper Roll'){
            //     $('#pipesize').attr('style', 'display:none;');
            // }else{
            //     $('#pipesize').removeAttr('style');
            // }
            if( selectedCategory === 'Plastic Roll'){
                $('#pipe_size').val('');
                $('#pipe_size').prop('readonly', false);
                $('#gramPerMeter').removeAttr('style');
            }else{
                $('#pipe_size').val(0); 
                $('#pipe_size').prop('readonly', true);
                $('#gramPerMeter').attr('style', 'display:none;');
            }
        });

        $('#category').trigger('change');
        $('.select2').select2();
        let bhartidata = 0, bagBox = 0, roll_weight = 0, width = 0, length = 0, gsm = 0,gage = 0, numberOfOuter = 0;
        function updateRollsInBdl() {
            bhartidata = parseFloat(bhartidata);
            bagBox = parseFloat(bagBox);
              width = parseFloat(width);
               length = parseFloat(length);
                gsm = parseFloat(gsm);
                gage = parseFloat(gage);
                numberOfOuter = parseFloat(numberOfOuter);
                let gramPerMeter = (((gage/4 )* 0.95 ) * (width/39.37)).toFixed(3);
            let rollIn1 = (bhartidata * bagBox);
            let selectedOption = $('select[name="pipe_size"] option:selected');
            let materialWeight = parseFloat(selectedOption.data('weight')) || 0;
            let selectedMaterial = $('select[name="packing_material_name"] option:selected');
            let materialNameWeight = parseFloat(selectedMaterial.data('weight')) || 0;

            let selectedouter = $('select[name="outer_name"] option:selected');
            let outernameWeight = parseFloat(selectedouter.data('weight')) || 0;

            let selectedcarton_no = $('select[name="carton_no"] option:selected');
            let selectedcartonweight = parseFloat(selectedcarton_no.data('weight')) || 0;

            //let numberOfOuter = document.getElementById('number_of_outer').value;
            let number_of_bags_per_box = document.getElementById('number_of_bags_per_box').value;

            let masterPacking = document.querySelector('input[name="master_packing"]:checked').value;
            console.log('selectedcartonweight:', selectedcartonweight);

            var selectedCat = $('#category').find('option:selected').text();
            //let sheetwigth = (width * length*(gsm + 6)/1550000).toFixed(3);
            let sheetwigth = (width && length && gsm) 
        ? (width * length * (gsm + 6) / 1550000).toFixed(3) 
        : 0;
           // let rollweight = (length/(1000/(gsm+6)*39.37/width)+0.57/rollIn1).toFixed(3);
            let rollweight = (width && length && gsm && rollIn1) 
        ? (length / (1000 / (gsm + 6) * 39.37 / width) + 0.57 / rollIn1).toFixed(3) 
        : 0;
            let bdl_kg1 = (rollIn1 * rollweight).toFixed(3);
            $('#rolls_in_1_bdl').val(rollIn1);
        //    $('#bdl_kg').val(bdl_kg1);
            $('#bdl_kg').val((rollIn1 * (length/(1000/(gsm+6)*39.37/width)+0.57/rollIn1).toFixed(3)).toFixed(3));
            $('#gram_per_meter').val(gramPerMeter);
            // if(selectedCat == 'Paper Sheet'){
            $('#roll_weight_to_sheet_weight').val(sheetwigth);
            $('#sheet_weight').val(sheetwigth);
            // }else{
                // $('#sheet_weight').val(sheetwigth);
                $('#roll_weight').val(rollweight);
            // }roll_weight
            let test1 = (materialWeight *rollIn1)
            let materilnameWeight1 = (materialNameWeight *rollIn1)
            let numberOfOuterval = (outernameWeight *numberOfOuter*number_of_bags_per_box)
            let masterpacking = '';
            if(masterPacking == 'Box'){
              masterpacking = (selectedcartonweight*number_of_bags_per_box)
              console.log('Box');
              console.log(masterpacking);
            }else{
                masterpacking = (0.120*number_of_bags_per_box)
                console.log('Bag');
                console.log(masterpacking);
            }
            if(selectedCat == 'Plastic Roll'){
                // $('#rollWeightText').text('((Gauge/4)*0.95*Width/39.37/1000)*Length * Rolls in 1 Bdl');
                $('#rollWeightText').text(
                    '((((Gauge/4)*0.95*Width/39.37/1000)*Length * Rolls in 1 Bdl) + (Paper Tube material weight from the material master * Rolls in 1 BDL) + (Packing materila name material weight from the material master * Rolls in 1 bdl) + (Outer name material weight from the material master * number of outer used per box * Bag/Box per bundle) + (If Box(Carton name material weight from the material master* Bags/Box) or if Bag(0.120* Bag/Box)) + (Kantan weight))/Rolls in 1 BDL'
                );

                //$('#roll_weight').val((((gage / 4) * 0.95 * width / 39.37 / 1000) * length * rollIn1).toFixed(3) + ' + ' + (test1.toFixed(3)) + ' + ' + (materilnameWeight1.toFixed(3))+ ' + ' + (numberOfOuterval.toFixed(3))+ ' + ' + (masterpacking.toFixed(3))+ ' + ' + 0.15);
                console.log((((gage / 4) * 0.95 * width / 39.37 / 1000) * length * rollIn1).toFixed(3) + ' + ' + (test1.toFixed(3)) + ' + ' + (materilnameWeight1.toFixed(3))+ ' + ' + (numberOfOuterval.toFixed(3))+ ' + ' + (masterpacking.toFixed(3))+ ' + ' + 0.15);
                var plasticRollWeight = (
                (parseFloat((gage / 4) * 0.95 * width / 39.37 / 1000 * length) / rollIn1 +
                parseFloat(test1) / rollIn1 +
                parseFloat(materilnameWeight1) / rollIn1 +
                parseFloat(numberOfOuterval) / rollIn1 +
                parseFloat(masterpacking) / rollIn1 +
                0.15 / rollIn1).toFixed(3)
                ); 
               $('#roll_weight').val(plasticRollWeight);
               $('#bdl_kg').val((plasticRollWeight*rollIn1).toFixed(3));
            }
            else{
                $('#rollWeightText').text('(Length/(1000/(GSM+6)*39.37/Width)+0.57/Roll in 1 Bdl)');
            }
            if(selectedCat == 'Paper Sheet'){
                $('#bdl_kg').val(sheetwigth*rollIn1);
            }
        }
        
        $('#roll_weight').on('input', function () {
            let rollWeight = parseFloat($(this).val());
            let rollsIn1Bdl = parseFloat($('#rolls_in_1_bdl').val());

            if (!isNaN(rollWeight) && !isNaN(rollsIn1Bdl)) {
                let bdlKg = (rollsIn1Bdl * rollWeight).toFixed(3);
                $('#bdl_kg').val(bdlKg);
            } else {
                $('#bdl_kg').val('');
            }
        });
        $('input[name="master_packing"]').change(function () {
            if ($(this).is(':checked')) {
                let masterPacking = $(this).val();

                updateRollsInBdl(masterPacking);
            }
        });
        $('#bharti').keyup(function(){
            bhartidata = $(this).val();
            updateRollsInBdl();
            
        });
        $('select[name="pipe_size"]').change(function() {
            updateRollsInBdl();
        });
        $('select[name="outer_name"]').change(function() {
            updateRollsInBdl();
        });
        $('select[name="carton_no"]').change(function() {
            updateRollsInBdl();
        });
        $('select[name="category"]').change(function() {
            updateRollsInBdl();
        });
        $('#number_of_outer').keyup(function(){
            numberOfOuter = $(this).val();
            updateRollsInBdl();
            
        });
        $('select[name="packing_material_name"]').off('change').on('change', function() {
            updateRollsInBdl(); // Call the function on change
        });
        $('#number_of_bags_per_box').keyup( function(){
            bagBox = $(this).val();
            updateRollsInBdl();
            
        });
        // $('#roll_weight').keyup( function(){
        //     roll_weight = $(this).val();
        //     updateRollsInBdl();
            
        // });
        $('#width').keyup( function(){
            
            width = $(this).val();
            updateRollsInBdl();
        });
        $('#length').keyup( function(){
            length = $(this).val();
            updateRollsInBdl();
        });
        $('#gsm').keyup( function(){
            gsm = $(this).val();
            updateRollsInBdl();
        });
        $('#gage').keyup( function(){
            gage = $(this).val();
            updateRollsInBdl();
        });
    });
</script>
<script>
    $(document).ready(function () {
    //         $('#category').on('change', function() {
    //             var selectedCategory = $(this).find('option:selected').text();;
    //             if (selectedCategory === 'Plastic Roll' || selectedCategory === 'Plastic Jumbo Roll') {
    //                 $('#rollWegithtoSheetweight').attr('style', 'display:none;');
    //                 $('#gauge-field').show();
    //             } else {
    //                 // console.log(selectedCategory);
    //                 $('#gauge-field').hide();
    //                 $('#rollWegithtoSheetweight').removeAttr('style');
    //             }
    //             if (selectedCategory === 'Paper Roll' || selectedCategory === 'Paper Sheet') {
    //                 $('#gsm-field').show();
                    
    //             } else {
    //                 $('#gsm-field').hide();
                    
    //             }
    //             if(selectedCategory === 'Plastic Jumbo Roll'){
    //                 $('#lengthInMeters').attr('style', 'display:none;');
                    
    //             }else{
    //                 $('#lengthInMeters').removeAttr('style');
                    
    //             }
    //             if(selectedCategory === 'Paper Sheet'){
    //                 $('#rollWeight').attr('style', 'display:none;');
    //                 $('#sheetWeight').attr('style', 'display:none;');
    //                 // $('#paperSheet').attr('style', 'display:none;');
    //                 $('#rollWegithtoSheetweight').removeAttr('style');
    //                 $('#paperSheetPacking').attr('style', 'display:none;');
    //                 $('#paperSheetCarton').attr('style', 'display:none;');
                    
    //             }else{
    //                 $('#rollWeight').removeAttr('style');
    //                 $('#sheetWeight').removeAttr('style');
    //                 // $('#paperSheet').removeAttr('style');
    //                 $('#paperSheetPacking').removeAttr('style');
    //                 $('#paperSheetCarton').removeAttr('style');
    //                 $('#rollWegithtoSheetweight').attr('style', 'display:none;');
                    
    //             }
    //             if( selectedCategory === 'Plastic Roll'){
    //                 $('#pipe_size').val('');
    //                 $('#pipe_size').prop('readonly', false);
    //             }else{
    //                 $('#pipe_size').val(0); 
    //                 $('#pipe_size').prop('readonly', true);
    //             }
    //         });

    //         // Trigger the change event on page load to set the correct visibility
    //         $('#category').trigger('change');
        
        
    // });
            $('#category').on('change', function() {
                var selectedCategory = $(this).find('option:selected').text();;
                if (selectedCategory === 'Plastic Roll' || selectedCategory === 'Plastic Jumbo Roll') {
                    $('#rollWegithtoSheetweight').attr('style', 'display:none;');
                    
                    $('#gauge-field').show();
                } else {
                    $('#gauge-field').hide();
                    $('#rollWegithtoSheetweight').removeAttr('style');
                    $('#rollWeight').attr('style', 'display:none;');
                   // $('#sheetWeight').attr('style', 'display:none;');
                }
                // if(selectedCategory === 'Paper Sheet') {
                //     $('#rollWegithtoSheetweight').attr('style', 'display:none;');
                // }else{
                //     $('#rollWegithtoSheetweight').attr('style', 'display:none;');
                // }
                if (selectedCategory === 'Paper Roll' || selectedCategory === 'Paper Sheet') {
                    $('#gsm-field').show();
                    
                } else {
                    $('#gsm-field').hide();
                    
                }
                if(selectedCategory === 'Plastic Jumbo Roll'){
                    $('#lengthInMeters').attr('style', 'display:none;');
                    
                }else{
                    $('#lengthInMeters').removeAttr('style');
                    
                }
                // if( selectedCategory === 'Paper Roll'){
                //     $('#pipesize').attr('style', 'display:none;');
                // }else{
                //     $('#pipesize').removeAttr('style');
                // }
                if( selectedCategory === 'Plastic Roll'){
                    $('#pipe_size').val('');
                    $('#pipe_size').prop('readonly', false);
                    $('#gramPerMeter').removeAttr('style');
                }else{
                    $('#gramPerMeter').attr('style', 'display:none;');
                    $('#pipe_size').val(0); 
                    $('#pipe_size').prop('readonly', true);
                }
                if(selectedCategory === 'Paper Sheet'){
                    $('#rollWeight').attr('style', 'display:none;');
                    $('#sheetWeight').removeAttr('style');
                    // $('#sheetWeight').attr('style', 'display:none;');
                    $('#paperSheetPacking').attr('style', 'display:none;');
                    $('#paperSheetCarton').attr('style', 'display:none;');
                    $('#rollWegithtoSheetweight').removeAttr('style');
                    
                }else{
                    $('#rollWeight').removeAttr('style');
                    $('#sheetWeight').attr('style', 'display:none;');
                    // $('#sheetWeight').removeAttr('style');
                    $('#paperSheetPacking').removeAttr('style');
                    $('#paperSheetCarton').removeAttr('style');
                    $('#rollWegithtoSheetweight').attr('style', 'display:none;');
                }
            });

            $('#category').trigger('change');
        
    });
    // document.addEventListener('DOMContentLoaded', function () {
    //     const addGroupButton = document.getElementById('add_group_button');
    //     const saveNewGroupButton = document.getElementById('save_new_group_button');
    //     const groupNameWrapper = document.getElementById('group_name_wrapper');
    //     const newGroupNameWrapper = document.getElementById('new_group_name_wrapper');
    //     const groupNameSelect = document.getElementById('group_name_select');
    //     const newGroupNameInput = document.getElementById('new_group_name');

    //     addGroupButton.addEventListener('click', function () {
    //         groupNameWrapper.classList.add('d-none');
    //         newGroupNameWrapper.classList.remove('d-none');
    //     });

    //     saveNewGroupButton.addEventListener('click', function () {
    //         const newGroupName = newGroupNameInput.value.trim();
    //         if (newGroupName) {
    //             $.ajax({
    //                 url: '{{ route('product.storeGroup') }}',
    //                 type: 'POST',
    //                 data: {
    //                     _token: '{{ csrf_token() }}',
    //                     name: newGroupName
    //                 },
    //                 success: function (response) {
    //                     if (response.success) {
    //                         const newOption = document.createElement('option');
    //                         newOption.value = response.group.id;
    //                         newOption.textContent = response.group.name;
    //                         newOption.selected = true;
    //                         groupNameSelect.appendChild(newOption);

    //                         newGroupNameInput.value = '';
    //                         groupNameWrapper.classList.remove('d-none');
    //                         newGroupNameWrapper.classList.add('d-none');
    //                         toastr.success('Group name added successfully!');
    //                         } else {
    //                             toastr.error(response.error);
    //                         }
    //                     },
    //                     error: function (response) {
    //                         toastr.error('Error adding new group name.');
    //                     }
    //             });
    //         } else {
    //             toastr.error('Please enter a group name.');
    //         }
    //     });
    // });
    // document.addEventListener('DOMContentLoaded', function () {
    //     const addGroupButton = document.getElementById('add_group_button');
    //     const saveNewGroupButton = document.getElementById('save_new_group_button');
    //     const groupNameWrapper = document.getElementById('group_name_wrapper');
    //     const newGroupNameWrapper = document.getElementById('new_group_name_wrapper');
    //     const groupNameSelect = document.getElementById('group_name_select');
    //     const newGroupNameInput = document.getElementById('new_group_name');

    //     addGroupButton.addEventListener('click', function () {
    //         groupNameWrapper.classList.add('d-none');
    //         newGroupNameWrapper.classList.remove('d-none');
    //     });

    //     saveNewGroupButton.addEventListener('click', function () {
    //         const newGroupName = newGroupNameInput.value.trim();
    //         if (newGroupName) {
    //             $.ajax({
    //                 url: '{{ route('product.storeGroup') }}',
    //                 type: 'POST',
    //                 data: {
    //                     _token: '{{ csrf_token() }}',
    //                     name: newGroupName
    //                 },
    //                 success: function (response) {
    //                     if (response.success) {
    //                         const newOption = document.createElement('option');
    //                         newOption.value = response.group.id;
    //                         newOption.textContent = response.group.name;
    //                         newOption.selected = true;
    //                         groupNameSelect.appendChild(newOption);

    //                         newGroupNameInput.value = '';
    //                         groupNameWrapper.classList.remove('d-none');
    //                         newGroupNameWrapper.classList.add('d-none');
    //                         toastr.success('Group name added successfully!');
    //                         } else {
    //                             toastr.error(response.error);
    //                         }
    //                     },
    //                     error: function (response) {
    //                         toastr.error('Error adding new group name.');
    //                     }
    //             });
    //         } else {
    //             toastr.error('Please enter a group name.');
    //         }
    //     });
    // });
</script>
<script>
$(document).ready(function() {
    $('#packing_material_category').on('change', function() {
        var selectedCategoryId = $(this).val();
        var packingMaterialTypeDiv = $('#packing_material_type_div');
        var packingMaterialTypeSelect = $('#packing_material_type');
        var packingMaterialNameSelect = $('#packing_material_name');

        packingMaterialTypeSelect.empty().append('<option value="">Select material Type</option>');
        packingMaterialNameSelect.empty().append('<option value="">Select material Name</option>');

        if (selectedCategoryId) {
            $.ajax({
                url: '{{ route("material.getSubcategories", ":id") }}'.replace(':id', selectedCategoryId),
                type: 'GET',
                success: function(data) {
                    console.log(data.subcategories);
                    if (data.subcategories.length > 0) {
                        packingMaterialTypeSelect.empty().append('<option value="">Select subcategory</option>');
                        $.each(data.subcategories, function(index, subcategory) {
                            // packingMaterialTypeSelect.append('<option value="' + subcategory.id + '">' + subcategory.sub_cat_name + '</option>');
                            packingMaterialTypeSelect.append('<option value="' + subcategory.id + '">' + subcategory.sub_cat_name + '</option>');
                        });
                        // packingMaterialTypeSelect.find('option:eq(1)').prop('selected', true);
                        packingMaterialTypeSelect.find('option:eq(1)').prop('selected', true);
                        packingMaterialTypeDiv.show();

                        var selectedSubCategoryId = packingMaterialTypeSelect.val();
                        // var selectedSubCategoryId = packingMaterialTypeSelect.val();
                        console.log('Initially selected subcategory ID:', selectedSubCategoryId);
                        loadMaterialNames(selectedCategoryId, selectedSubCategoryId);

                        // Handle subcategory change
                        packingMaterialTypeSelect.off('change').on('change', function() {
                            var selectedSubCategoryId = $(this).val();
                            if (selectedSubCategoryId) {
                                loadMaterialNames(selectedCategoryId, selectedSubCategoryId);
                            } else {
                                packingMaterialNameSelect.empty().append('<option value="">Select material Name</option>');
                            }
                        });
                    } else {

                        packingMaterialTypeDiv.hide();
                        loadMaterialNames(selectedCategoryId, null);
                    }
          
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        } else {
            packingMaterialTypeDiv.hide();
            packingMaterialNameSelect.empty().append('<option value="">Select material Name</option>');
        }
    });

    $('#packing_material_type').on('change', function() {
        var selectedSubCategoryId = $(this).val();
        var packingMaterialTypeDiv = $('#packing_material_type_div');
        var packingMaterialTypeSelect = $('#packing_material_type');
        var packingMaterialNameSelect = $('#packing_material_name');

        //packingMaterialTypeSelect.empty().append('<option value="">Select material Type</option>');
        packingMaterialNameSelect.empty().append('<option value=""></option>');

        if (selectedSubCategoryId) {
            $.ajax({
            url: '{{ route("material.getMaterialsBySubCat", ":id") }}'.replace(':id', selectedSubCategoryId),
            type: 'GET',
            success: function(materials) {
                // var materials = response.materials;
                console.log('Materials:', materials.materials.length);
                var packingMaterialNameSelect = $('#packing_material_name');
                packingMaterialNameSelect.empty().append('<option value=""></option>');

                if (materials.materials.length > 0) {
                    $.each(materials.materials, function(index, material) {
                        // Append each material to the select dropdown
                        packingMaterialNameSelect.append('<option value="' + material.id + '">' + material.material_name + '</option>');
                    });
                    packingMaterialNameSelect.find('option:eq(1)').prop('selected', true);
                } else {
                    // Show a message if no materials are available
                    packingMaterialNameSelect.append('<option value="">No materials available</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
        } else {
            packingMaterialTypeDiv.hide();
            packingMaterialNameSelect.empty().append('<option value="">Select material Name</option>');
        }
    });

    function loadMaterialNames(categoryId, subcategoryId = null) {
        console.log(categoryId);
        console.log(subcategoryId);
        $.ajax({
            url: '{{ route("material.getMaterials", ["categoryId" => ":categoryId", "subcategoryId" => ":subcategoryId"]) }}'
                    .replace(':categoryId', categoryId)
                    .replace(':subcategoryId', subcategoryId ? subcategoryId : ''),
            type: 'GET',
            success: function(materials) {
                // var materials = response.materials;
                console.log('Materials:', materials.materials.length);
                var packingMaterialNameSelect = $('#packing_material_name');
                packingMaterialNameSelect.empty().append('<option value="">Select material Name</option>');

                if (materials.materials.length > 0) {
                    $.each(materials.materials, function(index, material) {
                        // Append each material to the select dropdown
                        packingMaterialNameSelect.append('<option value="' + material.id + '">' + material.material_name + '</option>');
                    });
                    packingMaterialNameSelect.find('option:eq(1)').prop('selected', true);
                } else {
                    // Show a message if no materials are available
                    packingMaterialNameSelect.append('<option value="">No materials available</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }
});
</script>
<script>
    const decimalInputs = document.querySelectorAll('.decimal-input');

    decimalInputs.forEach(input => {
        input.addEventListener('input', function () {
            const parts = this.value.split('.');
            if (parts.length > 2) {
                this.value = parts[0] + '.' + parts.slice(1).join('');
            }
            if (parts[1] && parts[1].length > 3) {
                this.value = parts[0] + '.' + parts[1].slice(0, 3);
            }
        });
    });

    function validateInputs() {
        let valid = true;
        decimalInputs.forEach(input => {
            const regex = /^\d+(\.\d{1,3})?$/; 
            if (!regex.test(input.value)) {
                alert(`Please enter a valid number with up to three decimal places in ${input.placeholder}.`);
                valid = false; 
            }
        });
        return valid;
    }
</script>
@endsection
@section('modul')
<div class="modal fade" id="customerOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog color-model-popup">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Transport Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('transform.add') }}" method="POST" id="transformForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-1">
                            <label class="heading-content" for="name">Name</label>
                            <input type="text" class="form-control input-form-content @error('name') is-invalid @enderror @if(!empty(old('name'))) is-valid @endif" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 mb-1">
                            <label class="heading-content" for="contact">Phone</label>
                            <input type="text" class="form-control input-form-content @error('phone') is-invalid @enderror @if(!empty(old('phone'))) is-valid @endif" id="phone" name="phone" placeholder="Enter phone number" value="{{ old('phone') }}">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-1">
                            <label class="heading-content" for="location">Location</label>
                            <input type="text" class="form-control input-form-content @error('location') is-invalid @enderror @if(!empty(old('location'))) is-valid @endif" id="location" name="location" placeholder="Enter location" value="{{ old('location') }}">
                            @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            
                        </div>
                        <div class="col-12 mb-1">
                            <label class="heading-content" for="pin">Pin</label>
                            <input type="text" class="form-control input-form-content @error('pin') is-invalid @enderror @if(!empty(old('pin'))) is-valid @endif" id="pin" name="pin" placeholder="Enter pin code" value="{{ old('pin') }}">
                            @error('pin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="button-1">
                            <button type="submit" class="delete-customer">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="productOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data modal-details-widthh">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('productform.add') }}" method="POST" id="productformForm">
                @csrf
                <div class="modal-body">
                    <div class="row form-inp-group">
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content"  for="category">Category</label>
                            <select name="category" id="category" class="custom-select d-block w-100 form-select-grps form-control select2">
                                <option class="option-desgn" value="" hidden>Select Category</option>
                                @foreach($category as $categories)
                                    <option value="{{$categories->id}}"{{ old('category') == $categories->id ? 'selected' : '' }}>{{$categories->name}}</option>
                                @endforeach
                            </select>
                            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="Name">Product Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('product_name') is-invalid @enderror @if(!empty(old('product_name'))) is-valid @endif" name="product_name" id="product_name"  value="{{old('product_name')}}" required >
                            @error('product_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-6 mb-1 groupname_details" id="group_name_wrapper">
                            <div class="col-md-10 mb-1">
                                <label class="heading-content" for="group_name">Group Name <span style="color: red;">*</span></label>
                                <select class="form-control select2 form-select-grp input-form-content @error('name') is-invalid @enderror @if(!empty(old('name'))) is-valid @endif" id="group_name_select" name="group_name" required>
                                    <option value="">Select Group Name</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}" {{ old('name') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                    @endforeach
                                </select>
                                @error('group_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="add-icon-btn add-icon-center-btn" id="groupaddProductModul">
                                <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff" class="bi bi-plus" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg>
                            </div> 
                        </div>
                        
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content"  for="AliasSku">Alias / SKU<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('alias_sku') is-invalid @enderror @if(!empty(old('alias_sku'))) is-valid @endif" id="alias_sku"  required name="alias_sku" value="{{old('alias_sku')}}">
                            @error('alias_sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-4 mb-1">
                            <label class="heading-content"  for="width">Width in inches<span style="color: red;">*</span></label>
                            <input type="text" class="decimal-input form-control input-form-content @error('width') is-invalid @enderror @if(!empty(old('width'))) is-valid @endif" id="width" name="width" value="{{old('width')}}" >
                            @error('width')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-4 mb-1" id="lengthInMeters">
                            <label class="heading-content"  for="length">Length in meters<span style="color: red;">*</span></label>
                            <input type="text" class="decimal-input form-control input-form-content @error('length') is-invalid @enderror @if(!empty(old('length'))) is-valid @endif" id="length" name="length" value="{{old('length')}}">
                            @error('length')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-4 mb-1" id="gsm-field" style="display:none;">
                            <label class="heading-content"  for="GSM">GSM</label>
                            <input type="text" class="decimal-input form-control input-form-content @error('gsm') is-invalid @enderror @if(!empty(old('gsm'))) is-valid @endif" id="gsm" name="gsm" value="{{ old( 'gsm' ) }}">
                            @error('gsm')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-3 mb-3" id="gauge-field" style="display:none;">
                            <label class="heading-content"  for="Gauge">Gauge</label>
                            <input type="text" class="decimal-input form-control input-form-content @error('gage') is-invalid @enderror @if(!empty(old('gage'))) is-valid @endif" id="gage" name="gage" value="{{ old( 'gage' ) }}">
                            @error('gage')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-4 mb-1 master-radio">
                            <label class="heading-content" for="name">Master Packing</label>
                            <div class="form-radio-sec">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input custom-radio" name="master_packing" id="master_packing_bag" value="Bag">
                                    <label class="form-check-label" for="master_packing_bag">Bag</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input custom-radio" name="master_packing" id="master_packing_box" value="Box" checked>
                                    <label class="form-check-label" for="master_packing_box">Box</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Specifications</h5>
                </div>
                <div class="modal-body">
                    <div class="upload-file-sec">
                        <div class="row form-inp-group">
                            <div class="col-lg-4 mb-1">
                                <label class="heading-content"  for="BhartiContact">Bharti<span style="color: red;">*</span></label>
                                <input type="number" step="0.001" min="0" class="decimal-input form-control input-form-content @error('bharti') is-invalid @enderror @if(!empty(old('bharti'))) is-valid @endif" name="bharti" value="{{ old( 'bharti' ) }}" id="bharti">
                                @error('bharti')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title"></span>
                            </div>
                            <div class="col-lg-4 mb-1">
                                <label class="heading-content"  for="number">Bags/Box<span style="color: red;">*</span></label>
                                <input type="number" step="0.001" min="0" class="decimal-input form-control input-form-content @error('number_of_bags_per_box') is-invalid @enderror @if(!empty(old('number_of_bags_per_box'))) is-valid @endif" id="number_of_bags_per_box" name="number_of_bags_per_box" value="{{ old( 'number_of_bags_per_box' )}}">
                                @error('number_of_bags_per_box')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title">Per Bundle</span>
                            </div>
                            <div class="col-lg-4 mb-1" id="pipesize">
                                <label class="heading-content"  for="name">Paper Tube</label>
                                <select name="pipe_size" class="custom-select d-block w-100 form-select-grps form-control select2">
                                    <option value="">Select Paper Tube</option>
                                    @foreach($pipeSizes as $size)
                                        <option data-weight="{{$size->material_weight}}" value="{{ $size->id }}" {{ old('pipe_size') == $size->id ? 'selected' : '' }}>{{ $size->material_name }}</option>
                                    @endforeach    
                                </select>
                            </div>
                        </div>
                        <div class="row form-inp-group">
                            <div class="col-lg-6 mb-3" id="rollWegithtoSheetweight">
                                <label class="heading-content"  for="number">Roll Weight to Sheet Weight</label>
                                <input type="number" class="decimal-input form-control input-form-content @error('roll_weight_to_sheet_weight') is-invalid @enderror @if(!empty(old('roll_weight_to_sheet_weight'))) is-valid @endif" id="roll_weight_to_sheet_weight" name="roll_weight_to_sheet_weight" value="{{ old( 'roll_weight_to_sheet_weight' ) }}" readonly>
                                @error('roll_weight_to_sheet_weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title" >(width*length*(GSM+6)/1550000)</span>
                            </div>
                            <div class="col-lg-6 mb-3"id="gramPerMeter">
                                <label class="heading-content"  for="number">Gram Per Meter</label>
                                <input type="number" class="decimal-input form-control input-form-content @error('gram_per_meter') is-invalid @enderror @if(!empty(old('gram_per_meter'))) is-valid @endif" id="gram_per_meter" name="gram_per_meter" value="{{ old( 'gram_per_meter' )}}">
                                @error('gram_per_meter')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title">((gage/4 )* 0.95 ) * (width/39.37)</span>
                            </div>
                            <div class="col-lg-6 mb-3"id="paperSheetPacking">
                                <label class="heading-content"  for="number">Packing Material QTY/<span class="label-title">Used per box/bag</span></label>
                                <input type="number" class="decimal-input form-control input-form-content @error('packing_material_qty') is-invalid @enderror @if(!empty(old('packing_material_qty'))) is-valid @endif" id="packing_material_qty" name="packing_material_qty" value="{{ old( 'packing_material_qty' ) }}">
                                @error('packing_material_qty')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title">Bharti/Packing Type</span>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="number">No. of Outer/<span class="label-title">Used per Master</span></label>
                                <input type="number" class="decimal-input form-control input-form-content @error('number_of_outer') is-invalid @enderror @if(!empty(old('number_of_outer'))) is-valid @endif " id="number_of_outer" name="number_of_outer" value="{{ 'number_of_outer' }}">
                                @error('number_of_outer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title"></span>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="name">Outer Name</label>
                                <select name="outer_name" class="custom-select d-block w-100 form-select-grps form-control select2">
                                    <option value="">Select Outer Name</option>
                                    @foreach($outers as $outer)
                                        <option data-weight="{{ $outer->material_weight }}" value="{{ $outer->id }}" {{ old('outer_name') == $outer->id ? 'selected' : '' }}>{{ $outer->material_name }}</option>
                                    @endforeach    
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3" id="paperSheetCarton">
                                <label class="heading-content"  for="number">Carton Name.</label>
                                <select name="carton_no" class="custom-select d-block w-100 form-select-grps form-control select2">
                                    <option value="">Select Carton Name</option>
                                    @foreach($cartons as $carton)
                                        <option data-weight="{{$carton->material_weight}}" value="{{ $carton->id }}" {{ old('carton_no') == $carton->id ? 'selected' : '' }}>{{ $carton->material_name }}</option>
                                    @endforeach    
                                </select>
                                @error('carton_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title"></span>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="name">Packing Material Sub Category<span style="color: red;">*</span></label>
                                <select class="form-control select2 input-form-content form-select-grp @error('packing_material_type') is-invalid @enderror @if(!empty(old('packing_material_type'))) is-valid @endif" id="packing_material_type" name="packing_material_type">
                                <option value="" selected disabled>Select packing material sub category</option>    
                                    @foreach($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}" {{ old('packing_material_type') == $subCategory->id ? 'selected' : '' }}>{{ $subCategory->sub_cat_name}}</option>
                                    @endforeach
                                </select>
                                @error('packing_material_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="name">Packing Material Name<span style="color: red;">*</span></label>
                                <select class="form-control select2 input-form-content form-select-grp @error('packing_material_name') is-invalid @enderror @if(!empty(old('packing_material_name'))) is-valid @endif" id="packing_material_name" name="packing_material_name">
                                    <!-- <option value="">Select material Name</option>
                                    @foreach($materials as $materiyal)
                                        <option value="{{ $materiyal->id }}" {{ old('packing_material_name') == $materiyal->id ? 'selected' : '' }}>{{ $materiyal->material_name }}</option>
                                    @endforeach -->
                                </select>
                                @error('packing_material_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="number">Roll in 1 BDl</label>
                                <input type="number" step="0.001" min="0" class="decimal-input form-control input-form-content @error('rolls_in_1_bdl') is-invalid @enderror @if(!empty(old('rolls_in_1_bdl'))) is-valid @endif" id="rolls_in_1_bdl" name="rolls_in_1_bdl" value="{{ old( 'rolls_in_1_bdl' ) }}" readonly>
                                @error('rolls_in_1_bdl')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title">Bharti* Bags/Box=Bdl</span>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="number">BDL K.G.</label>
                                <input type="number" class="decimal-input form-control input-form-content @error('bdl_kg') is-invalid @enderror @if(!empty(old('bdl_kg'))) is-valid @endif" id="bdl_kg" name="bdl_kg" value="{{ old( 'bdl_kg' )}}" readonly>
                                @error('bdl_kg')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title">Rolls In 1 Bdle*Roll Weight</span>
                            </div>
                            <div class="col-lg-6 mb-3" id="rollWeight">
                                <label class="heading-content"  for="">Roll Weight</label>
                                <input type="text" class="decimal-input form-control input-form-content @error('roll_weight') is-invalid @enderror @if(!empty(old('roll_weight'))) is-valid @endif" id="roll_weight" name="roll_weight" value="{{ old( 'roll_weight' ) }}" >
                                @error('roll_weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <span class="input-title" id="rollWeightText">(Length/(1000/(GSM+6)*39.37/Width)+0.57/Roll in 1 Bdl)</span>
                            </div>
                        </div>
                        <div class="upload--file-section product-popup-save">
                            <div class="btn-sec btn_group"></div>
                                <div class="order-btn-grp">
                                    <div class="btn-sec btn_group">
                                        <div class="button-1 cta_btn">
                                            <button type="submit" class="primary-button stock-btn">Save</button>
                                            <!-- <a href="javascript:void(0)" class="primary-button stock-btn">Create a New Product</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="companyAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data modal-details-width">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Company Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" action="{{ route('customers.add')}}" method="post"  id="customersForm">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-1">
                            <label class="heading-content"  for="name">Company Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('company_name') is-invalid @enderror @if(!empty(old('company_name'))) is-valid @endif" name="company_name" id="company_name" placeholder="John & company" value="{{old('company_name')}}">
                                @error('company_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 mb-1">
                            <label class="heading-content"  for="number">GSTIN<span style="color: red;">*</span></label>
                            <input type="text" name="gstin" class="form-control input-form-content @error('gstin') is-invalid @enderror @if(!empty(old('gstin'))) is-valid @endif" id="gstin" placeholder="16516 51611 51" value="{{old('gstin')}}">
                                    @error('gstin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 mb-1">
                            <label class="heading-content"  for="paymentterms">Payment Terms<span style="color: red;">*</span></label>
                            <select class="custom-select d-block w-100 form-select-grp select2 @error('payment_terms') is-invalid @enderror" id="payment_terms" name="payment_terms">
                                <option value="">Select Payment</option>
                                <option value="Advance"{{ old('payment_terms') == 'Advance' ? 'selected' : '' }}>Advance</option>
                                <option value="7 days"{{ old('payment_terms') == '7 days' ? 'selected' : '' }}>7 days</option>
                                <option value="30 days"{{ old('payment_terms') == '30 days' ? 'selected' : '' }}>30 days</option>
                                <option value="45 days"{{ old('payment_terms') == '45 days' ? 'selected' : '' }}>45 days</option>
                            </select>
                            @error('payment_terms')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-1">
                            <label class="heading-content"  for="address">Billing Address Line 1<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('address1') is-invalid @enderror @if(!empty(old('address1'))) is-valid @endif" id="address1" name="address1" placeholder="4140 Parker Rd. Allentown" value="{{old('address1')}}">
                                    @error('address1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="heading-content"  for="number">Billing Address Line 2</label>
                            <input type="text" class="form-control input-form-content " name="address2" id="address2"placeholder="6391 Elgin St. Celina" value="{{old('address2')}}">
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="heading-content"  for="name">Pin<span style="color: red;">*</span></label>
                            <input type="pin" class="form-control input-form-content @error('pin') is-invalid @enderror @if(!empty(old('pin'))) is-valid @endif" id="pin" name="pin" value="{{ old('pin')}}" placeholder="352218">
                                    @error('pin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-1">
                            <label class="heading-content"  for="name">Country<span style="color: red;">*</span></label>
                            <select class="custom-select d-block w-100 form-select-grp select2" id="country" name="country_id"required>
                                <option value="">Select Country</option>
                                    @foreach($countrys as $country)
                                        <option value="{{$country->id}}" {{ old('country_id', '101') == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
                                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label class="heading-content"  for="State">State<span style="color: red;">*</span></label>
                            <select class="custom-select d-block w-100 form-select-grp select2" id="state" name="state_id" required>
                                <option value="">Select State</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label class="heading-content"  for="name">City<span style="color: red;">*</span></label>
                            <select class="custom-select d-block w-100 form-select-grp select2" id="city" name="city_id" required>
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-1 company-group-popup">
                            <div class="col-md-10 mb-1">
                                <label class="heading-content"  for="name">Group</label>
                                <select class="custom-select d-block w-100 form-select-grp select2" id="group" name="group">
                                    <option value="">Select Group</option>
                                    @foreach( $groups as $group )
                                        <option value="{{$group->name}}"{{ old('group') == $group->name ? 'selected' : '' }}>{{$group->name}}</option>
                                    @endforeach
                                </select>
                                @error('group')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="add-icon-btn grppopup-icon-center-btn color_data" id="groupaddModul">
                                <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff" class="bi bi-plus"  viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/></svg>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-1">
                            <label class="heading-content"  for="name">Perf. Matrix<span style="color: red;">*</span></label>
                            <input type="test" name="matrix" class="form-control @error('matrix') is-invalid @enderror @if(!empty(old('matrix'))) is-valid @endif"  value="{{old('matrix')}}" placeholder="Matrix">
                            @error('matrix')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="heading-content"  for="name">First Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('first_name') is-invalid @enderror @if(!empty(old('first_name'))) is-valid @endif" name="first_name" id="first_name"
                                    placeholder="John" value="{{old('first_name')}}" >
                                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="heading-content"  for="name">Last Name</label>
                            <input type="text" class="form-control input-form-content @error('last_name') is-invalid @enderror @if(!empty(old('last_name'))) is-valid @endif" id="last_name"
                                        placeholder="William" value="{{old('last_name')}}" name="last_name">
                                        @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="heading-content"  for="name">Phone Number<span style="color: red;">*</span></label>
                            <input type="number" class="form-control input-form-content @error('contect') is-invalid @enderror @if(!empty(old('contect'))) is-valid @endif" id="number"placeholder="+123456789 " name="contect" value="{{old('contect')}}" min="13" >
                            @error('contect')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="heading-content"  for="name">Alternate Phone Number</label>
                            <input type="number" class="form-control input-form-coentent @error('alt_phone') is-invalid @enderror" id="alt_phone"placeholder="+123456789 " name="alt_phone" value="{{old('alt_phone')}}">
                            @error('alt_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>   
                        <div class="col-md-12 mb-1">
                            <label class="heading-content"  for="email">Email</label>
                            <input type="email" class="form-control input-form-content @error('email') is-invalid @enderror @if(!empty(old('email'))) is-valid @endif" id="address"placeholder="john@gmail.com"  name="email" value="{{old('email')}}">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="button-1">
                            <button type="submit" class="delete-customer">Save</button>
                        </div>
                    </div>    
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="groupaddModulData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data modal-details-widths">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Group Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('customers.groupadd') }}" method="POST" id="groupformForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md mb-3">
                            <label class="heading-content" for="name">Name</label>
                            <input type="text" class="form-control input-form-content @error('name') is-invalid @enderror @if(!empty(old('name'))) is-valid @endif" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer group-popup-footer">
                    <div class="button-1">
                        <button type="submit" class="delete-customer">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="groupaddProductModulData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data modal-details-widths">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Group Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('products.productgroupadd') }}" method="POST" id="productgroupformForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md mb-3">
                            <label class="heading-content" for="name">Name</label>
                            <input type="text" class="form-control input-form-content @error('name') is-invalid @enderror @if(!empty(old('name'))) is-valid @endif" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer group-popup-footer">
                    <div class="button-1">
                        <button type="submit" class="delete-customer">Save</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
<div class="modal fade" id="coloraddModulData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog color-model-popup">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Colour Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                
            </div>
            <form action="{{route('customers.coloradd') }}" method="POST" id="colorformForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md mb-3">
                            <label class="heading-content" for="name">Name</label>
                            <input type="text" class="form-control input-form-content @error('name') is-invalid @enderror" id="colorname" name="name" placeholder="Enter name" value="{{ old('name') }}">
                            <div class="invalid-feedback"></div>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                        <div class="button-1">
                            <button type="submit" class="delete-customer">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>


<div class="modal fade" id="colorModul" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Colour List ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this colour?</p>
            </div>
            <div class="modal-footer">
                <div class="button-1">
                    <a href="javascript:void(0)" class="delete-customer delete-colordata delete-customerOrder-color" id="role_id" data-id="">OK</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection