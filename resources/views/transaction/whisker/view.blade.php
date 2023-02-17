@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Transactions'])
   <div class="container-fluid py-4">
          <div id="alert">
            @include('components.alert')
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Transaction Details</h6>
                    </div>
                  
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table table-responsive align-items-center mb-0">
                                <thead>
                                    <tr>
                                          
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('transaction-id')}}</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{__('Name')}}</th>
                                        {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('Payment Gateway')}}</th> --}}
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('Payment Type')}}</th>
                                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('Amount')}}</th>
                                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                             
                                            {{__('Payment Date')}}</th>
                                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('Payment Status')}}</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('Action')}}</th>
                                             
                                    </tr>
                                </thead>
                                <tbody>
                                @if(!empty($response['payments']))
                                @foreach($response['payments'] as $payment )
                                    <tr>
                                        <td class="text-center"> 
                                            {{$payment['arm_transaction_id']}}   
                                        </td>
                                        <td class="text-center">
                                           {{$payment['arm_plan']}}   
                                        </td>
                                         {{-- <td class="text-center">
                                           {{$payment['arm_payment_gateway']}}   
                                        </td> --}}
                                         <td class="text-center">
                                           {{$payment['arm_payment_type']}}   
                                        </td>
                                       <td class="text-center">
                                           {{html_entity_decode($payment['arm_paid_amount'], ENT_QUOTES, "UTF-8")}}   
                                        </td>
                                         <td class="text-center">
                                          @php
                                          $d=strtotime($payment['arm_payment_date']);
                                           $date = date("m-d-Y", $d)@endphp
                                           {{$date}}   
                                        </td> 
                                        <td class="text-center">
                                             {{$payment['arm_payment_status']}}
                                        </td>
                                        <td>
                                             <a class="btn btn-blue" href="{{ route('whisker.transactionpdf',['id'=>$payment['arm_log_id']]) }}">pdf</a>
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
    
    <script>

    </script>
@endpush
    