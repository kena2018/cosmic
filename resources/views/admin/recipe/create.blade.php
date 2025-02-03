@extends('layouts.app')
@section('navbarTitel', 'Recipe Create')

@section('content')
    <div class="main-outer">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Recipe Create</span>
                <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
            </div>
            <form class="needs-validation" action="{{ route('recipes.store')}}" method="post" novalidate id="recipeAddData">
            <hr class="addsupplier-section-border">
                @csrf
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group" id="recipes-container">
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content" for="name">Recipe Name</label>

                                <input type="text" class="form-control input-form-content @error('recipe_name') is-invalid @enderror" name="recipe_name" id="recipe_name" placeholder="Recipe Name" value="{{old('recipe_name')}}" >
                                @error('recipe_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="heading-content" for="status">Status</label>
                                <select name="status" class="custom-select d-block w-100 form-select-grps form-control select2">
                                    <option class="option-desgn" value="">Select Status</option>
                                    <option class="option-desgn" value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option class="option-desgn" value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-designs table-bottom">
                    <table class="table active all">
                        <thead>
                            <th class="material_sub_category"><a href="javascript:void(0);" title="">Material Sub category</a></th>
                            <th class="material_name"><a href="javascript:void(0);" title="">Material Name</a></th>
                            <th class="top_layer"><a href="javascript:void(0);" title="">Top Layer %</a></th>
                            <th class="middle_layer"><a href="javascript:void(0);" title="">Middle Layer %</a></th>
                            <th class="percentage_recipe"><a href="javascript:void(0);" title="">Percentage</a></th>
                            <th class="action_recipe"><a href="javascript:void(0);" title="">Action</a></th>
                        </thead>
                        <tbody id="appendrecipe"> 
                            <tr class="table-select-data customerorder-table">
                                <td class="table-data-contents"></td>
                                <td class="table-data-contents"></td>
                                <td class="table-data-contents">
                                <input type="number" class="form-control input-form-content order-input   @error('top_layer') is-invalid @enderror" id="top_layer" name="top_layer"  value="{{old('top_layer')}}" min="0" max="100" readonly >
                                @error('top_layer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </td>
                                <td class="table-data-contents">
                                    <input type="number" class="form-control input-form-content order-input   @error('middle_layer') is-invalid @enderror" id="middle_layer" name="middle_layer"  value="{{old('middle_layer')}}" min="0" max="100"  >
                                    @error('middle_layer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </td>
                                <td class="table-data-contents"></td>
                            </tr>
                            <tr class="recipes-select-data">
                                <td class="table-data-contents">
                                    <select class="custom-select d-block w-100 form-select-grp select2 submaterial-select" id="submaterial_id" name="submaterial_id[]">
                                        <option value="">Select</option>
                                        @foreach($submaterials as $submaterial)
                                        
                                        <option value="{{$submaterial->id}}"  data-id="{{$submaterial->id}}">{{$submaterial->sub_cat_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('submaterial_id.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <!-- @error('submaterial_id.0')<div class="invalid-feedback">{{ $message }}</div>@enderror -->
                                </td>
                                <td class="table-data-contents">
                                    <select class="custom-select d-block w-100 form-select-grp select2 material-select" id="material_id" name="material_id[]">
                                        <option value="">Select</option>
                                        @foreach($materials as $material)
                                        
                                        <option value="{{$material->id}}"  data-id="{{$material->id}}">{{$material->material_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('material_id.0')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </td>
                                <td class="table-data-contents">
                                    <input type="text" name="up[]" value="{{old('up.0')}}"class="order-input @error('up.0') is-invalid @enderror @if(!empty(old('up.0'))) is-valid @endif" id="up">
                                </td>
                                <td class="table-data-contents"> 
                                  <input type="text" name="down[]" value="{{old('down.0')}}"class="order-input @error('down.0') is-invalid @enderror @if(!empty(old('down.0'))) is-valid @endif" id="down">
                                </td>
                                <td class="table-data-contents">
                                    <input type="text" name="percentage[]" value="{{old('percentage.0')}}"class="order-input @error('percentage.0') is-invalid @enderror @if(!empty(old('percentage.0'))) is-valid @endif"id="percentage" readonly>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td id="sumUP"></td>
                                <td id="downSum"></td>
                                <td id="percantageSum"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        
                        </div>
                        <div class="upload-file-sec customer-list-sec recipe-btns">
                            <div class="btn-sec btn_group">
                                <div class="button-1 cta_btn">
                                    <a href="javascript:void(0)" class="primary-button stock-btn" id="addRecipeBtn">Add Material</a>
                                </div>
                            </div>
                            <div class="order-btn-grp">
                                <div class="btn-sec btn_group">
                                    <div class="button-1 cta_btn">
                                        <button id="saveButton" type="submit" class="primary-button stock-btn">Save</button>
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
        updateSums();
        $('.select2').select2();
    // Add validation to the form
    $("#recipeAddData").validate({
        rules: {
            recipe_name: {
                required: true,
                minlength: 3
            },
            status: {
                required: true
            },
            middle_layer: {
                required: true
            },
            "submaterial_id[]": {
                required: true
            },
            "material_id[]": {
                required: true
            },
            "up[]": {
                required: true,
                number: true,
                min: 0,
                max: 100
            },
            "down[]": {
                required: true,
                number: true,
                min: 0,
                max: 100
            }
        },
        messages: {
            recipe_name: {
                required: "Please enter a recipe name",
                minlength: "Recipe name must be at least 3 characters long"
            },
            status: {
                required: "Please select a status"
            },
            middle_layer: {
                required: "Please enter percentage for middle layer"
            },
            "submaterial_id[]": {
                required: "Please select a submaterial"
            },
            "material_id[]": {
                required: "Please select a material"
            },
            "up[]": {
                required: "Please enter a value for Top Layer",
                number: "Please enter a valid number",
                min: "Value must be at least 0",
                max: "Value cannot exceed 100"
            },
            "down[]": {
                required: "Please enter a value for Middle Layer",
                number: "Please enter a valid number",
                min: "Value must be at least 0",
                max: "Value cannot exceed 100"
            }
        },
        errorElement: 'div',
        // errorPlacement: function (error, element) {
        //     if (element.hasClass('select2')) {
        //         error.insertAfter(element.next('.select2-container'));
        //     } else {
        //         error.insertAfter(element);
        //     }
        // }
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
    $('#recipeAddData').on('submit', function() { 
        let isValid = true;
        // Validate each input and select field in the last row
        $('tbody  tr:last').find('select[name="submaterial_id[]"]').each(function() {
            if (!$("#recipeAddData").validate().element($(this))) {
                isValid = false;
            }
        });
        $('tbody  tr:last').find('select[name="material_id[]"]').each(function() {
            if (!$("#recipeAddData").validate().element($(this))) {
                isValid = false;
            }
        });
        $('tbody  tr:last').find('[name="up[]"]').each(function() {
                if (!$("#recipeAddData").validate().element($(this))) {
                    isValid = false;
                }
            });
            $('tbody  tr:last').find('[name="down[]"]').each(function() {
                if (!$("#recipeAddData").validate().element($(this))) {
                    isValid = false;
                }
            });
            if (!isValid) {
                event.preventDefault();
            }
    });

    var productSelectCounter = 1;
$('#addRecipeBtn').click(function () {
        
        var materialOptions = '';
        var subcategoryOptions = '';
        $('tbody select.material-select').first().find('option').each(function () {
            materialOptions += `<option value="${$(this).val()}">${$(this).text()}</option>`;
        });
        $('tbody select.submaterial-select').first().find('option').each(function () {
            subcategoryOptions += `<option value="${$(this).val()}">${$(this).text()}</option>`;
        });

        var newRow =  `<tr class="recipes-select-data">
                        <td class="table-data-contents">
                            <select class="custom-select d-block w-100 form-select-grp select2 submaterial-select" name="submaterial_id[]" id="submaterial_id_${productSelectCounter}">
                                ${subcategoryOptions}
                            </select>
                        </td>
                        <td class="table-data-contents">
                            <select class="custom-select d-block w-100 form-select-grp select2 material-select" name="material_id[]" id="material_id_${productSelectCounter}">
                                ${materialOptions}
                            </select>
                        </td>
                        <td class="table-data-contents"><input type="text" name="up[]" id="up_${productSelectCounter}" class="order-input"></td>
                        <td class="table-data-contents"><input type="text" name="down[]"  id="down_${productSelectCounter}" class="order-input"></td>
                        <td class="table-data-contents"><input type="text" name="percentage[]" id="percentage_${productSelectCounter}" class="order-input" readonly></td>
                        <td class="table-data-contents table-delete-icon">
                            <a href="javascript:void(0)" class="btn-sm m-1 deleteRow"><span class="table-group-icons edit-icon-tag"></span></a>
                        </td>
                    </tr>`;
        $('tbody').append(newRow);
        $('tbody select.material-select').last().select2();
        $('tbody select.submaterial-select').last().select2();
        productSelectCounter++;

        // Add validation to dynamically added inputs
        $('input[name="up[]"]').last().rules('add', {
            required: true,
            number: true,
            min: 0,
            max: 100
        });
        $('input[name="down[]"]').last().rules('add', {
            required: true,
            number: true,
            min: 0,
            max: 100
        });
        $('select[name="submaterial_id[]"]').last().rules('add', {
            required: true
        });
        $('select[name="material_id[]"]').last().rules('add', {
            required: true
        });
        // $('#recipeAddData').validate().form();
        // Handle row deletion
        $('.deleteRow').click(function () {
            $(this).closest('tr').remove();
            updateSums();
            // $('#recipeAddData').validate().form();
        });
    });
        $(document).on('click','#leaveButton', function(){
            window.location.href = "{{ route('recipes.index') }}";
        });
        $('.orderList').click( function(){
            $("#indexModul").modal("show");
        });
        // Update the sum for all fields (up, down, percentage)
    function updateSums(total) {
        var row = $(this).closest('tr');
        var sumUp = 0;
        var sumDown = 0;
        var sumPercentage = 0;
        var percentageValue = 0;

        // Sum all the 'up' fields
        $('input[name="up[]"]').each(function() {
            var value = parseFloat($(this).val()) || 0;
            sumUp += value;
        });

        // Sum all the 'down' fields
        $('input[name="down[]"]').each(function() {
            var value = parseFloat($(this).val()) || 0;
            sumDown += value;
        });

        // Sum all the 'percentage' fields
        $('input[name="percentage[]"]').each(function() {
            var value = parseFloat($(this).val()) || 0;
            // console.log(value);
            sumPercentage += value;
        });
        // console.log(total);
        // Update the sum fields
        $('#sumUP').text(sumUp.toFixed(2));  // Show sum for UP
        $('#downSum').text(sumDown.toFixed(2));  // Show sum for Down
        $('#percantageSum').text(sumPercentage.toFixed(2));  // Show sum for Percentage
        // var up = (sumUp.toFixed(2))+ (sumDown.toFixed(2));
        // $('#25percentage').text(up.toFixed(2));  // Show sum for Percentage
        var totalSum = sumUp + sumDown;
        // var percentagefirst = 0;
        var percentagefirst = (sumUp / totalSum) * 100 || 0;
        var percentagesecound = (sumDown / totalSum) * 100 || 0;
        $('#middle_layer').on('input', function () {
            var topLayerValue = parseFloat($(this).val()) || 0;  // Get the value of top_layer input, default to 0 if empty
            topLayerValue = 100 - topLayerValue;  // Subtract from 100
            //  console.log(percentageValue);
            $('input[name="top_layer"]').val(topLayerValue.toFixed(0));
            updateSums(); // Update 25percentage field with the result
        });
        $('input[name="percentage[]"]').each(function() {
            var row = $(this).closest('tr');
            var up = parseFloat(row.find('input[name="up[]"]').val()) || 0;
            var down = parseFloat(row.find('input[name="down[]"]').val()) || 0;
            var topLayerValue = parseFloat($('input[name="top_layer"]').val()) || 0;
            var percentagedownValuedata = 100-topLayerValue;
            var uptotal = (( up/sumUp )*topLayerValue);
            var downtotal = (( down/sumDown )*percentagedownValuedata);
            var updown = uptotal + downtotal ;
            updown = isNaN(updown) ? 0 : updown;
            $(this).val(updown.toFixed(2) + '%');
        });
        
    }
    $(document).on('input', 'input[name="up[]"]', function() {
        // Call the updateSums function directly when the 'up' value changes
        updateSums();
    });
    $(document).on('input', 'input[name="down[]"]', function() {
        // Call the updateSums function directly when the 'up' value changes
        updateSums();
    });
    $(document).on('change', '.submaterial-select', function() {
        var submaterialId = $(this).val();  // Get the selected submaterial ID
        var materialSelect = $(this).closest('tr').find('.material-select');  // Find the material select in the same row
        // Check if a valid submaterial is selected
        if (submaterialId) {
            // AJAX request to fetch materials based on subcategory
            $.ajax({
            url: '{{ route("material.getMaterialsBySubCat", ":id") }}'.replace(':id', submaterialId),
            type: 'GET',
            success: function(materials) {
                // var materials = response.materials;
                materialSelect.empty().append('<option value="">Select Material</option>');  // Clear existing options
                if (materials.materials.length > 0) {
                    $.each(materials.materials, function(index, material) {
                        materialSelect.append(
                            '<option value="' + material.id + '" data-weight="' + material.material_weight + '">' + 
                            material.material_name + 
                            '</option>'
                        );
                    });

                    materialSelect.select2();  // Reinitialize select2 after updating options
                } else {
                    materialSelect.append('<option value="">No materials available</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
        } else {
            // If no submaterial is selected, clear the material select options
            materialSelect.empty();
            materialSelect.append('<option value="">Select</option>');
            materialSelect.select2();
        }
    });


    // Recalculate sums when page loads initially (in case of pre-filled values)
    updateSums();
        
        
        
    });
    
</script>
@endsection