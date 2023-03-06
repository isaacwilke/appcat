@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Webcam'])
    
    <div class="container-fluid py-4">
      <div id="alert">
            @include('components.alert')
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="height: 415px;">
                   
                    <div class="card-body">   
                        
                        <div class="col-md-6">
                                <h6>Webcam</h6>
                            </div>
                                
                        
                                <div class="row">
                                    <div class="col-12 m-auto">
                                        
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
 
    <script>
                
    </script>
@endpush