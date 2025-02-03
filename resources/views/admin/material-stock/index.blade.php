@extends('layouts.app')
@section('navbarTitel', 'Material Stocks')
@section('content')
<style>
   .icon-tab-btn .calendar-dropdown { display: none; position: absolute; top: 25%; right: 0px; background: #fff; border: 1px solid #BCBFC5; border-radius: 5px; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); z-index: 1000;}
   .calendariicon {position: relative;}
</style>
<div class="main-outer">
    <div class="outer card">
        <div class="upload-file-sec list-sec">
            <span class="addsupplier-section-heading">List of Material Stock</span>
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
            </div>
        </div>
        <hr class="addsupplier-section-border">
        <div class="table-responsive table-designs">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <table class="table table-bordered" id="stockTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Material Name</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>In Stock Quantity</th>
                        <th>Unit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var table = $('#stockTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: '{{ route("materialStock.index") }}',
                // url: '{{ route("price-list.index") }}',
                data: function(d) {
                    d.SearchData = $('#searchdata').val();
                },
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'material_name', name: 'material_name' },
                { data: 'category_id', name: 'category_id' }, // Derived column
                { data: 'sub_category', name: 'sub_category' },
                { data: 'unit1_value', name: 'unit1_value' },
                { data: 'unit1', name: 'unit1' },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[0, 'desc']],
        });
        $('#searchdata').on('input', function() {
            table.ajax.reload(null, false); // Reload the table without resetting pagination
        });
    });
</script>
@endsection

