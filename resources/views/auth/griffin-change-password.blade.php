@extends('layouts.app')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                @include('layouts.navbars.guest.navbar')
            </div>
        </div>
        <div id="alert">
            @include('components.alert')
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                 <img src="{{asset('argon/img/griffinlogo.png')}}" class="bg-warning h-50" alt="main_logo"/>
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Change Password</h4>
                                    <p class="mb-0">Fill below details to set your password</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{route('griffin.postpassword')}}">
                                        @csrf
                                            
                                        <div class ="row">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                                <input type="email" name="email" class="form-control" placeholder="Email"  value="" aria-label="Email">
                                                @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" >
                                                @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                            {{-- <div class="flex flex-col mb-3">
                                                <input type="password" name="confirm-password" class="form-control form-control-lg" placeholder="Password" aria-label="Password"  >
                                                @error('confirm-password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div> --}}
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                                <input type="text" name="code" class="form-control" placeholder="code" aria-label="code">
                                                @error('code') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Submit</button>
                                            </div>
                                        </div>    
                                    </form>
                                </div>
                               
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
              background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new
                                    currency"</h4>
                                <p class="text-white position-relative">The more effortless the writing looks, the more
                                    effort the writer actually put into the process.</p>
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
        $(document).ready(function(){
            $('#alert').fadeOut(5000);
        });
    </script>
@endpush
