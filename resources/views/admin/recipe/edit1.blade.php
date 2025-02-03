@extends('layouts.app')
@section('navbarTitel', 'Recipe Edit')

@section('content')
    <div class="main-outer">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Recipe Edit</span>
                <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
            </div>
            <form class="needs-validation" action="{{ route('recipes.update',$recipe->id)}}" method="post" novalidate id="permissionadd">
            <hr class="addsupplier-section-border">
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            @csrf
                            @method('PUT')
                                <div class="col-lg-6 mb-3">
                                    <label class="heading-content"  for="name">Recipe Name<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control input-form-content @error('recipe_name') is-invalid @enderror @if(!empty(old('recipe_name'))) is-valid @endif" name="recipe_name" id="name" placeholder="Recipe Name" value="{{ old('recipe_name', $recipe->recipe_name ?? '') }}"  >
                                    @error('recipe_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="heading-content"  for="name">Status</label>
                                    <select name="status" id="status" class="custom-select d-block w-100 form-select-grps form-control select2">
                                        <option class="option-desgn" value="">Select Status</option>
                                        <option class="option-desgn" value="1" {{ old('status', $recipe->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option class="option-desgn" value="0" {{ old('status', $recipe->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <div class="table-responsive table-designs">
                                    <table class="table active all">
                                        <thead>
                                            <th><a href="javascript:void(0);" title="">Material Name</a></th>
                                            <th><a href="javascript:void(0);" title="">UP</a></th>
                                            <th><a href="javascript:void(0);" title="">Down</a></th>
                                            <th><a href="javascript:void(0);" title="">Percentage</a></th>
                                            <th><a href="javascript:void(0);" title="">Action</a></th>
                                        </thead>
                                        <tbody>
                                            <tr class="table-select-data customerorder-table">
                                                <td class="table-data-contents"></td>
                                                <td class="table-data-contents">25</td>
                                                <td class="table-data-contents">75</td>
                                                <td class="table-data-contents"></td>
                                            </tr>
                                            
                                            @foreach($RecipeMaterials as $index => $PriceListItem)
                                            <tr class="grouppricing-select-data">
                                                <td class="table-data-contents">
                                                    <select class="custom-select d-block w-100 form-select-grp select2 material-select" id="material_id_{{$PriceListItem->id}}" name="material_id[]">
                                                        <option value="">Select</option>
                                                        @foreach($materials as $material)
                                                        <option value="{{$material->id}}"   data-id="{{$material->id}}"{{ old('material.0',$PriceListItem->material_id) == $material->id ? 'selected' : '' }}>{{$material->material_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('material.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </td>
                                                <td class="table-data-contents">
                                                    <input type="text" name="up[]" value="{{old('up.0',$PriceListItem->up ?? '')}}"class="order-input @error('up.0') is-invalid @enderror @if(!empty(old('up.0'))) is-valid @endif">
                                                    @error('up.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </td>
                                                <td class="table-data-contents">
                                                    <input type="text" name="down[]" value="{{old('down.0',$PriceListItem->downs ?? '')}}"class="order-input @error('down.0') is-invalid @enderror @if(!empty(old('down.0'))) is-valid @endif">
                                                    @error('down.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </td>
                                                <td class="table-data-contents">
                                                    <input type="text" name="percentage[]" value="{{old('percentage.0',$PriceListItem->percentage ?? '')}}"class="order-input @error('percentage.0') is-invalid @enderror @if(!empty(old('percentage.0'))) is-valid @endif">
                                                    @error('percentage.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </td>
                                                @if($loop->index > 0)
                                                <td class="table-data-contents table-delete-icon">
                                                    <a href="javascript:void(0)" class="btn-sm m-1 deleteRow"><span class="table-group-icons edit-icon-tag"></span></a>
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="upload--file-section">
                            <div class="btn-sec recipe-btns">
                                <div class="btn-sec btn_group">
                                    <button type="button" class="btn btn-secondary" id="addRecipeBtn">Add Another Recipe</button>
                                </div>
                            </div>
                            <div class="order-btn-grp">
                                <div class="btn-sec btn_group">
                                    <div class="button-1 cta_btn">
                                        <button id="saveButton" type="submit" class="primary-button stock-btn">Update</button>
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
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2();
        var productSelectCounter = 1;
        $('#addRecipeBtn').click(function () {
            var productOptions = '';
            $('tbody select.material-select').first().find('option').each(function() {
                    var materialId = $(this).val();
                    var matrerialText = $(this).text();
                    // console.log(minqty);
                    productOptions += `<option value="${materialId}"
                                        >${matrerialText}</option>`;
                });
                var newRow = `<tr class="grouppricing-select-data">
                                    <td class="table-data-contents">
                                        <select class="custom-select d-block w-100 form-select-grp select2 material-select" name="material_id[]" id="material_${productSelectCounter}">
                                            ${productOptions}
                                        </select>
                                    </td>
                                    <td><input type="text" name="up[]" class="order-input" id="up${productSelectCounter}"></td>
                                    <td><input type="text" name="down[]" class="order-input" id="up${productSelectCounter}"></td>
                                    <td><input type="text" name="percentage[]" class="order-input" id="up${productSelectCounter}"></td>
                                    <td class="table-data-contents table-delete-icon">
                                        <a href="javascript:void(0)" class="btn-sm m-1 deleteRow"><span class="table-group-icons edit-icon-tag"></span></a>
                                    </td>
                                </tr>`;
            // console.log('data');
            $('tbody').append(newRow);
            $('tbody select.material-select').last().select2();
            // $('.deleteRow').click(function() {
            //         $(this).closest('tr').remove();
            //     });
            productSelectCounter++;
            // $('tbody').append('<tr><td>newRecipeFields</td><td>12</td><td>12</td><td>12</td></tr>');
        });
        $('tbody').on('click', '.deleteRow', function() {
                $(this).closest('tr').remove(); 
            });
        $(document).on('click','#leaveButton', function(){
            window.location.href = "{{ route('recipes.index') }}";
        });
        $('.orderList').click( function(){
            $("#indexModul").modal("show");
        });
    });
</script>
@endsection