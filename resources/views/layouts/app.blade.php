<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('argon/img/apple-icon.png')}}">
      @if(Session::has('one') ||  str_contains(request()->url(), 'whisker')==true )
        <link rel="icon" type="image/png" href="{{asset('argon/img/cropped-ws_icon3-1-32x32.jpg')}}">
    @elseif(Session::has('two')||  str_contains(request()->url(), 'griffin')==true)
        <link rel="icon" type="image/png" href="{{asset('argon/img/cropped-grcr_icon-32x32.jpg')}}">
    @endif
    <title>
        {{-- Argon Dashboard 2 by Creative Tim --}}
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('argon/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{asset('argon/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{asset('argon/assets/css/argon-dashboard.css')}}" rel="stylesheet" />
</head>

<body class="{{ $class ?? '' }}">
    @if(!(Session::has('user')|| Session::has('griffin_user')))
        @yield('content')
    @endif

       @if(Session::has('user')|| Session::has('griffin_user'))
        @if (in_array(request()->route()->getName(), ['sign-in-static', 'sign-up-static', 'login', 'register', 'recover-password', 'rtl', 'virtual-reality']))
            @yield('content')
        @else
            @if (!in_array(request()->route()->getName(), ['profile-static']))
                <div class="min-height-300 bg-primary position-absolute w-100"></div>
            @elseif (in_array(request()->route()->getName(), ['dashboard','profile-static']))
                <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
                    <span class="mask bg-primary opacity-6"></span>
                </div>
            @endif
            @include('layouts.navbars.auth.sidenav')
                <main class="main-content border-radius-lg">
                    @yield('content')
                </main>
            @include('components.fixed-plugin')
        @endif
   @endif

  {{-- @if(!(Session::has('user')|| Session::has('griffin_user')))
        @yield('content')
    @endif

    @if(Session::has('user')|| Session::has('griffin_user'))
     
            @include('layouts.navbars.auth.sidenav')
                <main class="main-content">
                <div class="min-height-200 position-absolute  w-100 bg-primary"></div>
                    @yield('content')
            
                 @include('components.fixed-plugin')
                </main>
          
       
    @endif --}}

    <!--   Core JS Files   -->
  
    <script src="{{asset('argon/assets/js/core/popper.min.js')}}"></script>
        
    <script src="{{asset('argon/assets/js/core/bootstrap.min.js')}}"></script>
    
    <script src="{{asset('argon/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    
    <script src="{{asset('argon/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script src="{{asset('argon/assets/js/argon-dashboard.js') }}"></script>
    <script src="{{asset('argon/assets/js/custom.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
   
    @stack('js');
</body>

</html>
