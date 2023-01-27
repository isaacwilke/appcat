@extends('layouts.app')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
    <div id="alert">
        @include('components.alert')
    </div>
       
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
               
                    <div class="row">
                        <div class="col-xl-5 col-lg-6 col-md-8 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                 <img src="{{asset('argon/img/griffinlogo.png')}}" class="bg-warning h-50" alt="main_logo"/>
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Reset your password</h4>
                                    <p class="mb-0">Enter your email to Reset your Password</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{route('griffin.password')}}">
                                        @csrf
                                        @method('post')
                                        <div class="flex flex-col mb-3">
                                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" value="{{ old('email') }}" aria-label="Email">
                                            @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-blue btn-lg w-100 mt-4 mb-0">Send Reset Link</button>
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