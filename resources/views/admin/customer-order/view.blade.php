@extends('layouts.app')
@section('navbarTitel', 'View Order')
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
                    <button type="button" id="Button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
                </div>
            </div>
            <hr class="addsupplier-section-border">
            <div class="heading-btn"><span class="addsupplier-section-headingg">Order Type</span></div>
            <div class="upload-file-sec">
                <div class="row col-12 customer-files-sec">
                    <div class="options input-dgn">
                        <div class="row form-inp-group">
                            <div class="col-md-4 mb-3">
                                <label class="heading-content"  for="name">Company</label>
                                <span class="form-control">{{$customerOrders->customer->company_name ?? ''}}</span>
                            </div>
                        </div>
                        <div class="row form-inp-group">
                            <div class="col-md-4 mb-3">
                                <label class="heading-content"  for="name">Phone no.</label>
                                <span class="form-control">{{$customerOrders->contact ?? ''}}</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="heading-content" for="price_list">Price List</label>
                                <span class="form-control">{{ optional($pricelists->find($customerOrders->price_list))->list_name }}</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="heading-content"  for="number">Delivery Date</label>
                                <span class="form-control">{{$customerOrders->delivery_date ?? ''}}</span>
                            </div>
                        </div>
                        <div class="row form-inp-group">
                            <div class="col-md-4 mb-3">
                                <label class="heading-content"  for="name">Delivery Instructions</label>
                                <span class="form-control">{{$customerOrders->shipping_address ?? ''}}</span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="heading-content"  for="name">Transport Details</label>
                                <span class="form-control">{{ optional($transforms->find($customerOrders->packing_name))->name }}</span>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label class="heading-content"  for="number">Order ID</label>
                                <span class="form-control">{{$customerOrders->order_id ?? ''}}</span>

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
                        <th><a href="javascript:void(0);" title="">Colour</a></th>
                        <th><a href="javascript:void(0);" title="">Sticker</a></th>
                        <th><a href="javascript:void(0);" title="">Packing Material Name<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title="">BDL<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title="">Bharti<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title="">Bag/Box<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title="">Total Roll<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title="">Rate<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title="">Total<span style="color: red;">*</span></a></th>
                        <th><a href="javascript:void(0);" title="">Remark</a></th>
                    </thead>
                     @foreach($productsOrders as $index => $productId)
                        <tr class="table-select-data customerorder-table">
                            <td class="table-data-contents">
                                <span class="form-control">{{ optional($products->find($productId->product_id))->alias_sku }}</span>
                            </td>
                            <td class="table-data-contents">
                                <span class="form-control">{{ optional($products->find($productId->product_id))->product_name }}</span>
                            </td>
                            <td class="table-data-contents">
                                <span class="form-control">{{ $productId->colour ?? '' }}</span>
                            </td>
                            <td class="table-data-contents">
                                <span class="form-control">{{ $productId->sticker_name ?? '' }}</span>
                            </td>
                            <td class="table-data-contents">
                                <span class="form-control">{{ $productId->packing_material_type ?? '' }}</span>
                            </td>
                            <td class="table-data-contents total-input">
                                <span class="form-control">{{ $productId->bdl_kg ?? '' }}</span>
                            </td>
                            <td class="table-data-contents">
                                <span class="form-control">{{ $productId->bharti ?? '' }}</span>
                            </td>
                            <td class="table-data-contents">
                                <span class="form-control">{{ $productId->unit_box ?? '' }}</span>
                            </td>
                            <td class="table-data-contents">
                                <span class="form-control">{{ formatIndianCurrencyNumber($productId->roll_counte) ?? '' }}</span>
                            </td>
                            <td class="table-data-contents total-input">
                                <span class="form-control">{{ formatIndianCurrencyNumber($productId->rate) ?? '' }}</span>
                            </td>
                            <td class="table-data-contents total-input">
                                <span class="form-control">{{ formatIndianCurrencyNumber($productId->total) ?? '' }}</span>
                            </td>
                            <td class="table-data-contents">
                                <span class="form-control">{{ $productId->remark ?? '' }}</span>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div>
                <div class="row col-12 customer-files-sec">
                    <div class="options input-dgn customer_notes_sec">
                        <div class="row form-inp-group">
                            <div class="col-md-4 mb-3">
                                <label class="heading-content"  for="Customer_notes">Customer Notes</label>
                                <span class="form-control customer_notes_span">{{$customerOrders->customer_notes ?? ''}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $(document).on('click','#Button', function(){
            window.location.href = "{{ route('customerOrder.index') }}";
        });
    });
</script>
@endsection