@extends('layouts.app')
@section('navbarTitel', 'Reports - Extruder Report')
@section('content')

<div class="main-outer">
    <div class="main-section">
        <div class="outer card report-graph">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="report-bar-heading">
                    <h6>React Bar Graph</h6>
                    </div>
                    <section class="bar-graph bar-graph-horizontal bar-graph-one">
                        <div class="bar-one">
                            <span class="year">2018</span>
                            <div class="bar" data-percentage="99%"></div>
                        </div>
                        <hr class="report-border">
                        <div class="bar-two">
                            <span class="year">2016</span>
                            <div class="bar" data-percentage="55%"></div>
                        </div>
                        <hr class="report-border">
                        <div class="bar-three">
                            <span class="year">2014</span>
                            <div class="bar" data-percentage="74.7%"></div>
                        </div>
                        <hr class="report-border">
                        <div class="bar-four">
                            <span class="year">2012</span>
                            <div class="bar" data-percentage="74.7%"></div>
                        </div>
                        <hr class="report-border">
                        <div class="bar-five">
                            <span class="year">2010</span>
                            <div class="bar" data-percentage="66.8%"></div>
                        </div>
                        <hr class="report-border">
                        <div class="bar-six">
                            <span class="year">2008</span>
                            <div class="bar" data-percentage="46.8%"></div>
                        </div>
                        <hr class="report-border">
                        <div class="bar-seven">
                            <span class="year">2006</span>
                            <div class="bar" data-percentage="56.8%"></div>
                        </div>
                        <hr class="report-border">
                        <div class="bar-eight">
                            <span class="year">2004</span>
                            <div class="bar" data-percentage="60.8%"></div>
                        </div>
                        <hr class="report-border">
                        <div class="bar-nine">
                            <span class="year">2002</span>
                            <div class="bar" data-percentage="26.8%"></div>
                        </div>
                        <hr class="report-border">
                        <div class="bar-ten">
                            <span class="year">2000</span>
                            <div class="bar" data-percentage="36.8%"></div>
                        </div>
                        <hr class="report-border">
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
                <table class="table active all">
                    <thead>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Date">Date</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Shift">Shift</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Size">Size</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Gauge">Gauge</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Colour">Colour</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Kg">Kg</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Micron">Micron</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="GSM">GSM</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Gram">Gram</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Covg">Covg</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Meter">Meter</a></th>
                        <th><a class="table-anc-content" href="javascript:void(0);" title="Machine">Machine</a></th>
                    </thead>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">27/1/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">0.0</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">600</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">0</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">100</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">100</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Machine 1</a></td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">27/1/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">0.0</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">700</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">0</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">200</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">200</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Machine 2</a></td>
                    </tr>
                    <tr>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">27/1/24</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">0.0</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">800</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">0</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">500</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">500</a></td>
                        <td><a class="table-anc-content" href="javascript:void(0);" title="">Machine 3</a></td>
                    </tr>
                </table>
            </div>
        </div>
</div>

@endsection
