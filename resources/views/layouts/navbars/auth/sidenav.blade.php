<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#"
            target="_blank">
            @if(Session::has('one'))
                <img src="{{asset('argon/img/whiskerlogo.png')}}" class="navbar-brand-img h-100" alt="main_logo">
                
            @elseif(Session::has('two'))
                <img src="{{asset('argon/img/griffinlogo.png')}}" class="navbar-brand-img h-100 bg-success" alt="main_logo">
               
            @endif
        </a>
    </div>
    <hr class="horizontal dark mt-5">
    
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @if(Session::has("one"))
                @if(Session::has('existing_user'))
            
                    <li class="nav-item">
                        <form method="get"  class="nav-link" action="{{route('switch')}}" id="myForm">
                            <div class="icon icon-shape icon-sm  text-center d-flex align-items-center justify-content-center">
                            <label class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="checkbox" value="dark"  onclick="document.getElementById('myForm').submit();"> 
                                </label>
                            </div>
                                <span class="nav-link-text ms-1">Switch to Griffin</span>
                        </form>
                            
                    </li>
                @else
                    <li class="nav-item">
                    <a class="nav-link" href="https://griffinrockcatretreat.com/">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Griffin Rock CAT Retreat</span>
                    </a>
                       
                        
                    </li>
                  
                @endif
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'whisker-billing' ? 'active' : '' }}" href="{{route('whisker-billing')}}">
                        <div
                            class="icon border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni-2x ni ni-credit-card  text-dark  opacity-10"></i>
                        </div>
                        <span class="nav-link-text text-xl ms-2">Billing And Shipping Details</span>
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'whisker.order' ? 'active' : '' }}" href="{{route('whisker.order')}}">
                        <div
                            class="icon border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni-2x ni ni-bag-17  text-dark  opacity-10"></i>
                        </div>
                        <span class="nav-link-text text-xl ms-2">Order Details</span>
                    </a>
                </li>
                {{-- <li class="nav-item mt-3 d-flex align-items-center">
                    <div class="ps-4">
                        <i class="fab fa-laravel" style="color: #f4645f;"></i>
                    </div>
                    <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Laravel Examples</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}" href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'user-management') == true ? 'active' : '' }}" href="#">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">User Management</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pages</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'tables') == true ? 'active' : '' }}" href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Tables</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{  str_contains(request()->url(), 'billing') == true ? 'active' : '' }}" href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Billing</span>
                    </a>
                </li> --}}
            @endif 
            @if(Session::has('two'))
                @if(Session::has('existing_user'))
            
                    <li class="nav-item">
                        <form method="get" class="nav-link" action="{{ route('switch.whisker')}}" id="myForm">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <label class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="checkbox" value="dark"  onclick="document.getElementById('myForm').submit();"> 
                                </label>
                            </div>
                                <span class="nav-link-text ms-1">Switch to Whisker</span>
                        </form>
                            
                    </li>
                @else
                  <li class="nav-item">
                    <a class="nav-link" href="https://whiskersandsoda.com/">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">whisker and soda</span>
                    </a>
                       
                        
                    </li>
                @endif
                   <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'griffin-billing' ? 'active' : '' }}" href="{{route('griffin-billing')}}">
                        <div
                            class="icon border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni-2x ni ni-credit-card  text-dark  opacity-10"></i>
                        </div>
                        <span class="nav-link-text text-xl ms-2">Billing And Shipping Details</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'griffin.order' ? 'active' : '' }}" href="{{route('griffin.order')}}">
                        <div class="icon border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni-2x ni ni-bag-17  text-dark  opacity-10"></i>
                        </div>
                        <span class="nav-link-text text-xl ms-2">Order Details</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'virtual-reality' ? 'active' : '' }}" href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Virtual Reality</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'rtl' ? 'active' : '' }}" href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">RTL</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'profile-static' ? 'active' : '' }}" href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Sign In</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-collection text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Sign Up</span>
                    </a>
                </li> --}}
            @endif
        </ul>
    
    {{-- @if(Session::has('one'))
    <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-50 mx-auto" src="{{asset('argon/img/whiskerlogo.png')}}"
                alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                   <form method="get" class=" dropdown-item" action="{{route('switch')}}" id="myForm">
                        <label class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="checkbox" value="dark"  onclick="document.getElementById('myForm').submit();"> 
                            Griffin</label>
                    </form>
                   
                </div>
            </div>
        </div>
        
    </div>
    @elseif(Session::has('two'))
    <div class="sidenav-footer mx-3  bg-success">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-50 mx-auto" src="{{asset('argon/img/griffinlogo.png')}}"
                alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                  <form method="get" class="dropdown-item " action="{{ route('switch.whisker')}}" id="myForm">
                        <label class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="checkbox" value="dark"  onclick="document.getElementById('myForm').submit();"> 
                            Whisker</label>
                    </form>
                   
                </div>
            </div>
        </div>
        
    </div>
    @endif --}}
</aside>
