<!DOCTYPE html>
<html>
<head>
<title>Production Order PDF</title>
<style>
    *{font-family: sans-serif;}
    .pdf-container { width: 780px;  margin: -40px 0px 0 -40px;height: 100%;background-color: #ffffff; box-shadow: 0 5px 10px #1e20251f !important; border: 1px solid #00000026; border-bottom-left-radius: 5px;}
    .data-container {  padding: 25px 30px 45px 30px;  }
    .divider-sec { width: 100%; height: 10px; background: #6B4023;}
    .pdf-container .middle-sec-inf { font-size: 15px;  font-weight: 600;  color: #222222;}
    .header-table { width: 100%; margin-bottom: 10px;}
    .header-table .left-section { font-size: 20px;font-weight: 600;  color: #6B4023;text-align: right;}
    .left-section-date { font-size: 15px; font-weight: 400; color: #000000;}
    .header-table .right-section { text-align: left; width: 70%;}
    .header-table .right-section img {  max-width: 90px; margin-left: -4px;}
    .info-table {  width: 100%;  border-collapse: collapse;}
    .info-table th { font-weight: 600; color: #2e2e2e; font-size: 13px;padding: 10px 8px 10px 10px; text-align: left;border-right: 1px solid #9b9b9b; border-left: 1px solid #9b9b9b; background: #f3f3f3;}
    .info-table td {font-size: 14px;padding: 10px 8px 10px 15px; text-align: left; font-weight: 600; color: #222222;border-right: 1px solid #9b9b9b;}
    .section-heading {font-size: 17px; font-weight: 600; color: #6B4023; padding: 25px 0 10px 3px;}
    .first-section-heading {border-top: 1px solid #9b9b9b;}
    .section-divider {  border: 1px solid #00000026;  margin-bottom: 10px;}
    .first-tablee tr { border-bottom: 1px solid #9b9b9b;border-top: 1px solid #9b9b9b;}
    .table-heading-sec { width: 195px;  text-align: left;}
    .middle-section{margin-bottom: 15px; width: 100%;}
    .middle-sec-head { font-size: 13px; color: #626262; font-weight: 600;margin-right: 7px;}
    .last-section {margin: 40px 0 8px 0; text-align: left;}
    .last-sec-head { font-size: 19px; font-weight: 600; color: #141414; letter-spacing: 1px;}
    th.project_desc { font-weight: 600; color: #545454; font-size: 13px; text-align: left; width: 12%;}
    td.project_data { font-weight: 600; color: #222222; font-size: 13px;width: 30%;}
    .project-title { text-align: right; font-size: 18px; padding: 0 0 10px 0;}
    th.project_date { font-weight: 600; color: #545454; font-size: 13px; text-align: right;}
    td.project_datee { font-weight: 600; color: #222222; font-size: 13px; text-align: right;width: 10%;}
    .project-date { text-align: right; font-weight: 400;}
    .sub-heading-sec { font-size: 16px !important; padding: 10px 0 10px 10px !important; border-right: none !important;background: none !important;color: #000 !important;}
    tr.info-table-row { border-right: 1px solid #9b9b9b;border-top: 1px solid #9b9b9b;}
</style>
</head>
<body>
<div class="pdf-container">
    <div class="divider-sec"></div>
    <div class="data-container">
        <table class="header-table">
            <tr>
                <td class="right-section">
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
                <?php $categoryValue =  optional($category->find(optional($products->find($productionOrder->product_type))->category))->name ?? '' ?>

                <td class="project_data">
                    <div class="project-title">Production Order </div>
                    <div class="project-date">Date: 15 Nov 2024 </div>
                </td>
            </tr>
            <tr>
                
            </tr>
        </table>
        <!-- <div >
            <div class="middle-section-data">
                <span class="middle-sec-head">Project Desc:</span> <span class="middle-sec-inf">Customer Order</span>
            </div>
            <div class="middle-section-data">
                <span class="middle-sec-head">Date:</span> <span class="middle-sec-inf"> 09/11/2024</span>
            </div>
        </div> -->
        <!-- <table class="middle-section">
            <tr class="middle-sec">
                <th class="project_desc">Project Desc:</th>
                <td class="project_data">Customer Order</td>
                <th class="project_date">Date:</th>
                <td class="project_datee">09/11/2024</td>
            </tr>
        </table> -->
        <div class="section-heading first-section-heading">Production Information</div>
        <table class="info-table first-tablee">
            <tr>
                <th class="table-heading-sec">Order Type:</th>
                <td> {{ old('order_type', $productionOrder->order_type ?? 'N/A') }}</td>
            </tr>
            <?php if ($productionOrder->order_type != 'Make to Stock' ): ?>
            <tr>
                <th class="table-heading-sec">Company Name:</th>
                <td> {{ optional($customers->find($productionOrder->company_name))->company_name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Sales Order:</th>
                <td>{{ optional($salesOrders->find($productionOrder->sales_order))->order_id ?? 'N/A' }}</td>
            </tr>
            <?php endif; ?>
            <tr>
                <th class="table-heading-sec">Product Name:</th>
                <td>{{ old('product_type', optional($products->find($productionOrder->product_type))->product_name ?? 'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">SKU:</th>
                <td>{{ old('sku', $productionOrder->sku ?? 'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Total Bundle Quantity:</th>
                <td>{{ old('qty_required', $productionOrder->qty_required) }}</td>
            </tr>
            <tr>
            <th class="table-heading-sec">Pending Bundle Quantity:</th>
            <td>{{ old('pending_bundle_quantity', $productionOrder->pending_bundle_quantity ?? '0') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Remark:</th>
                <td>{{ old('remark', $productionOrder->remark ?? 'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Required Bundle Quantity:</th>
                <td>{{ old('bundle_quantity', $productionOrder->bundle_quantity ?? 'N/A') }}</td>
            </tr>
            
        </table>
        <div class="section-heading">Order Specification</div>
        <table class="info-table first-tablee">
        <?php if ($categoryValue === 'Paper Roll' ): ?>
            <tr class="info-table-row">
                <th class="sub-heading-sec">Step 1 - Lamination</th>
                <td ></td>
            </tr>
            <tr>
                <th class="table-heading-sec">Paper Name:</th>
                <td>{{ old('lamination_paper_name',$productionOrder->lamination_paper_name??'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Lamination Name:</th>
                <td>{{ old('lamination_name', $productionOrder->lamination_name ?? 'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Lamination Gum Name:</th>
                <td>{{ old('lamination_gun_name', $productionOrder->lamination_gun_name ?? 'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Lamination Type:</th>
                <td>{{old('lamination_type',$productionOrder->lamination_type ?? 'N/A')}}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Internal Notes:</th>
                <td>{{ old('lamination_internal_notes',$productionOrder->lamination_internal_notes ?? 'N/A') }}</td>
            </tr>
            <?php else: ?>
            <tr class="info-table-row">
                <th class="sub-heading-sec">Step 1 - Extrusion</th>
                <td ></td>
            </tr>
            <tr>
                <th class="table-heading-sec">Gauge:</th>
                <td>{{   old('extrusion_colour',$productionOrder->extrusion_gauge??'N/A')}}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Colour:</th>
                <td>{{ old('extrusion_colour', $productionOrder->extrusion_colour?? 'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Size:</th>
                <td>{{ old('extrusion_size', $productionOrder->extrusion_size??'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Recipe:</th>
                <td>{{ old('extrusion_recipe', $productionOrder->extrusion_recipe??'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Quantity of Packing:</th>
                <td>{{ old('extrusion_qty_of_packing', $productionOrder->extrusion_qty_of_packing??'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Internal Notes:</th>
                <td>{{ old('extrusion_internal_notes', $productionOrder->extrusion_internal_notes??'N/A') }}</td>
            </tr>
            <?php endif; ?>
            <?php if ($categoryValue != 'Plastic Jumbo Roll' ): ?>
            <tr class="info-table-row">
                <th class="sub-heading-sec">Step 2 - Rewinding</th>
                <td ></td>
            </tr>
            <tr>
                <th class="table-heading-sec">Pipe:</th>
                <td>{{ old('rewinding_pipe', $productionOrder->rewinding_pipe??'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Sticker:</th>
                <td>{{ old('rewinding_sticker', $productionOrder->rewinding_sticker??'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Quantity in Rolls:</th>
                <td>{{ old('rewinding_qty_in_rolls', $productionOrder->rewinding_qty_in_rolls??'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Colour:</th>
                <td>{{ old('rewinding_colour', $productionOrder->rewinding_colour??'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Width:</th>
                <td>{{ old('rewinding_width', $productionOrder->rewinding_width??'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Length:</th>
                <td>{{ old('rewinding_length', $productionOrder->rewinding_length??'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Internal Notes:</th>
                <td>{{ old('rewinding_internal_notes', $productionOrder->rewinding_internal_notes??'N/A') }}</td>
            </tr>
            <tr class="info-table-row">
                <th class="sub-heading-sec">Step 3 - Silai</th>
                <td ></td>
            </tr>
            <tr>
                <th class="table-heading-sec">Product Name:</th>
                <td>{{ old('sticching_product_name', $productionOrder->sticching_product_name??'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Colour:</th>
                <td>{{ old('sticching_colour', $productionOrder->sticching_colour??'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Packing Name:</th>
                <td>{{ old('sticching_packing_name', $productionOrder->sticching_packing_name??'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Packing Type:</th>
                <td>{{ old('sticching_packing_type', $productionOrder->sticching_packing_type??'N/A')}}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Bag/box:</th>
                <td>{{ old('sticching_bag',$productionOrder->sticching_bag?? 'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Internal Notes:</th>
                <td>{{ old('Stitching_internal_notes',$productionOrder->Stitching_internal_notes??'N/A') }}</td>
            </tr>
            <tr class="info-table-row">
                <th class="sub-heading-sec">Step 4 - Packing</th>
                <td ></td>
            </tr>
            <tr>
                <th class="table-heading-sec">Bharti:</th>
                <td>{{ old('rewinding_pipe', $productionOrder->rewinding_pipe??'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Packing Name:</th>
                <td>{{ old('rewinding_sticker', $productionOrder->rewinding_sticker??'N/A') }}</</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Carton:</th>
                <td>{{ old('packing_carton', $productionOrder->packing_carton??'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Outer Name:</th>
                <td>{{ old('packing_outer_name', $productionOrder->packing_outer_name ?? 'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">QTY Rolls:</th>
                <td>{{ old('packing_qty_rolls', $productionOrder->packing_qty_rolls?? 'N/A') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Internal Notes:</th>
                <td>{{ old('packing_internal_notes',$productionOrder->packing_internal_notes??'N/A') }}</td>
            </tr>
            <tr class="info-table-row">
                <th class="sub-heading-sec">Production Instructions</th>
                <td ></td>
            </tr>
            <?php endif; ?>
            <tr>
                <th class="table-heading-sec">Start Date:</th>
                <td>{{ old('start_date', $productionOrder->start_date??'N/A') }}</td>
            </tr>
        </table>
        <div class="last-section">
            <span class="last-sec-head">Thank You !</span>
        </div>
    </div>
</div>
</body>
</html>