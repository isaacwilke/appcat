@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="row mt-4">
            <div class="col-lg-6 mb-lg-0 mb-4 h-100">
             
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Click on below Button To switch</h6>
                        <p class="text-sm mb-0">
                           
                            <span class="font-weight-bold "> Whisker And Soda - Where Cats and Relax Collide</span> 
                        </p>
                    </div>
                    <div class="card-body"  height="300" width="557" style="display: block; box-sizing: border-box; height: 300px; width: 557.1px;">
                    <form role="form" method="POST" action="{{route('api.performed')}}">
                        @csrf
                    <input type="hidden" name="site" value="Whisker And Soda - Where Cats and Relax Collide">
                    <input type="hidden" name="email" value="{{$credentials['email']}}">
                    <input type="hidden" name="password" value="{{$credentials['password']}}">
                        <button type="submit" class="btn btn-success">Proceed to site</a>
                    </form>  
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-lg-0 mb-4 h-100">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">Click on below Button To switch</h6>
                            <p class="text-sm mb-0">
                                
                                <span class="font-weight-bold">Griffin Rock CAT Retreat - Your Cat's Vacation oasis</span> 
                            </p>
                        </div>
                    <div class="card-body" height="300" width="557" style="display: block; box-sizing: border-box; height: 300px; width: 557.1px;">
                    <form role="form" method="POST" action="{{route('api.performed')}}">
                    @csrf
                    <input type="hidden" name="site" value="Griffin Rock CAT Retreat - Your Cat's Vacation oasis">
                    <input type="hidden" name="email" value="{{$credentials['email']}}">
                    <input type="hidden" name="password" value="{{$credentials['password']}}">
                        <button type="submit" class="btn btn-success">Proceed to site</a>
                    </form> 
                    </div>
                        
                </div>
            </div>
            
        </div>
    </div>
</div>
 @endsection