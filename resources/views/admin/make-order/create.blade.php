@extends('layouts.app')
@section('navbarTitel', 'Add Manufacturing Orders')
@section('content')
 
<div class="main-outer">
    <div class="outer card">
        <form class="needs-validation" action="{{ route('make_order.store')}}" method="post" novalidate id="form1">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Order Details</span>
                <div class="btn-sec btn_group">
                    <a href="{{route('make_order.index')}}">
                    <span class="back-icons back-tab-icon"></span>
                    </a>
                </div>
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    @csrf
                    <div class="row form-inp-group">
                        <div class="col-md-6 mb-3">
                            <label class="heading-content"  for="name">Product Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('product_name') is-invalid @enderror @if(!empty(old('product_name'))) is-valid @endif" name="product_name" id="product_name" placeholder="John & company" value="{{old('product_name')}}" required >
                                @error('product_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="heading-content"  for="number">Status</label>
                            <input type="text" name="status" class="form-control input-form-content @error('status') is-invalid @enderror @if(!empty(old('status'))) is-valid @endif" id="status" placeholder="16516 51611 51" value="{{old('status')}}" required>
                                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                       
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-md-4 mb-3">
                            <label class="heading-content"  for="address">SKU<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('sku') is-invalid @enderror @if(!empty(old('sku'))) is-valid @endif" id="sku" name="sku" placeholder="4140 Parker Rd. Allentown, New Mexico 31134"required value="{{old('sku')}}">
                                    @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content"  for="number">Colour</label>
                            <input type="text" class="form-control input-form-content @error('colour') is-invalid @enderror @if(!empty(old('colour'))) is-valid @endif " name="colour" id="colour"placeholder="6391 Elgin St. Celina, Delaware 10299" value="{{old('colour')}}">
                            @error('colour')<div class="invalid-feedback">{{ $message }}</div>@enderror

                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content"  for="name">Packing<span style="color: red;">*</span></label>
                            <input type="test" class="form-control input-form-content @error('packing') is-invalid @enderror @if(!empty(old('packing'))) is-valid @endif" id="packing" name="packing" value="{{ old('packing')}}" placeholder="packing">
                                    @error('packing')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-md-4 mb-3">
                            <label class="heading-content"  for="address">QTY in Bundle<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('qty_in_bundle') is-invalid @enderror @if(!empty(old('qty_in_bundle'))) is-valid @endif" id="qty_in_bundle" name="qty_in_bundle" placeholder="4140 Parker Rd. Allentown, New Mexico 31134"required value="{{old('qty_in_bundle')}}">
                                    @error('qty_in_bundle')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content"  for="number">Bharti</label>
                            <input type="text" class="form-control input-form-content @error('bharti') is-invalid @enderror @if(!empty(old('bharti'))) is-valid @endif" name="bharti" id="bharti"placeholder="6391 Elgin St. Celina, Delaware 10299" value="{{old('bharti')}}">
                            @error('bharti')<div class="invalid-feedback">{{ $message }}</div>@enderror

                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="heading-content"  for="name">Bag/Box<span style="color: red;">*</span></label>
                            <input type="test" class="form-control input-form-content @error('bag_box') is-invalid @enderror @if(!empty(old('bag_box'))) is-valid @endif" id="bag_box" name="bag_box" value="{{ old('bag_box')}}" placeholder="352218">
                                    @error('bag_box')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            
                        </div>
                        <div class="upload--file-section">
                        <div class="btn-sec btn_group">
                            
                        </div>
                        <div class="order-btn-grp">
                            <div class="btn-sec btn_group">
                                <div class="button-1 cta_btn">
                                    <button type="submit" class="primary-button stock-btn">Save</button>
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
       

@endsection