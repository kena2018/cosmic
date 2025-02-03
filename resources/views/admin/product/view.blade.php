@extends('layouts.app')
@section('navbarTitel', 'Product View')

@section('content')

<div class="main-outer">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Product Information</span>
                <button type="button" id="Button" class="orderList"><span class="back-icons back-tab-icon"></span></button>
            </div>
            <hr class="addsupplier-section-border">
            <?php $categoryValue = optional($productCategory->find($product->category))->name ?? 'N/A'; ?>
            <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <div class="col-lg-6 mb-1">
                                <label class="heading-content"  for="category">Category</label>
                                <span class="form-control">{{ optional($productCategory->find($product->category))->name ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content" for="Name">Product Name</label>
                                <span class="form-control">{{ $product->product_name ?? '' }}</span>
                            </div>
                            <div class="col-lg-6 mb-3 ">
                                <label class="heading-content" for="group_name">Group Name</label>
                                <span class="form-control">{{ optional($groups->find($product->group_name))->name ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content"  for="AliasSku">Alias / SKU</label>
                                <span class="form-control">{{ $product->alias_sku ?? ' ' }}</span>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content"  for="width">Width in inches</label>
                                <span class="form-control">{{ $product->width ?? ' ' }}</span>
                            </div>
                            <?php if ($categoryValue === 'Paper Roll' || $categoryValue === 'Paper Sheet' || $categoryValue === 'Plastic Roll' ): ?>
                            <div class="col-lg-3 mb-3" id="lengthInMeters">
                                <label class="heading-content"  for="length">Length in meters</label>
                                <span class="form-control">{{ $product->length ?? ' ' }}</span>
                            </div>
                            <?php endif; ?>
                            <?php if ($categoryValue === 'Paper Roll' || $categoryValue === 'Paper Sheet'): ?>
                            <div class="col-lg-3 mb-3" id="gsm-field" >
                                <label class="heading-content"  for="GSM">GSM</label>
                                <span class="form-control">{{ $product->gsm ?? ' ' }}</span>
                            </div>
                            <?php endif; ?>
                            <?php if ($categoryValue === 'Plastic Roll' || $categoryValue === 'Plastic Jumbo Roll'): ?>
                            <div class="col-lg-3 mb-3" id="gauge-field" >
                                <label class="heading-content"  for="Gauge">Gauge</label>
                                <span class="form-control">{{ $product->gage ?? ' ' }}</span>
                            </div>
                            <?php endif; ?>
                            <div class="col-lg-3 mb-3">
                                <label class="heading-content" for="name">Master Packing</label>
                                <span class="form-control" >{{ $product->master_packing ?? ' ' }}</span>
                            </div>

                        </div>
                    </div>
            </div>
            <div class="heading-btn">
                <span class="companydetails-section-heading">Product Specifications</span>
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-lg-6 mb-3">
                            <label class="heading-content"  for="BhartiContact">Bharti<span style="color: red;">*</span></label>
                            <span class="form-control">{{$product->bharti ?? ' '}}</span>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="heading-content"  for="number">Bags/Box<span style="color: red;">*</span></label>
                            <span class="form-control">{{$product->number_of_bags_per_box ?? ' '}}</span>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="heading-content"  for="name">Pipe size</label>
                            <span class="form-control">{{optional($pipeSizes->find($product->pipe_size))->material_name}}</span>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="heading-content"  for="number">Roll in 1 BDL</label>
                            <span class="form-control">{{$product->rolls_in_1_bdl ?? ' '}}</span>
                        </div>
                    </div>

                    <div class="row form-inp-group">
                    <?php if ($categoryValue !== 'Paper Sheet'): ?>
                        <div class="col-lg-6 mb-3" id="rollWeight">
                            <label class="heading-content"  for="">Roll Weight</label>
                            <span class="form-control">{{$product->roll_weight ?? ' '}}</span>
                        </div>
                        <?php else: ?>
                        <div class="col-lg-6 mb-3" id="sheetWeight">
                            <label class="heading-content"  for="">Sheet Weight</label>
                            <span class="form-control">{{$product->sheet_weight ?? ' '}}</span>
                        </div>
                        <div class="col-lg-6 mb-3" id="rollWegithtoSheetweight">
                            <label class="heading-content"  for="number">Roll Weight to Sheet Weight</label>
                            <span class="form-control">{{$product->roll_weight_to_sheet_weight ?? ' '}}</span>
                        </div>
                        <?php endif; ?>
                        <div class="col-lg-6 mb-3">
                            <label class="heading-content"  for="number">BDL K.G.</label>
                            <span class="form-control">{{$product->bdl_kg ?? ' '}}</span>
                        </div>
                        <div class="col-lg-6 mb-3"id="gramPerMeter">
                            <label class="heading-content"  for="number">Gram Per Meter</label>
                            <span class="form-control">{{$product->gram_per_meter ?? ' '}}</span>
                        </div>
                        <div class="col-lg-6 mb-3"id="paperSheetPacking">
                            <label class="heading-content"  for="number">Packing Material QTY/<span class="label-title">Used per box/bag</span></label>
                            <span class="form-control">{{$product->packing_material_qty ?? ' '}}</span>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="heading-content"  for="name">Outer Name</label>
                            <span class="form-control">{{ optional($outers->find($product->outer_name))->material_name ?? ' ' }}</span>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="heading-content"  for="number">No. of Outer/<span class="label-title">Used per Master</span></label>
                            <span class="form-control">{{ $product->number_of_outer ?? ' ' }}</span>
                        </div>
                        <div class="col-lg-6 mb-3" id="paperSheetCarton">
                            <label class="heading-content"  for="number">Carton Name.</label>
                            <span class="form-control">{{ optional($cartons->find($product->carton_no))->material_name ?? ' ' }}</span>
                        </div>
                        
                        <div class="col-lg-6 mb-3">
                            <label class="heading-content"  for="name">Packing Material Sub Category<span style="color: red;">*</span></label>
                            <span class="form-control">{{ optional($subCategories->find($product->packing_material_type))->sub_cat_name ?? ' ' }}</span>
                        </div>
                    <div class="col-lg-6 mb-3">
                        <label class="heading-content" for="name">Packing Material Name<span style="color: red;">*</span></label>
                        <span class="form-control">{{ optional($materials->find($product->packing_material_name))->material_name ?? ' ' }}</span>
                    </div>

                    <div class="upload--file-section">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click','#Button', function(){
            window.location.href = "{{ route('products.index') }}";
        });
    });
       
@endsection

