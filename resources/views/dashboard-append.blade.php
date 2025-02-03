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
                                                                <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->order_id ?? 'N/A' }}</a></td>
                                                                <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->production_id ?? 'N/A' }}</a></td>
                                                                <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->first_name ?? '' }} {{ $laminationOrder->last_name ?? '' }}
                                                     
                                                                <td data-th="Column Header 2"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $laminationOrder->product_name ?? 'N/A' }}">{{ $laminationOrder->product_name ?? 'N/A' }}</a></td>
                                                                @if($laminationOrder->lamination_type == 'Cutter' || $laminationOrder->lamination_type == 'Strip')
                                                                    <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->bundle_quantity * 2 ?? 'N/A' }}</a></td>
                                                                    <td data-th="Column Header 4" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->completed_count * 2 ?? 'N/A' }}</a></td>
                                                                    <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->pending_count * 2 ?? 'N/A' }}</a></td>
                                                                @else
                                                                    <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->bundle_quantity ?? 'N/A' }}</a></td>
                                                                    <td data-th="Column Header 4" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->completed_count ?? 'N/A' }}</a></td>
                                                                    <td data-th="Column Header 3" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $laminationOrder->pending_count ?? 'N/A' }}</a></td>
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
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $extrusionOrder->order_id ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $extrusionOrder->production_id ?? 'N/A' }}</a></td>
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
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $rewindingOrder->order_id ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $rewindingOrder->production_id ?? 'N/A' }}</a></td>
                                                        <td data-th="Column Header 1" class="center-data"><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $rewindingOrder->first_name ?? '' }} {{ $rewindingOrder->last_name ?? '' }}</a></td>
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
                                                        <td data-th="Column Header 2" class="center-data"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $packingOrder->first_name ?? '' }} {{ $packingOrder->last_name ?? '' }}">{{ $packingOrder->first_name ?? '' }} {{ $packingOrder->last_name ?? '' }}</a></td>
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
                                                        <td data-th="Column Header 2" class="center-data"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $stitchingOrder->first_name ?? '' }} {{ $stitchingOrder->last_name ?? '' }}">{{ $stitchingOrder->first_name ?? '' }} {{ $stitchingOrder->last_name ?? '' }}</a></td>
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
                                                        <td data-th="Column Header 2" class="center-data"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $laminationOrder->first_name ?? ' ' }} {{ $laminationOrder->last_name ?? ' ' }}">{{ $laminationOrder->first_name ?? ' ' }} {{ $laminationOrder->last_name ?? ' ' }}</a></td>
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
                                                        <td data-th="Column Header 2" class="center-data"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $extrusionOrder->first_name ?? ' ' }} {{ $extrusionOrder->last_name ?? ' ' }}">{{ $extrusionOrder->first_name ?? ' ' }} {{ $extrusionOrder->last_name ?? ' ' }}</a></td>
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
                                                        <td data-th="Column Header 2" class="center-data"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $rewindingOrder->first_name ?? ' ' }} {{ $rewindingOrder->last_name ?? ' ' }}">{{ $rewindingOrder->first_name ?? ' ' }} {{ $rewindingOrder->last_name ?? ' ' }}</a></td>
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
                                                        <td data-th="Column Header 2" class="center-data"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $packingOrder->first_name ?? ' ' }} {{ $packingOrder->last_name ?? ' ' }}">{{ $packingOrder->first_name ?? ' ' }} {{ $packingOrder->last_name ?? ' ' }}</a></td>
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
                                                        <td data-th="Column Header 2" class="center-data"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $stitchingOrder->first_name ?? ' ' }} {{ $stitchingOrder->last_name ?? ' ' }}">{{ $stitchingOrder->first_name ?? ' ' }} {{ $stitchingOrder->last_name ?? ' ' }}</a></td>
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
                        <table class="table active all dashboard-material-table production-tble">
                            <thead>
                                <tr>
                                    <th><a class="table-anc-contents" href="javascript:void(0);" title="Product Name">Material Name</a></th>
                                    <th><a class="table-anc-contents" href="javascript:void(0);" title="Product Name">Category Name</a></th>
                                    <th><a class="table-anc-contents" href="javascript:void(0);" title="Product Name">Sub Category Name</a></th>
                                    <th><a class="table-anc-contents" href="javascript:void(0);" title="Product Name">Unit</a></th>
                                    <!-- <th><a class="table-anc-contents" href="javascript:void(0);" title="Product Name">Product Name</a></th>
                                    <th><a class="table-anc-contents" href="javascript:void(0);" title="Required Qty">Required Qty</a></th>
                                    <th><a class="table-anc-contents" href="javascript:void(0);" title="In -stock">In-stock</a></th> -->
                                </tr>
                            </thead>
                            @if($materialDetails->isNotEmpty())
                                @foreach($materialDetails as $data)
                                    <tr>
                                        <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{$data->material_name}}</a></td>
                                        <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{$data->category->name}}</a></td>
                                        <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{$data->subCategory->sub_cat_name}}</a></td>
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
            <div class="outer card dashboard-table">
                <h6 class="table-section-heading">Ready to Dispatch - *Transport Wise <br></h6>
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
                            <tr class="dashboard-table-data">
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
                                <tr>
                                    <td><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $order->company_name ?? 'N/A' }}">{{ $order->company_name ?? 'N/A' }}</a></td>
                                    <td class="left_data"><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $order->product_name ?? 'N/A' }}">{{ $order->product_name ?? 'N/A' }}</a></td>
                                    <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $order->colour ?? 'N/A' }}</a></td>
                                    <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $order->packing_material_type ?? 'N/A' }}</a></td>
                                    <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $order->bharti ?? 'N/A' }}</a></td>
                                    <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $order->number_of_bags_per_box ?? 'N/A' }}</a></td>
                                    <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $order->rolls_in_1_bdl ?? 'N/A' }}</a></td>
                                    <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $order->bdl_kg ?? 'N/A' }}</a></td>
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
                <div class="outer card dashboard-table">
                    <h6 class="table-section-heading">Latest Sales Orders</h6>
                    <div class="table-responsive table-designss">
                        <table class="table active all">
                            <thead>
                                <tr class="dashboard-table-data">
                                    <th class="dashboard-table-datacontent3">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Packing Type">Order Date</a>
                                    </th>
                                    <th class="dashboard-table-datacontent1">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Customer">Order Id</a>
                                    </th>
                                    <th class="dashboard-table-datacontent2">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Colour">Company name</a>
                                    </th>
                                    <th class="dashboard-table-datacontent4">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Bharti">Total Bundle</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($customerOrderDetails['orders']->isNotEmpty())
                                @foreach($customerOrderDetails['orders'] as $order)
                                            <tr>
                                                <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $order->created_at ? $order->created_at->format('d-m-Y') : 'N/A' }}</a></td>
                                                <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $order->order_id ?? 'N/A' }}</a></td>
                                                <td><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $order->customer->company_name ?? 'N/A' }}">{{ $order->customer->company_name ?? 'N/A' }}</a></td>
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
                <div class="outer card dashboard-table">
                    <h6 class="table-section-heading">Latest Production Orders</h6>
                    <div class="table-responsive table-designss">
                        <table class="table active all">
                            <thead>
                                <tr class="dashboard-table-data">
                                    <th class="dashboard-table-datacontent3">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Packing Type">Order Date</a>
                                    </th>
                                    <th class="dashboard-table-datacontent1">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Customer">Work Order Id</a>
                                    </th>
                                    <th class="dashboard-table-datacontent2">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Colour">Product Name</a>
                                    </th>
                                    <th class="dashboard-table-datacontent4">
                                        <a class="table-anc-contents" href="javascript:void(0);" title="Bharti">Required Quantity</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($customerOrderDetails['latestProductionOrders']->isNotEmpty())
                                @foreach($customerOrderDetails['latestProductionOrders'] as $latestProductionOrder)
                                            <tr>
                                            <td>
                                                <a class="table-anc-contents" href="javascript:void(0);" title="">
                                                    {{ $latestProductionOrder->created_at ? $latestProductionOrder->created_at->format('d-m-Y') : 'N/A' }}
                                                </a>
                                            </td>
                                                <td><a class="table-anc-contents" href="javascript:void(0);" title="">{{ $latestProductionOrder->id ?? 'N/A' }}</a></td>
                                                <td><a class="table-anc-contents tooltip-data" href="javascript:void(0);" title="{{ $latestProductionOrder->product->product_name ?? 'N/A' }}">{{ $latestProductionOrder->product->product_name ?? 'N/A' }}</a></td>
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