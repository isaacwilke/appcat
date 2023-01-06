@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

    
    
    @include('layouts.navbars.auth.topnav', ['title' => 'Orders Lists'])
    <div class="container-fluid py-4">
          <div id="alert">
            @include('components.alert')
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Order View</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="order">
                                <thead>
                                    <tr>
                                          
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('transaction-id')}}</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{__('payment_method')}}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('first name')}}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('last name')}}</th>
                                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('order_key')}}</th>
                                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('discount_total')}}</th>
                                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('discount_tax')}}</th>
                                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('shipping_total')}}</th> 
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('shipping_tax')}}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('cart_tax')}}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('total')}}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('total_tax')}}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('status')}}</th>
                                             <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('currency')}}</th>
                                             <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('date_completed')}}</th>
                                             <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('date_paid')}}</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(!empty($orders))
                                @foreach($orders as $order)
                                    <tr >
                                        <td class="text-center"> 
                                            {{$order['transaction_id']}}   
                                        </td>
                                        <td class="text-center">
                                           {{$order['payment_method']}}   
                                        </td>
                                         <td class="text-center">
                                           {{$order['billing']['first_name']}}   
                                        </td>
                                         <td class="text-center">
                                           {{$order['billing']['last_name']}}   
                                        </td>
                                       <td class="text-center">
                                           {{$order['order_key']}}   
                                        </td>
                                         <td class="text-center">
                                           {{$order['discount_total']}}   
                                        </td> 
                                        <td class="text-center">
                                           {{$order['discount_tax']}}   
                                        </td>
                                         <td class="text-center">
                                           {{$order['shipping_total']}}   
                                        </td>
                                         <td class="text-center">
                                           {{$order['shipping_tax']}}   
                                        </td> 
                                        <td class="text-center">
                                           {{$order['cart_tax']}}   
                                        </td> 
                                        <td class="text-center">
                                           {{$order['total']}}   
                                        </td> 
                                        <td class="text-center">
                                           {{$order['total_tax']}}   
                                        </td> 
                                        <td class="text-center">
                                           {{$order['status']}}   
                                        </td> 
                                        <td class="text-center">
                                           {{$order['currency']}}   
                                        </td> 
                                        <td class="text-center">
                                           {{$order['date_completed']}}   
                                        </td> 
                                        <td class="text-center">
                                           {{$order['date_paid']}}   
                                        </td> 
                                        <td class="align-middle">
                                            <a href="{{route('griffin.edit',['id'=>$order['id']])}}" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit order">
                                                {{__('Edit')}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach  
                                @else
                                     <tr >
                                        <td class="text-center"> 
                                            {{" No Records Found"}}   
                                        </td>
                                    </tr>                                    
                                @endif
                                </tbody>
                            </table>
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
    <script>
    $(document).ready(function(){
            $('#alert').fadeOut(5000);
            
    });
    </script>
     
@endpush
