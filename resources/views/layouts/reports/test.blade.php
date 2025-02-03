@extends('layouts.app')
@section('navbarTitel', 'Reports - Daily Rewinding Report')
@section('content')
<style>
  .bar-graph {
    width: 100% !important;
    padding: 20px !important;
}

.bar-one {
    display: flex !important;
    align-items: center !important;
    margin: 10px 0 !important;
}

.year {
    width: 100px !important; /* Fixed width for year label */
    text-align: left !important;
}

.bar {
    height: 30px !important; /* Height of the bar */
    background-color: #4CAF50 !important; /* Green color for the bar */
    margin-left: 10px !important;
    transition: width 0.3s !important; /* Smooth transition for width */
}

.percentage {
    margin-left: 10px !important; /* Space for percentage label */
    color: #333 !important; /* Color for percentage text */
}

.bar-ranges {
    display: flex !important;
    justify-content: space-between !important;
    margin-top: 20px !important;
}


</style>
<div class="main-outer">
    <div class="main-section">
        <div class="outer card report-graph">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="report-bar-heading">
                        <h6>React Bar Graph</h6>
                    </div>
                    <section class="bar-graph bar-graph-horizontal bar-graph-one">
                        @foreach($barGraphData as $year => $percentage)
                            <div class="bar-one">
                                <span class="year">{{ $year }}</span>
                                <div class="bar" style="width: {{ $percentage }};"></div>
                                <span class="percentage">{{ $percentage }}</span>
                            </div>
                            <hr class="report-border">
                        @endforeach
                        <div class="bar-ranges">
                            <span class="bar-range">0</span>
                            <span class="bar-range">Rs.20,000</span>
                            <span class="bar-range">Rs.40,000</span>
                            <span class="bar-range">Rs.60,000</span>
                            <span class="bar-range">Rs.80,000</span>
                            <span class="bar-range">Rs.100,000</span>
                            <span class="bar-range">Rs.120,000</span>
                        </div>
                    </section>

                </div>
            </div>
        </div>
        <div class="icon-tab-btn">
            <div class="btn-sec btn_group">
                <a href="javascript:void(0)">
                    <span class="table-calender-icon calender-icon-tag"></span>
                </a>
            </div>
            <div class="btn-sec btn_group">
                <a href="javascript:void(0)">
                    <span class="report-print-icon report-print-icon-tag"></span>
                </a>
            </div>
        </div>
    </div>

    <div class="report-heading">
        <h6>Production Graph</h6>
    </div>

    <div class="outer card">
        <div class="upload-file-sec customer-list-sec">
            <h6 class="addsupplier-section-heading">Product list</h6>
        </div>
        <div class="table-responsive table-designs">
            <table class="table active all" id="rewindingTable">
                <thead>
                    <th>Dep.</th>
                    <th>Size</th>
                    <th>Gauge</th>
                    <th>Product Name</th>
                    <th>MTR</th>
                    <th>Tube</th>
                    <th>Colour</th>
                    <th>Roll</th>
                    <th>Contractor</th>
                    <th>Meter</th>
                    <th>GSM</th>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#rewindingTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('reports.rewinding') }}",
        columns: [
            { data: 'category_name', name: 'category_name' },
            { data: 'pipe_size', name: 'pipe_size' },
            { data: 'gage', name: 'gage' },
            { data: 'product_name', name: 'product_name' },
            { data: 'pending_bundle_qty', name: 'pending_bundle_qty' },
            { data: 'rewinding_pipe', name: 'rewinding_pipe' },
            { data: 'color', name: 'color' },
            { data: 'rewinding_qty_in_rolls', name: 'rewinding_qty_in_rolls' },
            // { data: 'contractor', name: 'contractor' }, 
            // { data: 'meter', name: 'meter' },
            { data: 'gsm', name: 'gsm' }
        ]
    });
});
</script>

@endsection
