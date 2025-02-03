@extends('layouts.app')
@section('navbarTitel', 'Reports - Lamination Report')
@section('content')
<style>
.report-graph {width: 65%;}
.icon-tab-btn .calendar-dropdown { display: none; position: absolute; top: 8%; right: 0px; background: #fff; border: 1px solid #BCBFC5; border-radius: 5px; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); z-index: 1000;}
.calendariicon {position: relative;}
.graph-container { position: relative; display: flex;  align-items: flex-end;  height: 315px; width: 75%; border-left: 1px solid #dcdcdc; border-bottom: 1px solid #dcdcdc; margin: 15px 0 13px 80px;}
.bar-container { display: flex; align-items: flex-end; justify-content: center; height: 100%; gap: 10px; width: 85%;}
.bar-left { margin-left: 63px;}
.bar { width: 30px; text-align: center; color: white; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); position: relative;}
.x-axis { display: flex; justify-content: center; width: 100%; gap: 35px; position: absolute; bottom: -25px; left: -26px;}
.x-axis .label, .y-axis .label { font-size: 13px; margin-left: 38px; font-weight: 500;  line-height: 20px; color: #434444;}
.y-axis { position: absolute; left: 0px; top: 6px; height: 100%; display: flex; flex-direction: column; justify-content: space-between; margin-left: -145px; align-items: end; width: 137px;flex-flow: column-reverse;}
.bar:hover .tooltip { opacity: 1; position: absolute; top: -26px; left: -13%; text-align: center; width: 43px; background: #d9d9d9; border-radius: 5px; font-size: 12px; font-weight: 600;transition: .5s;padding:2px 1px;color: rgb(59, 60, 60);}
@media (max-width:991px){
    .graph-container { margin: 15px 0 13px 40px !important;}
}
</style>
<div class="main-outer">
    <div class="main-section">
    <div class="outer card report-graph">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="report-bar-heading">
                        <h6>Lamination Bar Graph</h6> 
                    </div>
                    <div class="graph-container">
                       
                        <div class="bar-container">
                            @foreach($barGraphData as $year => $data)
                            <div class="bar bar-left" style="height: {{ $data['percentage'] }}%;; background-color: #985E37;" data-percentage="{{ $data['percentage'] }}">
                                <div class="tooltip">{{ $data['percentage'] }}</div>
                            </div>
                            @endforeach
                            <div class="x-axis">
                                <div class="label">0-10</div>
                                <div class="label">11-20</div>
                                <div class="label">20-31</div>
                            </div>
                        </div>
                        
                        <div class="y-axis">
                            @foreach($barRanges as $range)
                                <div class="label">{{ $range }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div> 
        </div> 

        <div class="icon-tab-btn">
            <div class="btn-sec btn_group calendariicon">
                <a href="javascript:void(0)" id="calendarIcon">
                    <span class="table-calender-icon calender-icon-tag"></span>
                </a>
                <div id="calendarDropdown" class="calendar-dropdown">
                    <!-- You can use a date picker library or a custom calendar here -->
                    <input type="date" id="calendarInput" />
                </div>
            </div>
            <div class="btn-sec btn_group">
                <a href="{{ route('reports.lamination.pdf') }}" target="_blank">
                    <span class="report-print-icon report-print-icon-tag"></span>
                </a>
            </div>
            <div class="btn-sec btn_group">
                <!-- <a href="{{ route('reports.lamination.pdf') }}" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a> -->
                <a href="{{route('reports.index')}}">
                    <span class="back-icons back-tab-icon"></span>
                </a>
            </div>
        </div>
    </div>

    <div class="outer card">
        <div class="upload-file-sec customer-list-sec">
            <h6 class="addsupplier-section-heading">Lamination orders list</h6> 
        </div>
        <div class="table-responsive table-designs">
            <table class="table active all" id="rewindingTable">
                <thead>
                    <th>Date</th>
                    <th>Sales Order Id</th>
                    <th>Production Order ID</th>
                    <th>Customer Name</th>
                    <th>User Name</th>
                    <th>Product Name</th>
                    <th>Completed quantity in Bundles</th>
                    <th>Quantity Required in Bundles</th>
                    <th>Machine</th>
                    <th>Meter</th>
                    <th>Action</th>
                </thead>
            </table>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const calendarIcon = document.getElementById("calendarIcon");
    const calendarDropdown = document.getElementById("calendarDropdown");

    // Toggle the dropdown visibility
    calendarIcon.addEventListener("click", function (event) {
        event.stopPropagation(); // Prevent click event from propagating
        if (calendarDropdown.style.display === "block") {
            calendarDropdown.style.display = "none";
        } else {
            calendarDropdown.style.display = "block";
        }
    });

    // Close the dropdown when clicking outside
    document.addEventListener("click", function () {
        calendarDropdown.style.display = "none";
    });

    // Prevent dropdown from closing when clicking inside it
    calendarDropdown.addEventListener("click", function (event) {
        event.stopPropagation();
    });
});
</script>
<script>
$(document).ready(function() {
    $('#rewindingTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('reports.lamination') }}", // Use the route to get data via AJAX
        columns: [
            { data: 'date', name: 'date' },
            { data: 'sales_order_id', name: 'sales_order_id' },
            { data: 'production_order_id', name: 'production_order_id' },
            { data: 'customer_name', name: 'customer_name' },
            { data: 'user_name', name: 'user_name' },
            // { data: 'full_name', name: 'full_name' },
            // { data: 'last_name', name: 'last_name' },
            { data: 'product_name', name: 'product_name', class: 'product_names tooltip-tabledata' ,
                render: function (data, type, row) {
                    return '<span title="' + data + '">' + data + '</span>';}
             },
            { data: 'this_orders_completed_quantity', name: 'this_orders_completed_quantity' },
            { data: 'bundle_quantity', name: 'bundle_quantity'},
            { data: 'machine', name: 'machine' },
            { data: 'meter', name: 'meter' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
<script>
    document.querySelectorAll('.bar').forEach(function(bar) {
        bar.addEventListener('mouseenter', function() {
            const value = this.getAttribute('data-value');
            const tooltip = this.querySelector('.tooltip');
            console.log(tooltip);
            tooltip.innerText = value;
            tooltip.style.display = 'block';
            tooltip.style.color = '#3b3c3c';
        });

        bar.addEventListener('mouseleave', function() {
            const tooltip = this.querySelector('.tooltip');
            tooltip.style.display = 'block';
        });
    });
</script>
@endsection

