<!DOCTYPE html>
<html lang="en">
  <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ isset($metaTitle) ? $metaTitle : 'Cosmic - ERP' }}</title>
      <!-- <title>Cosmic-ERP</title> -->
      <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>


    @if(str_contains(url('/'), '127.0.0.1'))
        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css')}}" />

        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}" />
        <!-- <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css')}}"> -->
        <link rel="icon" href="{{ asset('assets/img/Cosmiclogo.ico') }}"/>
        <!-- <link href="{{ asset('assets/css/chosen.min.css')}}"/> -->
        <!-- <link rel="stylesheet" href="{{ asset('assets/css/intltelinput.css')}}"/> -->
        <!-- <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css')}}"/> -->
        <!-- <script src="{{ asset('assets/js/intlTelInput.min.js') }}"></script> -->
        <!-- <script src="{{ asset('assets/js/jquery.2.1.1min.js') }}"></script> -->
        <!-- <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script> -->
        
      
      
    @else
       <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('public/assets/css/plugins.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('public/assets/css/kaiadmin.min.css')}}" />

        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="{{ asset('public/assets/css/demo.css')}}" />
        <link rel="stylesheet" href="{{ asset('public/assets/css/main.css')}}" />
        <!-- <link rel="stylesheet" href="{{ asset('public/assets/css/toastr.min.css')}}"> -->
        <link rel="icon" href="{{ asset('public/assets/img/Cosmiclogo.ico') }}"/>
        <!-- <link href="{{ asset('public/assets/css/chosen.min.css')}}"/> -->
        <!-- <link rel="stylesheet" href="{{ asset('public/assets/css/intltelinput.css')}}"/> -->
        <!-- <link rel="stylesheet" href="{{ asset('public/assets/css/font-awesome.css')}}"/> -->
        <!-- <script src="{{ asset('public/assets/js/intlTelInput.min.js') }}"></script> -->
        <!-- <script src="{{ asset('public/assets/js/jquery.2.1.1min.js') }}"></script> -->
        <!-- <script src="{{ asset('public/assets/js/chosen.jquery.min.js') }}"></script> -->
        
        
    @endif
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
        <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <head>
        <!-- Other head content -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

  </head>

        <style>
    input.error {
    border: 2px solid red;
},
.error-border {
        border: 2px solid red;
    }
    .switch {
  position: relative;
  display: inline-block;
  width: 40px; 
  height: 22px; 
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}


.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: .4s;
  border-radius: 22px; 
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px; 
  width: 16px; 
  left: 3px; 
  bottom: 3px; 
  background-color: white;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:checked + .slider:before {
  transform: translateX(18px); 
}

.slider.round {
  border-radius: 22px;
}

.slider.round:before {
  border-radius: 50%; 
}
.custom-radio {
    display: none;
}

.custom-radio + .form-check-label {
    position: relative;
    padding-left: 2em; 
    cursor: pointer;
}

.custom-radio + .form-check-label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 1.5em;
    height: 1.5em;
    border: 2px solid #6b4023;
    border-radius: 0.25em;
    background-color: transparent;
}

.custom-radio:checked + .form-check-label:before {
    background-color: #6b4023;
    border-color: #6b4023;
    content: '\2713'; 
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2em;
}

.btm-margin
{
  margin-left: 20px;
}

</style>
        
