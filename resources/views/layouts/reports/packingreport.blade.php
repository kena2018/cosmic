@extends('layouts.app')
@section('navbarTitel', 'Reports - Packing Report')
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
                    <th><a class="table-anc-content" href="javascript:void(0);" title="Dep">Dep</a></th>
                    <th><a class="table-anc-content" href="javascript:void(0);" title="MTR">MTR</a></th>
                    <th><a class="table-anc-content" href="javascript:void(0);" title="Colour">Colour</a></th>
                    <th><a class="table-anc-content" href="javascript:void(0);" title="Tube">Tube</a></th>
                    <th><a class="table-anc-content" href="javascript:void(0);" title="Bharti">Bharti</a></th>
                    <th><a class="table-anc-content" href="javascript:void(0);" title="Bag/Box">Bag/Box</a></th>
                    <th><a class="table-anc-content" href="javascript:void(0);" title="Roll">Roll</a></th>
                    <th><a class="table-anc-content" href="javascript:void(0);" title="Packing">Packing</a></th>
                    <th><a class="table-anc-content" href="javascript:void(0);" title="Item">Item</a></th>
                    <th><a class="table-anc-content" href="javascript:void(0);" title="Contractor">Contractor</a></th>
                    <th><a class="table-anc-content" href="javascript:void(0);" title="Meter">Meter</a></th>
                </thead>
                <tr>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">27/1/24</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">Paper</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">501E</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">9/10</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">M.R.P.110</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">75</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">15</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">BAG</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">RAJGURU SONATA</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">COM.KAUSHALYAMEN</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">111775</a></td>
                </tr>
                <tr>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">27/1/24</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">Paper</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">501E</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">9/10</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">M.R.P.110</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">75</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">15</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">BAG</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">RAJGURU SONATA</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">COM.KAUSHALYAMEN</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">111775</a></td>
                </tr>
                <tr>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">27/1/24</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">Paper</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">501E</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">9/10</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">M.R.P.110</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">N/A</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">75</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">15</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">BAG</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">RAJGURU SONATA</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">COM.KAUSHALYAMEN</a></td>
                    <td><a class="table-anc-content" href="javascript:void(0);" title="">111775</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
