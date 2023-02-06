@extends('layouts.app')

@section('content')
<style type="text/css">
.pass-checking-text {
    margin-top: 22px;
    font-size: 13px;
    font-weight: bold;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.4;
    letter-spacing: -0.3px;
    color: #2d2d2d;
    justify-content: center;
    display: flex;
}
.pass-checklist ul {
  list-style: none;
  padding: 0;
  margin: 0 0 0 6px;
  font-size: 13px;
  font-weight: 600;
  font-stretch: normal;
  font-style: normal;
  line-height: 1.4;
  letter-spacing: -0.3px;
  text-align: left;
  color: #6a707e;
}
.pass-checklist ul li{
  padding-bottom: 4px;
}

.pass-checklist ul li.ccross:before {
    font-family: "Font Awesome 5 Free";
    content: "\f00d";
    width: 16px;
    height: 16px;
    margin-right: 10px;
}
.pass-checklist ul li.ctick:before {
    font-family: "Font Awesome 5 Free";
    content: "\f00c";
    width: 16px;
    height: 16px;
    margin-right: 10px;
}
.pass-checklist ul li.ctick {
  font-weight: 600;
  font-stretch: normal;
  font-style: normal;
  line-height: 1.4;
  letter-spacing: -0.3px;
  text-align: left;
  color: #2ED47A;
}
.changepass-submit-btn-two:disabled {
  opacity: 0.4;
}
</style>
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
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain text-start pb-0 mt-2">
                                  <img src="{{asset('argon/img/W&S_logo_login.png')}}" class="text-center rounded mx-auto d-block img-fluid" alt="main_logo"/>
                                <div class="card-header pb-0 text-start mt-2">
                                    <h4 class="font-weight-bolder">Change password</h4>
                                    <p class="mb-0">Set a new password for your email</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{route('whisker.postpassword')}}">
                                        @csrf
                                         <div class ="row">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                                <input type="email" name="email" required class="form-control" placeholder="Email"  value="" aria-label="Email">
                                                @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                <input type="password" id ="password" name="password" class="form-control" placeholder="Password" aria-label="Password" >
                                                @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                              <p class="passwordhint">Password Requirements: </p>
                                                <div class="pass-checklist">
                                                    <ul>
                                                    <li class="condition-one ccross" id="character_length">Must contain at least 12 characters</li>
                                                    <li class="condition-one ccross" id="uppercase_latter">Must contain at least one uppercase letter</li>
                                                    <li class="condition-one ccross" id="lowercase_latter">Must contain at least one lowercase letter</li>
                                                    <li class="condition-one ccross" id="one_number">Must contain at least one number</li>
                                                    <li class="condition-one ccross" id="special_character">Must contain at least one special character</li>
                                                    </ul>
                                                </div>
                                            <div class="input-group mb-3 mt-1">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                <input type="password" required id="confirm-password" name="confirm-password" class="form-control form-control-lg" placeholder="Confirm-Password" aria-label="Password">
                                                @error('confirm-password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                                <input type="text" name="code" class="form-control" placeholder="code" aria-label="code">
                                                @error('code') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" id="submit" class="btn btn-lg btn-blue btn-lg w-100 mt-4 mb-0">Submit</button>
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
            $("#confirm-password").on('blur',function (){

               var pass = $('#password').val();
        
                var confirmpass = $('#confirm-password').val();
                if($('.ctick').length ==5 && pass == confirmpass) {
                    $('#submit').removeAttr('disabled',true);
                }else{
                    alert('password and confirm password not matched');
                    $('#submit').attr('disabled',true);
            
                }
   
            });
        });
        $(document).on('keyup', '#password', function () {
            let password = $("#password").val();
            var confirmpass = $('#confirm-password').val();
            password_length = password.length;
            if (password === '') {
                
                password_is_valid = false;
            

            }if(password.length==12){
                var password1 = true;
                
            }
            if(password.length < 12) {
                $("#character_length").removeClass('ctick').addClass('ccross');
                password_is_valid = false;
                
            } else {
                $("#character_length").removeClass('ccross').addClass('ctick');
                var character = true;
                
            }
            if (!password.match(/[A-Z]/)) {
                $("#uppercase_latter").removeClass('ctick').addClass('ccross');
                password_is_valid = false;
                
            } else {
                $("#uppercase_latter").removeClass('ccross').addClass('ctick');
                var uppercase = true;
                
            }
            if (!password.match(/[a-z]/)) {
                $("#lowercase_latter").removeClass('ctick').addClass('ccross');
                password_is_valid = false;
                
            } else {
                $("#lowercase_latter").removeClass('ccross').addClass('ctick');
                var lowercase= true;
                
            }
            if (!password.match(/[0-9]/)) {
                $("#one_number").removeClass('ctick').addClass('ccross');
                password_is_valid = false;
            
            } else {
                $("#one_number").removeClass('ccross').addClass('ctick');
                var number = true;
                
            }
            if (!password.match(/[!@#$%^&*]/)) {
                $("#special_character").removeClass('ctick').addClass('ccross');
                password_is_valid = false;
                
            } else {
                $("#special_character").removeClass('ccross').addClass('ctick');
                var special_character = true;

                
            }
            if(password != confirmpass) {
                alert('password and confirm password not matched');
                $('#submit').attr('disabled',true);
            }
        });
    </script>
@endpush