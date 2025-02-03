@extends('layouts.app')
@section('navbarTitel', 'Recipe')
@section('content')
    <div class="main-outer">
        <div class="outer card">
            <div class="upload-file-sec customer-list-sec">
                <span class="addsupplier-section-heading">Recipe List</span>
                <div class="btn-sec btn_group">
                    <div class="search-sec">
                        <form class="input-group">
                            <div class="form-outline" data-mdb-input-init>
                                <input id="searchdata" type="text" class="form-control form-control-inp"
                                    placeholder="Search">
                                <span class="search-icons search-icon-tag"></span>
                            </div>
                        </form>
                    </div>
                    <div class="button-1 cta_btn icon-btn">
                        <a href="{{route('recipes.create')}}" class="primary-button  confirm-leave-link ">Add Recipe</a>
                    </div>
                </div>
            </div>
            <hr class="addsupplier-section-border">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

            <div class="table-responsive table-designs">
                <table class="table active all dataRecipe">
                    <thead>
                        <th class="permission-table-contnts"><a class="permission_title" href="javascript:void(0);" title="Recipe Id">Id</a></th>
                        <th class="permission-table-contnts"><a class="permission_title" href="javascript:void(0);" title="Recipe Name">Name</a></th>
                        <th class="permission-table-contnts"><a class="permission_title" href="javascript:void(0);" title="Recipe Status">Status</a></th>
                        <th class="permission-table-contnts"><a href="javascript:void(0);" title="Actions">Actions</a></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
        var recipeId;
        var table = $('.dataRecipe').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                    url: "{{ route('recipes.index') }}",
                data: function(d) {
                        d.SearchData = $('#searchdata').val();
                
                },
            },
            columns: [
                { data: 'id', name: 'id', orderable: true, searchable: true, visible: false },
                { data: 'recipe_name', name: 'recipe_name', orderable: true, searchable: true },
                { data: 'status', name: 'status', orderable: true, searchable: true },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'desc']],
        });
        $('#searchdata').on('input', function() {
            table.ajax.reload(null, false); // Reload the table without resetting pagination
        });
        $('.dataRecipe').on('click', '.delete-recipe', function() {
            recipeId = $(this).data('id');
            // console.log(recipeId);
            $("#recipesModal").modal("show");

        });
        $('.Cancel-recipe').click( function(){
            $("#recipesModal").modal("hide");
        });
        $('.delete-recipe').click( function(){

            if (!recipeId) {
                alert('Recipe ID is missing.');
                return;
            }
            $.ajax({
                    url: '{{ route('recipes.destroy', ['recipe' => ':recipeId']) }}'.replace(':recipeId', recipeId),
                    type: 'DELETE',
                    data: {
                        id: recipeId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Item deleted successfully!');
                            location.reload();
                        } else {
                            toastr.error('An error occurred while deleting the item.');
                        }
                    },
                    error: function(response) {
                        alert('Error deleting Recipe.');
                    }
                });
            
        });
        
    });
</script>              
@endsection
@section('modul')
<div class="modal fade" id="recipesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content model-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Recipe ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <p class="modal-para">Are you sure you want to delete this recipe ?</p>
            </div>
            <div class="modal-footer cstmr-odr-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                        <a href="javascript:void(0)" class="delete-customer delete-recipe" id="role_id" data-id="">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
