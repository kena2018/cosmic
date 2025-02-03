@extends('layouts.print')
@section('navbarTitel', 'Customer Order')
@section('content')
<style>
    .form-container {height: auto !important;}
    .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px;font-size:15px; }
        .table th { background-color: #f2f2f2; text-align: left;font-size:15px; }
</style>
<div class="form-container">
    <div class="header">
        <div class="form-title">Order Information</div>
        <div class="logo">
            @if(str_contains(url('/'), '127.0.0.1'))
            <img
            src="{{ asset('public/assets/img/Cosmiclogo.png')}}"
            alt="navbar brand"
            class="navbar-brand"
            />
            @else
            <img
            src="{{ asset('public/assets/img/Cosmiclogo.png')}}"
            alt="navbar brand"
            class="navbar-brand"
            />
            @endif
        </div>
    </div>
    <div class="personal-info">
        <div class="section-title">Order Type</div>
        <div class="row first-section">
            <p class="field-size"><strong>Company:</strong> {{ old('customer_name', $customerOrders->customer->company_name ?? '') }}</p>
            <p class="field-size"><strong>Phone no.:</strong> {{old('contact',$customerOrders->contact ?? '')}}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Price List:</strong> {{ optional($pricelists->find($customerOrders->price_list))->list_name }}</p>
            <p class="field-size"><strong>Delivery Date:</strong> {{ old('delivery_date', isset($customerOrders->delivery_date) ? \Carbon\Carbon::parse($customerOrders->delivery_date)->format('d-m-Y') : 'N/A') }}
            </p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Delivery Instructions:</strong> {{old('shipping_address',$customerOrders->shipping_address ?? '')}}</p>
            <p class="field-size"><strong>Transport Details:</strong> {{ optional($transforms->find($customerOrders->packing_name))->name }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Order ID:</strong> {{old('order_id',$customerOrders->order_id ?? '')}}</p>
        </div>
    </div>
    <div class="personal-info">
        <div class="section-title">Product Details</div>
        @foreach($productsOrders as $index => $productId)
        <div class="row first-section">
            <p class="field-size"><strong>Product Name:</strong> {{ $products->firstWhere('id', $productId->product_id)->product_name ?? '' }}</p>
            <p class="field-size"><strong>SKU:</strong> {{ $products->firstWhere('id', $productId->product_id)->alias_sku ?? '' }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Colour:</strong> {{ old('color.0', $productId->colour ?? '') }}</p>
            <p class="field-size"><strong>Sticker:</strong>  {{old('sticker_name.0',$productId->sticker_name ?? '')}}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Packing Material Name:</strong> {{old('packing_material_type.0',$productId->packing_material_type ?? '')}}</p>
            <p class="field-size"><strong>BDL:</strong> {{old('bdl_kg.0',$productId->bdl_kg ?? '')}}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Bharti:</strong> {{old('bharti.0',$productId->bharti ?? '')}}</p>
            <p class="field-size"><strong>Bag/Box:</strong> {{old('unit_box.0',$productId->unit_box ?? '')}}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Total Roll:</strong> {{old('roll_counte.0',$productId->roll_counte ?? '')}}</p>
            <p class="field-size"><strong>Rate:</strong> {{old('rate.0',$productId->rate ?? '')}}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Total:</strong> {{old('total.0',$productId->total ?? '')}}</p>
            <p class="field-size"><strong>Remark:</strong> {{old('remark.0',$productId->remark ?? '')}}</p>
        </div>
        
        @endforeach
        <div class="section-title"></div>
        <div class="row first-section ">
            <p class="field-size"><strong>Customer Notes:</strong> {{ old('customer_notes', $customerOrders->customer_notes ?? '') }}</p>
        </div>
    </div>
</div>
<!-- <div class="main-outer">
    <div class="outer card">
        <div class="heading-btn">
            <span class="addsupplier-section-heading">ORDER INFORMATION</span>
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
                        <div class="row form-inp-group">
                            <div class="col-md-4 mb-3">
                                <p><strong>Company:</strong> {{ old('customer_name', $customerOrders->customer->company_name ?? '') }}</p>
                            </div>
                        </div>
                        <div class="row form-inp-group">
                            <div class="col-md-4 mb-3">
                                <p><strong>Phone no.:</strong> {{old('contact',$customerOrders->contact ?? '')}}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p><strong>Price List:</strong></p>

                                <select class="d-none form-control @error('price_list') is-invalid @enderror" name="price_list" id="price_list_add_data">
                                    <option value="">Select Price List</option>
                                    @foreach($pricelists as $pricelist)
                                        <option value="{{ $pricelist->id }}" data-price-name="{{ $pricelist->list_name }}"
                                        {{ old('price_list', $customerOrders->price_list ?? '') == $pricelist->id ? 'selected' : '' }}
                                        >
                                            {{ $pricelist->list_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="text" id="list_name" class="" value="" placeholder="Price List Name" readonly>

                            </div>
                            <div class="col-md-4 mb-3">
                                <p><strong>Delivery Date:</strong> {{old('delivery_date',$customerOrders->delivery_date ?? '')}}</p>
                                
                            </div>
                        </div>
                        <div class="row form-inp-group">
                            <div class="col-md-4 mb-3">
                                <p><strong>Delivery Instructions:</strong> {{old('shipping_address',$customerOrders->shipping_address ?? '')}}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="heading-content" for="number">Transport Details</label>
                                <select class=" d-none form-control @error('packing_name') is-invalid @enderror @if(old('packing_name')) is-valid @endif" name="packing_name" id="packing_name_select">
                                    <option value="">Select</option>
                                    @foreach($transforms as $transform)
                                        <option value="{{ $transform->id }}" data-transport-name="{{ $transform->name }}" {{ old('packing_name', $customerOrders->packing_name ?? '') == $transform->id ? 'selected' : '' }}>{{ $transform->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" id="packing_name_input" class="" value="{{ old('packing_name_name', $customerOrders->packing_name_name ?? '') }}" placeholder="Transport Name" readonly>
                                @error('packing_name')<div class="invalid-feedback">{{ $message }}</div>@enderror    
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="heading-content"  for="number">Order ID</label>
                                <input type="text" class="" id="order_id" name="order_id" placeholder="Advance" value="{{old('order_id',$customerOrders->order_id ?? '')}}"readonly>
                                @error('order_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                </div>
            </div>

            <div class="table-responsive table-designs">
                <table class="table active all">
                    <thead>
                        <th>Product Name</th>
                        <th>SKU</th>
                        <th>Colour</th>
                        <th>Sticker</th>
                        <th>Packing Material Name</th>
                        <th>BDL</th>
                        <th>Bharti</th>
                        <th>Bag/Box</th>
                        <th>Total Roll</th>
                        <th>Rate</th>
                        <th>Total</th>
                        <th>Remark</th>
                        
                    </thead>
                    @foreach($productsOrders as $index => $productId)
                        <tr class="table-select-data">
                            <td class="table-data-contents">
                                <select class="d-none form-control " id="product_{{$productId->id}}" name="product[{{$index}}]">
                                    <option value="">Select</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}" 
                                            data-product="{{$product->product_name}}" 
                                            data-id="{{$product->id}}"
                                            {{ old('product.' . $index, $productId->product_id) == $product->id ? 'selected' : '' }}>
                                            {{$product->product_name}}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="text" id="product_input_{{$productId->id}}" class=" input-form-content" value="{{ old('product_name.' . $index, $productId->product_name ?? '') }}"placeholder="Product Name (Index)" readonly>
                                @error('product.' . $index)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
<td class="table-data-contents">
    <select class="d-none custom-select d-block w-100 form-select-grp  sku-select" 
            id="sku_{{$productId->id}}" 
            name="sku[]">
        <option value="">Select</option>
        @foreach($products as $product)
            <option value="{{$product->id}}" 
                    data-pmt="{{$product->packing_material_type}}" 
                    data-bdl="{{$product->bdl_kg}}" 
                    data-bharti="{{$product->bharti}}" 
                    data-bagBox="{{$product->number_of_bags_per_box}}"  
                    data-id="{{$product->id}}" 
                    {{ old('sku.' . $loop->index, $productId->product_id) == $product->id ? 'selected' : '' }}>
                {{$product->alias_sku}}
            </option>
        @endforeach
    </select>

    <input type="text" id="sku_input_{{$productId->id}}" 
           class=" input-form-content" 
           value="{{ old('sku_alias', $productId->alias_sku ?? '') }}" 
           placeholder="Selected SKU" 
           readonly>

    @error('sku.' . $loop->index)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</td>
<td class="table-data-contents">
    <div class="d-flex align-items-center">
        <button class="btn color-select dropdown-toggle d-flex align-items-center d-none" 
                type="button" 
                id="dropdownMenuButton_{{$productId->id}}" 
                data-bs-toggle="dropdown" 
                aria-expanded="false">
            {{ old('color.0', $productId->colour ?? 'Select') }}
        </button>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_{{$productId->id}}">
            @foreach($colors as $color)
                <li class="d-flex align-items-center justify-content-between dropdown-item d-none">
                    <span class="color-name">{{ $color->name }}</span>
                    <span class="table-group-icons edit-icon-tag delete-color" 
                          data-color-name="{{ $color->name }}"></span>
                </li>
            @endforeach
        </ul>

        <input type="text" name="color[]" class="selected-color " 
               value="{{ old('color.0', $productId->colour ?? '') }}"readonly>
    </div>
    @error('sku.' . $loop->index)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</td>
                        <td class="table-data-contents">
                            <input type="text" name="sticker_name[]" value="{{old('sticker_name.0',$productId->sticker_name ?? '')}}"class=" order-input" readonly>
                        </td>
                            <td class="table-data-contents">
                                <input type="text" name="packing_material_type[]" value="{{old('packing_material_type.0',$productId->packing_material_type ?? '')}}"class="order-input " readonly>
                                @error('packing_material_type.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents total-input">
                                <input type="text" name="bdl_kg[]" value="{{old('bdl_kg.0',$productId->bdl_kg ?? '')}}"class="order-input" readonly>
                                @error('bdl_kg.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents">
                                <input type="text" name="bharti[]" value="{{old('bharti.0',$productId->bharti ?? '')}}"class="order-input " readonly>
                                @error('bharti.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents">
                                <input type="text" name="unit_box[]" value="{{old('unit_box.0',$productId->unit_box ?? '')}}" class="order-input "readonly>
                                @error('unit_box.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents">
                                <input type="text" name="roll_counte[]" value="{{old('roll_counte.0',$productId->roll_counte ?? '')}}"class="order-input "readonly>
                                @error('roll_counte.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents total-input">
                                <input type="text" name="rate[]" value="{{old('rate.0',$productId->rate ?? '')}}"class="order-input "readonly>
                                @error('rate.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents total-input">
                                <input type="text" name="total[]" value="{{old('total.0',$productId->total ?? '')}}" class="order-input "readonly>
                                @error('total.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>
                            <td class="table-data-contents">
                                <input type="text" name="remark[]" value="{{old('remark.0',$productId->remark ?? '')}}"class="order-input "readonly>
                                @error('remark.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </td>


    </tr>
@endforeach

                </table>
            </div>
            <div class="upload-file-sec">
                <div class="row col-12 customer-files-sec">
                    <div class="upload---file-sections custmr-notes-sec">
                        <div class="row form-inp-group">
                            <div class="">
                                <label class="heading-content"  for="name">Customer Notes:</label>
                                <textarea class="notes-area" name="customer_notes" id="" cols="30" rows="10" readonly>{{ old('customer_notes', $customerOrders->customer_notes ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>   
</div> -->
<!-- <div id="data-container" data-customers='[{"id":1,"company_name":"Company A"},{"id":2,"company_name":"Company B"}]'></div> -->
<div id="data-container" data-customers="{{ json_encode($customers) }}"></div>
@endsection
@section('js')
<script>
$(document).ready(function() {
    window.print();
    $('select[name^="product"]').each(function() {
        var productId = $(this).attr('id'); // Get the ID of the select element
        var inputFieldId = '#product_input_' + productId.split('_')[1]; // Get the corresponding input field

        // On page load, check if a product is already selected and set the input value
        var selectedOption = $(this).find('option:selected');
        var selectedProductName = selectedOption.data('product');
        if (selectedProductName) {
            $(inputFieldId).val(selectedProductName);
        }

        // Update the input field when the user selects a new product
        $(this).on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var productName = selectedOption.data('product');
            $(inputFieldId).val(productName ? productName : '');
        });
    });
    $('select[name^="sku"]').each(function() {
        var skuSelectId = $(this).attr('id'); // Get the ID of the select element
        var productId = skuSelectId.split('_')[1]; // Extract the unique product ID
        var inputFieldId = '#sku_input_' + productId; // Get the corresponding input field ID

        // On page load, check if a SKU is already selected and set the input value
        var selectedOption = $(this).find('option:selected');
        var selectedSKU = selectedOption.text(); // Get the selected SKU alias
        if (selectedSKU) {
            $(inputFieldId).val(selectedSKU); // Set the input field value
        }

        // Update the input field when a SKU is selected
        $(this).on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var skuAlias = selectedOption.text(); // Get the alias_sku value
            $(inputFieldId).val(skuAlias ? skuAlias : ''); // Update input field
        });
    });
    $('.dropdown-menu').on('click', 'li', function() {
        var selectedColor = $(this).find('.color-name').text(); // Get the selected color name
        var productId = $(this).closest('td').find('button').attr('id').split('_')[1]; // Extract the product ID
        var buttonId = '#dropdownMenuButton_' + productId; // Get the button ID
        var hiddenInput = $(this).closest('td').find('.selected-color'); // Get the hidden input field
        
        // Update the button text with the selected color
        $(buttonId).text(selectedColor);
        
        // Update the hidden input field with the selected color
        hiddenInput.val(selectedColor);
    });
});
</script>
@endsection