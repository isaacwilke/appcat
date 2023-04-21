@extends('layouts.app')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
 
        <div class="row">
            <div class="col-12">
                @include('layouts.navbars.guest.navbar')
            </div>
              <div id="alert">
        @include('components.alert')
    </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain pb-0 text-start mt-2">
                               <img src="{{asset('argon/img/GRCR_logo_login.png')}}" class="text-center rounded mx-auto d-block img-fluid" alt="main_logo"/>
                                <div class="card-header pb-0 ">
                                
                             
                                    <h4 class="font-weight-bolder mt-2">Your IP is blocked due to security reasons. Please contact administrator for assistance.</h4>
                                </div>
                             </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            @php  $array = [
                                asset('argon/img/grcr_login_right1.jpg'),
                                asset('argon/img/grcr_login_right2.jpg'),
                                asset('argon/img/grcr_login_right3.jpg'),
                            ];
                            $random_keys=array_rand($array);                             
                            @endphp
                            <div class="position-relative  h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                               id="image" style="background-image: url({{$array[$random_keys]}});
              background-size: cover;">
                                <span class="mask  opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative"></h4>
                                <p class="text-white position-relative"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('js')
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

    <script>
	$( "#griifinloginform" ).submit(function( event ) {
	$("#btnlogin").empty();
	$("#btnlogin").append('<i class="fa fa-refresh fa-spin"></i> Processing');
	});


        $(document).ready(function(){
            $('#alert').fadeOut(5000);
            
        });
    </script>
@endpush