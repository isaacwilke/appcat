@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Contact Us'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                       
                        <div class="card-body">
                            {{-- <div class="d-flex align-items-center">
                            <p><b>Get In Touch</b></p> --}}
                            <div class="col-md-6">
                                <h6>Get In Touch</h6>
                            </div>
                            
                        </div>
                            
                           
                                  <form role="form" method="POST" action="{{route('griffin.sendcontact')}}">
                                    @csrf
                                <div class="form-group mb-3">
                                       
                                        <input type="text" required class="form-control" id="exampleFormControlInput1" name ="name" placeholder="name">
                                    </div>
                                    <div class="form-group mb-3">
                                       <input type="email" required class="form-control" id="exampleFormControlInput1" name="email" placeholder="email">
                                    </div>
                                   
                                    <div class="form-group mb-3">
                                        
                                        <textarea name="message" required class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                    </div>

                                      <div class="form-group text-center">
                                            <button type="submit" class="btn btn-blue mt-2 mb-0">Submit</button>
                                        </div>
                                </form>
                           
                            
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