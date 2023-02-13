@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Membership'])
   
    <div class="container-fluid py-4">
        <div id="alert">
            @include('components.alert')
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <p>Membership Details</p>
                            
                        </div>
                    </div> 
              
                 
                    <div class="row mb-5 ps-2 pe-2">
                        @foreach($response['memberships'] as $membership)
                          
                        <div class="col-md-4">
                            <div class="card d-flex text-center"> 
                                <div class="card-body">
                            
                                    <h5 class="card-title">{{$membership['name']}}</h5>
                                    <p class="card-text">
                                   {{html_entity_decode($membership['recurring_profile'], ENT_QUOTES, "UTF-8")}} 
                                    </p>
                                    <p class="card-text">
                                    <span>Payment Mode:-</span> {{$membership['user_payment_mode']}}</p>
                                    <p class="card-text">
                                    <span>Start Date:-</span> {{$membership['start_date']}}</p>
                                    <p class="card-text">
                                    <span>End Date:-</span> {{$membership['end_date']}}</p>
                                    <p class="card-text">
                                    <span>Renew Date:-</span> {{$membership['renew_date']}}</p>
                                   
                                    {{-- <a href="#" class="btn btn-blue">Edit</a> --}}
                                </div>
                        
                            </div>
                        
                        </div> 
                        
                        
                        @endforeach
                        
                        
                        
                        
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
    