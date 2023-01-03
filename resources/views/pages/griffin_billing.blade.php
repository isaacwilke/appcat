@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Billing And Shipping Details'])
     
    
     <div class="container-fluid py-4 pt-4 my-4 mt-4">
      <div id="alert">
        @include('components.alert')
    </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Billing And Shipping Details</p>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <form role="form" id="Billing_form" method="POST" action="{{route('billing.stored')}}">
                            @csrf
                          
                            <p class="text-uppercase text-sm">User Information</p>
                            <input class="form-control" readonly type="hidden" name="auth_token" value="{{$result['token']}}">
                            <input class="form-control" readonly type="hidden" name="user_id" value="{{$billing['id']}}">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Username</label>
                                        <input class="form-control" readonly type="text" name="username" value="{{$billing['username']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email address</label>
                                        <input class="form-control" type="email" name="email" readonly value="{{$billing['email']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">First name</label>
                                        <input class="form-control" type="text" name="first_name" value="{{$billing['first_name']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Last name</label>
                                        <input class="form-control" type="text" name="last_name" value="{{$billing['last_name']}}">
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Billing Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">First name</label>
                                        <input class="form-control" type="text" name="billing_first_name" value="{{$billing['billing']['first_name']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Last name</label>
                                        <input class="form-control" type="text" name="billing_lastt_name"value="{{$billing['billing']['last_name']}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Company</label>
                                        <input class="form-control" type="text" name="billing_company" value="{{$billing['billing']['company']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Address1</label>
                                        <input class="form-control" type="text" name="billing_address1" value="{{$billing['billing']['address_1']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Address2</label>
                                        <input class="form-control" type="text"name="billing_address2" value="{{$billing['billing']['address_2']}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">City</label>
                                        <input class="form-control" type="text" name="billing_city" value="{{$billing['billing']['city']}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Country</label>
                                        <input class="form-control" type="text" name="billing_country" value="{{$billing['billing']['country']}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">State</label>
                                        <input class="form-control" type="text" name="billing_state" value="{{$billing['billing']['state']}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">postal code</label>
                                        <input class="form-control" type="text" name="billing_postcode" value="{{$billing['billing']['postcode']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email</label>
                                        @php $billingemail = !empty($billing['billing']['email'])?$billing['billing']['email']:$billing['email'];
                                        @endphp
                                        <input class="form-control" required type="email" name="billing_email" value={{$billingemail}}>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">phone</label>
                                        <input class="form-control" type="text" name="billing_phone" value="{{$billing['billing']['phone']}}">
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Shipping Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">First name</label>
                                        <input class="form-control" type="text" name="shipping_first_name" value="{{$billing['shipping']['first_name']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Last name</label>
                                        <input class="form-control" type="text" name="shipping_last_name" value="{{$billing['shipping']['last_name']}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Company</label>
                                        <input class="form-control" type="text" name="shipping_company"value="{{$billing['shipping']['company']}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Address1</label>
                                        <input class="form-control" type="text" name="shipping_address1" value="{{$billing['shipping']['address_1']}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Address2</label>
                                        <input class="form-control" type="text"  name="shipping_address2" value="{{$billing['shipping']['address_2']}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">phone</label>
                                        <input class="form-control" type="text"  name="shipping_phone" value="{{$billing['shipping']['phone']}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">City</label>
                                        <input class="form-control" type="text" name="shipping_city" value="{{$billing['shipping']['city']}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Country</label>
                                        <input class="form-control" type="text" name="shipping_country" value="{{$billing['shipping']['country']}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">State</label>
                                        <input class="form-control" type="text" name="shipping_state" value="{{$billing['shipping']['state']}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">postal code</label>
                                        <input class="form-control" type="text" name="shipping_postcode" value="{{$billing['shipping']['postcode']}}">
                                    </div>
                                </div>
                                
                             
                            </div>
                            <div class="row justify-center">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg mt-4 mb-0">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       
            <div class="col-md-4">
                <div class="card card-profile">
                    <img src="{{asset('argon/img/bruce-mars.jpg')}}" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-4 col-lg-4 order-lg-2">
                            <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                <a href="javascript:;">
                                   
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                        <div class="d-flex justify-content-between">
                            <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block"></a>
                            <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i
                                    class="ni ni-collection"></i></a>
                            <a href="javascript:;"
                                class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block"></a>
                            <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"><i
                                    class="ni ni-email-83"></i></a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    <div class="d-grid text-center">
                                        <span class="text-lg font-weight-bolder"></span>
                                        <span class="text-sm opacity-8"></span>
                                    </div>
                                    <div class="d-grid text-center mx-4">
                                        <span class="text-lg font-weight-bolder"></span>
                                        <span class="text-sm opacity-8"></span>
                                    </div>
                                    <div class="d-grid text-center">
                                        <span class="text-lg font-weight-bolder"></span>
                                        <span class="text-sm opacity-8"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <h5>
                               <span class="font-weight-bold"> {{$billing['username']}}</span>
                            </h5>
                            <div class="h6 font-weight-300">
                                <h5>
                               <span class="font-weight-bold"> {{$billing['email']}} </span>
                            </h5>
                            </div>
                            <div class="h6 mt-4">
                               <h5>
                               <span class="font-weight-bold"> {{$billing['role']}} </span>
                            </h5>
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
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

    <script>
        $(document).ready(function(){
            $('#alert').fadeOut(5000);
        });
    </script>
@endpush