<body>
    <div class="wrapper">
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <div class="logo-header" data-background-color="dark">
            <a href="{{route('dashboard')}}" class="logo">
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
              
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more dropdown dropdown__open" >
            <li class="nav-item topbar-user dropdown hidden-caret dropdown__window">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false">
                    <div class="avatar-sm">
                      @if(Auth::check() && Auth::user()->user_photo)
                              <img alt="avatar" src="{{ asset(Auth::user()->profile) }}" style="width: 35px; height: 35px; border-radius: 20%;">
                            @else
                              <img alt="avatar" src="{{ asset('public/assets/img/profile.jpg') }}" style="width: 35px; height: 35px; border-radius: 20%;" class="rounded-circle">
                            @endif
                      <!-- <img
                        src="/assets/img/profile.jpg"
                        alt="..."
                        class="avatar-img rounded-circle"
                      /> -->
                    </div>
                    <span class="profile-username">
                      <span class="profile-username-name"> {{ Auth::user()->name ?? '' }}</span>
                      <span class="profile-username-arrow"><i class="fa-solid fa-angle-down"></i></span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <img
                              src="{{ asset('public/assets/img/profile.jpg') }}"
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
 
                            <!-- <a
                              href="javascript:void(0)"
                              class="btn btn-primary">View Profile
                            </a> -->
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
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none; ">
                            @csrf
                        </form>
                      </li>
                    </div>
                  </ul>
                </li>
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
                  @if(str_contains(url('/'), '127.0.0.1'))
                  <!-- <img
                    src="{{ asset('assets/img/kaiadmin/logo_light.svg')}}"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20"/> -->
                  @else
                  <!-- <img
                    src="{{ asset('public/assets/img/kaiadmin/logo_light.svg')}}"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20"/> -->
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
          
            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
              <div class="container-fluid">
              <div class="row">
                    <div class="page-heading">
                        <h5>@yield('navbarTitel')</h5>
                    </div>
                </div>
                <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                  </div>
                </nav>

              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                
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
                              <img alt="avatar" src="{{ asset('public/assets/img/profile.jpg') }}" style="width: 35px; height: 35px; border-radius: 20%;" class="rounded-circle">
 
                            @endif
                      <!-- <img
                        src="/assets/img/profile.jpg"
                        alt="..."
                        class="avatar-img rounded-circle"
                      /> -->
                    </div>
                    <span class="profile-username">
                      <span class="profile-username-name"> {{ Auth::user()->name ?? '' }}</span>
                      <span class="profile-username-arrow"><i class="fa-solid fa-angle-down"></i></span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <img
                              src="{{ asset('public/assets/img/profile.jpg') }}"
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
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none; ">
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
      @yield('modul')
      

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

    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
    <script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
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
<!-- <script type="text/javascript">
  $('#customerMenu').click( function(){
    console.log('hello');

  });
</script> -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#togglePassword').click(function() {
        var passwordField = $('#password');
        // console.log(passwordField);
        // var conPasswordField = $('#password_confirmation');
        var type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        // var type = conPasswordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        // conPasswordField.attr('type', type);

        // Toggle the eye icon
        $(this).toggleClass('fa-eye fa-eye-slash');
        // $(this).toggleClass('fa-eye fa-eye-slash');
    });
    $( '#togglePasswords').click( function() {
      var conPasswordField = $('#password_confirmation');
      var type = conPasswordField.attr('type') === 'password' ? 'text' : 'password';
      conPasswordField.attr('type', type);
        $(this).toggleClass('fa-eye fa-eye-slash');
      
      // console.log(conPasswordField);
    });
});
</script>
<script>
  
  $(document).ready(function() {
    let targetUrl = '';
    
    // Get the current or referrer URL
    // const currentOrReferrerUrl = document.referrer || window.location.pathname;
    // const currentOrReferrerUrl = document.referrer ? new URL(document.referrer).pathname : window.location.pathname;
    const currentOrReferrerUrl = window.location.pathname;
    // console.log(currentOrReferrerUrl);
    // Only attach the modal behavior if the current or referrer URL ends with `.create` or `.edit`
    if (currentOrReferrerUrl.endsWith('/create') || currentOrReferrerUrl.endsWith('/edit')) {
        // Attach click event to links with the class .confirm-leave-link
        $(document).on('click', '.confirm-leave-link', function(event) {
            event.preventDefault(); // Prevent immediate navigation
            
            // Store the URL from the clicked link
            targetUrl = $(this).attr('href');
            
            // Show the confirmation modal
            $('#leaveConfirmationModal').modal('show');
        });
        
        // Handle the "Leave" button click in the confirmation modal
        $('#confirmLeaveButton').off('click').on('click', function() {
            if (targetUrl) {
                window.location.href = targetUrl; // Redirect to the stored URL
            }
        });
    }
});

</script>

     
<div class="modal fade leavesite_modal" id="indexModul" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content leavesite-model-data">
            <div class="modal-header leavesite-model-header">
                <h5 class="modal-title leavesite-model-title" id="exampleModalLabel">Are you sure you want to leave?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="modal-para leavesite-model-para">You are about to leave the Page. Any unsaved changes will be lost.</p>
            </div>
            <div class="modal-footer leave-sites-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                      <button type="button" class="leavesite-model-btn" id="leaveButton">Leave</button>
                    </div>
                    <div class="button-1">
                      <button type="button" class="leavesite-model-btn" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade reload_modal" id="leaveConfirmationModal" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content reload-model-data">
            <div class="modal-header reload-model-header">
                <h5 class="modal-title reload-model-title" id="exampleModalLabel">Reload Site ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="modal-para reload-model-para">Changes you made may not be saved.</p>
            </div>
            <div class="modal-footer reload-sites-popup">
                <div class="btn-sec btn_group">
                    <div class="button-1">
                        <button type="button" class="reload-model-btn" id="confirmLeaveButton">Reload</button>
                    </div>
                    <div class="button-1">
                        <button type="button" class="reload-model-btn" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  </body>
</html>