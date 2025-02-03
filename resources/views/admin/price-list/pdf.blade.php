<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price List</title>
    <style>
        body { font-family: Arial, sans-serif;}
        .sales-order { width: 740px; margin: -40px 0px 0 -40px; background: #fff; padding: 20px;}
        .header-table { width: 100%; margin-bottom: 5px; border-collapse: collapse;}
        .details-table { width: 100%; margin-bottom: 20px; border-collapse: collapse;}
        .header-table td { vertical-align: middle; padding: 5px;}
        .header-table .date { vertical-align: bottom; padding: 5px;width: 33%;font-size: 12px; text-align: right;}
        .details-table td { vertical-align: bottom; padding: 0 5px;}
        .details-table td p {font-size: 12px;}
        .logo {width: 33%;}
        .heading {width: 33%;}
        .logo img { width: 100px;}
        .heading h1 { font-size: 22px; font-weight: 900; text-align: center; margin: 0;text-transform: uppercase;}
        .contact-section { text-align: left;}
        .contact-section p {margin: 0;padding: 0 0 5px 5px; font-size: 12px;}
        .order-table {  max-width: 900px; width: 100%; border-collapse: collapse; }
        .order-table th, .order-table td { border: 1px solid #000; padding: 8px; text-align: center; font-size: 13px; font-weight: normal;}
        .order-table th {background-color: #f00; font-weight: bold;color: #fff;font-size: 12px;}
        .conditions-section { font-size: 14px;padding: 0px 0 10px 0}
        .notes-section { font-size: 14px; margin-top: 5px; padding: 5px 0 5px 5px; border: 1px solid #000; background-color: #ffffff;height: 80px;}
        .notes-section p {margin: 0;}
        .ms-sec { font-weight: 600;}
        .details-right { text-align: right;}
        .details-middle {text-align: center;}
        .price-table_no { width: 20px;}
        .price-table_box { width: 165px;text-align: left !important;}
        .price-table_subcat {width: 65px;}
        .price-table_meter { width: 25px;}
        .price-table_qty { width: 25px;}
        .price-table_rate { width: 25px;}
        .price-table_bundle { width: 25px;}
        .price-table_box_data {text-align: left !important;}
        .conditions-section p {font-size: 16px;}
        .condition_number { margin: -10px 0 0px -15px;}
        .date .rate-date {margin: 0px;font-size: 10px;}
    </style>
</head>
<body>
    <div class="sales-order">
        <table class="header-table" cellspacing="0" cellpadding="0">
            <tr>
                <td class="date">
                    <p class="ms-sec-order rate-date"><span class="ms-sec"> RATES AS ON:</span> <?php echo date('d.m.Y'); ?></p>
                </td>
            </tr>
        </table>
        <table class="header-table" cellspacing="0" cellpadding="0">
            <tr>
                <td class="logo">
                    @if(str_contains(url('/'), '127.0.0.1'))
                    <img
                    src="{{ asset('public/assets/img/Cosmiclogo.png')}}"
                    alt="navbar brand"
                    class="navbar-brand"
                    />
                    @else
                    <img
                    src="{{ asset('public/assets/img/Cosmiclogo.png')}}"
                    alt="navbar brand"
                    class="navbar-brand"
                    />
                    @endif
                </td>
                <td class="heading">
                    <h1>{{ $priceList->list_name }}</h1>
                </td>
                <td class="date">
                    <p class="ms-sec-order"><span class="ms-sec">Date :</span> ______________</p>
                </td>
            </tr>
        </table>

        <div class="contact-section">
            <p>MONIK SHAH : 9924144755</p>
            <p>CHIRAG SHAH : 9924144754 (DISPATCH PAYMENT DETAIL)</p>
        </div>

        <table class="details-table" cellspacing="0" cellpadding="0">
            <tr>
                <td class="details-left">
                    <p><strong>PARTY NAME :</strong> ______________</p>
                    <p><strong>DELIVERY DATE :</strong> ______________</p>
                </td>
                <td class="details-middle">
                    <p><strong>TRANSPORT :</strong> ______________</p>
                </td>
                <td class="details-right">
                    <p><strong>DISCOUNT :</strong> ______________</p>
                    <p><strong>PAYMENT :</strong> ______________</p>
                </td>
            </tr>
        </table>

        <table class="order-table" cellspacing="0" cellpadding="0">
            @foreach ($groupedItems as $packingType => $items)
                <thead>
                    <tr>
                        <th class="price-table_no">No.</th>
                        <th class="price-table_box">{{ ucfirst($packingType) }} PACK </th>
                        <th class="price-table_subcat">Packing Material Sub Category Name</th>
                        <th class="price-table_meter">METER</th>
                        <th class="price-table_qty">QTY</th>
                        <th class="price-table_rate">Rate</th>
                        <th class="price-table_bundle">Bundle</th>
                    </tr>
                </thead>
                @if($items->isNotEmpty())
                    @foreach ($items as $item)
                        <tbody>
                            <tr>
                                <td>{{ $item->product_id }}</td>
                                <td class="price-table_box_data">{{ $item->product_name }}</td>
                                <td>{{ optional($MaterialSubCategories->find($item->packing_material_type))->sub_cat_name ?? 'N/A' }}</td>
                                <td>{{ optional($products->find($item->product_id))->length ?? 'N/A' }}</td>
                                <td>{{ $item->min_qty }}</td>
                                <td>{{ $item->special_rate ?? $item->discount_rate ?? $item->rate}}</td>
                                <td>{{ optional($products->find($item->product_id))->rolls_in_1_bdl ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    @endforeach
                @else
                    <p>No {{ $packingType }} products found.</p>
                @endif
            @endforeach
        </table>

        <div class="conditions-section">
            <p><strong>CONDITIONS :</strong></p>
            <ol class="condition_number">
                <li>Rates include 18% GST.</li>
                <li>Ex-Ahmedabad Rates.</li>
                <li>Rate may change without prior notice, So please confirm rate before placing order.</li>
                <li>All the products are above 200 gauge only as per law.</li>
            </ol>
        </div>

        <div class="notes-section">
            <p><strong>NOTE :</strong></p>
        </div>
    </div>
</body>
</html>