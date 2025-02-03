@extends('layouts.app')
@section('navbarTitel', 'Order Reports')
@section('content')
<div class="main-outer">
    <!-- Filters Section -->
    <div class="outer card">
        <div class="upload-file-sec customer-list-sec">
            <span class="addsupplier-section-heading">Filter Reports</span>
            <div class="btn-sec btn_group">
                <!-- <a href="{{ route('reports.lamination.pdf') }}" class="btn-sm m-1" target="_blank"><i class="files-group-icons files-icon-tag"></i></a> -->
                <a href="{{route('reports.index')}}">
                    <span class="back-icons back-tab-icon"></span>
                </a>
            </div>
        </div>
        <hr class="addsupplier-section-border">
        <div class="upload-file-sec">
            <div class="row customers-filess-section">
                <form action="" method="GET" class="mb-4">
                    <div class="row form-inp-group">
                        <div class="col-sm-3">
                            <label class="heading-content" for="start_date">From:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control form-input-filter" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-sm-3">
                            <label class="heading-content" for="end_date">To:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control form-input-filter" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-sm-3">
                            <label class="heading-content" for="status">Order Status:</label>
                            <select id="status" name="status" class="form-control form-input-filter form-select-grp">
                                <option value="">All</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                        <label class="heading-content" for="customer_name">Customer Name:</label>
                        <select id="customer_name" name="customer_name" class="form-control form-select-grp form-input-filter">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->company_name }}" 
                                    {{ request('company_name') == $customer->company_name ? 'selected' : '' }}>
                                    {{ $customer->company_name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                        <!-- <div class="col-sm-3">
                            <label class="heading-content" for="customer_name">Customer Name:</label>
                            <input type="text" id="customer_name" name="customer_name" class="form-control form-input-filter" placeholder="Customer Name" value="{{ request('customer_name') }}">
                        </div> -->
                        <!-- <div class="col-sm-4">
                            <label for="product_category">Product Category:</label>
                            <input type="text" id="product_category" name="product_category" class="form-control form-control-inp" placeholder="Product Category" value="{{ request('product_category') }}">
                        </div> -->
                        <!-- <div class="col-sm-4">
                            <label for="payment_status">Payment Status:</label>
                            <select id="payment_status" name="payment_status" class="form-control form-control-inp">
                                <option value="">All</option>
                                <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            </select>
                        </div> -->

                        <div class="row filter-btn">
                            <div class="button-1 cta_btn ">
                                <button type="submit" class="">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="graph-tablesec">
        <!-- Bar Chart Section -->
        <div class="outer card mt-4 order-graphsec">
            <div class="upload-file-sec customer-list-sec">
                <span class="addsupplier-section-heading">Order Statistics</span>
            </div>
            <hr class="addsupplier-section-border">
            <canvas id="ordersChart" class="orderchart"></canvas>
        </div>

        <!-- Orders Table -->
        <div class="outer card mt-4 oder-listsec">
            <div class="upload-file-sec customer-list-sec">
                <span class="addsupplier-section-heading">Orders List</span>
            </div>
            <hr class="addsupplier-section-border">
            <div class="table-responsive table-designs">
                <table class="table cstm-table table-bordered yajra-datatable" id="materials">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Customer Name</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Export Buttons -->
    <div class="outer card mt-4">
        <div class="upload-file-sec customer-list-sec">
            <span class="addsupplier-section-heading">Export Options</span>
        </div>
        <div class="row filter-btn">
            <div class="button-1 cta_btn export-btn">
                <a href="{{ route('reports.orders.export', request()->query()) }}" class="primary-button">Export to Excel</a>
            </div>
            <!-- Add other export options here -->
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(function () {
    var table = $('#materials').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('reports.order') }}",
            data: function (d) {
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
                d.status = $('#status').val();
                d.customer_name = $('#customer_name').val();
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'customer_id', name: 'customer_id'},
            {data: 'order_date', name: 'order_date'},
            {data: 'status', name: 'status'},
        ],
    });

    function updateChart() {
        $.ajax({
            url: "{{ route('reports.order') }}",
            data: {
                start_date: $('#start_date').val(),
                end_date: $('#end_date').val(),
                status: $('#status').val(),
                customer_name: $('#customer_name').val()
            },
            success: function (response) {
                console.log(response);
                if (response.data) {
                    var chartData = response.data.reduce(function (acc, item) {
                        var date = item.order_date;
                        if (!acc[date]) {
                            acc[date] = 0;
                        }
                        acc[date]++;
                        return acc;
                    }, {});

                    var labels = Object.keys(chartData);
                    var counts = Object.values(chartData);

                    ordersChart.data.labels = labels;
                    ordersChart.data.datasets[0].data = counts;
                    ordersChart.update();
                } else {
                    console.error('Data is undefined');
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    }
    updateChart();

    $('form').on('submit', function (e) {
        e.preventDefault();
        table.draw();
        updateChart();
    });
});

var ctx = document.getElementById('ordersChart').getContext('2d');
var chartData = {!! json_encode($chartData) !!};

var ordersChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: chartData.map(data => data.date),
        datasets: [{
            label: 'Orders Count',
            data: chartData.map(data => data.count),
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


</script>

@endsection
