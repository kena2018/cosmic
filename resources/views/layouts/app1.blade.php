[15:10] Naheda Sheikh
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
          <title>Cosmic-ERP</title>
      <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
      <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />
 
    @if(str_contains(url('/'), '127.0.0.1'))
        <!-- CSS Files -->
        <link rel="stylesheet"  href="{{ asset('assets/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css')}}" />
 
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
 
       
       
    @else
       <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('public/assets/css/plugins.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('public/assets/css/kaiadmin.min.css')}}" />
 
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="{{ asset('public/assets/css/demo.css')}}" />
        <link rel="stylesheet" href="{{ asset('public/assets/css/main.css')}}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
       
    @endif
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
       
<body>
    <div class="wrapper">
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              @if(str_contains(url('/'), '127.0.0.1'))
 
                <img
                  src="{{ asset('assets/img/Cosmic-Logo-New1 8.svg')}}"
                  alt="navbar brand"
                  class="navbar-brand"
                   />
       
              @else
                 <img
                  src="{{ asset('assets/img/Cosmic-Logo-New1 8.svg')}}"
                  alt="navbar brand"
                  class="navbar-brand"
                  />
                 
              @endif
             
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
         
          </div>
          @include('layouts.sidebar')
        </div>
      <!-- End Sidebar -->
 
        <div class="main-panel">
          <div class="main-header">
            <div class="main-header-logo">
                    <!-- Logo Header -->
              <div class="logo-header" data-background-color="dark">
                <a href="index.html" class="logo">
                  <img
                    src="{{ asset('assets/img/kaiadmin/logo_light.svg')}}"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20"/>
                </a>
                <div class="nav-toggle">
                  <button class="btn btn-toggle toggle-sidebar">
                      <i class="gg-menu-right"></i>
                  </button>
                  <button class="btn btn-toggle sidenav-toggler">
                      <i class="gg-menu-left"></i>
                  </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
              </div>
               
            </div>
         
            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
              <div class="container-fluid">
              <div class="row">
                    <div class="page-heading">
                        <h3>Dashboard</h3>
                    </div>
                </div>
                <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                  </div>
                </nav>
 
              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                  <a
                    class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-expanded="false"
                    aria-haspopup="true">
                    <i class="fa fa-search"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-search animated fadeIn">
                      <form class="navbar-left navbar-form nav-search">
                          <div class="input-group">
                              <input
                                  type="text"
                                  placeholder="Search ..."
                                  class="form-control"
                              />
                          </div>
                      </form>
                  </ul>
                </li>
                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false">
                    <div class="avatar-sm">
                      @if(Auth::check() && Auth::user()->user_photo)
                              <img alt="avatar" src="{{ asset(Auth::user()->profile) }}" style="width: 35px; height: 35px; border-radius: 20%;">
                            @else
                              <img alt="avatar" src="/assets/img/profile.jpg" style="width: 35px; height: 35px; border-radius: 20%;" class="rounded-circle">
 
                            @endif
                      <!-- <img
                        src="/assets/img/profile.jpg"
                        alt="..."
                        class="avatar-img rounded-circle"
                      /> -->
                    </div>
                    <span class="profile-username">
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold"> {{ Auth::user()->name ?? '' }}</span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <img
                              src="{{ Auth::user()->profile ?? '' }}"
                              alt="image profile"
                              class="avatar-img rounded"
                            />
                          </div>
                          <div class="u-text">
                            <h4>{{ Auth::user()->name ?? '' }}</h4>
                            <p class="text-muted">{{ Auth::user()->email ?? '' }}</p>
 
                            <!-- @if(Auth::check() && Auth::user()->user_photo)
                              <img alt="avatar" src="{{ asset(Auth::user()->profile) }}" style="width: 20px; height: 20px; border-radius: 20%;">
                            @else
                              <img alt="avatar" src="{{ url('public/assets/img/profile.jpg') }}" style="width: 20px; height: 20px; border-radius: 20%;">
 
                            @endif -->
 
                            <a
                              href="profile.html"
                              class="btn btn-xs btn-secondary btn-sm">View Profile
                            </a>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">My Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </nav>
            @yield('content')  
          </div>
        </div>
      </div>    
      <!--   Core JS Files   -->
 
      <!-- modal popup  -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content model-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Customer List ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     <p class="modal-para">Are you sure you want to delete this list ?</p>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-sec btn_group">
                            <div class="button-3 cta_btn icon-btn">
                                <a href="javascript:void(0)" class="primary-button ">Cancel</a>
                            </div>
                        </div>
                        <div class="btn-sec btn_group">
                            <div class="button-3 cta_btn icon-btn">
                                <a href="javascript:void(0)" class="primary-button ">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
 
     
      <script src="{{ asset('public/assets/js/core/popper.min.js')}}"></script>
      <script src="{{ asset('publicassets/js/core/bootstrap.min.js')}}"></script>
 
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
 
    @yield('js')
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });
 
      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });
 
      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 
<!-- Initialize Toastr -->
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
 
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif
 
    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif
 
    @if (session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif
 
    @if (session('info'))
        toastr.info("{{ session('info') }}");
    @endif
</script>
 
  </body>
</html>
 