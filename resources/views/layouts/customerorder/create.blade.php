@extends('layouts.app')
@section('navbarTitel', 'Add New Order')
@section('content')
 <style>
    .graph-container {position: relative;  display: flex;  align-items: flex-end;  height: 370px;  width: 90%;  border-left: 1px solid #dcdcdc;  border-bottom: 1px solid #dcdcdc;  margin: 15px 0 13px 50px;}
.bar-container { display: flex; align-items: flex-end; height: 100%; gap: 10px;}
.bar { width: 30px; text-align: center; color: white; padding: 5px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);}
.bar-left { margin-left: 115px;}
.y-axis { position: absolute; left: 0px; top: 0; height: 100%; display: flex; flex-direction: column; justify-content: space-between; margin-left: -145px; align-items: end; width: 137px;}
.x-axis { display: flex; width: 100%; gap: 165px; position: absolute; bottom: -22px; left: 152px;}
.x-axis .label, .y-axis .label {  font-size: 13px;}

.filter-dropdown:after { border-bottom: 8px solid #fff; border-left: 8px solid transparent; border-right: 8px solid transparent; content: ""; right: 2px; top: -8px; position: absolute; z-index: 1001;}

.product-demo { margin: 0;  width: 100%;  display: flex; align-items: end; justify-content: end;flex-direction: column;  padding: 20px 20px 20px 0;}
.product-demo-tabs  { text-align: center; font-weight: 300; font-style: normal; width: 100%;}
.product-demo-table { border: 1px solid #e5e6ea;width: 100%; }
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
.product-orderid { width: 135px;}
.product-productname { width: 350px;}
.product-program { width: 252px;} 
.product-production { width: 232px;}
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
.product-panel1, .product-panel2 { position: relative; height: 100%; display: flex; align-items: center; justify-content: center;}
.product-main{width: 100%;}
.product-panel-content1, .product-panel-content2{ font-size: 16px; font-weight: 500; line-height: 24px; color: #495057;}
.middle-line { margin: 5px 0 !important; color: #9e9e9e;}
.product-tab.first-tab { margin: 0;}
.product-tab.last-tab { margin: 0 0 0 9px;}
 </style>
<div class="main-outer">
<div class="row customer-section-list">
            <div class="details-table col-lg-12">
                <div class="card-tb-1 table-responsive">
                    <div class="table-type-title">Production Details</div>
                    <div class="product-demo-row">  
                        <div class="product-info-section">
                            <div class="product-main">
                                <div class="product-panel1">
                                    <span class="product-panel-content1">Pending Material Work Order</span>
                                </div>
                                <hr class="middle-line">
                                <div class="product-panel2">
                                    <span class="product-panel-content2">Ready Material Work Order</span>
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
                                    <label class="product-tab" for="tab-4">Stiching</label>
                                    <label class="product-tab last-tab" for="tab-5">Packing</label>
                                </div>
                                <div class="product-content">
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table">
                                                <thead>
                                                    <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Order ID</a></th>
                                                    <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                    <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                            </tr>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                            </tr>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                            </tr>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                            </tr>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                            </tr>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                            </tr>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order1</a></td>
                                                            </tr>
                                                       
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table">
                                                <thead>
                                                <tr>
                                                    <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Order ID</a></th>
                                                    <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                    <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                            
                                                    <tr>
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order12</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title="">order12</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order12</a></td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title="">order12</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order12</a></td>
                                                    </tr>
                                                  
                                                  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table">
                                                <thead>
                                                <tr>
                                                    <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Order ID</a></th>
                                                    <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                    <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                            
                                                    <tr>
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order13</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title="">order13</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order13</a></td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title="">order13</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order13</a></td>
                                                    </tr>
                                                  
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table"> 
                                                <thead>
                                                <tr>
                                                    <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Order ID</a></th>
                                                    <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                    <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                    
                                                    <tr>
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order14</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title="">order14</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order14</a></td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title="">order14</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order14</a></td>
                                                    </tr>
                                                   
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table"> 
                                                <thead>
                                                <tr>
                                                    <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Order ID</a></th>
                                                    <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                    <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order15</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title="">order15</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order15</a></td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title="">order15</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order15</a></td>
                                                    </tr>
                                                    
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-demo-table">
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table"> 
                                                <thead>
                                                    <tr>
                                                            <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Order ID</a></th>
                                                            <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                            <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                            <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                            <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                              
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order16</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                            </tr>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order16</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                            </tr>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order16</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                            </tr>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order16</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                            </tr>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order16</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                            </tr>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order16</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                            </tr>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order16</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                            </tr>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order16</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                            </tr>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order16</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                            </tr>
                                                            <tr>
                                                            <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order16</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title=""></a>order16</td>
                                                            </tr>
                                                        
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table"> 
                                            <thead>
                                            <tr>
                                                    <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Order ID</a></th>
                                                    <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                    <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                    <tr>
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order16</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title="">order16</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order16</a></td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title="">order16</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order16</a></td>
                                                    </tr>
                                                  
                                                  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table"> 
                                            <thead>
                                            <tr>
                                                    <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Order ID</a></th>
                                                    <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                    <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                    <tr>
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order17</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title="">order17</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order17</a></td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title="">order17</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order17</a></td>
                                                    </tr>
                                                  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table"> 
                                            <thead>
                                            <tr>
                                                    <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Order ID</a></th>
                                                    <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                    <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                                    <tr>
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order18</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title="">order18</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order18</a></td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title="">order18</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order18</a></td>
                                                    </tr>
                                                 
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="product-panel">
                                        <div class="product-main">
                                            <table class="product-table dashboard-material-table"> 
                                            <thead>
                                            <tr>
                                                    <th class="product-orderid"><a class="table-anc-contents" href="javascript:void(0);">Order ID</a></th>
                                                    <th class="product-productname"><a class="table-anc-contents" href="javascript:void(0);">Product Name</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Program</a></th>
                                                    <th class="product-production"><a class="table-anc-contents" href="javascript:void(0);">Production</a></th>
                                                    <th class="product-program"><a class="table-anc-contents" href="javascript:void(0);">Pending</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                    <tr>
                                                        <td data-th="Column Header 1"><a class="table-anc-contents" href="javascript:void(0);" title="">order19</a></td>
                                                        <td data-th="Column Header 2"><a class="table-anc-contents" href="javascript:void(0);" title="">order19</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order19</a></td>
                                                        <td data-th="Column Header 4"><a class="table-anc-contents" href="javascript:void(0);" title="">order19</a></td>
                                                        <td data-th="Column Header 3"><a class="table-anc-contents" href="javascript:void(0);" title="">order19</a></td>
                                                    </tr>
                                                   
                                                
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
</div>
       
<div class="modal fade" id="unloadModal" tabindex="-1" aria-labelledby="unloadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="unloadModalLabel">Confirm Navigation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Before leaving the order page, please confirm that you are okay with losing any unsaved order details.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Stay on Page</button>
          <button type="button" class="btn btn-danger" id="leavePageBtn">Leave Page</button>
        </div>
      </div>
    </div>
  </div><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
  let preventUnload = true;
  let unloadModalShown = false;

  window.addEventListener('beforeunload', function (e) {
    if (preventUnload && !unloadModalShown) {
      e.preventDefault();
      e.returnValue = '';
      showUnloadModal(); // Trigger the modal instead of the native dialog
    }
  });

  function showUnloadModal() {
    const unloadModal = new bootstrap.Modal(document.getElementById('unloadModal'));
    unloadModal.show();
    unloadModalShown = true;

    // Prevent the unload until the user confirms
    const leavePageBtn = document.getElementById('leavePageBtn');
    leavePageBtn.addEventListener('click', function() {
      preventUnload = false;
      window.location.href = window.location.href;  // Simulate page leave
    });
  }
</script>
@endsection
