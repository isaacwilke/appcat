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
                            <p>Membership List</p>
                            
                        </div>
                    </div> 
              
                 
                    <div class="row mb-5 ms-2 me-2">
                        @foreach($response as $plan)
                          
                        <div class="col-md-4 mt-2">
                            <div class="card d-flex text-center"> 
                                <div class="card-body">
                            
                                    <h5 class="card-title">{{$plan['plan_name']}}</h5>
                                    
                                    <a href=" {{ route('whisker.memberlist.detail', ['id' => $plan['plan_id']])}}" class="btn btn-blue">View</a>
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
    