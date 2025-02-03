@extends('layouts.app')
@section('navbarTitel', 'Dashboard')

@section('content')
<style>
.graph-container {position: relative;  display: flex;  align-items: flex-end;  height: 370px;  width: 90%;  border-left: 1px solid #dcdcdc;  border-bottom: 1px solid #dcdcdc;  margin: 15px 0 13px 50px;}
.bar-container { display: flex; align-items: flex-end; justify-content: center; height: 100%; gap: 10px;position: relative; width: 100%;}
.bar {width: 30px; text-align: center; color: white; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);position: relative;}
.bar-left { margin-left: 63px;}
.y-axis { position: absolute; left: 0px; top: 6px; height: 100%; display: flex; flex-direction: column; justify-content: space-between; margin-left: -145px; align-items: end; width: 137px;}
.x-axis { display: flex; justify-content: center; width: 100%; gap: 55px; position: absolute; bottom: -25px; left: 0;}
.x-axis .label, .y-axis .label {  font-size: 13px; margin-left: 63px;}

.filter-dropdown:after { border-bottom: 8px solid #fff; border-left: 8px solid transparent; border-right: 8px solid transparent; content: ""; right: 2px; top: -8px; position: absolute; z-index: 1001;}

.product-demo { margin: 0;  width: 68%;  display: flex; align-items: end; justify-content: end;flex-direction: column;  padding: 20px 20px 20px 0;}
.product-demo-tabs  { text-align: center; font-weight: 300; font-style: normal; width: 100%;}
.product-demo-table {width: 100%; }
.product-demo-tabs .tabs-state { display: none;}
.product-demo-tabs .product-flex-tabs { display: flex; justify-content: space-between;margin-bottom: 7px;}
.product-demo-tabs .product-flex-tabs .product-tab { flex-grow: 1;text-align: start;}
.product-demo-tabs .product-flex-tabs .product-tab:hover {background-color: #ffffff; color: #6B4023;border-radius: 3px;}
.product-demo-tabs .product-tab { padding: 9px 20px; margin: 0 0 0 9px; background-color: #f0f0f0; color: #484848; font-size: 15px; cursor: pointer;     border: 1px solid #e5e6ea; font-weight: 500; z-index: 1;}
.product-content .product-panel, .product-demo-table .product-panel { margin-top: -6px; background-color: #fff; padding-top: 6px;  display: none;  text-align: left;  height: auto;}
.tabs-state:nth-child(1):checked ~ .product-flex-tabs .product-tab:nth-child(1), .tabs-state:nth-child(2):checked ~ .product-flex-tabs .product-tab:nth-child(2), .tabs-state:nth-child(3):checked ~ .product-flex-tabs .product-tab:nth-child(3), .tabs-state:nth-child(4):checked ~ .product-flex-tabs .product-tab:nth-child(4), .tabs-state:nth-child(5):checked ~ .product-flex-tabs .product-tab:nth-child(5) { background-color: #ffffff; color: #6B4023; cursor: default; border-bottom: 2px solid #6B4023; border-radius: 3px;}
.tabs-state:nth-child(1):checked ~ .product-content .product-panel:nth-child(1), .tabs-state:nth-child(2):checked ~ .product-content .product-panel:nth-child(2), .tabs-state:nth-child(3):checked ~ .product-content .product-panel:nth-child(3), .tabs-state:nth-child(4):checked ~ .product-content .product-panel:nth-child(4), .tabs-state:nth-child(5):checked ~ .product-content .product-panel:nth-child(5) { display: block;}

.tabs-state:nth-child(1):checked ~ .product-demo-table .product-panel:nth-child(1), .tabs-state:nth-child(2):checked ~ .product-demo-table .product-panel:nth-child(2), .tabs-state:nth-child(3):checked ~ .product-demo-table .product-panel:nth-child(3), .tabs-state:nth-child(4):checked ~ .product-demo-table .product-panel:nth-child(4), .tabs-state:nth-child(5):checked ~ .product-demo-table .product-panel:nth-child(5) { display: block;}

.product-table { font-family: "Lato", sans-serif; color: #484848; width: 100%;border: 1px solid #e5e6ea;}
.product-table th { letter-spacing: 1px; white-space: normal; font-size: 14px; background: #f3f6f9; vertical-align: middle; color: #484848 !important;}
.product-table th a{ font-weight: 500; color: #484848; font-size: 14px;}
.product-table tr td { font-size: 12px; display: table-cell; vertical-align: middle; padding: 10px 20px 6px 20px; text-align: left;}
.product-orderid { width: 175px;}
.production-orderid { width: 200px;text-align: center !important;}
.product-productname { width: 400px;}
.product-program { width: 100px;text-align: center !important;} 
.product-production { width: 100px;text-align: center !important;}
.product-demo-title2 { position: absolute; top: 69%; left: 20px;}
.product-demo-title1 { position: absolute; top: 42%; left: 20px;}
.product-demo-span2, .product-demo-span1 { font-size: 16px; font-weight: 500; line-height: 24px; color: #495057;}

.filter-container { width: 300px; margin: 0 auto; display: flex; align-items: center;}
.filter-container #custom-date-container { padding: 10px; border: 1px solid #ddd; border-radius: 5px; background-color: #ffffff; margin: 10px 0px 0 -70px;}
.filter-container #custom-date-container.hidden { display: none;}
.filter-container label { display: block; margin-bottom: 5px;}
#custom-date-container input[type="date"] { display: block; margin-bottom: 10px;font-size:12px; width: 100%;border-color: var(--border-color); }
#custom-date-container button { padding: 5px 10px; background-color: #6B4023; font-size: 13px; color: white; border: none; cursor: pointer; border-radius: 3px;}
.dropdown-filtr { position: absolute; top: -2px; right: 18px;}
label.heading-contents { font-size: 14px !important; font-weight: 500; line-height: 18px; font-family: "Poppins", sans-serif; color: var(--black) !important;}
.filter-select { border-color: #BCBFC5; background: none; width: 100%;}
.product-demo-row {  display: flex; justify-content: end; width: 100%;  }
.product-info-section { margin: 20px 0px 20px 20px; border: 1px solid #e5e6ea; display: flex; justify-content: center; align-items: end; flex-direction: column; width: 32%;}
.product-panel1, .product-panel2 { position: relative; display: flex; align-items: center; justify-content: center;width: 100%; height: 50%;}
.product-main{width: 100%;height: 100%;}
.product-panel-content1{ font-size: 16px; font-weight: 500; line-height: 24px; color: #495057;padding: 10px 0 10px 0; width: 100%; text-align: center;cursor: pointer;background-color: #f0f0f0; color: #484848; border: 1px solid #e5e6ea; margin: 0 10px;}
.product-panel-content2{font-size: 16px; font-weight: 500; line-height: 24px; color: #495057;padding: 10px 0 10px 0; width: 100%; text-align: center;cursor: pointer;background-color: #f0f0f0; color: #484848; border: 1px solid #e5e6ea;margin: 0 10px 5px 10px;}
/* .product-panel-content1, .product-panel-content2:hover { color: #6B4023;} */
.second-sec-border {border-top: 1px solid #e9ebec;}
.middle-line { margin: 2px 0 2px 0!important; color: #9e9e9e;}
.product-tab.first-tab { margin: 0;}
.product-tab.last-tab { margin: 0 0 0 9px;}
.product-content { display: none;overflow-x: auto;  white-space: nowrap;}
.product-panel-content1.active, .product-panel-content2.active  {  color: #6B4023; border-bottom: 2px solid #6B4023;background: #fff;}
.product-content.active { display: block; }
.bar:hover .tooltip { opacity: 1; position: absolute; top: -26px; left: -13%; text-align: center; width: 43px; background: #d9d9d9; border-radius: 5px; font-size: 12px; font-weight: 600;transition: .5s;padding:2px 1px;}
.latest_order_sec {display: flex; justify-content: space-between; gap: 20px; margin-top: 3px;margin-bottom: 20px;}
.latestorder-table1 {width: 48%;}
.latestorder-table2 {width: 51%;}
.dashboard-table-datacontent1 { width: 250px !important;}
.dashboard-table-datacontent3 { width: 500px !important; word-wrap: break-word; word-break: break-word; white-space: normal;}
.product_nme {width: 150px !important; word-wrap: break-word; word-break: break-word; white-space: normal;text-align: start;}
.latest-table-datacontent3 { width: 90px !important; text-align: start !important;}
.latest-table-datacontent1 { width: 90px !important;}
.latest-table-datacontent2 {  width: 285px !important;text-align: start !important;}
.latest-table-data th { background-color: #f3f6f9 !important; width: 100px;}
.latest-table-data th a, .latest-material-table th a, .material-table-data th a, .dashboard-table-datas th a { color: #484848 !important;}
.latest-table-data td { text-align: center !important;}
.latest-table-datas { margin: 0 0 10px 0; width: 100%; padding: 0px 0 !important; transition: all .4s; box-shadow: 0 5px 10px #1e20251f !important;}
.latest-table-datas .company_nmm{ width: 150px !important;  word-wrap: break-word; word-break: break-word; white-space: normal; text-align: start;}
.orderdate-data { text-align: start;}
.material-table-data tr th { background: #f3f6f9 !important;}
.material-table-content .material_nmm { text-align: start !important;}
.cat_nmm { text-align: start !important;}
.subcat_nmm { text-align: start !important;}
.dashboard-table-datas .dashboard-table-datacontent1, .dashboard-table-datas .dashboard-table-datacontent3 { text-align: start;}
.dashboard-table-datas th {background-color: #f3f6f9 !important;}
.dashboard-table-ready { margin: 0 0 10px 0; width: 100%; padding: 0px 0 !important; transition: all .4s; box-shadow: 0 5px 10px #1e20251f !important;}
.dashboard-table-ready tr td { text-align: center;}
.dashboard-table-datas .left_data { text-align: start !important;}
.dashboard-table-datas td { text-align: center;}
.center-data {text-align: center !important;}
.sorting-print { position: absolute; right: 275px; top: 2px;}

@media (min-width:1500px){
    .dashboard-table-datacontent3 { width: 250px !important; word-wrap: break-word; word-break: break-word; white-space: normal;}
}
@media (max-width:1500px){
    .product-orderid { width: 165px;}
    .product-productname { width: 450px;}
}
@media (max-width:1400px){
    .product-info-section{width: 34%;}
    .product-panel-content1, .product-panel-content2 { font-size: 14px;}
    .dashboard-material-table tr th a, .dashboard-material-table tr td a{font-size: 13px;}
    .bar:hover .tooltip{font-size: 11px;}
    .bar-container{width: 100%;}
}
</style>

<div class="sorting-section">
    <div class="sorting-print">
        <a href="javascript:void(0);" target="_blank">
            <span class="report-print-icon report-print-icon-tag"></span>
        </a>
    </div>
    <li class="dropdown card-header-dropdown">
        <div class="filter-container">
            <span class="sort-text">Date Filter :</span>
            <div class="dropdown-filtr">
                <select id="date-filter" class="filter-select">
                    <option value="current_month" class="filters" id="current_month">Current Month</option>
                    <option value="today" class="filters" id="today">Today</option>
                    <option value="current_week" class="filters" id="current_week">Current Week</option>
                    <option value="current_year" class="filters" id="current_year">Current Year</option>
                    <option value="custom_date" id="custom_date">Custom Date</option>
                </select>
                <div id="custom-date-container" class="hidden">
                    <label class="heading-contents" for="start-date">Start Date:</label>
                    <input class="filters" type="date" id="start-date">
                    <label class="heading-contents" for="end-date">End Date:</label>
                    <input class="filters" type="date" id="end-date">
                    <button id="apply-button">Apply</button>
                </div>
            </div>
        </div>
    </li>
</div>
<div class="main-outer dashboard-outer" id="data-container">
        <div class="row customer-section-list">
            <div class="details-table col-lg-12">
                <div class="card-tb-1 table-responsive">
                    <div class="table-type-title">Production Details</div>
                    <div class="product-demo-row">  
                        <div class="product-info-section">
                            <div class="product-main">
                                <div class="product-panel1">
                                    <span class="product-panel-content1 active" id="pending-tab">Pending Material Work Order</span>
                                </div>
                                <hr class="middle-line">
                                <div class="product-panel2">
                                    <span class="product-panel-content2" id="ready-tab">Ready Material Work Order</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-demo">
                            <div class="product-demo-tabs">
                                <input class="tabs-state" id="tab-1" name="tabs-state" type="radio" checked=""/>
                                <input class="tabs-state" id="tab-2" name="tabs-state" type="radio"/>
                                <input class="tabs-state" id="tab-3" name="tabs-state" type="radio"/>
                                <input class="tabs-state" id="tab-4" name="tabs-state" type="radio"/>
                                <input class="tabs-state" id="tab-5" name="tabs-state" type="radio"/>

                                <div class="product-flex-tabs">
                                    <label class="product-tab first-tab" for="tab-1">Lamination</label>
                                    <label class="product-tab" for="tab-2">Extrusion</label>
                                    <label class="product-tab" for="tab-3">Rewinding</label>
                                    <label class="product-tab" for="tab-4">Packing</label>
                                    <label class="product-tab last-tab" for="tab-5">Silai</label>
                                </div>
                                <div class="product-content active" id="pending-content">
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table">
                                                <thead>
                                                    <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Sales Order ID</a></th>
                                                    <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Work Order ID</a></th>
                                                    <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Customer Name</a></th>
                                                    <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                    <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @if($customerOrderDetails['laminationOrders']->isNotEmpty())
                                                        @foreach($customerOrderDetails['laminationOrders'] as $laminationOrder)
                                                            <tr>
                                                                <td data-th="Column Header 1">
                                                                    <a class="table-anc-contents" href="{{ $laminationOrder->customer_order_id ? route('customerOrder.edit', $laminationOrder->customer_order_id) : route('customerOrder.index') }}" title="">{{ $laminationOrder->order_id ?? 'N/A' }}</a>
                                                                </td>
                                                                <td data-th="Column Header 1" class="center-data">
                                                                    <a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->production_id ?? 'N/A' }}</a>
                                                                </td>
                                                                <td data-th="Column Header 1" class="center-data">
                                                                    <a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->first_name ?? '' }} {{ $laminationOrder->last_name ?? '' }}
                                                                    </a>
                                                                </td>
                                                                <td data-th="Column Header 2">
                                                                    <a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $laminationOrder->product_name ?? 'N/A' }}">{{ $laminationOrder->product_name ?? 'N/A' }}</a>
                                                                </td>
                                                                @if($laminationOrder->lamination_type == 'Cutter' || $laminationOrder->lamination_type == 'Strip')
                                                                    <td data-th="Column Header 3" class="center-data">
                                                                        <a class="table-anc-contents" href="javascript:void(0);" title="">
                                                                            {{ $laminationOrder->bundle_quantity * 2 ?? 'N/A' }}
                                                                        </a>
                                                                    </td>
                                                                    <td data-th="Column Header 4" class="center-data">
                                                                        <a class="table-anc-contents" href="javascript:void(0);" title="">
                                                                            {{ $laminationOrder->completed_count * 2 ?? 'N/A' }}
                                                                        </a>
                                                                    </td>
                                                                    <td data-th="Column Header 3" class="center-data">
                                                                        <a class="table-anc-contents" href="javascript:void(0);" title="">
                                                                            {{ $laminationOrder->pending_count * 2 ?? 'N/A' }}
                                                                        </a>
                                                                    </td>
                                                                @else
                                                                    <td data-th="Column Header 3" class="center-data">
                                                                        <a class="table-anc-contents" href="javascript:void(0);" title="">
                                                                            {{ $laminationOrder->bundle_quantity ?? 'N/A' }}
                                                                        </a>
                                                                    </td>
                                                                    <td data-th="Column Header 4" class="center-data">
                                                                        <a class="table-anc-contents" href="javascript:void(0);" title="">
                                                                            {{ $laminationOrder->completed_count ?? 'N/A' }}
                                                                        </a>
                                                                    </td>
                                                                    <td data-th="Column Header 3" class="center-data">
                                                                        <a class="table-anc-contents" href="javascript:void(0);" title="">
                                                                            {{ $laminationOrder->pending_count ?? 'N/A' }}
                                                                        </a>
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="5">
                                                                <span class="Nodataavailable" style="text-align: center; display: block;">No data available</span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table">
                                                <thead>
                                                <tr>
                                                <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Sales Order ID</a></th>
                                                <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Work Order ID</a></th>
                                                <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Customer Name</a></th>
                                                <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if($customerOrderDetails['extrusionOrders']->isNotEmpty())
                                                    @foreach($customerOrderDetails['extrusionOrders'] as $extrusionOrder)
                                                    <tr>
                                                        <td data-th="Column Header 1">
                                                            <a class="table-anc-contents" href="{{ $extrusionOrder->customer_order_id ? route('customerOrder.edit', $extrusionOrder->customer_order_id) : route('customerOrder.index') }}" title="">{{ $extrusionOrder->order_id ?? 'N/A' }}</a>
                                                        </td>
                                                        <td data-th="Column Header 1" class="center-data">
                                                            <a class="table-anc-contents" href="javascript:void(0);" title="">{{ $extrusionOrder->production_id ?? 'N/A' }}</a>
                                                        </td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $extrusionOrder->first_name ?? '' }} {{ $extrusionOrder->last_name ?? '' }}</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $extrusionOrder->product_name ?? 'N/A' }}">{{ $extrusionOrder->product_name ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $extrusionOrder->bundle_quantity ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 4" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $extrusionOrder->completed_count ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $extrusionOrder->pending_count ?? 'N/A' }}</a></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5">
                                                            <span class="Nodataavailable" style="text-align: center; display: block;">No data available</span>
                                                        </td>
                                                    </tr>
                                                @endif  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table">
                                                <thead>
                                                <tr>
                                                <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Sales Order ID</a></th>
                                                <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Work Order ID</a></th>
                                                <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Customer Name</a></th>
                                                <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if($customerOrderDetails['rewindingOrders']->isNotEmpty())
                                                    @foreach($customerOrderDetails['rewindingOrders'] as $rewindingOrder)
                                                    <tr>
                                                        <td data-th="Column Header 1">
                                                            <a class="table-anc-contents" href="{{ $rewindingOrder->customer_order_id ? route('customerOrder.edit', $rewindingOrder->customer_order_id) : route('customerOrder.index') }}" title="">{{ $rewindingOrder->order_id ?? 'N/A' }}</a>
                                                        </td>
                                                        <td data-th="Column Header 1" class="center-data">
                                                            <a class="table-anc-contents" href="javascript:void(0);" title="">{{ $rewindingOrder->production_id ?? 'N/A' }}</a>
                                                        </td>
                                                        <td data-th="Column Header 1" class="center-data">
                                                            <a class="table-anc-contents" href="javascript:void(0);" title="">{{ $rewindingOrder->first_name ?? '' }} {{ $rewindingOrder->last_name ?? '' }}</a>
                                                        </td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $rewindingOrder->product_name ?? 'N/A' }}">{{ $rewindingOrder->product_name ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $rewindingOrder->bundle_quantity ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 4" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $rewindingOrder->completed_count ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $rewindingOrder->pending_count ?? 'N/A' }}</a></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5">
                                                            <span class="Nodataavailable" style="text-align: center; display: block;">No data available</span>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table"> 
                                                <thead>
                                                <tr>
                                                <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Sales Order ID</a></th>
                                                <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Work Order ID</a></th>
                                                <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Customer Name</a></th>
                                                <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                    @if($customerOrderDetails['packingOrders']->isNotEmpty())
                                                    @foreach($customerOrderDetails['packingOrders'] as $packingOrder)
                                                    <tr>
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="{{ $packingOrder->customer_order_id ? route('customerOrder.edit', $packingOrder->customer_order_id) : route('customerOrder.index') }}" title="">{{ $packingOrder->order_id ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $packingOrder->production_id ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="{{ $packingOrder->first_name ?? '' }} {{ $packingOrder->last_name ?? '' }}">{{ $packingOrder->first_name ?? '' }} {{ $packingOrder->last_name ?? '' }}</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $packingOrder->product_name ?? 'N/A' }}">{{ $packingOrder->product_name ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $packingOrder->bundle_quantity ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 4" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $packingOrder->completed_count ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $packingOrder->pending_count ?? 'N/A' }}</a></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5">
                                                            <span class="Nodataavailable" style="text-align: center; display: block;">No data available</span>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table"> 
                                                <thead>
                                                    <tr>
                                                        <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Sales Order ID</a></th>
                                                        <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Work Order ID</a></th>
                                                        <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Customer Name</a></th>
                                                        <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                        <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                        <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                        <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if($customerOrderDetails['stitchingOrders']->isNotEmpty())
                                                    @foreach($customerOrderDetails['stitchingOrders'] as $stitchingOrder)
                                                    <tr>
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="{{ $stitchingOrder->customer_order_id ? route('customerOrder.edit', $stitchingOrder->customer_order_id) : route('customerOrder.index') }}" title="">{{ $stitchingOrder->order_id ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $stitchingOrder->production_id ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="{{ $stitchingOrder->first_name ?? '' }} {{ $stitchingOrder->last_name ?? '' }}">{{ $stitchingOrder->first_name ?? '' }} {{ $stitchingOrder->last_name ?? '' }}</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $stitchingOrder->product_name ?? 'N/A' }}">{{ $stitchingOrder->product_name ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $stitchingOrder->bundle_quantity ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 4" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $stitchingOrder->completed_count ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $stitchingOrder->pending_count ?? 'N/A' }}</a></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5">
                                                            <span class="Nodataavailable" style="text-align: center; display: block;">No data available</span>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content product-demo-table" id="ready-content">
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table"> 
                                                <thead>
                                                    <tr>
                                                    <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Sales Order ID</a></th>
                                                    <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Work Order ID</a></th>
                                                    <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Customer Name</a></th>
                                                    <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                    <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($customerOrderDetails['laminationOrders']->isNotEmpty())
                                                        @foreach($customerOrderDetails['laminationOrders'] as $laminationOrder)
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->order_id ?? 'N/A' }}</a></td>
                                                            <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->production_id ?? 'N/A' }}</a></td>
                                                            <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->first_name ?? '' }} {{ $laminationOrder->last_name ?? '' }}
                                                                </a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $laminationOrder->product_name ?? 'N/A' }}">{{ $laminationOrder->product_name ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->bundle_quantity ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 4" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->completed_count ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->pending_count ?? 'N/A' }}</a></td>    
                                                    </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="5">
                                                                <span class="Nodataavailable" style="text-align: center; display: block;">No data available</span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table"> 
                                            <thead>
                                            <tr>
                                            <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Sales Order ID</a></th>
                                            <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Work Order ID</a></th>
                                            <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Customer Name</a></th>
                                            <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                            <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                            <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                            <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @if($customerOrderDetails['extrusionOrders']->isNotEmpty())
                                                    @foreach($customerOrderDetails['extrusionOrders'] as $extrusionOrder)
                                                    <tr>
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $extrusionOrder->order_id ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $extrusionOrder->production_id ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="{{ $extrusionOrder->first_name ?? '' }} {{ $extrusionOrder->last_name ?? '' }}">{{ $extrusionOrder->first_name ?? '' }} {{ $extrusionOrder->last_name ?? '' }}</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $extrusionOrder->product_name ?? 'N/A' }}">{{ $extrusionOrder->product_name ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $extrusionOrder->bundle_quantity ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 4" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $extrusionOrder->completed_count ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $extrusionOrder->pending_count ?? 'N/A' }}</a></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5">
                                                            <span class="Nodataavailable" style="text-align: center; display: block;">No data available</span>
                                                        </td>
                                                    </tr>
                                                @endif  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table"> 
                                            <thead>
                                            <tr>
                                            <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Sales Order ID</a></th>
                                            <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Work Order ID</a></th>
                                            <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Customer Name</a></th>
                                            <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                            <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                            <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                            <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @if($customerOrderDetails['rewindingOrders']->isNotEmpty())
                                                    @foreach($customerOrderDetails['rewindingOrders'] as $rewindingOrder)
                                                    <tr>
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $rewindingOrder->order_id ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $rewindingOrder->production_id ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="{{ $rewindingOrder->first_name ?? ' ' }} {{ $rewindingOrder->last_name ?? ' ' }}">{{ $rewindingOrder->first_name ?? 'N/A' }}{{ $rewindingOrder->last_name ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $rewindingOrder->product_name ?? 'N/A' }}">{{ $rewindingOrder->product_name ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $rewindingOrder->bundle_quantity ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 4" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $rewindingOrder->completed_count ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $rewindingOrder->pending_count ?? 'N/A' }}</a></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5">
                                                            <span class="Nodataavailable" style="text-align: center; display: block;">No data available</span>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table"> 
                                            <thead>
                                            <tr>
                                            <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Sales Order ID</a></th>
                                            <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Work Order ID</a></th>
                                            <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Customer Name</a></th>
                                            <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                            <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                            <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                            <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($customerOrderDetails['packingOrders']->isNotEmpty())
                                                    @foreach($customerOrderDetails['packingOrders'] as $packingOrder)
                                                    <tr>
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $packingOrder->order_id ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $packingOrder->production_id ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="{{ $packingOrder->first_name ?? ' ' }} {{ $packingOrder->last_name ?? ' ' }}">{{ $packingOrder->first_name ?? ' ' }} {{ $packingOrder->last_name ?? ' ' }}</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $packingOrder->product_name ?? 'N/A' }}">{{ $packingOrder->product_name ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $packingOrder->bundle_quantity ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 4" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $packingOrder->completed_count ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $packingOrder->pending_count ?? 'N/A' }}</a></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5">
                                                            <span class="Nodataavailable" style="text-align: center; display: block;">No data available</span>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table"> 
                                            <thead>
                                            <tr>
                                            <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Sales Order ID</a></th>
                                            <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Work Order ID</a></th>
                                            <th class="production-orderid"><a class="table-anc-contents" href="javascript:void(0);">Customer Name</a></th>
                                            <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                            <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                            <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                            <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                    @if($customerOrderDetails['stitchingOrders']->isNotEmpty())
                                                    @foreach($customerOrderDetails['stitchingOrders'] as $stitchingOrder)
                                                    <tr>
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $stitchingOrder->order_id ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $stitchingOrder->production_id ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="{{ $stitchingOrder->first_name ?? ' ' }} {{ $stitchingOrder->last_name ?? ' ' }}">{{ $stitchingOrder->first_name ?? ' ' }} {{ $stitchingOrder->last_name ?? ' ' }}</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $stitchingOrder->product_name ?? 'N/A' }}">{{ $stitchingOrder->product_name ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $stitchingOrder->bundle_quantity ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 4" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $stitchingOrder->completed_count ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $stitchingOrder->pending_count ?? 'N/A' }}</a></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5">
                                                            <span class="Nodataavailable" style="text-align: center; display: block;">No data available</span>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-content-datas">
            <div class="graph-content">
                <div class="outer card report-graph">
                    <div class="heading-content-up">
                        <h6 class="card-graph-title">Production vs Dispatch <span class="everyday">(every 10 days)</span></h6>
                        <div class="content_boxes">
                            <div class="production-content"><span class="production-title">Production :</span><div class="production-box"></div></div>
                            <div class="dispatch-content"><span class="dispatch-title">Dispatch :</span><div class="dispatch-box"></div></div>
                        </div>
                    </div>
                    <div class="upload-file-sec">
                        <div class="row customer-files-sec">
                            <div class="graph-container">
                                <div class="bar-container">
                                    @foreach($productionAndDispatcedDetails as $data)
                                    @php
                                        $productionHeight = ($maxYValue > 0) ? ($data['production'] / $maxYValue) * 100 : 0;
                                        $dispatchHeight = ($maxYValue > 0) ? ($data['dispatch'] / $maxYValue) * 100 : 0;
                                    @endphp
                                    <div class="bar bar-left" style="height: {{ $productionHeight > 0 ? $productionHeight . '%' : '0px' }}; background-color: #ff8900;" data-value="{{ $data['production'] }}">
                                        <div class="tooltip">{{ $data['production'] }}</div>
                                    </div>

                                    <div class="bar" style="height: {{ $dispatchHeight > 0 ? $dispatchHeight . '%' : '0px' }}; background-color: #4CAF50;" data-value="{{ $data['dispatch'] }}">
                                        <div class="tooltip">{{ $data['dispatch'] }}</div>
                                    </div>
                                    @endforeach

                                    <div class="x-axis">
                                        @foreach($xAxisLabels as $range)
                                            <div class="label">{{ $range }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="y-axis">
                                    @foreach($yAxisLabels as $label)
                                        <div class="label">{{ $label }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="material-table-content">
                <div class="outer card  table-group-second">
                <h6 class="table-section-heading">Material to be Purchased</h6>
                    <div class="table-responsive table-designss">
                        <table class="table active all material-table-data production-tble">
                            <thead>
                                <tr>
                                    <th class="material_nmm"><a class="table-anc-contents" href="javascript:void(0);" title="Product Name">Material Name</a></th>
                                    <th class="cat_nmm"><a class="table-anc-contents" href="javascript:void(0);" title="Product Name">Category Name</a></th>
                                    <th class="subcat_nmm"><a class="table-anc-contents" href="javascript:void(0);" title="Product Name">Sub Category Name</a></th>
                                    <th class="unit_datas"><a class="table-anc-contents" href="javascript:void(0);" title="Product Name">Unit</a></th>
                                    <!-- <th><a class="table-anc-contents" href="javascript:void(0);" title="Product Name">Product Name</a></th>
                                    <th><a class="table-anc-contents" href="javascript:void(0);" title="Required Qty">Required Qty</a></th>
                                    <th><a class="table-anc-contents" href="javascript:void(0);" title="In -stock">In-stock</a></th> -->
                                </tr>
                            </thead>
                            @if($materialDetails->isNotEmpty())
                                @foreach($materialDetails as $data)
                                    <tr>
                                        <td class="material_nmm"><a class="table-anc-contents" href="javascript:void(0);" title="">{{$data->material_name}}</a></td>
                                        <td class="cat_nmm"><a class="table-anc-contents" href="javascript:void(0);" title="">{{$data->category->name}}</a></td>
                                        <td class="subcat_nmm"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $data->subCategory->sub_cat_name ?? 'null' }}
                                        </a></td>
                                        <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{$data->unit}}</a></td>
                                            <!-- 
                                        <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{$data->material_name}}</a></td>
                                        <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{$data->material_name}}</a></td> -->
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">
                                        <span class="Nodataavailable" style="text-align: center; display: block;">No data available</span>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <section class="dash-table-sec">
            <!-- <div class="customer-list-sec">
                    <h6 class="table-section-heading">Mumbai Golden Transporter</h6>
            </div> -->
            <div class="outer card dashboard-table-ready">
                <h6 class="table-section-heading">Ready to Dispatch - Transport Wise <br></h6>
                @if($customerOrderDetails['customerOrders']->isNotEmpty())
                @foreach($customerOrderDetails['customerOrders'] as $packingName => $orders)
                @php
                    $totalBdlKg = $orders->sum('bdl_kg');
                @endphp
                <!-- @foreach($customerOrderDetails['transport'] as $transport)
                    @if($packingName == $transport->id)
                        <h6 class="table-section-heading">{{ $transport->name }} (Total Bdl Kg: {{ $totalBdlKg }})</h6>
                    @endif
                @endforeach -->
                @php
                    $foundTransport = false;
                @endphp

                @foreach($customerOrderDetails['transport'] as $transport)
                    @if($packingName == $transport->id)
                        <h6 class="table-section-heading">{{ $transport->name }} (Total Bdl Kg: {{ $totalBdlKg }})</h6>
                        @php
                            $foundTransport = true;
                        @endphp
                        @break
                    @endif
                @endforeach

                @if (!$foundTransport)
                    <h6 class="table-section-heading second-sec-border">Unknown Transporter (Total Bdl Kg: {{ $totalBdlKg }})</h6>
                @endif
                <div class="table-responsive table-designss">
                    <table class="table active all">
                        <thead>
                            <tr class="dashboard-table-datas">
                                <th class="dashboard-table-datacontent1">
                                    <a class="table-anc-contents" href="javascript:void(0);" title="Customer">Company Name</a>
                                </th>
                                <th class="dashboard-table-datacontent3">
                                    <a class="table-anc-contents" href="javascript:void(0);" title="Packing Type">Product Name</a>
                                </th>
                                <th class="dashboard-table-datacontents">
                                    <a class="table-anc-contents" href="javascript:void(0);" title="Product Name">Colour</a>
                                </th>
                                <th class="dashboard-table-datacontent2">
                                    <a class="table-anc-contents" href="javascript:void(0);" title="Colour">Packing Type</a>
                                </th>
                                <th class="dashboard-table-datacontent4">
                                    <a class="table-anc-contents" href="javascript:void(0);" title="Bharti">Bharti</a>
                                </th>
                                <th class="dashboard-table-datacontents">
                                    <a class="table-anc-contents" href="javascript:void(0);" title="Product Name">Bag/Box</a>
                                </th>
                                <th class="dashboard-table-datacontent2">
                                    <a class="table-anc-contents" href="javascript:void(0);" title="Colour">Bundle</a>
                                </th>
                                <th class="dashboard-table-datacontent4">
                                    <a class="table-anc-contents" href="javascript:void(0);" title="Bharti">Bdl Kg</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="dashboard-table-datas">
                                    <td class="left_data"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $order->company_name ?? 'N/A' }}">{{ $order->company_name ?? 'N/A' }}</a></td>
                                    <td class="left_data"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $order->product_name ?? 'N/A' }}">{{ $order->product_name ?? 'N/A' }}</a></td>
                                    <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $order->colour ?? 'N/A' }}</a></td>
                                    <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $order->packing_material_type ?? 'N/A' }}</a></td>
                                    <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ formatIndianCurrencyNumber($order->bharti) ?? 'N/A' }}</a></td>
                                    <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ formatIndianCurrencyNumber($order->number_of_bags_per_box) ?? 'N/A' }}</a></td>
                                    <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ formatIndianCurrencyNumber($order->rolls_in_1_bdl) ?? 'N/A' }}</a></td>
                                    <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ formatIndianCurrencyNumber($order->bdl_kg) ?? 'N/A' }}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endforeach
                @else
                <tr>
                    <td colspan="8">
                        <span class="Nodataavailable" style="text-align: center; display: block;">No data available</span>
                    </td>
                </tr>
                @endif 
            </div>
        </section>
        <div class="latest_order_sec">
            <section class="dash-table-sec latestorder-table1">
                    <!-- <div class="customer-list-sec">
                        <h6 class="table-section-heading">Mumbai Golden Transporter</h6>
                    </div> -->
                <div class="outer card latest-table-datas">
                    <h6 class="table-section-heading">Latest Sales Orders</h6>
                    <div class="table-responsive table-designss">
                        <table class="table active all">
                            <thead>
                                <tr class="latest-table-data">
                                    <th class="latest-table-datacontent3">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Packing Type">Order Date</a>
                                    </th>
                                    <th class="latest-table-datacontent1">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Customer">Order Id</a>
                                    </th>
                                    <th class="latest-table-datacontent2">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Colour">Company name</a>
                                    </th>
                                    <th class="latest-table-datacontent4">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Bharti">Total Bundle</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($customerOrderDetails['orders']->isNotEmpty())
                                @foreach($customerOrderDetails['orders'] as $order)
                                            <tr>
                                                <td class="orderdate-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $order->created_at ? $order->created_at->format('d-m-Y') : 'N/A' }}</a></td>
                                                <td class="orderid-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $order->order_id ?? 'N/A' }}</a></td>
                                                <td class="company_nmm"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $order->customer->company_name ?? 'N/A' }}">{{ $order->customer->company_name ?? 'N/A' }}</a></td>
                                                <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $order->total_bundle ?? 'N/A' }}</a></td>
                                            </tr>
                                        @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">
                                            <span class="Nodataavailable" style="text-align: center; display: block;">No data available</span>
                                        </td>
                                    </tr>
                                @endif  
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="dash-table-sec latestorder-table2">
                    <!-- <div class="customer-list-sec">
                        <h6 class="table-section-heading">Mumbai Golden Transporter</h6>
                    </div> -->
                <div class="outer card latest-table-datas">
                    <h6 class="table-section-heading">Latest Production Orders</h6>
                    <div class="table-responsive table-designss">
                        <table class="table active all">
                            <thead>
                                <tr class="latest-table-data">
                                    <th class="latest-table-datacontent3">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Packing Type">Order Date</a>
                                    </th>
                                    <th class="latest-table-datacontent1">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Customer">Work Order Id</a>
                                    </th>
                                    <th class="latest-table-datacontent2">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Colour">Product Name</a>
                                    </th>
                                    <th class="latest-table-datacontent4">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Bharti">Required Quantity</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody> 
                            @if($customerOrderDetails['latestProductionOrders']->isNotEmpty())
                                @foreach($customerOrderDetails['latestProductionOrders'] as $latestProductionOrder)
                                            <tr>
                                                <td class="orderdate-data">
                                                    <a class="table-anc-contents" href="javascript:void(0);" title="">
                                                        {{ $latestProductionOrder->created_at ? $latestProductionOrder->created_at->format('d-m-Y') : 'N/A' }}
                                                    </a>
                                                </td>
                                                <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $latestProductionOrder->id ?? 'N/A' }}</a></td>
                                                <td class="product_nme"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $latestProductionOrder->product->product_name ?? 'N/A' }}">{{ $latestProductionOrder->product->product_name ?? 'N/A' }}</a></td>
                                                <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $latestProductionOrder->bundle_quantity ?? 'N/A' }}</a></td>
                                            </tr>
                                        @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">
                                            <span class="Nodataavailable" style="text-align: center; display: block;">No data available</span>
                                        </td>
                                    </tr>
                                @endif  
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
  document.getElementById('pending-tab').addEventListener('click', function() {
      document.getElementById('pending-tab').classList.add('active');
      document.getElementById('ready-tab').classList.remove('active');
      document.getElementById('pending-content').classList.add('active');
      document.getElementById('ready-content').classList.remove('active');
  });

  document.getElementById('ready-tab').addEventListener('click', function() {
      document.getElementById('ready-tab').classList.add('active');
      document.getElementById('pending-tab').classList.remove('active');
      document.getElementById('ready-content').classList.add('active');
      document.getElementById('pending-content').classList.remove('active');
  });
