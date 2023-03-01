@extends('layouts.app',['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Update Profile'])
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
    <div class="container-fluid pt-4 mt-4">
      <div id="alert">
            @include('components.alert')
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <p>Update profile</p>
                            
                        </div>
                    </div> 
                    <div class="card-body">   
                        <div class="col-12 text-center">
                            <div class="multisteps-form mb-5">
                        
                                <div class="row">
                                    <div class="col-12  mx-auto my-5">
                                        <div class="multisteps-form__progress">
                                            {{-- <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                                <span>User Information</span>
                                            </button> --}}
                                            <button class="multisteps-form__progress-btn js-active" type="button" title="update profile">
                                                <span>Update Profile</span>
                                            </button>
                                            <button class="multisteps-form__progress-btn" type="button" title="Update Password">
                                                <span>Update Password</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <div class="col-12 m-auto">
                                        <form name="test" class="multisteps-form__form" id="update_profile" method="POST" >
                                            @csrf
                                            {{-- <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                                <div class="row text-center">
                                                    <div class="col-12 mx-auto">
                                                        <h5 class="font-weight-normal">Let's start with the basic information</h5>
                                                        <p></p>
                                                    </div>
                                                </div>
                                               <div class="multisteps-form__content">
                                                    <div class="row mt-3">
                                                        <div class="col-12 col-sm-4">
                                                            <div class="avatar avatar-xxl position-relative">
                                                                <img src="https://demos.creative-tim.com/test/soft-ui-dashboard-pro/assets/img/team-2.jpg" class="border-radius-md" />
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-7 mt-4 mt-sm-0 text-start">
                                                            <input class="form-control" readonly type="hidden" name="auth_token" value="{{$result['token']}}">
                                                            <input class="form-control" readonly type="hidden" name="user_id" value="{{$billing['id']}}">
                                                            <label> Username</label>
                                                            <input class="multisteps-form__input form-control mb-3" type="text" readonly  name="username" value="{{$billing['username']}}"placeholder="Eg. Michael" />
                                                            <label> Email</label>
                                                            <input class="multisteps-form__input form-control mb-3" type="email" name="email" readonly value="{{$billing['email']}}" placeholder="Eg. Michael" />
                                                             <label> Role</label>
                                                            <input class="multisteps-form__input form-control mb-3" type="text" name="role" readonly value="{{$billing['role']}}" placeholder="Eg. Michael" />
                                                            <label>First Name</label>
                                                            <input class="multisteps-form__input form-control mb-3" type="text" name="first_name" value="{{$billing['first_name']}}" placeholder="Eg. Michael" />
                                                            <label>Last Name</label>
                                                            <input class="multisteps-form__input form-control mb-3" type="text" name="last_name" value="{{$billing['last_name']}}" placeholder="Eg. Tomson" />
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="button-row d-flex mt-4">
                                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                                                    </div>
                                                </div>
                                            </div>  --}}
                                    
                                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                                <div class="row text-center">
                                                    <div class="col-12 mx-auto">
                                                        <h5 class="font-weight-normal"></p>
                                                    </div>
                                                </div>
                                                <div class="multisteps-form__content">
                                                    <div class="row text-start">
                                                       <input class="form-control" type="hidden" name="id"  value="{{$user['user']['id']}}">
                                                        <input class="form-control" type="hidden" name="auth_token"  value="{{$user['token']['token']}}">
                                                        <div class="col-12 col-md-6  mt-3">
                                                            <label>First Name</label>
                                                            <input class="multisteps-form__input form-control"type="text" name="firstname" value="{{$user['user']["first_name"]}}" />
                                                            @error('firstname') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                                        </div>
                                                        <div class="col-12 col-md-6  mt-3">
                                                            <label>Last Name</label>
                                                            <input class="multisteps-form__input form-control" type="text" name="lastname"value="{{ $user['user']["last_name"] }}" />
                                                              @error('lastname') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                                        </div>
                                                         <div class="col-12 col-md-6  mt-3">
                                                            <label>User Name</label>
                                                            <input class="multisteps-form__input form-control" readonly name="username" value="{{ $user['user']['username'] }}"  />
                                                        </div>
                                                        <div class="col-12 col-md-6 mt-3">
                                                            <label>Email Address</label>
                                                            <input class="multisteps-form__input form-control"  type="email" name="email" value="{{ $user['user']['email']}}"/>
                                                            @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                                        </div>
                                                        <div class="col-12 col-md-6 mt-3">
                                                            <label>Description</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="description" value="{{$user['user']["description"]}}"  />
                                                        </div>
                                                         <div class="col-12 col-md-6 mt-3">
                                                            <label> Role</label>
                                                            <input class="multisteps-form__input form-control" readonly  type="text" name="roles" value="{{$user['user']['roles']['0']}}"/>
                                                        </div>
                                                     
                                                    </div>
                                                    <div class="button-row text-center mt-4">
                                                     <button type="button" id="update-profile" data-id="{{route('update')}}" class="btn btn-blue text-uppercase btn-sm ms-auto">{{'update profile'}}</button>
                                                       {{-- <button class="btn btn-blue mb-0" type="submit" title="Send">Submit</button> --}}
                                                        {{-- <button class="btn bg-gradient-dark ms-auto mb-0" type="button" title="Next">Next</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                       
                                       
                                        
                                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                                                <div class="row text-center">
                                                    <div class="col-12 mx-auto">
                                                        <h5 class="font-weight-normal">Are you living in a nice area?</h5>
                                                        <p>One thing I love about the later sunsets is the chance to go for a walk through the neighborhood woods before dinner</p>
                                                    </div>
                                                </div>
                                                <div class="multisteps-form__content">
                                                    <div class="row mt-3">
                                                        <div class="col-12 col-sm-4">
                                                            <div class="avatar avatar-xxl position-relative">
                                                                <img src="https://demos.creative-tim.com/test/soft-ui-dashboard-pro/assets/img/team-2.jpg" class="border-radius-md" />
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-7 mt-4 mt-sm-0 text-start">
                                                            
                                                            <label> Password</label>
                                                              @php $password = Session::get('user_credentials');@endphp
                                                            <input class="multisteps-form__input form-control mb-3" type="password" id='password' name="password" value="{{$password["password"]}}"/>
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
                                                            <label> Confirm Password</label>
                                                            <input class="multisteps-form__input form-control mb-3" type="password" id ="confirm-password" name="confirm-password"  value="" />
                                                             
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="button-row  mt-4 col-12">
                                                            
                                                            <button class="btn btn-blue ms-auto mb-0" disabled id='update_password' data-id ='{{route("update-whisker-password")}}' type="button" title="Send">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       </form>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>  
        
        

    </div>
  

    
     @include('layouts.footers.auth.footer')
@endsection
@push('js')
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="{{asset('argon/assets/js/plugins/multistep-form.js')}}" type="text/javascript"></script>

    <script>
        $(document).ready(function(){
            $('#alert').fadeOut(5000);
            $('#update_password').click(function(){
                var action = $(this).attr('data-id');
                alert(action);
                $('form[name=test]').attr('action',action);
                $('form[name=test]').submit();
            });

            $('#update-profile').click(function(){
                var action = $(this).attr('data-id');
               
                $('form[name=test]').attr('action',action);
                $('form[name=test]').submit();
            });
            $("#confirm-password").on('blur',function (){

               var pass = $('#password').val();
       
                var confirmpass = $('#confirm-password').val();
                if($('.ctick').length ==5 && pass == confirmpass) {
                    $('#update_password').removeAttr('disabled',true);
                }else{
                
                    $('#update_password').attr('disabled',true);
                
                }
   
            });
        });

        $(document).on('keyup , blur', '#password', function () {
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
                
                $('#update_password').attr('disabled',true);
            }else{
                $('#update_password').removeAttr('disabled',true);
            }

   
        });
       
        
    </script>
@endpush