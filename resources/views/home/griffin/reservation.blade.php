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
						 
						 
						   @php $information= json_decode($booking['details']['additional_info'], true); 
							   $extraoptions= json_decode($booking['extra']['options'], true); 
							  
                           @endphp
                               
							   
							   
                        <div class="card-body">
                            <p class="text-uppercase text-sm"></p>
                            <input class="form-control" type="hidden" readonly name="bookingid" value="{{$booking['unique_id']}}">
                            <p class=" text-sm">Reservation Information</p>
							 
							<div class="row">
							
							 
							 
								<div class="col-md-2">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Room Number</label>
                                        <input class="form-control" type="text" readonly name="room_no" value="{{ isset($booking['room_no']) ? $booking['room_no'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Number of Rooms</label>
                                        <input class="form-control" type="text" readonly name="no_of_rooms" value="{{ isset($booking['no_of_rooms']) ? $booking['no_of_rooms'] : '' }}">
                                    </div>
                                </div>
                             
								<div class="col-md-2">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Number of Cats</label>
                                        @php $cats= $booking['adults'] + $booking['children'];@endphp
                                        <input class="form-control" type="text"readonly name="no_of_cats" value="{{$cats}}">
                                    </div>
                                </div>
								
								<div class="col-md-2">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Status</label>
                                        <input class="form-control" type="text" readonly name="status" value="{{ isset($booking['status']) ? ucwords($booking['status']) : '' }}">
                                    </div>
                                </div>
								
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Booking Date Time</label>
                                        <input class="form-control" type="text" readonly name="status" value="{{ isset($booking['received_on']) ? ucwords($booking['received_on']) : '' }}">
                                    </div>
                                </div>
								
								<div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Check-In Date</label>
                                        <input class="form-control" type="text" readonly name="checkin" value="{{ isset($booking['check_in']) ? date('m-d-Y',strtotime($booking['check_in'])) : '' }}">
                                    </div>
                                </div>
                              
								<div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Check-In Time</label>
                                        <input class="form-control" type="text" readonly name="checkin_time" value="{{ isset($information['checkin_time']) ? $information['checkin_time'] : '' }}">
                                    </div>
                                </div>
								
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Check-Out Date</label>
                                        
                                        <input class="form-control" type="text"readonly name="checkout" value="{{ isset($booking['check_out']) ? date('m-d-Y',strtotime($booking['check_out'])) : '' }}">
                                    </div>
                                </div>
								
								
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Check-Out Time</label>
                                        
                                        <input class="form-control" type="text"readonly name="checkout_time" value="{{ isset($information['checkout_time']) ? $information['checkout_time'] : '' }}">
                                    </div>
                                </div>
								
                             
                                
                              
                            </div>
							
							
							<hr class="horizontal dark">
                            <p class="text-sm">Extra Addon Services</p>
                            <div class="row">
							
								<?php 
								foreach($extraoptions as $value)
								{
									//dd($value);
									?>
									<div class="col-md-3">
										<div class="form-group">
											<label for="example-text-input" class="form-control-label"><?php echo $value['name']."(Qty)"; ?></label>
											<input class="form-control" type="text" readonly 
												value="{{ isset($value['quantity']) ? $value['quantity'] : '' }}">
										</div>
									</div>
									<?php
								}
								?>
                                
							</div>
						   
						   
						   
                            <hr class="horizontal dark">
                            <p class="text-sm">Cats Information</p>
                           
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cat_name"
                                            value="{{ isset($information['cats_name']) ? $information['cats_name'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cat_age"
                                            value="{{ isset($information['cats_age']) ? $information['cats_age'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_weight" value="{{ isset($information['cats_weight']) ? $information['cats_weight'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents']) ? $information['vaccine_uploaded_documents'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions_2" value="{{ isset($information['special_dietary_needs_or_restrictions']) ? $information['special_dietary_needs_or_restrictions'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <input class="form-control" type="text" readonly name="add_special_dietary" value="{{'undefined'}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference" value="{{ isset($information['litter_preference']) ? $information['litter_preference'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
                                        <input class="form-control" type="text" readonly name="others_liter" value="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req" value="">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
                                        <input class="form-control" type="text" readonly name="list_medications" value="">
                                    </div>
                                </div>
                                
                            </div>
                            <hr class="horizontal dark">
                            <p class=" text-sm">Contact Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Phone</label>
                                        <input class="form-control" readinly type="text"readonly name="phone"
                                            value="{{ isset($information['phone']) ? $information['phone'] : '' }}">
                                    </div>
                                </div>
								
								<div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Phone 2</label>
                                        <input class="form-control" type="text" readonly name="phone_2"
                                            value="{{ isset($information['phone_2']) ? $information['phone_2'] : '' }}">
                                    </div>
                                </div>
								
								
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Street Address</label>
                                        <input class="form-control"readonly type="text" name="address_street"
                                            value="{{ isset($information['address_street']) ? $information['address_street'] : '' }}">
                                    </div>
                                </div>
                                   <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">City</label>
                                        <input class="form-control" type="text"readonly name="city"
                                            value="{{ isset($information['city']) ? $information['city'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">State</label>
                                        <input class="form-control" type="text" readonly name="state"
                                            value="{{ isset($information['state']) ? $information['state'] : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Zip</label>
                                        <input class="form-control" type="text"readonly name="zip"
                                            value="{{ isset($information['zip']) ? $information['zip'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Preferred  method  of  contact</label>
                                        <input class="form-control" type="text" readonly name="preferred_method_of_contact"
                                            value="{{ isset($information['preferred_method_of_contact']) ? $information['preferred_method_of_contact'] : '' }}">
                                    </div>
                                </div>

                                    <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Emergency Contact Number</label>
                                        <input class="form-control" type="text"readonly name="emergency_contact"
                                            value="{{ isset($information['emergency_contact']) ? $information['emergency_contact'] : '' }}">
                                    </div>
                                </div>
                                
                                  
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
       
    </div>
     @include('layouts.footers.auth.footer')
@endsection

@push('js')
    
    <script>

    </script>
@endpush
    
