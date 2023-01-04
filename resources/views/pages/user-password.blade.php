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
    @include('layouts.navbars.auth.topnav', ['title' => 'Change Password'])
     <div id="alert">
        @include('components.alert')
    </div>
    

  

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action="{{route('update-whisker-password')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Change Password</p>
                              
                            </div>
                        </div>
                       
                        <div class="card-body">
                            <p class="text-uppercase text-sm">User Information</p>
                            <div class="row">
                             
                             <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Password</label>
                                        @php $password = Session::get('user_credentials');@endphp
                                        <input class="form-control" type="password" id="password"  name="password"  value="{{$password["password"]}}">
                                    
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
                                </div></div>
                                <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Confirm Password</label>
                                       
                                        <input class="form-control" type="password" id ="confirm-password" name="confirm-password"  value="">
                                    
                                    </div></div></div> 
                                <div class="col-md-12 mt-2">
                                    <div class="form-group text-center">
                                       
                                        <button type="submit" id ="submit" disabled class="btn btn-primary text-uppercase btn-sm ms-auto">{{'Submit'}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        @include('layouts.footers.auth.footer')
    </div>
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