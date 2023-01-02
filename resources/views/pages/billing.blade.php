@extends('layouts.app', ['class' => 'g-sidenav-show bg-gary-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Billing And Shipping Details'])
    <style>
        .spinner{
           height:150px;
           width:150px; 
          
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
                            <p>Billing And Shipping Details</p>
                            
                        </div>
                    </div> 
                    <div class="card-body">   
                        <div class="col-12 text-center">
                            <div class="multisteps-form mb-5">
                        
                                <div class="row">
                                    <div class="col-12  mx-auto my-5">
                                        <div class="multisteps-form__progress">
                                            <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                                <span>User Information</span>
                                            </button>
                                            <button class="multisteps-form__progress-btn" type="button" title="Address">
                                                <span>Billing Infornation</span>
                                            </button>
                                            <button class="multisteps-form__progress-btn" type="button" title="Order Info">
                                                <span>Shipping Information</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <div class="col-12 m-auto">
                                        <form class="multisteps-form__form" id="Billing_form" method="POST" action="{{route('whisker.stored')}}">
                                        @csrf
                                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
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
                                            </div>
                                    
                                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                                                <div class="row text-center">
                                                    <div class="col-12 mx-auto">
                                                        <h5 class="font-weight-normal">What are you doing? (checkboxes)</h5>
                                                        <p>Give us more details about you. What do you enjoy doing in your spare time?</p>
                                                    </div>
                                                </div>
                                                <div class="multisteps-form__content">
                                                    <div class="row text-start">
                                                        <div class="col-4 col-md-4  mt-3">
                                                            <label>First Name</label>
                                                            <input class="multisteps-form__input form-control"type="text" name="billing_first_name" value="{{$billing['billing']['first_name']}}" placeholder="Eg. Argon" />
                                                        </div>
                                                        <div class="col-12 col-md-4  mt-3">
                                                            <label>Last Name</label>
                                                            <input class="multisteps-form__input form-control" type="text" name="billing_lastt_name"value="{{$billing['billing']['last_name']}}" placeholder="Eg. 221" />
                                                        </div>
                                                         <div class="col-12 col-md-4  mt-3">
                                                            <label>Company</label>
                                                            <input class="multisteps-form__input form-control" name="billing_company" value="{{$billing['billing']['company']}}" placeholder="Eg. 221" />
                                                        </div>
                                                        <div class="col-12 col-md-4 mt-3">
                                                            <label>Address 1</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="billing_address1" value="{{$billing['billing']['address_1']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                        <div class="col-12 col-md-4 mt-3">
                                                            <label>Address 2</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="billing_address2" value="{{$billing['billing']['address_2']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> City</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="billing_city" value="{{$billing['billing']['city']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> Country</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="billing_country" value="{{$billing['billing']['country']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> State</label>
                                                            <input class="multisteps-form__input form-control"   type="text" name="billing_state" value="{{$billing['billing']['state']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> Postal Code</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="billing_postcode" value="{{$billing['billing']['postcode']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-6 col-md-6 mt-3">
                                                            <label> Email</label>
                                                            @php $billingemail = !empty($billing['billing']['email'])?$billing['billing']['email']:$billing['email'];@endphp
                                                            <input class="multisteps-form__input form-control"  required type="email" name="billing_email" value={{$billingemail}} placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-6 col-md-6 mt-3">
                                                            <label> phone</label>
                                                            <input class="multisteps-form__input form-control" type="text" name="billing_phone" value="{{$billing['billing']['phone']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                    </div>
                                                    <div class="button-row d-flex mt-4">
                                                        <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
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
                                                    <div class="row text-start">
                                                        <div class="col-6 col-md-6  mt-3">
                                                            <label>First Name</label>
                                                            <input class="multisteps-form__input form-control"type="text" name="shipping_first_name" value="{{$billing['shipping']['first_name']}}" placeholder="Eg. Argon" />
                                                        </div>
                                                        <div class="col-6 col-md-6  mt-3">
                                                            <label>Last Name</label>
                                                            <input class="multisteps-form__input form-control" type="text" name="shipping_last_name" value="{{$billing['shipping']['last_name']}}" placeholder="Eg. 221" />
                                                        </div>
                                                         <div class="col-12 col-md-4  mt-3">
                                                            <label>Company</label>
                                                            <input class="multisteps-form__input form-control" type="text" name="shipping_company"value="{{$billing['shipping']['company']}}" placeholder="Eg. 221" />
                                                        </div>
                                                        <div class="col-12 col-md-4 mt-3">
                                                            <label>Address 1</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_address1" value="{{$billing['shipping']['address_1']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                        <div class="col-12 col-md-4 mt-3">
                                                            <label>Address 2</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_address2" value="{{$billing['shipping']['address_2']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> City</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_city" value="{{$billing['shipping']['city']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> Country</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_country" value="{{$billing['shipping']['country']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> State</label>
                                                            <input class="multisteps-form__input form-control"   type="text" name="billing_state" value="{{$billing['billing']['state']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-6 mt-3">
                                                            <label> Postal Code</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_postcode" value="{{$billing['shipping']['postcode']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         
                                                         <div class="col-12 col-md-6 mt-3">
                                                            <label> phone</label>
                                                            <input class="multisteps-form__input form-control" type="text"  name="shipping_phone" value="{{$billing['shipping']['phone']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="button-row d-flex mt-4 col-12">
                                                            <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                                                            <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Send">Submit</button>
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
        
         @include('layouts.footers.auth.footer')  

    </div>
@endsection
@push('js')
<script src="{{asset('argon/assets/js/plugins/multistep-form.js')}}" type="text/javascript"></script>
<script src="" type="text/javascript"></script>



    

@endpush
