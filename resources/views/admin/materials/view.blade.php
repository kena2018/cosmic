@extends('layouts.app')
@section('navbarTitel', 'View Materials')
@section('content')

<div class="main-outer">
    <div class="outer card">
        <div class="heading-btn">
            <span class="addsupplier-section-heading">Material Information</span>
            <button type="button" id="Button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
        </div>
            
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec bottom_sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <!-- Material Category Field -->
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="category_id">Material Category </label>
                            <span class="form-control">{{ $material->category->name ?? ' ' }}</span>
                        </div>
                        <!-- Sub-Category Field -->
                        <div class="col-lg-6 mb-1" id="sub_category_div">
                            <label class="heading-content" for="sub_category">Sub Category</label>
                            <span class="form-control">{{ $material->subCategory->sub_cat_name ?? ' ' }}</span>
                        </div>
                        <!-- Material Name Field -->
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="material_name">Material Name </label>
                            <span class="form-control">{{ $material->material_name ?? ' ' }}</span>
                        </div>

                        <!-- Quantity Field -->
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="unit1">Unit 1</label>
                            <span class="form-control">{{ $material->unit1 ?? ' ' }}</span>
                        </div>
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="unit2">Unit 2</label>
                            <span class="form-control">{{ $material->unit2 ?? ' ' }}</span>
                        </div>
                        <!-- Unit Field -->
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="remark">Remark</label>
                            <span class="form-control">{{ $material->remark ?? ' ' }}</span>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<!-- JavaScript for Category and Sub-Category Handling -->
@endsection
@section('js')
<script>
    $(document).ready(function(){ 
        $(document).on('click','#Button', function(){
            window.location.href = "{{ route('material.index') }}";
        });
    });

</script>

@endsection
