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
                                        <input class="form-control" type="text" readonly name="status" value="{{ isset($booking['received_on']) ? date('m-d-Y h:i:sa',strtotime($booking['received_on'])) : '' }}">
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
							
							<?php if($booking['row_type'] == 'single-room'){
								
								$extraoptions= json_decode($booking['extra']['options'], true); 
							    ?>
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
						   
						   
						   
                            <?php } ?>
							
							
							<?php 
								if($booking['row_type'] == 'multiple-room')
								{
									$roomnoArr = explode(",",$booking['room_no']);
									$roomcounter = 0;
									foreach($booking['extra'] as $extradata)
									{
										?>
										<hr class="horizontal dark">
										<p class="text-sm">Extra Addon Services for Room Number <?php echo $roomnoArr[$roomcounter]; ?></p>
										<div class="row">
										
										<?php
										$extraoptions= json_decode($extradata['options'], true);
										if(count($extraoptions) == 0)
										{
											echo "<p class='text-sm' style='text-align:center'>No extra add on services added for this room.</p>";
										}
										?>
										
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
										<?php
										$roomcounter++;
									}
									
							    } 
							?>
							
							
							
                             
						   <?php if(isset($information['cats_name1']) && !empty($information['cats_name1'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 1 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name1"
                                            value="{{ isset($information['cats_name1']) ? $information['cats_name1'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age1"
                                            value="{{ isset($information['cats_age1']) ? $information['cats_age1'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_weight1" value="{{ isset($information['cats_weight1']) ? $information['cats_weight1'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_1']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_1']) ? $information['vaccine_uploaded_documents_1'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions1" value="{{ isset($information['special_dietary_needs_or_restrictions1']) ? $information['special_dietary_needs_or_restrictions1'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary1" >{{ isset($information['add_special_dietary1']) ? $information['add_special_dietary1'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference1" value="{{ isset($information['litter_preference1']) ? $information['litter_preference1'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter1" >{{ isset($information['otherslitter1']) ? $information['otherslitter1'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req1"  value="{{ isset($information['medication_req1']) ? $information['medication_req1'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications1" >{{ isset($information['list_medications1']) ? $information['list_medications1'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
							
							<?php if(isset($information['cats_name2']) && !empty($information['cats_name2'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 2 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name2"
                                            value="{{ isset($information['cats_name2']) ? $information['cats_name2'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age2"
                                            value="{{ isset($information['cats_age2']) ? $information['cats_age2'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_weight2" value="{{ isset($information['cats_weight2']) ? $information['cats_weight2'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_2']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_2']) ? $information['vaccine_uploaded_documents_2'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions2" value="{{ isset($information['special_dietary_needs_or_restrictions2']) ? $information['special_dietary_needs_or_restrictions2'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary2" >{{ isset($information['add_special_dietary2']) ? $information['add_special_dietary2'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference2" value="{{ isset($information['litter_preference2']) ? $information['litter_preference2'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter2" >{{ isset($information['otherslitter2']) ? $information['otherslitter2'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req2"  value="{{ isset($information['medication_req2']) ? $information['medication_req2'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications2" >{{ isset($information['list_medications2']) ? $information['list_medications2'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
							
								<?php if(isset($information['cats_name3']) && !empty($information['cats_name3'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 3 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name3"
                                            value="{{ isset($information['cats_name3']) ? $information['cats_name3'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age3"
                                            value="{{ isset($information['cats_age3']) ? $information['cats_age3'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_weight3" value="{{ isset($information['cats_weight3']) ? $information['cats_weight3'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_3']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_3']) ? $information['vaccine_uploaded_documents_3'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions3" value="{{ isset($information['special_dietary_needs_or_restrictions3']) ? $information['special_dietary_needs_or_restrictions3'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary3" >{{ isset($information['add_special_dietary3']) ? $information['add_special_dietary3'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference3" value="{{ isset($information['litter_preference3']) ? $information['litter_preference3'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter3" >{{ isset($information['otherslitter3']) ? $information['otherslitter3'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req3"  value="{{ isset($information['medication_req3']) ? $information['medication_req3'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications3" >{{ isset($information['list_medications3']) ? $information['list_medications3'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
							
							
								<?php if(isset($information['cats_name4']) && !empty($information['cats_name4'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 4 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name4"
                                            value="{{ isset($information['cats_name4']) ? $information['cats_name4'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age4"
                                            value="{{ isset($information['cats_age4']) ? $information['cats_age4'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_weight4" value="{{ isset($information['cats_weight4']) ? $information['cats_weight4'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_4']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_4']) ? $information['vaccine_uploaded_documents_4'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions4" value="{{ isset($information['special_dietary_needs_or_restrictions4']) ? $information['special_dietary_needs_or_restrictions4'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary4" >{{ isset($information['add_special_dietary4']) ? $information['add_special_dietary4'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference4" value="{{ isset($information['litter_preference4']) ? $information['litter_preference4'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter4" >{{ isset($information['otherslitter4']) ? $information['otherslitter4'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req4"  value="{{ isset($information['medication_req4']) ? $information['medication_req4'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications4" >{{ isset($information['list_medications4']) ? $information['list_medications4'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
								<?php if(isset($information['cats_name5']) && !empty($information['cats_name5'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 5 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name5"
                                            value="{{ isset($information['cats_name5']) ? $information['cats_name5'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age5"
                                            value="{{ isset($information['cats_age5']) ? $information['cats_age5'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_weight5" value="{{ isset($information['cats_weight5']) ? $information['cats_weight5'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_5']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_5']) ? $information['vaccine_uploaded_documents_5'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions5" value="{{ isset($information['special_dietary_needs_or_restrictions5']) ? $information['special_dietary_needs_or_restrictions5'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary5" >{{ isset($information['add_special_dietary5']) ? $information['add_special_dietary5'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference5" value="{{ isset($information['litter_preference5']) ? $information['litter_preference5'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter5" >{{ isset($information['otherslitter5']) ? $information['otherslitter5'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req5"  value="{{ isset($information['medication_req5']) ? $information['medication_req5'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications5" >{{ isset($information['list_medications5']) ? $information['list_medications5'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
							
							
							
								<?php if(isset($information['cats_name6']) && !empty($information['cats_name6'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 6 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name6"
                                            value="{{ isset($information['cats_name6']) ? $information['cats_name6'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age6"
                                            value="{{ isset($information['cats_age6']) ? $information['cats_age6'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age6" value="{{ isset($information['cats_age6']) ? $information['cats_age6'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_6']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_6']) ? $information['vaccine_uploaded_documents_6'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions6" value="{{ isset($information['special_dietary_needs_or_restrictions6']) ? $information['special_dietary_needs_or_restrictions6'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary6" >{{ isset($information['add_special_dietary6']) ? $information['add_special_dietary6'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference6" value="{{ isset($information['litter_preference6']) ? $information['litter_preference6'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter6" >{{ isset($information['otherslitter6']) ? $information['otherslitter6'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req6"  value="{{ isset($information['medication_req6']) ? $information['medication_req6'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications6" >{{ isset($information['list_medications6']) ? $information['list_medications6'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
							
							
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
    
