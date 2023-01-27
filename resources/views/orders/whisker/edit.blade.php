@extends('layouts.app', ['class' => 'g-sidenav-show bg-gary-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Order Details'])
    <style>
        
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
                            <p>{{__('Edit Order Details')}}</p>
                            
                        </div>
                    </div> 
                    <div class="card-body">   
                        <div class="col-12 text-center">
                            <div class="multisteps-form mb-5">
                        
                                <div class="row">
                                    <div class="col-12  mx-auto my-5">
                                        <div class="multisteps-form__progress">
                                            <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                                <span>Order Information</span>
                                            </button>
                                            <button class="multisteps-form__progress-btn" type="button" title="Address">
                                                <span>Billing Infornation</span>
                                            </button>
                                            <button class="multisteps-form__progress-btn" type="button" title="Order Info">
                                                <span>Shipping Information</span>
                                            </button>
                                           
                                            <button class="multisteps-form__progress-btn" type="button" title="Order Info">
                                                <span>shipping_Tax</span>
                                            </button>
                                         
                                            
                                            <button class="multisteps-form__progress-btn" type="button" title="Order Info">
                                                <span>fee_Tax</span>
                                            </button>
                                          
                                            {{-- <button class="multisteps-form__progress-btn" type="button" title="Order Info">
                                                <span>Shipping Information</span>
                                            </button>
                                            <button class="multisteps-form__progress-btn" type="button" title="Order Info">
                                                <span>Shipping Information</span>
                                            </button> --}}
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <div class="col-12 m-auto">
                                        <form class="multisteps-form__form" id="Billing_form" method="POST" action="{{route('whisker.orderstore')}}">
                                        @csrf
                                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                                <div class="row text-center">
                                                    <div class="col-12 mx-auto">
                                                        <h5 class="font-weight-normal">Let's start with the Order Infirmation</h5>
                                                        <p></p>
                                                    </div>
                                                </div>
                                                <div class="multisteps-form__content">
                                                    <div class="row text-start">
                                                        <div class="col-4 col-md-4  mt-3">
                                                        <input class="multisteps-form__input form-control"type="hidden" name="order_id" value="{{$order['id']}}" placeholder="Eg. Argon" />
                                                        <input class="multisteps-form__input form-control"type="hidden" name="token" value="{{$token['token']}}" placeholder="Eg. Argon" />
                                                            <label>transaction_id</label>
                                                            <input class="multisteps-form__input form-control"type="text" name="transaction_id" value="{{$order['transaction_id']}}" placeholder="Eg. Argon" />
                                                        </div>
                                                        <div class="col-12 col-md-4  mt-3">
                                                            <label>payment_method</label>
                                                            <input class="multisteps-form__input form-control" type="text" name="payment_method"value="{{$order['payment_method']}}" placeholder="Eg. 221" />
                                                        </div>
                                                         <div class="col-12 col-md-4  mt-3">
                                                            <label>order_key</label>
                                                            <input class="multisteps-form__input form-control" readonly name="order_key" value="{{$order['order_key']}}" placeholder="Eg. 221" />
                                                        </div>
                                                        <div class="col-12 col-md-4 mt-3">
                                                            <label> discount_total</label>
                                                            <input class="multisteps-form__input form-control" readonly type="text" name="discount_total" value="{{$order['discount_total']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                        <div class="col-12 col-md-4 mt-3">
                                                            <label>discount_tax</label>
                                                            <input class="multisteps-form__input form-control"  readonly type="text" name="discount_tax" value="{{$order['discount_tax']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> shipping_total</label>
                                                            <input class="multisteps-form__input form-control"  readonly type="text" name="shipping_total" value="{{$order['shipping_total']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label>shipping_tax</label>
                                                            <input class="multisteps-form__input form-control" readonly type="text" name="shipping_tax" value="{{$order['shipping_tax']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> cart_tax</label>
                                                            <input class="multisteps-form__input form-control" readonly  type="text" name="cart_tax" value="{{$order['cart_tax']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> total</label>
                                                            <input class="multisteps-form__input form-control" readonly type="text" name="total" value="{{$order['total']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-6 col-md-6 mt-3">
                                                            <label> total_tax</label>
                                                            {{-- @php $billingemail = !empty($billing['billing']['email'])?$billing['billing']['email']:$billing['email'];@endphp --}}
                                                            <input class="multisteps-form__input form-control" readonly  type="text" name="total_tax" value="{{$order['total_tax']}}"placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-6 col-md-6 mt-3">
                                                            <label> status</label>
                                                            <input class="multisteps-form__input form-control" type="text" name="status" value="{{$order['status']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                           <div class="col-12 col-md-4 mt-3">
                                                            <label>currency</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="currency" value="{{$order['currency']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         {{-- <div class="col-12 col-md-4 mt-3">
                                                            <label> date_completed</label>
                                                            <input class="multisteps-form__input form-control"   type="datetime-local" name="date_completed" value="{{$order['date_completed']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> date_paid</label>
                                                            <input class="multisteps-form__input form-control"  type="datetime-local" name="date_paid" value="{{$order['date_paid']}}" placeholder="Eg. Tokyo" />
                                                        </div> --}}
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
                                                            <input class="multisteps-form__input form-control"type="text" name="billing_first_name" value="{{$order['billing']['first_name']}}" placeholder="Eg. Argon" />
                                                        </div>
                                                        <div class="col-12 col-md-4  mt-3">
                                                            <label>Last Name</label>
                                                            <input class="multisteps-form__input form-control" type="text" name="billing_lastt_name"value="{{$order['billing']['last_name']}}" placeholder="Eg. 221" />
                                                        </div>
                                                         <div class="col-12 col-md-4  mt-3">
                                                            <label>Company</label>
                                                            <input class="multisteps-form__input form-control" name="billing_company" value="{{$order['billing']['company']}}" placeholder="Eg. 221" />
                                                        </div>
                                                        <div class="col-12 col-md-4 mt-3">
                                                            <label>Address 1</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="billing_address1" value="{{$order['billing']['address_1']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                        <div class="col-12 col-md-4 mt-3">
                                                            <label>Address 2</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="billing_address2" value="{{$order['billing']['address_2']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> City</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="billing_city" value="{{$order['billing']['city']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> Country</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="billing_country" value="{{$order['billing']['country']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> State</label>
                                                            <input class="multisteps-form__input form-control"   type="text" name="billing_state" value="{{$order['billing']['state']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> Postal Code</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="billing_postcode" value="{{$order['billing']['postcode']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-6 col-md-6 mt-3">
                                                            <label> Email</label>
                                                            {{-- @php $billingemail = !empty($billing['billing']['email'])?$billing['billing']['email']:$billing['email'];@endphp --}}
                                                            <input class="multisteps-form__input form-control"  required type="email" name="billing_email" value="{{$order['billing']['email']}}"placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-6 col-md-6 mt-3">
                                                            <label> phone</label>
                                                            <input class="multisteps-form__input form-control" type="text" name="billing_phone" value="{{$order['billing']['phone']}}" placeholder="Eg. Tokyo" />
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
                                                            <input class="multisteps-form__input form-control"type="text" name="shipping_first_name" value="{{$order['shipping']['first_name']}}" placeholder="Eg. Argon" />
                                                        </div>
                                                        <div class="col-6 col-md-6  mt-3">
                                                            <label>Last Name</label>
                                                            <input class="multisteps-form__input form-control" type="text" name="shipping_last_name" value="{{$order['shipping']['last_name']}}" placeholder="Eg. 221" />
                                                        </div>
                                                         <div class="col-12 col-md-4  mt-3">
                                                            <label>Company</label>
                                                            <input class="multisteps-form__input form-control" type="text" name="shipping_company"value="{{$order['shipping']['company']}}" placeholder="Eg. 221" />
                                                        </div>
                                                        <div class="col-12 col-md-4 mt-3">
                                                            <label>Address 1</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_address1" value="{{$order['shipping']['address_1']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                        <div class="col-12 col-md-4 mt-3">
                                                            <label>Address 2</label>
                                                            
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_address2" value=""{{$order['shipping']['address_2']}} placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> City</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_city" value="{{$order['shipping']['city']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> Country</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_country" value="{{$order['shipping']['country']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> State</label>
                                                            <input class="multisteps-form__input form-control"   type="text" name="shipping_state" value="{{$order['shipping']['state']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-6 mt-3">
                                                            <label> Postal Code</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_postcode" value="{{$order['shipping']['postcode']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         
                                                         <div class="col-12 col-md-6 mt-3">
                                                            <label> phone</label>
                                                            <input class="multisteps-form__input form-control" type="text"  name="shipping_phone" value="{{$order['shipping']['phone']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="button-row d-flex mt-4 col-12">
                                                            <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                                                          
                                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                                                            
                                                        </div>
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
                                                      @if(empty($order['shipping_lines']))
                                                    <div class="row text-start">
                                                         <div class="col-6 col-md-6  mt-3">
                                                            <label>id</label>
                                                             
                                                             <input class="multisteps-form__input form-control" type="text" readonly name="shipping_lines_id[]" value="" placeholder="Eg. 221" />
                                                       
                                                        </div>
                                                        <div class="col-6 col-md-6  mt-3">
                                                            <label>Method title</label>
                                                             
                                                             <input class="multisteps-form__input form-control" type="text" name="shipping_lines_method_title[]" value="" placeholder="Eg. 221" />
                                                       
                                                        </div>
                                                         <div class="col-12 col-md-6  mt-3">
                                                            <label>method_id</label>
                                                          
                                                            <input class="multisteps-form__input form-control" type="text" name="shipping_lines_method_id[]" required value="" placeholder="Eg. 221" />

                                                           
                                                        </div>
                                                        <div class="col-12 col-md-6 mt-3">
                                                            <label> instance_id</label>
                                                           
                                                             <input class="multisteps-form__input form-control"  type="text" name="shipping_lines_instance_id[]" value="" placeholder="Eg. Tokyo" />
                                                            
                                                        </div>
                                                        <div class="col-12 col-md-6 mt-3">
                                                            <label>total</label>
                                                           
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_lines_total[]" value="" placeholder="Eg. Tokyo" />  
                                                            
                                                            
                                                        </div>
                                                         <div class="col-12 col-md-6 mt-3">
                                                            <label> Total Tax</label>
                                                            
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_lines_total_tax[]" value="" placeholder="Eg. Tokyo" />
                                                         
                                                        </div>
                                                       
                                                    </div>
                                                    @else
                                                    @foreach ($order['shipping_lines'] as $shipping)
                                                    
                                                       <div class="row text-start">
                                                         <div class="col-6 col-md-6  mt-3">
                                                            <label>id</label>
                                                             
                                                             <input class="multisteps-form__input form-control" type="text" readonly name="shipping_lines_id[]" value="{{$shipping['id']}}" placeholder="Eg. 221" />
                                                       
                                                        </div>
                                                        <div class="col-6 col-md-6  mt-3">
                                                            <label>Method title</label>
                                                             
                                                             <input class="multisteps-form__input form-control" type="text" name="shipping_lines_method_title[]" value="{{$shipping['method_title']}}" placeholder="Eg. 221" />
                                                       
                                                        </div>
                                                         <div class="col-12 col-md-6  mt-3">
                                                            <label>method_id</label>
                                                          
                                                            <input class="multisteps-form__input form-control" type="text" name="shipping_lines_method_id[]" required value="{{$shipping['method_id']}}" placeholder="Eg. 221" />

                                                           
                                                        </div>
                                                        <div class="col-12 col-md-6 mt-3">
                                                            <label> instance_id</label>
                                                           
                                                             <input class="multisteps-form__input form-control"  type="text" name="shipping_lines_instance_id[]" value="{{$shipping['instance_id']}}" placeholder="Eg. Tokyo" />
                                                            
                                                        </div>
                                                        <div class="col-12 col-md-6 mt-3">
                                                            <label>total</label>
                                                           
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_lines_total[]" value="{{$shipping['total']}}" placeholder="Eg. Tokyo" />  
                                                            
                                                            
                                                        </div>
                                                         <div class="col-12 col-md-6 mt-3">
                                                            <label> Total Tax</label>
                                                            
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_lines_total_tax[]" value="{{$shipping['total_tax']}}" placeholder="Eg. Tokyo" />
                                                         
                                                        </div>
                                                       
                                                    </div> 
                                                    <hr/>
                                                    @endforeach
                                                    @endif
                                                    <div class="row">
                                                        <div class="button-row d-flex mt-4 col-12">
                                                            <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                                                           
                                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- {{dd($order)}} --}}
                                        
                                            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                                                <div class="row text-center">
                                                    <div class="col-12 mx-auto">
                                                        <h5 class="font-weight-normal">Are you living in a nice area?</h5>
                                                        <p>One thing I love about the later sunsets is the chance to go for a walk through the neighborhood woods before dinner</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="multisteps-form__content">
                                                @php $feeline = sizeof($order['fee_lines']);
                                                 @endphp
                                                @if(empty($order['fee_lines']))
                                                
                                                    <div class="row text-start">
                                                        <div class="col-6 col-md-6  mt-3">
                                                        
                                                            <label> id</label>
                                                            
                                                            <input class="multisteps-form__input form-control" type="text" readonly name="fees_line_id[]" value="" placeholder="Eg. 221" />
                                                            
                                                           
                                                        </div>
                                                        <div class="col-6 col-md-6  mt-3">

                                                            <label> Name</label>
                                                            
                                                          
                                                            <input class="multisteps-form__input form-control" type="text" required name="fees_line_name[]" value="" placeholder="Eg. 221" />
                                                            
                                                            
                                                        </div>
                                                         <div class="col-12 col-md-6  mt-3">
                                                            <label>tax_class</label>
                                                           
                                                            <input class="multisteps-form__input form-control" type="text" name="fees_line_tax_class[]"value="" placeholder="Eg. 221" />
                                                            
                                                        </div>
                                                        <div class="col-12 col-md-6 mt-3">
                                                            <label> tax_status</label>
                                                           
                                                            <input class="multisteps-form__input form-control"  type="text" required name="fees_line_tax_status[]" value="{{'taxable'}}" placeholder="Eg. Tokyo" />

                                                          
                                                        </div>
                                                        <div class="col-12 col-md-6 mt-3">
                                                            <label>amount</label>
                                                            
                                                            <input class="multisteps-form__input form-control"  type="text" required name="fees_line_amount[]" value="" placeholder="Eg. Tokyo" />

                                                            
                                                        </div>
                                                         <div class="col-12 col-md-6 mt-3">
                                                            <label> total</label>
                                                          
                                                            <input class="multisteps-form__input form-control" required type="text" name="fees_line_total[]" value="" placeholder="Eg. Tokyo" />

                                                            
                                                        </div>
                                                         <div class="col-12 col-md-6 mt-3">
                                                            <label> total_tax</label>
                                                           
                                                            <input class="multisteps-form__input form-control"  required type="text" name="fees_line_total_tax[]" value="" placeholder="Eg. Tokyo" />

                                                            
                                                        </div>
                                                        
                                                    </div>
                                                
                                                     @else
                                                        @foreach ($order['fee_lines'] as $fees)
                                                           <div class="row text-start">
                                                               <div class="col-6 col-md-6  mt-3">
                                                        
                                                            <label> id</label>
                                                           
                                                            <input class="multisteps-form__input form-control" type="text" readonly name="fees_line_id[]" value="{{$fees['id']}}" placeholder="Eg. 221" />
                                                           
                                                        </div>
                                                        <div class="col-6 col-md-6  mt-3">
                                                            <label> Name</label>
                                                            
                                                            <input class="multisteps-form__input form-control" type="text" required name="fees_line_name[]" value="{{$fees['name']}}" placeholder="Eg. 221" />
                                                            
                                                        </div>
                                                         <div class="col-12 col-md-6  mt-3">
                                                            <label>tax_class</label>
                                                           
                                                            <input class="multisteps-form__input form-control" type="text" name="fees_line_tax_class[]"value="{{$fees['tax_class']}}" placeholder="Eg. 221" />
                                                          
                                                        </div>
                                                        <div class="col-12 col-md-6 mt-3">
                                                            <label> tax_status</label>
                                                          
                                                            <input class="multisteps-form__input form-control"  type="text" required name="fees_line_tax_status[]" value="{{$fees['tax_status']}}" placeholder="Eg. Tokyo" />
                                                            
                                                        </div>
                                                        <div class="col-12 col-md-6 mt-3">
                                                            <label>amount</label>
                                                            
                                                            <input class="multisteps-form__input form-control"  type="text" required name="fees_line_amount[]" value="{{$fees['amount']}}" placeholder="Eg. Tokyo" />
                                                           
                                                        </div>
                                                         <div class="col-12 col-md-6 mt-3">
                                                            <label> total</label>
                                                           
                                                            <input class="multisteps-form__input form-control" required type="text" name="fees_line_total[]" value="{{$fees['total']}}" placeholder="Eg. Tokyo" />
                                                           
                                                        </div>
                                                         <div class="col-12 col-md-6 mt-3">
                                                            <label> total_tax</label>
                                                          
                                                            <input class="multisteps-form__input form-control" required type="text" name="fees_line_total_tax[]" value="{{$fees['total_tax']}}" placeholder="Eg. Tokyo" />
                                                          
                                                        </div>
                                                       
                                                    </div> 
                                                     <hr> 
                                                        @endforeach
                                                    @endif
                                                    <div class="row">
                                                        <div class="button-row d-flex mt-4 col-12">
                                                            <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                                                           <button class="btn btn-blue ms-auto mb-0" type="submit" title="Send">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       
                                            {{-- <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
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
                                                            <input class="multisteps-form__input form-control"type="text" name="shipping_first_name" value="{{$order['shipping']['first_name']}}" placeholder="Eg. Argon" />
                                                        </div>
                                                        <div class="col-6 col-md-6  mt-3">
                                                            <label>Last Name</label>
                                                            <input class="multisteps-form__input form-control" type="text" name="shipping_last_name" value="{{$order['shipping']['last_name']}}" placeholder="Eg. 221" />
                                                        </div>
                                                         <div class="col-12 col-md-4  mt-3">
                                                            <label>Company</label>
                                                            <input class="multisteps-form__input form-control" type="text" name="shipping_company"value="{{$order['shipping']['company']}}" placeholder="Eg. 221" />
                                                        </div>
                                                        <div class="col-12 col-md-4 mt-3">
                                                            <label>Address 1</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_address1" value="{{$order['shipping']['address_1']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                        <div class="col-12 col-md-4 mt-3">
                                                            <label>Address 2</label>
                                                            
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_address2" value=""{{$order['shipping']['address_2']}} placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> City</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_city" value="{{$order['shipping']['city']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> Country</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_country" value="{{$order['shipping']['country']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> State</label>
                                                            <input class="multisteps-form__input form-control"   type="text" name="shipping_state" value="{{$order['shipping']['state']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-6 mt-3">
                                                            <label> Postal Code</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_postcode" value="{{$order['shipping']['postcode']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         
                                                         <div class="col-12 col-md-6 mt-3">
                                                            <label> phone</label>
                                                            <input class="multisteps-form__input form-control" type="text"  name="shipping_phone" value="{{$order['shipping']['phone']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="button-row d-flex mt-4 col-12">
                                                            <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
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
                                                            <input class="multisteps-form__input form-control"type="text" name="shipping_first_name" value="{{$order['shipping']['first_name']}}" placeholder="Eg. Argon" />
                                                        </div>
                                                        <div class="col-6 col-md-6  mt-3">
                                                            <label>Last Name</label>
                                                            <input class="multisteps-form__input form-control" type="text" name="shipping_last_name" value="{{$order['shipping']['last_name']}}" placeholder="Eg. 221" />
                                                        </div>
                                                         <div class="col-12 col-md-4  mt-3">
                                                            <label>Company</label>
                                                            <input class="multisteps-form__input form-control" type="text" name="shipping_company"value="{{$order['shipping']['company']}}" placeholder="Eg. 221" />
                                                        </div>
                                                        <div class="col-12 col-md-4 mt-3">
                                                            <label>Address 1</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_address1" value="{{$order['shipping']['address_1']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                        <div class="col-12 col-md-4 mt-3">
                                                            <label>Address 2</label>
                                                            
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_address2" value=""{{$order['shipping']['address_2']}} placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> City</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_city" value="{{$order['shipping']['city']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> Country</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_country" value="{{$order['shipping']['country']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-4 mt-3">
                                                            <label> State</label>
                                                            <input class="multisteps-form__input form-control"   type="text" name="shipping_state" value="{{$order['shipping']['state']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         <div class="col-12 col-md-6 mt-3">
                                                            <label> Postal Code</label>
                                                            <input class="multisteps-form__input form-control"  type="text" name="shipping_postcode" value="{{$order['shipping']['postcode']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                         
                                                         <div class="col-12 col-md-6 mt-3">
                                                            <label> phone</label>
                                                            <input class="multisteps-form__input form-control" type="text"  name="shipping_phone" value="{{$order['shipping']['phone']}}" placeholder="Eg. Tokyo" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="button-row d-flex mt-4 col-12">
                                                            <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                                                            <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Send">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
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
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
  <script src="{{asset('argon/assets/js/plugins/multistep-form.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('#alert').fadeOut(5000);
        });
    </script>
@endpush
