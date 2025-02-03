@extends('layouts.app')
@section('navbarTitel', 'Add Materials')
@section('content')
<div class="main-outer">
    <div class="outer card">
        <form id="materialAddForm" action="{{ route('material.store') }}" method="post"  enctype="multipart/form-data" class="form_mn">
            @csrf
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Material Information</span>
                <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                    <div class="col-lg-6 mb-1">
                        <label class="heading-content" for="category_id">Material Category<span style="color: red;">*</span></label>
                        <select class="custom-select select2 d-block w-100 form-select-grp form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id" size="1">
                            <option value="" disabled selected>Select Material Category</option>
                            @foreach($category as $categories)
                                <option data-name="{{ $categories->name }}" value="{{ $categories->id }}" {{ old('category') == $categories->id ? 'selected' : '' }}>
                                    {{ $categories->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>

                        <!-- Sub-Category Field -->
                        <div class="col-lg-6 mb-1" id="sub_category_div">
                        <label class="heading-content" for="sub_category">Sub Category<span style="color: red;">*</span></label>
                        <select class="custom-select select2 d-block w-100 form-select-grp form-control @error('sub_category') is-invalid @enderror" name="sub_category" id="sub_category">
                            <option value="">Select Sub Category</option>
                        </select>
                        @error('sub_category')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="material_name">Material Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('material_name') is-invalid @enderror" name="material_name" id="material_name" value="{{ old('material_name') }}" placeholder="Enter Material Name">
                            @error('material_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-1" id="materialWidth">
                            <label class="heading-content" for="material_width">Material Width<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('material_width') is-invalid @enderror" name="material_width" id="material_width" value="{{ old('material_width') }}" placeholder="Enter Material Width">
                            @error('material_width')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="unit1">Unit 1<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('unit1') is-invalid @enderror" name="unit1" id="unit1" value="{{ old('unit1') }}" placeholder="Unit 1">
                            @error('unit1')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="unit1">Unit 2</label>
                            <input type="text" class="form-control input-form-content @error('unit2') is-invalid @enderror" name="unit2" id="unit2" value="{{ old('unit2') }}" placeholder="Unit 2">
                            @error('unit2')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="remark">Remark</label>
                            <input type="text" class="form-control input-form-content @error('remark') is-invalid @enderror" name="remark" id="remark" value="{{ old('remark') }}" placeholder="Enter Remark">
                            @error('remark')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="material_weight">Material Weight</label>
                            <input type="number" class="form-control input-form-content @error('material_weight') is-invalid @enderror" name="material_weight" id="material_weight" value="{{ old('material_weight') }}" placeholder="Material Weight">
                            @error('material_weight')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-1 material-img-sec">
                            <label class="heading-content" for="material_product_image">Material Product Image</label>
                            <input type="file" class="form-control  input-form-content image-file-data @error('material_product_image') is-invalid @enderror" name="material_product_image" id="material_product_image" onchange="previewImage(event)">
                            @error('material_product_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content">Image Preview</label>
                            <img id="image_preview" src="#" alt="Image Preview" style="display: none; max-width: 200px; max-height: 200px; object-fit: contain;">
                        </div>
                    </div>
                    <div class="upload--file-section">
                        <div class="btn-sec btn_group"></div>
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
<!-- <script src="{{ asset('public/assets/js/createpage.js')}}"></script> -->
<script>
    $(document).on('focusin', '.select2', function(e) {
        // Select2 handles the focus differently, this ensures the dropdown opens on focus
        $(this).siblings('select').select2('open');
    });
    $(document).ready(function(){ 
        $('#sub_category').on('change', function() {
            var selectedSubCategoryId = $(this).val();  // Get the selected ID
            var selectedSubCategoryText = $(this).find('option:selected').text();  // Get the selected name

            if (selectedSubCategoryText === 'Paper Reel' || selectedSubCategoryText === 'Lamination Film') {
                $('#materialWidth').show(); // Show Material Width for Paper Reel or Lamination Film
            } else {
                $('#materialWidth').hide(); // Hide Material Width for all other sub-categories
            }
        });
        $(document).on('click','#leaveButton', function(){
            window.location.href = "{{ route('material.index') }}";
        });
        $('.orderList').click( function(){
            $("#indexModul").modal("show");
        });
        $('.select2').select2();
        $('#category_id').focus();
        // $('#material_product_image').on('focus', function() {
        //     $(this).trigger('click'); // Trigger click to open the file selection dialog
        // });
        
        // $('#material_product_image').on('change', function() {
        //     // Check if a file was selected
        //     if ($(this).val() !== '') {
        //         hasOpened = false; // Reset flag if a file is selected
        //     } else {
        //         hasOpened = true; // Keep it true if the dialog was canceled
        //     }
        // });
        // Function to preview the image
        // window.previewImage = function(event) {
        //     const input = event.target;
        //     const preview = $('#image_preview');

        //     if (input.files && input.files[0]) {
        //         const reader = new FileReader();

        //         reader.onload = function(e) {
        //             preview.attr('src', e.target.result);
        //             preview.show(); // Show the image preview
        //         };

        //         reader.readAsDataURL(input.files[0]); // Convert the file to base64
        //     } else {
        //         preview.hide(); // Hide the image preview if no file is selected
        //     }
        // };
        $('button[type="submit"]').on('focus', function() {
            $(this).addClass('btn-focus');
        }).on('blur', function() {
            $(this).removeClass('btn-focus');
        });
    });
    
    document.getElementById('category_id').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var selectedCategoryName = selectedOption.getAttribute('data-name');
        var subCategoryDiv = document.getElementById('sub_category_div');
        if (selectedCategoryName) {
            subCategoryDiv.style.display = 'block';
        } else {
            subCategoryDiv.style.display = 'none';
        }
    });
</script>
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        const imagePreview = document.getElementById('image_preview');

        if (file) {
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '#';
            imagePreview.style.display = 'none';
        }
    }
    $(document).ready(function () {
    $("#materialAddForm").validate({
        rules: {
            category_id: {
                required: true,
                maxlength: 255,
            },
            sub_category: {
                required: true,
                maxlength: 255,
            },
            unit1: {
                required: true,
                maxlength: 255,
            },
            unit2: {
                maxlength: 255,
            },
            material_weight: {
                required: true,
                number: true,
            },
            material_name: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            material_width: {
                required: true,
            }
            
        },
        messages: {
            material_weight: {
                    required: "Please enter Material weight.",
                },
            category_id: {
                required: "Please select Material Category.",
                // maxlength: "Category ID cannot exceed 255 characters."
            },
            sub_category: {
                required: "Please select Sub Category.",
                maxlength: "Sub category cannot exceed 255 characters."
            },
            unit1: {
                required: "Please enter  Unit 1.",
                maxlength: "Unit cannot exceed 255 characters."
            },
            unit2: {
                maxlength: "Unit cannot exceed 255 characters."
            },
            material_name: {
                required: "Please enter Material Name.",
                minlength: "Material name must be at least 3 characters long",
                maxlength: "Material name cannot exceed 50 characters"
            },
            material_width: {
                required: "Please enter Material Width.",
            }
        },
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
    });

    jQuery.validator.addMethod("filesize", function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param * 1024);
    });
    var subCategory = $('#sub_category');
    $('#category_id').on('change', function() {
        var selectedCategoryId = $(this).val();
        
        // var materialWidthDiv = $('#material_width').closest('.col-lg-6');

        if (selectedCategoryId) {
            $.ajax({
                url: '{{ route("material.getSubcategories", ":id") }}'.replace(':id', selectedCategoryId),
                type: 'GET',
                success: function(data) {
                    console.log('6666666666');
                    console.log(data.subcategories);
                    if (data.subcategories.length > 0) {
                        $('#sub_category').empty().append('<option value="" disabled selected>Select Sub Category</option>');
                        $.each(data.subcategories, function(index, subcategory) {
                            // packingMaterialTypeSelect.append('<option value="' + subcategory.id + '">' + subcategory.sub_cat_name + '</option>');
                            subCategory.append('<option value="' + subcategory.id + '">' + subcategory.sub_cat_name + '</option>');
                        });
                        // packingMaterialTypeSelect.find('option:eq(1)').prop('selected', true);
                        subCategory.find('option:eq(1)').prop('selected', true);
                        subCategory.show();
                        
                        var selectedSubCategoryId = subCategory.val();
                        var selectedSubCategoryText = subCategory.find('option:selected').text();
                        if (selectedSubCategoryText === 'Paper Reel' || selectedSubCategoryText === 'Lamination Film') {
                            $('#materialWidth').show(); // Show Material Width for Paper Reel or Lamination Film
                        } else {
                            $('#materialWidth').hide(); // Hide Material Width for all other sub-categories
                        }
                        // loadMaterialNames(selectedCategoryId, selectedSubCategoryId);

                        // Handle subcategory change
                        // packingMaterialTypeSelect.off('change').on('change', function() {
                        //     var selectedSubCategoryId = $(this).val();
                        //     if (selectedSubCategoryId) {
                        //         loadMaterialNames(selectedCategoryId, selectedSubCategoryId);
                        //     } else {
                        //         packingMaterialNameSelect.empty().append('<option value="">Select material Name</option>');
                        //     }
                        // });
                    } else {

                        packingMaterialTypeDiv.hide();
                        // loadMaterialNames(selectedCategoryId, null);
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
    
});
</script>

@endsection
