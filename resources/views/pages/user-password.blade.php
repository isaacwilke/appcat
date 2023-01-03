@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Change Password'])
     <div id="alert">
        @include('components.alert')
    </div>
    

  

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action="{{route('update-whisker-password')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Change Password</p>
                              
                            </div>
                        </div>
                       
                        <div class="card-body">
                            <p class="text-uppercase text-sm">User Information</p>
                            <div class="row">
                             
                             <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">password</label>
                                        @php $password = Session::get('user_credentials');@endphp
                                        <input class="form-control" type="type" name="password"  value="{{$password["password"]}}">
                                    
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="form-group text-center">
                                       
                                        <button type="submit" class="btn btn-primary text-uppercase btn-sm ms-auto">{{'Submit'}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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