</script>
<script>
    function setFilter(filterText) {
        document.getElementById('currentFilterText').innerText = filterText;

        console.log(`Selected filter: ${filterText}`);
    }
</script>


<script>
    document.getElementById('date-filter').addEventListener('change', function() {
    var customDateContainer = document.getElementById('custom-date-container');
    if (this.value === 'custom') {
        customDateContainer.classList.remove('hidden');
    } else {
        customDateContainer.classList.add('hidden');
    }
});

document.getElementById('apply-button').addEventListener('click', function() {
    var startDate = document.getElementById('start-date').value;
    var endDate = document.getElementById('end-date').value;
    if (startDate && endDate) {
        toastr.success('Selected Start Date: ' + startDate + '\nSelected End Date: ' + endDate);
    } else {
        toastr.error('Please select both start and end dates.');
    }
});
document.addEventListener('click', function(event) {
            var customDateContainer = document.getElementById('custom-date-container');
            var dateFilter = document.getElementById('date-filter');

            if (!customDateContainer.contains(event.target) && !dateFilter.contains(event.target)) {
                customDateContainer.classList.add('hidden');
            }
        });
</script>
<script>
$(document).ready(function() {
    $('#date-filter').on('change', function(e) {
        e.preventDefault();
        let filter = $(this).val();

        if (filter === 'custom_date') {
            $('#custom-date-container').removeClass('hidden');
        } else {
            $('#custom-date-container').addClass('hidden');

            $.ajax({
                url: "{{ route('dashboard') }}",
                type: "GET",
                data: { filter: filter },
                success: function(response) {
                    console.log(response);
                    $('#data-container').html(response);
                },
                error: function(xhr) {
                    console.error("Error fetching filtered data:", xhr.responseText);
                }
            });
        }
    });

    $('#apply-button').on('click', function(e) {
        e.preventDefault();
        let startDate = $('#start-date').val();
        let endDate = $('#end-date').val();

        if (startDate && endDate) {
            $.ajax({
                url: "{{ route('dashboard') }}",
                type: "GET",
                data: {
                    filter: 'custom_date',
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(response) {
                    console.log(response);
                    $('#data-container').html(response);
                },
                error: function(xhr) {
                    console.error("Error fetching custom date data:", xhr.responseText);
                }
            });
        } else {
        }
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

