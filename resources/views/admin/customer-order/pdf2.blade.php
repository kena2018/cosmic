<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sales Order</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f9f9f9;}
    .container { width: 800px; margin: -40px 0px 0px -40px; background: white; padding: 20px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); border: 1px solid #ddd;}
    .header { text-align: center; border: 1px solid #9b9b9b;}
    .header h1 { margin: 0; font-size: 22px; background-color: #f2f2f2; padding: 8px 0; border-bottom: 1px solid #9b9b9b;}
    .header p { font-size: 14px; padding: 0 140px;}
    .sales-order { text-align: center; }
    .sales-order h2 { margin: 0; padding: 0; border-left: 1px solid #9b9b9b;border-right: 1px solid #9b9b9b; font-size: 17px; padding: 5px 0;}
    table { width: 100%; border-collapse: collapse;}
    th, td {border-right: 1px solid #9b9b9b;border-left: 1px solid #9b9b9b;border-bottom: 1px solid #9b9b9b; padding: 8px; font-size: 12px; text-align: center;}
    th[colspan="2"] { text-align: center; }
    .gst-section { padding: 5px; font-size: 14px; margin-top: 0px;}
    .totals-section { margin-top: 20px; }
    .terms { margin-top: 20px; padding: 10px; border: 1px solid #ddd; font-size: 12px;}
    .details {border: 1px solid #9b9b9b;}
    .note { margin-top: 20px; text-align: right; font-size: 12px;}
    .left-details {text-align: left; padding: 0 0px 0 10px; width: 65%;border-right: 1px solid #9b9b9b;border-top: none; border-left: none; border-bottom: none;}
    .right-details {text-align: left;padding: 0 !important;border-top: none; border-left: none; border-bottom: none; border-right: none;}
    .left-details-data {font-size: 16px; font-weight: 600;padding: 0 0px 0 5px;}
    .address-sec {padding: 0 0 0 40px;}
    .ms-sec { font-weight: 600;}
    .gst-no {font-size: 15px;}
    .ms-sec-order { margin: 7px 0;}
    .right-details-order { background: #f2f2f2; padding: 3px 0px 3px 8px;border-bottom: 1px solid #9b9b9b;}
    .right-details-transport { padding: 3px 0px 3px 8px; height: 30px; border-bottom: 1px solid #9b9b9b;}
    .right-details-transport p {margin: 0;}
    .right-details-marka p { margin: 7px 0;}
    .right-details-marka { padding: 3px 0px 3px 8px;}
    .product-left {text-align: left !important;}
    .table-section th {font-size: 12px;}
    .table-section td {font-size: 12px;}
    .product_name {width: 25%;}
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
            <p><span class="ms-sec">M/s. :</span> <span class="left-details-data">RENUKA ENTERPRISES</span></p>
            <p class="address-sec">
              <span>5-2-399, RISALA ABDULLA, OSMANGUNJ</span><br>
              <span>9440796162  04024610389</span><br>
              <span class="address-main">HYDERABAD</span>
            </p>
            <p><span class="ms-sec">GSTIN No. :</span><span class="gst-no"> 36ACJFP5698L1ZN</span></p>
          </td>
          <td class="right-details">
            <div class="right-details-order">
              <p class="ms-sec-order"><span class="ms-sec">Order No.:</span> 301</p>
              <p class="ms-sec-order"><span class="ms-sec">Order Date:</span> 29/04/2024</p>
            </div>
            <div class="right-details-transport">
              <p><span class="ms-sec">Transport:</span></p>
            </div>
            <div class="right-details-marka">
              <p><span class="ms-sec">Marka:</span></p>
              <p><span class="ms-sec">Delivery:</span></p>
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
            <th rowspan="2">Sr.</th>
            <th rowspan="2" class="product_name">Product Name</th>
            <th rowspan="2">Bundle</th>
            <th rowspan="2">Qty</th>
            <th rowspan="2">Rate</th>
            <th rowspan="2">Taxable Amount</th>
            <th rowspan="2">GST %</th>
            <th colspan="2">Tax Amount</th>
            <th rowspan="2">Net Amount</th>
          </tr>
          <tr>
            <th>Integrated</th>
            <th>Tax Value</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td class="product-left">SYN. COSMIC TUFF 14" 10MTR-132 ORANGE BOX</td>
            <td>STICKER</td>
            <td>10</td>
            <td>1320.00</td>
            <td>63762.60</td>
            <td>18.0</td>
            <td>11477.27</td>
            <td>2053.47</td>
            <td>75239.87</td>
          </tr>
          <tr>
            <td>2</td>
            <td class="product-left">SYN. COSMIC TUFF 14" 10MTR-132 ORANGE BOX</td>
            <td>STICKER</td>
            <td>10</td>
            <td>1320.00</td>
            <td>63762.60</td>
            <td>18.0</td>
            <td>11477.27</td>
            <td>2053.47</td>
            <td>75239.87</td>
          </tr>
          <tr>
            <td>3</td>
            <td class="product-left">SYN. COSMIC TUFF 14" 10MTR-132 ORANGE BOX</td>
            <td>STICKER</td>
            <td>10</td>
            <td>1320.00</td>
            <td>63762.60</td>
            <td>18.0</td>
            <td>11477.27</td>
            <td>2053.47</td>
            <td>75239.87</td>
          </tr>
          <tr>
            <td>4</td>
            <td class="product-left">SYN. COSMIC TUFF 14" 10MTR-132 ORANGE BOX</td>
            <td>STICKER</td>
            <td>10</td>
            <td>1320.00</td>
            <td>63762.60</td>
            <td>18.0</td>
            <td>11477.27</td>
            <td>2053.47</td>
            <td>75239.87</td>
          </tr>
          <tr>
            <td>5</td>
            <td class="product-left">SYN. COSMIC TUFF 14" 10MTR-132 ORANGE BOX</td>
            <td>STICKER</td>
            <td>10</td>
            <td>1320.00</td>
            <td>63762.60</td>
            <td>18.0</td>
            <td>11477.27</td>
            <td>2053.47</td>
            <td>75239.87</td>
          </tr>
          <tr>
            <td></td>
            <td class="product-left">GSTIN No.: 24AAQFP4018H1Z7</td>
            <td>24</td>
            <td>total</td>
            <td></td>
            <td>144525.78</td>
            <td></td>
            <td>26014.64</td>
            <td></td>
            <td>170540.42</td>
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
          <td style="width: 65%; text-align: left;">
            <p>Total GST: <b>₹26,014.64</b></p>
            <p>Bill Amount: <b>₹1,70,540.00</b></p>
          </td>
          <td style="width: 35%; text-align: center;">
            <p><b>Grand Total:</b> ₹1,70,540.00</p>
          </td>
        </tr>
      </table>
    </section>

    <!-- Terms and Conditions -->
    <section class="terms">
      <p><b>Terms & Conditions:</b></p>
      <p>1. ALL RPF QUALITY MATERIAL MAY HAVE COLOUR VARIATION AND NO COMPLAIN SHALL BE ENTERTAINED FOR THE SAME.</p>
      <p>2. SUBJECT TO AHMEDABAD JURISDICTION.</p>
    </section>

    <!-- Note and Signature -->
    <section class="note">
      <p><b>Note:</b></p>
      <p>For, PRIMO INDUSTRIES</p>
      <p>(Authorized Signatory)</p>
    </section>
  </div>
</body>
</html>