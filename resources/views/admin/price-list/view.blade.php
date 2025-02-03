@extends('layouts.app')
@section('navbarTitel', 'View Price List')
@section('content')

    <div class="main-outer">
        <div class="outer card">
        <div class="heading-btn">
                <span class="addsupplier-section-heading">View Price List</span>
                <button type="button" id="Button" class="orderList"><span class="back-icons back-tab-icon"></span></button>
            </div>
            <hr class="addsupplier-section-border">
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-md-6 mb-3">
                                <label class="heading-content" for="list_name">List Name<span style="color: red;">*</span></label>
                                <span class="form-control input-form-content input_form_cntrl">{{ $priceList->list_name ?? ' ' }}</span>
                            </div>
                            <div class="col-md-6 mb-3" >
                                <label class="heading-content" for="discount">Discount(%)<span style="color: red;">*</span></label>
                                <span class="form-control input-form-content input_form_cntrl">{{ $priceList->discount ?? ' ' }}</span>
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
                        </thead>
                        @foreach($PriceListItems as $index => $PriceListItem)
                            <tr class="grouppricing-select-data">
                                <td class="table-data-contents">
                                    <span class="form-control input-form-content">{{ optional($products->find($PriceListItem->product_id))->product_name ?? ' ' }}</span> 
                                </td>
                                <td class="table-data-contents">
                                    <span class="form-control input-form-content">{{ optional($products->find($PriceListItem->product_id))->alias_sku ?? ' ' }}</span> 
                                </td>
                                <td class="table-data-contents">
                                    <span class="form-control input-form-content">{{  $PriceListItem->min_qty ?? ' ' }}</span> 
                                </td>
                                <td class="table-data-contents">
                                    <span class="form-control input-form-content">{{  $PriceListItem->rate ?? ' ' }}</span> 
                                </td>
                                <td class="table-data-contents">
                                    <span class="form-control input-form-content">{{  $PriceListItem->discount_rate ?? ' ' }}</span> 
                                </td>
                                <td class="table-data-contents">
                                    <span class="form-control input-form-content">{{  $PriceListItem->special_rate ?? ' ' }}</span> 
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
        </div>
    </div>
@endsection
@section('js')
<!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click','#Button', function(){
                window.location.href = "{{ route('price-list.index') }}";
            });
            $('.select2').select2();
});
    </script>
@endsection