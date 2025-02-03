@extends('layouts.print')
@section('navbarTitel', 'Print Price List')
@section('content')
<style>
    .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    .table th, .table td { border: 1px solid #ddd; padding: 8px;font-size:15px; }
    .table th { background-color: #f2f2f2; text-align: left;font-size:15px; }
    .bottom-row { padding-bottom: 10px; margin-bottom: 30px; border-bottom: 1px solid #ddd;}
</style>
<div class="form-container">
    <div class="header">
        <div class="form-title">Group Pricing Information</div>
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
        <div class="section-title">Company Details</div>
        <div class="row first-section">
            <p class="field-size"><strong>List Name:</strong> {{ old('list_name', $priceList->list_name) }}</p>
            <p class="field-size"><strong>Discount(%):</strong> {{ old('discount',$priceList->discount) }}</p>
        </div>
    </div>
    <div class="personal-info">
        <div class="section-title">Product Details</div>
        @foreach($PriceListItems as $index => $PriceListItem)
        <div class="row first-section">
            <p class="field-size"><strong>Product Name:</strong> {{ optional($products->find($PriceListItem->product_id))->product_name ?? 'N/A' }}</p>
            <p class="field-size"><strong>Min QTY:</strong> {{ $PriceListItem->min_qty }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Rate:</strong> {{ $PriceListItem->rate }}</p>
            <p class="field-size"><strong>Discount Rate:</strong> {{ $PriceListItem->discount_rate }}</p>
        </div>
        <div class="row bottom-row">
            <p class="field-size"><strong>Special Rate:</strong> {{ $PriceListItem->special_rate }}</p>
        </div>
        @endforeach
    </div>
</div>
    <!-- <div class="main-outer">
        <div class="outer card">
            <div class="heading-btn grp-pricing-data">
            <span class="addsupplier-section-heading">Group Pricing Details</span>
            <hr class="addsupplier-section-border">
            </div>
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group group-price-data">
                        <div class="col-md-6 mb-3">
                        <p><strong>List Name:</strong> {{ old('list_name', $priceList->list_name) }}</p>
                        </div>
                        <div class="col-md-6 mb-3" >
                        <p><strong>Discount(%):</strong> {{ old('discount',$priceList->discount) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="heading-btn grp-pricing-data">
            <span class="addsupplier-section-heading">Product Details</span>
            <hr class="addsupplier-section-border">
            </div>
            
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Min Qty</th>
                                        <th>Rate</th>
                                        <th>Discount Rate</th>
                                        <th>Special Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($PriceListItems as $index => $PriceListItem)
                                    <tr class="grouppricing-select-data">
                                        <td>
                                        {{ optional($products->find($PriceListItem->product_id))->product_name ?? 'N/A' }}
                                        </td>
                                        <td>
                                        {{ $PriceListItem->min_qty }}
                                        </td>
                                        <td>
                                        {{ $PriceListItem->rate }}
                                        </td>
                                        <td>
                                        {{ $PriceListItem->discount_rate }}
                                        </td>
                                        <td>
                                        {{ $PriceListItem->special_rate }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>        
        </div>
    </div> -->
@endsection
@section('js')
<script>
    $(document).ready(function() {
        setTimeout(function() {
            window.print();
        }, 1000);
    });
</script>
@endsection