@extends('layouts.app')
@section('navbarTitel', 'Reports')
@section('content')

<div class="main-outer">
    <div class="outer card">
            <div class="table-responsive table-designs">
                <table class="table active all">
                    <thead class="report-headings">
                        <th><a class="reports-data" href="javascript:void(0);" title="Production Reports">Production Reports</a></th>
                        <th><a class="reports-data" href="javascript:void(0);" title="Inventory Reports">Inventory Reports</a></th>
                        <th><a class="reports-data" href="javascript:void(0);" title="Supply Chain Reports">Supply Chain Reports</a></th>
                    </thead>
                    <tbody class="reports-table-data">
                        <tr>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Daily Production Reports</a>
                            </td>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Ready to Dispatch</a>
                            </td>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Purchase History</a>
                            </td>
                        </tr>
                        <tr>
                        <td class="table-data-contents">
                                <a class="table-anc-content" href="{{route('reports.lamination')}}">Lamination Report</a>
                            </td>

                            <td class="table-data-contents">
                                <a class="table-anc-content" href="">Packing Material Usage</a>
                            </td>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Material Requirement Planning (MRP) 
                                <span class="table-anc-content-span"> (Based on pending Sales Order + Pending <br>
                                    production)- Add column for ETA based on Po <br>
                                    Raised to Material Received time.</span>
                                </a>
                            </td>
                        </tr>
                        <tr>
                        <td class="table-data-contents">
                                <a class="table-anc-content" href="{{route('reports.extruder')}}">Extruder Report</a>
                            </td>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Raw Material Usage</a>
                            </td>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Purchase Order Status</a>
                            </td>
                        </tr>
                        <tr>
                        <td class="table-data-contents">
                            <a class="table-anc-content" href="{{ route('reports.rewinding') }}">Rewinding Reports</a>
                        </td>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Goods in Process</a>
                            </td>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="{{route('reports.order')}}">Orders Report</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="{{route('reports.stitching')}}">Silai Report</a>
                            </td>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="{{route('reports.stockInward')}}">Stock Inward Report</a>
                            </td>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="{{route('reports.stockOutward')}}">Stock Outward Report</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="{{route('reports.packing')}}">Packing Reports</a>
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive table-designs">
                <table class="table active all">
                    <thead class="report-headings">
                        <th><a class="reports-data" href="javascript:void(0);" title="Workforce Reports">Workforce Reports</a></th>
                        <th><a class="reports-data" href="javascript:void(0);" title="MIS Reports">MIS Reports</a></th>
                    </thead>
                    <tbody class="reports-table-data">
                        <tr>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Labor Productivity Report</a>
                            </td>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Paper Coverage Report</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Absenteeism Report</a>
                            </td>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Packing Material Cost Report</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Loan</a>
                            </td>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Raw Material Cost Report</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Salary Report</a>
                            </td>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Labour Cost Report <span class="table-anc-content-span">(Process wise Costing or Overall Costing)</span></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Withdrawal Report</a>
                            </td>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Film Coverage Report</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);"></a>
                            </td>
                            <td class="table-data-contents">
                                <a class="table-anc-content" href="javascript:void(0);">Gum Coverage Report</a>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>            
    </div>
</div>

@endsection
