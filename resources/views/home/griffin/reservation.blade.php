@extends('layouts.app', ['class' => 'g-sidenav-show bg-gary-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'View Reservation'])
    @php
        use Carbon\Carbon;
    @endphp 
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action="{{route('griffin.cancel')}}" enctype="multipart/form-data">
                        @csrf
                        
                    
                         @php 
                        $now = Carbon::now()->format('Y-m-d');
                           
                         @endphp
                         @if ($booking['check_in'] > $now) 
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">View Reservation</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Cancel</button>
                            </div>
                        </div>
                         @endif
                        <div class="card-body">
                            <p class="text-uppercase text-sm"></p>
                            <input class="form-control" type="hidden" readonly name="bookingid" value="{{$booking['unique_id']}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">No of Rooms</label>
                                        <input class="form-control" type="text" readonly name="no_of_rooms" value="{{$booking['no_of_rooms']}}">
                                    </div>
                                </div>
                             
                               @php $information= json_decode($booking['details']['additional_info'], true); 
                        
                            
                           @endphp
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">No of Cats</label>
                                        @php $cats= $booking['adults'] + $booking['children'];@endphp
                                        <input class="form-control" type="text"readonly name="no_of_cats" value="{{$cats}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Checkin</label>
                                        <input class="form-control" type="text" readonly name="checkin" value="{{$booking['check_in']}}">
                                    </div>
                                </div>
                              
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">checkout</label>
                                        
                                        <input class="form-control" type="text"readonly name="checkout" value="{{$booking['check_out']}}">
                                    </div>
                                </div>
                              
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-sm">Cats Information</p>
                           
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cat_name"
                                            value="{{$information['cats_name']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cat_age"
                                            value="{{$information['cats_age']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_weight" value="{{$information['cats_weight']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
                                        <input class="form-control" type="text" readonly name="vaccine_uploaded_documents" value="{{$information['vaccine_uploaded_documents']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions_2" value="{{$information['special_dietary_needs_or_restrictions_2']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <input class="form-control" type="text" readonly name="add_special_dietary" value="{{'undefined'}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preferencev:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference" value="{{$information['litter_preference']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
                                        <input class="form-control" type="text" readonly name="others_liter" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
                                        <input class="form-control" type="text" readonly name="list_medications" value="">
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
                                        <input class="form-control"readonly type="text" name="address_street"
                                            value="{{$information['address_street']}}">
                                    </div>
                                </div>
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">city</label>
                                        <input class="form-control" type="text"readonly name="city"
                                            value="{{$information['city']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">state</label>
                                        <input class="form-control" type="text" readonly name="state"
                                            value="{{$information['state']}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">zip</label>
                                        <input class="form-control" type="text"readonly name="zip"
                                            value="{{$information['zip']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">preferred_method_of_contact</label>
                                        <input class="form-control" type="text" readonly name="preferred_method_of_contact"
                                            value="{{$information['preferred_method_of_contact']}}">
                                    </div>
                                </div>

                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">emergency_contact</label>
                                        <input class="form-control" type="text"readonly name="emergency_contact"
                                            value="{{$information['emergency_contact']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">phone_2</label>
                                        <input class="form-control" type="text" readonly name="phone_2"
                                            value="{{$information['phone_2']}}">
                                    </div>
                                </div>
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">acceptance_of_terms_and_conditions</label>
                                        <input class="form-control" type="text"readonly name="acceptance_of_terms_and_conditions_2"
                                            value="{{$information['acceptance_of_terms_and_conditions_2']}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">acceptance_of_cancellation_policy</label>
                                        <input class="form-control" type="text" readonly name="acceptance_of_cancellation_policy_2"
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
    
