@extends('layouts.app')
@section('navbarTitel', 'Stock Inward Reports')
@section('content')

<div class="main-outer">
    <div class="outer card">
        <div class="upload-file-sec list-sec">
            <span class="addsupplier-section-heading">List of Stock Inward Reports</span>
            <div class="btn-sec btn_group">
                <div class="search-sec searchwith_back">
                    <form class="input-group">
                        <div class="form-outline" data-mdb-input-init> 
                            <input id="searchdata" type="text" class="form-control form-control-inp" placeholder="Search">
                            <span class="search-icons search-icon-tag"></span>
                        </div>
                    </form>
                    <div class="btn-sec btn_group bck_btn">
                        <a href="{{route('reports.index')}}">
                            <span class="back-icons back-tab-icon"></span> 
                        </a>
                    </div>
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
                        <th>User ID</th>
                        <th>Date</th>
                        <th>Machine</th>
                        <th>Material Name</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Unit 1</th>
                        <th>Unit 1 Value</th>
                        <th>Unit 2</th>
                        <th>Unit 2 Value</th>
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
                url: '{{ route("reports.stockInward") }}',
                data: function(d) {
                    d.SearchData = $('#searchdata').val();
                },
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'user_id', name: 'user_id' },
                { data: 'date', name: 'date' },
                { data: 'machine', name: 'machine' },
                { data: 'material_name', name: 'material_name' },
                { data: 'material_category_type', name: 'material_category_type' },
                { data: 'material_sub_category', name: 'material_sub_category' },
                { data: 'unit1', name: 'unit1' },
                { data: 'unit1_value', name: 'unit1_value' },
                { data: 'unit2', name: 'unit2' },
                { data: 'unit2_value', name: 'unit2_value' },
               { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            order: [[0, 'desc']],
        });

        $('#searchdata').on('input', function() {
            table.ajax.reload(null, false); // Reload the table without resetting pagination
        });
    });
</script>
@endsection
