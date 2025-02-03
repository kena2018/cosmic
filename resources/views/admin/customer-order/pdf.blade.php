<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Order</title>
    <style>
       body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #ffffff;}
       span {font-family: Arial, sans-serif;}
    .container { width: 730px; margin: -25px 0px 0px -35px; background: white; padding: 20px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); border: 1px solid #ddd;}
    .header { text-align: center; border: 1px solid #9b9b9b;}
    .header h1 { margin: 0; font-size: 22px; background-color: #f2f2f2; padding: 8px 0; border-bottom: 1px solid #9b9b9b;}
    .header p { font-size: 14px; padding: 0 140px;}
    .sales-order { text-align: center; }
    .sales-order h2 { margin: 0; padding: 0; border-left: 1px solid #9b9b9b;border-right: 1px solid #9b9b9b; font-size: 17px; padding: 5px 0;}
    table { width: 100%; border-collapse: collapse;}
    th, td {border-right: 1px solid #9b9b9b;border-left: 1px solid #9b9b9b;border-bottom: 1px solid #9b9b9b; padding: 8px; font-size: 12px; text-align: center;}
    th[colspan="2"] { text-align: center; }
    .gst-section { padding: 5px; font-size: 14px; margin-top: 0px;}
    .terms {border-right: 1px solid #9b9b9b;border-left: 1px solid #9b9b9b; border-bottom: 1px solid #9b9b9b; font-size: 12px;padding: 10px 0 0px 0px;}
    .details {border: 1px solid #9b9b9b;}
    .note { margin-top: 20px; text-align: right; font-size: 12px;}
    .left-details {text-align: left; padding: 0 0px 0 10px; width: 64.4%;border-right: 1px solid #9b9b9b;border-top: none; border-left: none; border-bottom: none;}
    .right-details {text-align: left;padding: 0 !important;border-top: none; border-left: none; border-bottom: none; border-right: none;}
    .left-details-data {font-size: 16px; font-weight: 600;padding: 0 0px 0 5px;text-transform: uppercase;}
    .address-sec {padding: 0 0 0 40px;}
    .ms-sec { font-weight: 600;}
    .gst-no {font-size: 12px;}
    .ms-sec-order { margin: 7px 0;}
    .right-details-order { background: #f2f2f2; padding: 3px 0px 3px 8px;border-bottom: 1px solid #9b9b9b;}
    .right-details-transport { padding: 3px 0px 3px 8px; height: 30px; border-bottom: 1px solid #9b9b9b;}
    .right-details-transport p {margin: 0;}
    .right-details-marka p { margin: 7px 0;}
    .right-details-marka { padding: 3px 0px 3px 8px;}
    .product-left {text-align: left !important;font-size: 12px !important;}
    .table-section th {font-size: 12px;}
    .table-section td {font-size: 12px;}
    .product_name {width: 30%;}
    .gstin_no {font-weight: 600;}
    .table-section .bottom_border td {border-bottom: none;}
    .top_border {border-top: 1px solid #9b9b9b;}
    .totals-section-billing {width: 63.2%; text-align: left;padding: 0 0 0 10px;}
    .totals-section-grand {width: 35%; text-align: left;padding: 0;}
    .total_amount {margin: 15px 0 !important;}
    .bill_amount {margin: 15px 0 !important;}
    .totals-section-round { padding: 5px 0 5px 10px;height: 35px;}
    .totals-section-grand-total { padding: 0px 0 0px 10px;margin-bottom:-6px; height: 35px; border-top: 1px solid #9b9b9b; background: #f2f2f2;}
    .grands_total {padding: 10px 0 0 0;}
    .right_item {text-align: right;}
    .terms p { margin: 0;}
    .terms-heading { padding: 0px 0 10px 10px;font-size:14px;}
    .terms-fr {padding: 3px 0 0px 10px;font-size:10px;}
    .terms td {border: none !important;}
    .terms_for_sec, .terms_for_sign {text-align: right;padding: 3px 10px 0px 0;}
    .names_sec {margin: 0;}
    .tabledata_width {width: 55px;}
    .tablegst_width {width: 30px;}
    .tabletaxamount_width {width: 100px;}
    .tabledata_bdl {width: 40px;}
    .tabledata_qty {width: 40px;}
    .tabledata_rate {width: 30px;}
    .product_name_tb {margin: 5px 0 0 -5px;}
    .product_name_tb span {text-decoration: underline;margin-left:5px;font-size: 11px;}
    .product_id_name {font-size: 12px;}
    .sr_no {width: 19px;}

    </style>
    </head>
    <body>
    <div class="container">
        <!-- Header Section -->
        <header class="header">
            <h1>PRIMO INDUSTRIES</h1>
            <p>412/1, Ashwamegh Industrial Estate, Near Canal, Nutan Nagar Bank Street, Changodar, Dist: Ahmedabad-382213. Ph: 079-40303831</p>
        </header>
        <section class="sales-order">
          <h2>SALES ORDER</h2>
        </section>
        <!-- Details Section -->
        <section class="details">
            <table>
                <tr>
                    <td class="left-details">
                        <p class="names_sec"><span  class="ms-sec">M/s. :</span> <span class="left-details-data"> {{ $customerOrders->customer->first_name ?? '' }} {{ $customerOrders->customer->last_name ?? '' }}
                        </span></p>
                        <p class="address-sec">
                            <span>  {{ $customerOrders->customer->address1 ?? '' }}</span><br>
                            <span>  {{ $customerOrders->customer->contect ?? '' }} {{ $customerOrders->customer->alt_phone ?? '' }}</span><br>
                            <span class="address-main"> {{ optional($cities->find($customerOrders->city_id))->name }}</span>
                        </p>
                        <p><span class="ms-sec">GSTIN No. :</span><span class="gst-no"> {{ $customerOrders->customer->gstin ?? '' }}</span></p>
                    </td>
                    <td class="right-details">
                        <div class="right-details-order">
                            <p class="ms-sec-order"><span class="ms-sec">Order No.: </span> {{old('order_id',$customerOrders->order_id ?? '')}}</p>
                            <p class="ms-sec-order"><span class="ms-sec">Order Date: </span> {{ old('created_at', isset($customerOrders->created_at) ? \Carbon\Carbon::parse($customerOrders->created_at)->format('d-m-Y') : 'N/A') }}
                            </p> 
                        </div>
                        <div class="right-details-transport">
                            <p><span class="ms-sec">Transport: </span> {{ optional($transforms->find($customerOrders->packing_name))->name }}</p>
                        </div>
                        <div class="right-details-marka">
                            <p><span class="ms-sec">Marka:</span></p>
                            <p><span class="ms-sec">Delivery: </span>{{ old('delivery_date', isset($customerOrders->delivery_date) ? \Carbon\Carbon::parse($customerOrders->delivery_date)->format('d-m-Y') : 'N/A') }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        </section>

        <!-- Table Section -->
        <section class="table-section">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2" class="sr_no">Sr.</th>
                        <th rowspan="2" class="product_name">Product Name</th>
                        <th rowspan="2" class="tabledata_bdl">Bundle</th>
                        <th rowspan="2" class="tabledata_qty">Qty</th>
                        <th rowspan="2" class="tabledata_rate">Rate</th>
                        <th rowspan="2" class="tabledata_width">Taxable Amount</th>
                        <th rowspan="2" class="tablegst_width">GST %</th>
                        <th colspan="2" class="tabletaxamount_width">Tax Amount</th>
                        <th rowspan="2" class="tabledata_width">Net Amount</th>
                    </tr>
                    <tr>
                        <th>Integrated</th>
                        <th>Tax Value</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($productsOrders as $index => $productId)
                  <tr >
                      <td>{{ $loop->iteration }}</td>
                      <td class="product-left"><span class="product_id_name" style="text-transform: capitalize;">{{ $products->firstWhere('id', $productId->product_id)->product_name ?? '' }} </span>
                        <p class="product_name_tb">
                          <span>{{ old('color.0', $productId->colour ?? '') }}</span>
                          <span style="text-transform: uppercase;">{{ $products->firstWhere('id', $productId->product_id)->master_packing ?? '' }}</span>
                          <span class="sticker_datas" style="float: right;">{{old('sticker_name.0',$productId->sticker_name ?? '')}}</span>
                        </p>
                       
                      </td>
                      <td>{{old('bdl_kg.0',$productId->bdl_kg ?? '')}}</td>
                      <td>{{old('roll_counte.0',formatIndianCurrencyNumber($productId->roll_counte) ?? '')}}</td>
                      <td>{{old('rate.0',formatIndianCurrencyNumber($productId->rate) ?? '')}}</td>
                      <td >{{old('total.0',formatIndianCurrencyNumber($productId->total) ?? '')}}</td>
                      <td >{{ $productDetails[$index]['gstValue'] }}</td>
                      <td >{{ number_format($productDetails[$index]['integrated'], 2) }}</td>
                      <td></td>
                      <td >{{ number_format($productDetails[$index]['taxAmount'], 2) }}</td>
                  </tr>
                  @endforeach
                  <tr>
                      <td></td>
                      <td class="product-left"><span class="gstin_no">GSTIN No.: </span>{{ $customerOrders->customer->gstin ?? '' }}</td>
                      <td>{{ number_format($totalBdl, 2) }}</td>
                      <td><span class="gstin_no">Total</span></td>
                      <td></td>
                      <td>{{ number_format($totalTaxAmountSum, 2) }}</td>
                      <td></td>
                      <td>{{ number_format($totalIntegratedSum, 2) }}</td>
                      <td></td>
                      <td>{{ number_format($totalAmountSum, 2) }}</td>
                  </tr>
                </tbody>
            </table>
        </section>
    

    <!-- GSTIN Section
    <section class="gst-section">
      <p><b>GSTIN No.:</b> 24AAQFP4018H1Z7</p>
    </section> -->

    <!-- Totals Section -->
    <section class="totals-section">
      <table>
        <tr>
          <td class="totals-section-billing">
            <p class="ms-sec-order total_amount"><span class="ms-sec">Total GST: </span>{{ number_format($totalIntegratedSum, 2) }}</p>
            <p class="ms-sec-order bill_amount"><span class="ms-sec">Bill Amount: </span>{{ number_format($totalAmountSum, 2) }}</p>
          </td>
          <td class="totals-section-grand">
            <div class="totals-section-round">
              <p class="ms-sec-order grands_total" id="allamout"><span>Round Off: </span><span class="right_item"> </span></p>
            </div>
            <div class="totals-section-grand-total">
              <p class="ms-sec-order"><span class="ms-sec">Grand Total: </span> <span class="ms-sec">{{ number_format($totalAmountSum, 2) }}</span></p>
            </div>
          </td>
        </tr>
      </table>
    </section>

    <!-- Terms and Conditions -->
    <section class="terms">
      <p class="terms-heading"><span class="ms-sec">Terms & Conditions:</span></p>
      <p class="terms-fr">1. ALL RPF QUALITY MATERIAL MAY HAVE COLOUR VARIATION AND NO COMPLAIN SHALL BE ENTERTAINED FOR THE SAME.</p>
      <p class="terms-fr">2. SUBJECT TO AHMEDABAD JURISDICTION.</p>
      <table>
        <tr>
          <td class="totals-section-billing">
            <p class="ms-sec-order total_amount"><span class="ms-sec">Note: </span></p>
          </td>
          <td class="totals-section-grand">
            <p class="terms_for_sec">For, PRIMO INDUSTRIES</p>
            <p class="terms_for_sign">(Authorized Signatory)</p>
          </td>
        </tr>
      </table>
    </section>
  </div>
    
</body>
</html>