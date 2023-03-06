<aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 overflow-hidden  "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand  text-center m-0" target="_blank">
            @if (Session::has('one'))
                <img src="{{ asset('argon/img/cropped-ws_icon3-1-32x32.jpg') }}"
                    class="navbar-brand-img image-fluid rounded" alt="main_logo">

                @if (Session::has('existing_user'))
                    <form method="get" class="mt-1" role='form' action="{{ route('switch') }}" id="myForm">

                        <div class="form-check form-switch justify-content-center">
                            <input class="form-check-input " type="checkbox" id="flexSwitchCheckDefault"
                                onclick="document.getElementById('myForm').submit();" />
                            <label class="form-check-label" for="flexSwitchCheckDefault">Switch to Griffin</label>
                        </div>


                    </form>
                
                @endif
            @elseif(Session::has('two'))
                <img src="{{ asset('argon/img/cropped-grcr_icon-180x180.jpg') }}" class="navbar-brand-img navbar-brand-img h-100 rounded"
                    alt="main_logo">

                @if (Session::has('existing_user'))
                    <form method="get" class="mt-1" action="{{ route('switch.whisker') }}" id="myForm">
                        <div class="form-check form-switch justify-content-center">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                onclick="document.getElementById('myForm').submit();" />
                            <label class="form-check-label" for="flexSwitchCheckDefault">Switch to Whisker</label>

                        </div>

                    </form>
                
                @endif
            @endif
             
        </a>
       
    </div>
    <hr class="horizontal dark ">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main" style="height:auto">
   
        <ul class="navbar-nav">
            <li class="nav-item">

                <a class="nav-link {{ str_contains(request()->url(), 'dashboard') == true ? 'active' : '' }}"
                    href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2  text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            @if (Session::has('one'))
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'whisker-membership') == true ? 'active' : '' }}"
                        href="{{route('whisker.member')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bullet-list-67  text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Membership</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link "
                        href="{{route('whisker.memberlist')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bullet-list-67  text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">List Membership</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'user-management') == true ? 'active' : '' }}"
                        href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bag-17  text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Bookings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'billing') == true ? 'active' : '' }}"
                        href="{{ route('whisker-billing') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-credit-card  text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Billings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'whisker-transaction') == true ? 'active' : '' }}"
                        href="{{route('whisker.transaction')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58  text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Transactions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'profile') == true ? 'active' : '' }}"
                        href="{{ route('profile') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02  text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == '' ? 'active' : '' }}" href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-box-2  text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Help</span>
                    </a>
                </li>
            @endif
            @if (Session::has('two'))
                {{-- <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'user-management') == true ? 'active' : '' }}"
                        href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58  text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Reservations</span>
                    </a>
                </li> --}}

                {{-- <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'griffin-billing' ? 'active' : '' }}"
                        href="{{ route('griffin-billing') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-credit-card  text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Billings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'tables') == true ? 'active' : '' }}"
                        href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58  text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Transactions</span>
                    </a>
                </li> --}}
                  <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'griffin-webcam') == true ? 'active' : '' }}"
                        href="{{route('griffin.webcam')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-camera-compact  text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Webcam</span>
                    </a>
                </li> 

                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'profile') == true ? 'active' : '' }}"
                        href="{{ route('griffin-profile') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02  text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'griffin-contactus') == true ? 'active' : '' }}" href="{{route('griffin.contactus')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-box-2  text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Help</span>
                    </a>
                </li>
            @endif


        </ul>
    </div>
    {{-- <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-50 mx-auto" src="{{ asset('argon/img/illustrations/icon-documentation-warning.svg') }}"
                alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                    <h6 class="mb-0">Need help?</h6>
                    <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
                </div>
            </div>
        </div>
        <a href="#" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
        <a class="btn btn-primary btn-sm mb-0 w-100" href="#" target="_blank" type="button">Upgrade to
            PRO</a>
    </div> --}}
     <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
 
    <script>
        $(document).ready(function(){
            $('#site').click(function(){
                var site = $(this).attr('data-id');
                location.href = site;
            });
        });
    </script>
</aside>