@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Update Profile'])
     <div id="alert">
        @include('components.alert')
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{asset('argon/img/bruce-mars.jpg')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                   
                </div>
                {{-- {{dd($user)}} --}}
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                           {{$user['user']['name']}}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                           
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
  

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action="{{route('update-griffin-profile')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Edit Profile</p>
                              
                            </div>
                        </div>
                       
                        <div class="card-body">
                            <p class="text-uppercase text-sm">User Information</p>
                            <div class="row">
                             <input class="form-control" type="hidden" name="id"  value="{{$user['user']['id']}}">
                            <input class="form-control" type="hidden" name="auth_token"  value="{{$user['token']['token']}}">
                             <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">First Name</label>
                                        <input class="form-control" type="text" name="firstname"  value="{{$user['user']["first_name"]}}">
                                     @error('firstname') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Last Name</label>
                                        <input class="form-control" type="text" name="lastname" value="{{ $user['user']["last_name"] }}">
                                        @error('lastname') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">User Name</label>
                                        <input class="form-control" type="text" readonly name="username" value="{{  $user['user']['username'] }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email Address</label>
                                        <input class="form-control" type="email"  name="email" value="{{ $user['user']['email']}}">
                                        @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Description</label>
                                     
                                        <input class="form-control" type="text" name="description"  value="{{$user['user']["description"]}}">
                                    </div>
                                </div>
                             <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Role</label>
                                     
                                        <input class="form-control" type="text" name="roles" readonly value="{{$user['user']['roles']['0']}}">
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-2">
                                    <div class="form-group text-center">
                                       
                                        <button type="submit" class="btn btn-blue text-uppercase btn-sm ms-auto">{{'update profile'}}</button>
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