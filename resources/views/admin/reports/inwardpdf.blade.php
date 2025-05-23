<!DOCTYPE html>
<html>
<head>
<title>Stock Inward Reports PDF</title>
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
                    <div class="project-title">Stock Inward Reports</div>
                    <div class="project-date">Date: {{ $inworddata[0]['date'] }}</div>
                </td>
            </tr>
        </table>
        <div class="section-heading first-section-heading">Inward Information</div>
        <table class="info-table first-tablee">
            <tr>
                <th class="table-heading-sec">User Name:</th>
                <td>{{ $inworddata[0]['user']['name'] }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Date:</th>
                <td>{{ $inworddata[0]['date'] }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Machine:</th>
                <td>{{ $inworddata[0]['machine'] }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Material Name:</th>
                <td>{{ $inworddata[0]['material']['material_name'] }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Category:</th>
                <td>{{ $inworddata[0]['category']['name'] }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">Sub Category:</th>
                <td>{{ $inworddata[0]['materialSubCategory']['sub_cat_name'] }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">unit1:</th>
                <td>{{ $inworddata[0]['unit1'] }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">unit1 Value:</th>
                <td>{{ $inworddata[0]['unit1_value'] }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">unit2:</th>
                <td>{{ $inworddata[0]['unit2'] }}</td>
            </tr>
            <tr>
                <th class="table-heading-sec">unit2 Value:</th>
                <td>{{ $inworddata[0]['unit2_value'] }}</td>
            </tr>
        </table>
        <div class="last-section">
            <span class="last-sec-head">Thank You !</span>
        </div>
    </div>
</div>
</body>
</html>
