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
                            <div class="card card-plain pb-0 text-start mt-2">
                                   <img src="{{asset('argon/img/GRCR_logo_login.png')}}" class="text-center rounded mx-auto d-block img-fluid" alt="main_logo"/>
                                <div class="card-header pb-0 text-start">
                              
                                    <h4 class="font-weight-bolder mt-2">Change Password</h4>
                                    <p class="mb-0">Fill below details to set your password</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" id="signupForm" action="{{route('griffin.postpassword')}}" autocomplete="off">
                                        @csrf
                                            
                                        <div class ="row">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                                <input type="email" name="email" id ="email"class="form-control" placeholder="Email" required  value="" aria-label="Email" style="border-right:1px solid #d2d6da !important;">
                                                @error('email') <p class="text-danger text-xs pt-1" > {{$message}} </p>@enderror
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                <input type="password" name="password" id="password" class="form-control" required placeholder="Password" aria-label="Password" style="border-right:1px solid #d2d6da !important;">
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
                                                <input type="password" required id="confirm-password" name="confirm-password" class="form-control" placeholder="Confirm-Password" aria-label="Password" style="border-right:1px solid #d2d6da !important;">
                                                @error('confirm-password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                            <div class="input-group mb-3 mt-1">
                                                <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                                <input type="text" name="code" class="form-control" placeholder="code" required aria-label="code" style="border-right: 1px solid #d2d6da !important;">
                                                @error('code') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" id ="submit" disabled class="changepass-submit-btn-two btn btn-lg btn-blue btn-lg w-100 mt-4 mb-0">Submit</button>
                                            </div>
                                        </div>    
                                    </form>
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
                                style="background-image: url({{$array[$random_keys]}});
              background-size: cover;">
                                <span class="mask opacity-6"></span>
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

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
 

<script>
    $(document).ready(function(e){
      
        $('#alert').fadeOut(5000); 
          
        $("#confirm-password").on('keyup',function (){

            var pass = $('#password').val();
      
            var confirmpass = $('#confirm-password').val();
            if($('.ctick').length ==5 && pass == confirmpass) {
                $('#submit').removeAttr('disabled',true);
            }else{
				
                $('#submit').attr('disabled',true);
         
            }
   
        });
       
    });
    

    $(document).on('keyup', '#password', function () {
        let password = $("#password").val();
        password_length = password.length;
        var confirmpass = $('#confirm-password').val();
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
          
            $('#submit').attr('disabled',true);
        }
    });

    $("#signupForm").submit(function(){
		let password = $("#password").val();
        password_length = password.length;
        var confirmpass = $('#confirm-password').val();
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
          
            $('#submit').attr('disabled',true);
			alert("Your password does'nt meet the requirements.")
			return false;
        }
	});
</script>
@endpush
