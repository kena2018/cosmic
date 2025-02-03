@extends('layouts.app')
@section('navbarTitel', 'Edit Materials')
@section('content')

<div class="main-outer">
    <div class="outer card">
        <div class="heading-btn">
            <span class="addsupplier-section-heading">Material Information</span>
            <button type="button"  class="orderList"><span class="back-icons back-tab-icon"></span></button>
        </div>
        <form id="materialEditForm" action="{{ route('material.update', $material->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <!-- Material Category Field -->
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="category_id">Material Category <span style="color: red;">*</span></label>
                            <select class="custom-select select2 d-block w-100 form-select-grp form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                <option value="" disabled>Select Material Category</option>
                                @foreach($category as $categories)
                                    <option data-name="{{$categories->name}}" value="{{ $categories->id }}" {{ old('category_id', $material->category_id) == $categories->id ? 'selected' : '' }}>{{ $categories->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Sub-Category Field -->
                        <div class="col-lg-6 mb-1" id="sub_category_div">
                            <label class="heading-content" for="sub_category">Sub Category</label>
                            <select class="custom-select select2 d-block w-100 form-select-grp form-control @error('sub_category') is-invalid @enderror" name="sub_category" id="sub_category">
                                <option value="" disabled>Select Sub Category</option>
                                @foreach($subcategories as $subCategory)
                                    <option value="{{ $subCategory->id }}" {{ old('sub_category', $material->sub_category) == $subCategory->id ? 'selected' : '' }}>
                                        {{ $subCategory->sub_cat_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sub_category')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-1" id="materialWidth">
                            <label class="heading-content" for="material_width">Material Width <span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('material_width') is-invalid @enderror" name="material_width" id="material_width" value="{{ old('material_width', $material->material_width) }}">
                            @error('material_width')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Material Name Field -->
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="material_name">Material Name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('material_name') is-invalid @enderror" name="material_name" id="material_name" value="{{ old('material_name', $material->material_name) }}">
                            @error('material_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Quantity Field -->
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="unit1">Unit 1<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('unit1') is-invalid @enderror" name="unit1" id="unit1" value="{{ old('unit1', $material->quantity ?? '') }}">
                            @error('unit1')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="unit2">Unit 2</label>
                            <input type="text" class="form-control input-form-content @error('unit2') is-invalid @enderror" name="unit2" id="unit2" value="{{ old('unit2', $material->unit ?? '') }}">
                            @error('unit2')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Unit Field -->
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="remark">Remark</label>
                            <input type="text" class="form-control input-form-content @error('remark') is-invalid @enderror" name="remark" id="remark" value="{{ old('remark', $material->remark) }}" placeholder="Enter Remark">
                            @error('remark')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-1">
                            <label class="heading-content" for="material_weight">Material weight</label>
                            <input type="number" class="form-control input-form-content @error('material_weight') is-invalid @enderror" name="material_weight" id="material_weight" value="{{ old('material_weight', $material->material_weight ?? '') }}">
                            @error('material_weight')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Material Product Image Field -->
                        <div class="col-lg-6 mb-1 material-img-sec">
                            <label class="heading-content" for="material_product_image">Material Product Image</label>
                            <input type="file" class="form-control input-form-content image-file-data @error('material_product_image') is-invalid @enderror" name="material_product_image" id="material_product_image" onchange="previewImage(event)">
                            @error('material_product_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Current Image Preview -->
                        <div class="col-lg-3 mb-1">
                            <label class="heading-content">Current Image</label>
                            <img src="{{ asset('public/storage/' . $material->material_product_image) }}" alt="Current Image" style="max-width: 200px; max-height: 200px; object-fit: contain;">
                        </div>

                        <!-- Image Preview -->
                        <div class="col-lg-3 mb-1">
                            <label class="heading-content">Image Preview</label>
                            <img id="image_preview" src="#" alt="Image Preview" style="display: none; max-width: 200px; max-height: 200px; object-fit: contain;">
                        </div>
                        
                    </div>
                    <div class="upload--file-section">
                        <div class="btn-sec btn_group"></div>
                        <div class="order-btn-grp">
                            <div class="btn-sec btn_group">
                                <div class="button-1 cta_btn">
                                    <button id="editButton" type="submit" class="primary-button stock-btn">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Category and Sub-Category Handling -->
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
            if ($(this).find('option:selected').text() === 'Paper Reel' || $(this).find('option:selected').text() === 'Lamination Film') {
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
        // $('select').on('focus', function() {
        //     $(this).prop('size', 5); // Use a more reasonable size
        // }).on('blur', function() {
        //     $(this).prop('size', 1); // Reset size when focus is lost
        // }).on('change', function() {
        //     $(this).prop('size', 1); // Close the dropdown after selection
        // });
        $('button[type="submit"]').on('focus', function() {
            $(this).addClass('btn-focus');
        }).on('blur', function() {
            $(this).removeClass('btn-focus');
        });
        // $('#material_product_image').on('focus', function() {
        //     // if (!hasOpened) {
        //     //     $(this).trigger('click'); // Trigger click to open the file selection dialog
        //     //     hasOpened = true; // Set the flag to true after opening
        //     // }
        //     $(this).trigger('click'); // Trigger click to open the file selection dialog
        // });
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

    window.onload = function() {
    var categorySelect = document.getElementById('category_id');
    var subCategoryDiv = document.getElementById('sub_category_div');
    var selectedOption = categorySelect.options[categorySelect.selectedIndex];
    var selectedCategoryName = selectedOption.getAttribute('data-name');
    // Find the <select> element inside subCategoryDiv
    var selectElement = subCategoryDiv.querySelector('select');
    // Get the selected option's text
    var selectedText = selectElement.options[selectElement.selectedIndex].text;
    // Print the selected option's text to the console
    if (selectedText === 'Paper Reel' || selectedText === 'Lamination Film') {
        $('#materialWidth').show(); // Show Material Width for Paper Reel or Lamination Film
    } else {
        $('#materialWidth').hide(); // Hide Material Width for all other sub-categories
    }
    // Initial check to set the visibility on page load
    if (selectedCategoryName) {
        subCategoryDiv.style.display = 'block';
    } else {
        subCategoryDiv.style.display = 'none';
    }

    // Add event listener for change event
    categorySelect.addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var selectedCategoryName = selectedOption.getAttribute('data-name');

        console.log(subCategoryDiv); // For debugging
        console.log(selectedCategoryName); // For debugging

        if (selectedCategoryName) {
            subCategoryDiv.style.display = 'block';
        } else {
            subCategoryDiv.style.display = 'none';
        }
    });
};

</script>

<!-- JavaScript for Image Preview -->
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        const imagePreview = document.getElementById('image_preview');

        if (file) {
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '#';
            imagePreview.style.display = 'none';
        }
    }

    $(document).ready(function () {
        $("#materialEditForm").validate({
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
                    number: true,
                    required: true,
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
                    required: "Please select Material Category",
                    maxlength: "Category ID cannot exceed 255 characters."
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
                },
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
        $('#category_id').on('change', function() {
        var selectedCategoryId = $(this).val();
        var subCategory = $('#sub_category');
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
                        // var selectedSubCategoryId = packingMaterialTypeSelect.val();
                        console.log('Initially selected subcategory ID:', selectedSubCategoryId);
                        // loadMaterialNames(selectedCategoryId, selectedSubCategoryId);

                        // Handle subcategory change
                        // packingMaterialTypeSelect.off('change').on('change', function() {
                        //     var selectedSubCategoryId = $(this).val();
                        //     if (selectedSubCategoryId) {
                        //         // loadMaterialNames(selectedCategoryId, selectedSubCategoryId);
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
