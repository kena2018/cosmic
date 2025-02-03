<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data</title>
    <style>
    *{font-family: "Poppins", sans-serif;}
    .form-container {  width: 700px;  margin: 50px auto;  padding: 20px; border: 1px solid #00000026; box-shadow: 1px 1px 2px rgba(56, 65, 74, 0.15); border-radius: 5px;height: 800px;background-color: #f0f0f0;}
    .header {display: flex;  justify-content: space-between;  align-items: center;}
    .logo {  display: flex;  flex-direction: column;  align-items: center;}
    .logo img { width: 100px;}
    .form-title { color: #6B4023;  font-size: 20px;   font-weight: 600;   text-transform: capitalize;}
    .section-title { padding: 15px 0; font-size: 16px; color: #6B4023; font-weight: bold; border-bottom: 1px solid #999;}
    .row {  display: flex;  justify-content: space-between;}
    .row label {  width: 150px;  font-weight: bold;}
    .row input[type="text"],
    .row input[type="date"],
    .row select {  width: calc(100% - 160px);  padding: 5px;  border: 1px solid #ddd;  border-radius: 3px;}
    .radio-group {  display: flex;  align-items: center;}
    .radio-group input[type="radio"] {  margin-right: 5px;}
    .radio-group label {  margin-right: 15px;}
    .contact-details, .personal-info {  margin: 20px 0;}
    .footer {  display: flex;  justify-content: space-between;  align-items: center;  padding-top: 20px;  border-top: 2px solid #ddd;}
    .footer div {  width: 40%;  text-align: center;  padding: 10px;  border-top: 2px solid #ff7a00;}
    .footer div span {  font-weight: bold;}
    .field-size { width: 48%; font-size: 15px;}
    .permission-content { column-count: 4; margin: 25px 0px 0 -4px;}
    .permission-sec label {font-size: 14px; color: #1C222B;font-weight: 400;}
    .permission-sec { padding: 7px 0px 0px 4px; display: flex; align-items: center; gap: 7px;}
    .first-section { margin-top: 20px;}
    .prdctn-odr-heading { font-size: 15px; font-weight: 600; line-height: 24px; color: #1C222B; padding: 0 0 5px 0; margin: 15px 0 -15px 0; border-bottom: 1px solid #999;}
    </style>
</head>
<body>
        @yield('content')

</body>
@if(str_contains(url('/'), '127.0.0.1'))
        
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
      <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
      <!-- <script src="{{ asset('assets/js/jquery.1.11.1min.js')}}"></script> -->

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      
      <script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
      <script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>
      <!-- <script src="{{ asset('assets/js/jquery-3.5.1.min.js')}}"></script> -->
      

      <!-- jQuery Scrollbar -->
      <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

      <!-- Chart JS -->
      <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js')}}"></script>

      <!-- jQuery Sparkline -->
      <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

      <!-- Chart Circle -->
      <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js')}}"></script>

      <!-- Datatables -->
      <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>

      <!-- Bootstrap Notify -->
      <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

      <!-- jQuery Vector Maps -->
      <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
      <script src="{{ asset('assets/js/plugin/jsvectormap/world.js')}}"></script>

      <!-- Sweet Alert -->
      <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>


      <script src="{{ asset('assets/js/kaiadmin.min.js')}}"></script>
      <!-- <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script> -->

      <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
      <!-- Kaiadmin DEMO methods, don't include it in your project! -->
      <!-- <script src="{{ asset('assets/js/setting-demo.js')}}"></script>
      <script src="{{ asset('js/app.js')}}"></script>
      <script src="{{ asset('js/custom.js')}}"></script> -->
      @else

        
    
      <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
      <!-- <script src="{{ asset('public/assets/js/jquery-3.5.1.min.js')}}"></script> -->
      <script src="{{ asset('public/assets/js/plugin/webfont/webfont.min.js')}}"></script>
      <!-- <script src="{{ asset('public/assets/js/jquery.1.11.1min.js')}}"></script> -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
      <script src="{{ asset('public/assets/js/core/popper.min.js')}}"></script>
      <script src="{{ asset('public/assets/js/core/bootstrap.min.js')}}"></script>

      <!-- jQuery Scrollbar -->
      <script src="{{ asset('public/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

      <!-- Chart JS -->
      <script src="{{ asset('public/assets/js/plugin/chart.js/chart.min.js')}}"></script>

      <!-- jQuery Sparkline -->
      <script src="{{ asset('public/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

      <!-- Chart Circle -->
      <script src="{{ asset('public/assets/js/plugin/chart-circle/circles.min.js')}}"></script>

      <!-- Datatables -->
      <script src="{{ asset('public/assets/js/plugin/datatables/datatables.min.js')}}"></script>

      <!-- Bootstrap Notify -->
      <script src="{{ asset('public/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

      <!-- jQuery Vector Maps -->
      <script src="{{ asset('public/assets/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
      <script src="{{ asset('public/assets/js/plugin/jsvectormap/world.js')}}"></script>

      <!-- Sweet Alert -->
      <script src="{{ asset('public/assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

      <!-- Kaiadmin JS -->
      <script src="{{ asset('public/assets/js/kaiadmin.min.js')}}"></script>

      <!-- Kaiadmin DEMO methods, don't include it in your project! -->
      <script src="{{ asset('public/assets/js/setting-demo.js')}}"></script>
      <!-- <script src="{{ asset('assets/js/demo.js')}}"></script> -->
      <!-- <script src="{{ asset('public/js/app.js')}}"></script>
      <script src="{{ asset('public/js/custom.js')}}"></script> -->
      <!-- <script src="{{ asset('public/assets/js/jquery.validate.min.js')}}"></script> -->
      <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

      @endif
      @yield('js')
</html>