@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Membership'])
   <div class="container-fluid py-4">
          <div id="alert">
            @include('components.alert')
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Membership Plan Details</h6>
                    </div>
                  
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table table-responsive align-items-center mb-0">
                                <thead>
                                    <tr>
                                          
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('Name')}}</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{__('Membership')}}</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{__('Payment Type')}}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('Access type')}}</th>
                                       
                                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{__('Amount')}}</th>
                                            <th class="text-secondary opacity-7"></th>
                                            
                                             
                                    </tr>
                                </thead>
                                <tbody>
                              
                                @if(!empty($response))
                                @foreach($response as $details )
                                
                                    <tr>
                                        <td class="text-center"> 
                                            {{$details['plan_name']}}   
                                        </td>
                                        <td class="text-center">
                                           {{$details['plan_options']['pricetext']}}   
                                        </td>
                                        <td class="text-center">
                                           {{$details['plan_options']['payment_type']}}   
                                        </td>
                                         <td class="text-center">
                                           {{$details['plan_options']['access_type']}}   
                                        </td>
                                        
                                        <td class="text-center">
                                              {{$details['plan_options']['payment_cycles'][0]['cycle_amount']}} 
                                        </td>
                                            <td class="align-middle">
                                            <a href="{{route('whisker.addmember',['id'=>$plan_id])}}" class="btn btn-blue"
                                                data-toggle="tooltip" data-original-title="purchase">
                                                {{__('Purchase')}}
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
    
    <script>

    </script>
@endpush
    