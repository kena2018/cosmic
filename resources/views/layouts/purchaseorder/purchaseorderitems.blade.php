@extends('layouts.app')
@section('navbarTitel', 'Purchase Order')
@section('content')
 
<div class="main-outer">
    <div class="outer card">
        <div class="upload-file-sec">
            <div class="row customer-files-sec">
                <div class="button-purchase">
                    <div class="btn-sec btn_group">
                        <div class="button-1 cta_btn icon-btn">
                            <a href="javascript:void(0)" class="primary-button ">Save</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-design-content">
            <div class="table-details">
                <div class="table-responsive table-designs">
                    <div class="heading-btn">
                        <h6 class="addsupplier-section-headingg">Order Items</h6>
                    </div>
                    <table class="table active all">
                        <thead>
                            <th><a href="javascript:void(0);" title="">Products</a></th>
                            <th><a href="javascript:void(0);" title="">Unites/Box</a></th>
                            <th><a href="javascript:void(0);" title="">Qty</a></th>
                            <th><a href="javascript:void(0);" title="">Rate</a></th>
                            <th><a href="javascript:void(0);" title="">Sub Total</a></th>
                            <th><a href="javascript:void(0);" title="">Tax</a></th>
                            <th><a href="javascript:void(0);" title="">Total</a></th>
                        </thead>
                        <tr>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">Paper Files - Plastic</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">1000</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">13</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">100</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">1300</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">18%</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">1,30,000 INR</a></td>
                        </tr>
                        <tr>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">Paper Files - Plastic</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">1000</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">13</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">100</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">1300</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">18%</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">1,30,000 INR</a></td>
                        </tr>
                        <tr>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">Paper Files - Plastic</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">1000</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">13</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">100</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">1300</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">18%</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">1,30,000 INR</a></td>
                        </tr>
                        <tr>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">Paper Files - Plastic</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">1000</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">13</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">100</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">1300</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">18%</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">1,30,000 INR</a></td>
                        </tr>
                        <tfoot class="table-footer">
                            <tr>
                                <td class="footer-table-heading" id="total" colspan="6">Sub Total :</td>
                                <td class="footer-table-data">52,00,000 INR</td> 
                            </tr>
                            <tr>
                                <td class="footer-table-heading" id="total" colspan="6">Tax :</td>
                                <td class="footer-table-data">02,60,000 INR</td> 
                            </tr>
                            <tr>
                                <td class="footer-table-heading" id="total" colspan="6">Total :</td>
                                <td class="footer-table-data">54,60,000 INR</td> 
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="table-responsive table-designs">
                    <div class="heading-btn">
                        <span class="addsupplier-section-headingg blk-head">History</span>
                    </div>
                    <table class="table active all">
                        <tr class="history-content">
                            <td class="history-content-heading"><a href="javascript:void(0);" title="">Staff Member marked order as Delivered</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">16:28:45 </a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">11-08-2023</a></td>
                        </tr>
                        <tr class="history-content">
                            <td class="history-content-heading"><a href="javascript:void(0);" title="">Staff Member marked order as Delivered</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">16:28:45 </a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">11-08-2023</a></td>
                        </tr>
                        <tr class="history-content">
                            <td class="history-content-heading"><a href="javascript:void(0);" title="">Staff Member marked order as Delivered</a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">16:28:45 </a></td>
                            <td><a class="table-anc-content" href="javascript:void(0);" title="">11-08-2023</a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="details-content">
                    <div class="heading-btnn">
                        <span class="addsupplier-section-heading blk-head">Customer Details</span>
                    </div>
                    <div class="customer-details-sec">
                        <div class="details-inp">
                            <label class="heading-contentt"  for="name">Customer Name</label>
                            <span class="details-input-content">Taral Shah</span>
                        </div>
                        <div class="details-inp">
                            <label class="heading-contentt"  for="name">Company Name</label>
                            <span class="details-input-content">Techify Solution</span>
                        </div>
                        <div class="details-inp">
                            <label class="heading-contentt"  for="name">Status</label>
                            <span class="details-input-content status-content">Delivered</span>
                        </div>
                        <div class="details-inp">
                            <label class="heading-contentt"  for="name">Billing Address</label>
                            <span class="details-input-content">716 BSquare 3, Sindhubhavan Rd, near Tradebulls, Bodakdev, Ahmedabad, Gujarat 380054, India</span>
                        </div>
                        <div class="details-inp">
                            <label class="heading-contentt"  for="name">Shipping Address</label>
                            <span class="details-input-content">716 BSquare 3, Sindhubhavan Rd, near Tradebulls, Bodakdev, Ahmedabad, Gujarat</span>
                        </div>
                    </div>
                </div>
        </div>
    </div>   
</div>
       

@endsection
