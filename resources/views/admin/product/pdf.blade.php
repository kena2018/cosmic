<!DOCTYPE html>
<html>
<head>
<title>Product PDF</title>
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
    .info-table th { font-weight: 600; color: #545454; font-size: 13px;padding: 10px 8px 10px 10px; text-align: left;border-right: 1px solid #9b9b9b; border-left: 1px solid #9b9b9b; background: #f3f3f3;}
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
                
                <td class="project_data">
                    <div class="project-title">Product</div>
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
        <div class="section-heading first-section-heading">Product Information</div>
        <table class="info-table first-tablee">
            <?php $categoryValue = optional($productCategory->find($product->category))->name ?? 'N/A'; ?>
            <tr>
                <th class="table-heading-sec">Category:</th>
                <td class="categoryValue">{{ optional($productCategory->find($product->category))->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Product Name:</th>
                <td>{{ old('product_name', $product->product_name ?? '') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Group Name:</th>
                <td>{{ optional($groups->find($product->group_name))->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Alias / SKU:</th>
                <td>{{ old('alias_sku', $product->alias_sku ?? '') }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Width in inches:</th>
                <td>{{ old('width', $product->width ?? '') }}</td>
            </tr>
            <?php if ($categoryValue === 'Paper Roll' || $categoryValue === 'Paper Sheet' || $categoryValue === 'Plastic Roll' ): ?>
            <tr>
                <th class="table-heading-sec">Length in meter:</th>
                <td>{{ old('length', $product->length ?? '') }}</td>
            </tr>
            <?php endif; ?>
            <?php if ($categoryValue === 'Paper Roll' || $categoryValue === 'Paper Sheet'): ?>
                <tr>
                    <th class="table-heading-sec">GSM:</th>
                    <td>{{ old('gsm', $product->gsm ?? '') }}</td>
                </tr>
            <?php endif; ?>
            <?php if ($categoryValue === 'Plastic Roll' || $categoryValue === 'Plastic Jumbo Roll'): ?>
                <tr>
                    <th class="table-heading-sec" >Gauge:</th>
                    <td>{{ old('gage', $product->gage ?? '') }}</td>
                </tr>
            <?php endif; ?>
            
            <tr>
                <th class="table-heading-sec">Master Packing:</th>
                <td>{{ old('master_packing', $product->master_packing ?? '') }}</td>
            </tr>
        </table>

        <div class="section-heading">Product Specifications</div>
        <table class="info-table first-tablee">
            <tr>
                <th class="table-heading-sec">Bharti:</th>
                <td> {{ old( 'bharti', $product->bharti ?? '' ) }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Bags/Box:</th>
                <td>{{ old( 'bharti', $product->number_of_bags_per_box ?? '' )}}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Pipe size:</th>
                <td>{{ old( 'bharti', $product->pipe_size ?? '' ) }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Roll in 1 BDL:</th>
                <td> {{ old( 'rolls_in_1_bdl', $product->rolls_in_1_bdl ?? '' ) }}</td>
            </tr>
            <?php if ($categoryValue !== 'Paper Sheet'): ?>
            <tr>
                <th class="table-heading-sec">Roll Weight:</th>
                <td>{{ old( 'roll_weight', $product->roll_weight ?? '' ) }}</td>
            </tr>
            <?php else: ?>
            <tr>
                <th class="table-heading-sec">Sheet Weight:</th>
                <td> {{ old( 'sheet_weight', $product->sheet_weight ?? '' ) }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec" >Roll Weight to Sheet Weight:</th>
                <td> {{ old( 'roll_weight_to_sheet_weight', $product->roll_weight_to_sheet_weight ?? '' ) }}</td>
            </tr>
            <?php endif; ?>
            <tr>
                <th class="table-heading-sec">BDL K.G.:</th>
                <td> {{ old( 'bdl_kg', $product->bdl_kg ?? '' )}}</td>
            </tr>
            <tr>
                <th class="table-heading-sec" id="paperSheetPacking">Packing Material QTY:</th>
                <td>{{ old( 'packing_material_qty', $product->packing_material_qty ?? '' ) }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec" >Outer Name:</th>
                <td>{{ optional($materials->find($product->outer_name))->material_name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec" >No. of Outer:</th>
                <td>{{ old( 'number_of_outer', $product->number_of_outer ?? '' )}}</td>
            </tr>
            <tr>
                <th class="table-heading-sec"id="paperSheetCarton" >Carton Name:</th>
                <td>{{ optional($materials->find($product->carton_no))->material_name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec" >Rate.:</th>
                <td> {{ old( 'rate', $product->rate ?? '' )}}</td>
            </tr>
            <tr>
                <th class="table-heading-sec" >Packing Material Sub Category.:</th>
                <td> {{$subcategoriesname->first()->sub_cat_name ??''}}</td>
            </tr>
            <tr>
                <th class="table-heading-sec" >Packing Material Name.:</th>
                <td> {{ optional($materials->find($product->packing_material_name))->material_name ?? '' }}</td>
            </tr>
        </table>
        <div class="last-section">
            <span class="last-sec-head">Thank You !</span>
        </div>
    </div>
</div>
</body>
</html>

