@extends('layouts.app', ['class' => 'g-sidenav-show bg-gary-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'View Reservation'])
     
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">View Reservation</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Cancel</button>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <p class="text-uppercase text-sm"></p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">No of Rooms</label>
                                        <input class="form-control" type="text" readonly name="checkin" value="{{$booking['no_of_rooms']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">No of Cats</label>
                                        <input class="form-control" type="text"readonly name="checkout" value="#">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">First name</label>
                                        <input class="form-control" type="text" name="firstname"  value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Last name</label>
                                        <input class="form-control" type="text" name="lastname" value="">
                                    </div>
                                </div> --}}
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-sm">Cats Information</p>
                            @php $information= json_decode($booking['details']['additional_info'], true); 
                           
                            
                           @endphp
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="address"
                                            value="{{$information['cats_name']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="address"
                                            value="{{$information['cats_age']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="city" value="{{$information['cats_weight']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
                                        <input class="form-control" type="text" readonly name="country" value="{{$information['vaccine_uploaded_documents']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="postal" value="{{$information['special_dietary_needs_or_restrictions_2']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <input class="form-control" type="text" readonly name="country" value="{{'undefined'}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preferencev:</label>
                                        <input class="form-control" type="text" readonly name="postal" value="{{$information['litter_preference']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
                                        <input class="form-control" type="text" readonly name="country" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="postal" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
                                        <input class="form-control" type="text" readonly name="country" value="">
                                    </div>
                                </div>
                                
                            </div>
                            <hr class="horizontal dark">
                            <p class=" text-sm">Owner Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Phone</label>
                                        <input class="form-control" readinly type="text"readonly name="phone"
                                            value="{{$information['phone']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">address street</label>
                                        <input class="form-control"readonly type="text" name="about"
                                            value="{{$information['address_street']}}">
                                    </div>
                                </div>
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">city</label>
                                        <input class="form-control" type="text"readonly name="phone"
                                            value="{{$information['city']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">state</label>
                                        <input class="form-control" type="text" readonly name="about"
                                            value="{{$information['state']}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">zip</label>
                                        <input class="form-control" type="text"readonly name="phone"
                                            value="{{$information['zip']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">preferred_method_of_contact</label>
                                        <input class="form-control" type="text" readonly name="about"
                                            value="{{$information['preferred_method_of_contact']}}">
                                    </div>
                                </div>

                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">emergency_contact</label>
                                        <input class="form-control" type="text"readonly name="phone"
                                            value="{{$information['emergency_contact']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">phone_2</label>
                                        <input class="form-control" type="text" readonly name="about"
                                            value="{{$information['phone_2']}}">
                                    </div>
                                </div>
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">acceptance_of_terms_and_conditions</label>
                                        <input class="form-control" type="text"readonly name="phone"
                                            value="{{$information['acceptance_of_terms_and_conditions_2']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">acceptance_of_cancellation_policy</label>
                                        <input class="form-control" type="text" readonly name="about"
                                            value="{{$information['acceptance_of_cancellation_policy_2']}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    
    <script>

    </script>
@endpush
    
