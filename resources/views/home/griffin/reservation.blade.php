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
								
                             <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Price</label>
                                        
                                        <input class="form-control" type="text"readonly name="amount_paid" value="${{ isset($information['amount_paid']) ? $information['amount_paid'] : '' }}">
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
								
								if(count($extraoptions) == 0)
								{
									echo "<p class='text-sm' style='text-align:center'>No extra add on services added for this room.</p>";
								}
								
								
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
							
							
							
							
							
								<?php if(isset($information['cats_name7']) && !empty($information['cats_name7'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 7 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name7"
                                            value="{{ isset($information['cats_name7']) ? $information['cats_name7'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age7"
                                            value="{{ isset($information['cats_age7']) ? $information['cats_age7'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age7" value="{{ isset($information['cats_age7']) ? $information['cats_age7'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_7']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_7']) ? $information['vaccine_uploaded_documents_7'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions7" value="{{ isset($information['special_dietary_needs_or_restrictions7']) ? $information['special_dietary_needs_or_restrictions7'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary7" >{{ isset($information['add_special_dietary7']) ? $information['add_special_dietary7'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference7" value="{{ isset($information['litter_preference7']) ? $information['litter_preference7'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter7" >{{ isset($information['otherslitter7']) ? $information['otherslitter7'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req7"  value="{{ isset($information['medication_req7']) ? $information['medication_req7'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications7" >{{ isset($information['list_medications7']) ? $information['list_medications7'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
								<?php if(isset($information['cats_name8']) && !empty($information['cats_name8'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 8 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name8"
                                            value="{{ isset($information['cats_name8']) ? $information['cats_name8'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age8"
                                            value="{{ isset($information['cats_age8']) ? $information['cats_age8'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age8" value="{{ isset($information['cats_age8']) ? $information['cats_age8'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_8']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_8']) ? $information['vaccine_uploaded_documents_8'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions8" value="{{ isset($information['special_dietary_needs_or_restrictions8']) ? $information['special_dietary_needs_or_restrictions8'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary8" >{{ isset($information['add_special_dietary8']) ? $information['add_special_dietary8'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference8" value="{{ isset($information['litter_preference8']) ? $information['litter_preference8'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter8" >{{ isset($information['otherslitter8']) ? $information['otherslitter8'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req8"  value="{{ isset($information['medication_req8']) ? $information['medication_req8'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications8" >{{ isset($information['list_medications8']) ? $information['list_medications8'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
								<?php if(isset($information['cats_name9']) && !empty($information['cats_name9'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 9 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name9"
                                            value="{{ isset($information['cats_name9']) ? $information['cats_name9'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age9"
                                            value="{{ isset($information['cats_age9']) ? $information['cats_age9'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age9" value="{{ isset($information['cats_age9']) ? $information['cats_age9'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_9']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_9']) ? $information['vaccine_uploaded_documents_9'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions9" value="{{ isset($information['special_dietary_needs_or_restrictions9']) ? $information['special_dietary_needs_or_restrictions9'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary9" >{{ isset($information['add_special_dietary9']) ? $information['add_special_dietary9'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference9" value="{{ isset($information['litter_preference9']) ? $information['litter_preference9'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter9" >{{ isset($information['otherslitter9']) ? $information['otherslitter9'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req9"  value="{{ isset($information['medication_req9']) ? $information['medication_req9'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications9" >{{ isset($information['list_medications9']) ? $information['list_medications9'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
							
							
								<?php if(isset($information['cats_name10']) && !empty($information['cats_name10'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 10 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name10"
                                            value="{{ isset($information['cats_name10']) ? $information['cats_name10'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age10"
                                            value="{{ isset($information['cats_age10']) ? $information['cats_age10'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age10" value="{{ isset($information['cats_age10']) ? $information['cats_age10'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_10']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_10']) ? $information['vaccine_uploaded_documents_10'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions10" value="{{ isset($information['special_dietary_needs_or_restrictions10']) ? $information['special_dietary_needs_or_restrictions10'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary10" >{{ isset($information['add_special_dietary10']) ? $information['add_special_dietary10'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference10" value="{{ isset($information['litter_preference10']) ? $information['litter_preference10'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter10" >{{ isset($information['otherslitter10']) ? $information['otherslitter10'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req10"  value="{{ isset($information['medication_req10']) ? $information['medication_req10'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications10" >{{ isset($information['list_medications10']) ? $information['list_medications10'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
								<?php if(isset($information['cats_name11']) && !empty($information['cats_name11'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 11 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name11"
                                            value="{{ isset($information['cats_name11']) ? $information['cats_name11'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age11"
                                            value="{{ isset($information['cats_age11']) ? $information['cats_age11'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age11" value="{{ isset($information['cats_age11']) ? $information['cats_age11'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_11']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_11']) ? $information['vaccine_uploaded_documents_11'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions11" value="{{ isset($information['special_dietary_needs_or_restrictions11']) ? $information['special_dietary_needs_or_restrictions11'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary11" >{{ isset($information['add_special_dietary11']) ? $information['add_special_dietary11'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference11" value="{{ isset($information['litter_preference11']) ? $information['litter_preference11'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter11" >{{ isset($information['otherslitter11']) ? $information['otherslitter11'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req11"  value="{{ isset($information['medication_req11']) ? $information['medication_req11'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications11" >{{ isset($information['list_medications11']) ? $information['list_medications11'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
								<?php if(isset($information['cats_name12']) && !empty($information['cats_name12'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 12 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name12"
                                            value="{{ isset($information['cats_name12']) ? $information['cats_name12'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age12"
                                            value="{{ isset($information['cats_age12']) ? $information['cats_age12'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age12" value="{{ isset($information['cats_age12']) ? $information['cats_age12'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_12']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_12']) ? $information['vaccine_uploaded_documents_12'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions12" value="{{ isset($information['special_dietary_needs_or_restrictions12']) ? $information['special_dietary_needs_or_restrictions12'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary12" >{{ isset($information['add_special_dietary12']) ? $information['add_special_dietary12'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference12" value="{{ isset($information['litter_preference12']) ? $information['litter_preference12'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter12" >{{ isset($information['otherslitter12']) ? $information['otherslitter12'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req12"  value="{{ isset($information['medication_req12']) ? $information['medication_req12'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications12" >{{ isset($information['list_medications12']) ? $information['list_medications12'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
								<?php if(isset($information['cats_name13']) && !empty($information['cats_name13'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 13 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name13"
                                            value="{{ isset($information['cats_name13']) ? $information['cats_name13'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age13"
                                            value="{{ isset($information['cats_age13']) ? $information['cats_age13'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age13" value="{{ isset($information['cats_age13']) ? $information['cats_age13'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_13']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_13']) ? $information['vaccine_uploaded_documents_13'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions13" value="{{ isset($information['special_dietary_needs_or_restrictions13']) ? $information['special_dietary_needs_or_restrictions13'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary13" >{{ isset($information['add_special_dietary13']) ? $information['add_special_dietary13'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference13" value="{{ isset($information['litter_preference13']) ? $information['litter_preference13'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter13" >{{ isset($information['otherslitter13']) ? $information['otherslitter13'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req13"  value="{{ isset($information['medication_req13']) ? $information['medication_req13'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications13" >{{ isset($information['list_medications13']) ? $information['list_medications13'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
								<?php if(isset($information['cats_name14']) && !empty($information['cats_name14'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 14 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name14"
                                            value="{{ isset($information['cats_name14']) ? $information['cats_name14'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age14"
                                            value="{{ isset($information['cats_age14']) ? $information['cats_age14'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age14" value="{{ isset($information['cats_age14']) ? $information['cats_age14'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_14']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_14']) ? $information['vaccine_uploaded_documents_14'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions14" value="{{ isset($information['special_dietary_needs_or_restrictions14']) ? $information['special_dietary_needs_or_restrictions14'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary14" >{{ isset($information['add_special_dietary14']) ? $information['add_special_dietary14'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference14" value="{{ isset($information['litter_preference14']) ? $information['litter_preference14'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter14" >{{ isset($information['otherslitter14']) ? $information['otherslitter14'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req14"  value="{{ isset($information['medication_req14']) ? $information['medication_req14'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications14" >{{ isset($information['list_medications14']) ? $information['list_medications14'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
								<?php if(isset($information['cats_name15']) && !empty($information['cats_name15'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 15 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name15"
                                            value="{{ isset($information['cats_name15']) ? $information['cats_name15'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age15"
                                            value="{{ isset($information['cats_age15']) ? $information['cats_age15'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age15" value="{{ isset($information['cats_age15']) ? $information['cats_age15'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_15']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_15']) ? $information['vaccine_uploaded_documents_15'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions15" value="{{ isset($information['special_dietary_needs_or_restrictions15']) ? $information['special_dietary_needs_or_restrictions15'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary15" >{{ isset($information['add_special_dietary15']) ? $information['add_special_dietary15'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference15" value="{{ isset($information['litter_preference15']) ? $information['litter_preference15'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter15" >{{ isset($information['otherslitter15']) ? $information['otherslitter15'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req15"  value="{{ isset($information['medication_req15']) ? $information['medication_req15'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications15" >{{ isset($information['list_medications15']) ? $information['list_medications15'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
								<?php if(isset($information['cats_name16']) && !empty($information['cats_name16'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 16 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name16"
                                            value="{{ isset($information['cats_name16']) ? $information['cats_name16'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age16"
                                            value="{{ isset($information['cats_age16']) ? $information['cats_age16'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age16" value="{{ isset($information['cats_age16']) ? $information['cats_age16'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_16']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_16']) ? $information['vaccine_uploaded_documents_16'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions16" value="{{ isset($information['special_dietary_needs_or_restrictions16']) ? $information['special_dietary_needs_or_restrictions16'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary16" >{{ isset($information['add_special_dietary16']) ? $information['add_special_dietary16'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference16" value="{{ isset($information['litter_preference16']) ? $information['litter_preference16'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter16" >{{ isset($information['otherslitter16']) ? $information['otherslitter16'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req16"  value="{{ isset($information['medication_req16']) ? $information['medication_req16'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications16" >{{ isset($information['list_medications16']) ? $information['list_medications16'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
								<?php if(isset($information['cats_name17']) && !empty($information['cats_name17'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 17 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name17"
                                            value="{{ isset($information['cats_name17']) ? $information['cats_name17'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age17"
                                            value="{{ isset($information['cats_age17']) ? $information['cats_age17'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age17" value="{{ isset($information['cats_age17']) ? $information['cats_age17'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_17']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_17']) ? $information['vaccine_uploaded_documents_17'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions17" value="{{ isset($information['special_dietary_needs_or_restrictions17']) ? $information['special_dietary_needs_or_restrictions17'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary17" >{{ isset($information['add_special_dietary17']) ? $information['add_special_dietary17'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference17" value="{{ isset($information['litter_preference17']) ? $information['litter_preference17'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter17" >{{ isset($information['otherslitter17']) ? $information['otherslitter17'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req17"  value="{{ isset($information['medication_req17']) ? $information['medication_req17'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications17" >{{ isset($information['list_medications17']) ? $information['list_medications17'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
								<?php if(isset($information['cats_name18']) && !empty($information['cats_name18'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 18 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name18"
                                            value="{{ isset($information['cats_name18']) ? $information['cats_name18'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age18"
                                            value="{{ isset($information['cats_age18']) ? $information['cats_age18'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age18" value="{{ isset($information['cats_age18']) ? $information['cats_age18'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_18']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_18']) ? $information['vaccine_uploaded_documents_18'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions18" value="{{ isset($information['special_dietary_needs_or_restrictions18']) ? $information['special_dietary_needs_or_restrictions18'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary18" >{{ isset($information['add_special_dietary18']) ? $information['add_special_dietary18'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference18" value="{{ isset($information['litter_preference18']) ? $information['litter_preference18'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter18" >{{ isset($information['otherslitter18']) ? $information['otherslitter18'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req18"  value="{{ isset($information['medication_req18']) ? $information['medication_req18'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications18" >{{ isset($information['list_medications18']) ? $information['list_medications18'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
								<?php if(isset($information['cats_name19']) && !empty($information['cats_name19'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 19 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name19"
                                            value="{{ isset($information['cats_name19']) ? $information['cats_name19'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age19"
                                            value="{{ isset($information['cats_age19']) ? $information['cats_age19'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age19" value="{{ isset($information['cats_age19']) ? $information['cats_age19'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_19']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_19']) ? $information['vaccine_uploaded_documents_19'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions19" value="{{ isset($information['special_dietary_needs_or_restrictions19']) ? $information['special_dietary_needs_or_restrictions19'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary19" >{{ isset($information['add_special_dietary19']) ? $information['add_special_dietary19'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference19" value="{{ isset($information['litter_preference19']) ? $information['litter_preference19'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter19" >{{ isset($information['otherslitter19']) ? $information['otherslitter19'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req19"  value="{{ isset($information['medication_req19']) ? $information['medication_req19'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications19" >{{ isset($information['list_medications19']) ? $information['list_medications19'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
								<?php if(isset($information['cats_name20']) && !empty($information['cats_name20'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 20 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name20"
                                            value="{{ isset($information['cats_name20']) ? $information['cats_name20'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age20"
                                            value="{{ isset($information['cats_age20']) ? $information['cats_age20'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age20" value="{{ isset($information['cats_age20']) ? $information['cats_age20'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_20']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_20']) ? $information['vaccine_uploaded_documents_20'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions20" value="{{ isset($information['special_dietary_needs_or_restrictions20']) ? $information['special_dietary_needs_or_restrictions20'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary20" >{{ isset($information['add_special_dietary20']) ? $information['add_special_dietary20'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference20" value="{{ isset($information['litter_preference20']) ? $information['litter_preference20'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter20" >{{ isset($information['otherslitter20']) ? $information['otherslitter20'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req20"  value="{{ isset($information['medication_req20']) ? $information['medication_req20'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications20" >{{ isset($information['list_medications20']) ? $information['list_medications20'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
								<?php if(isset($information['cats_name21']) && !empty($information['cats_name21'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 21 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name21"
                                            value="{{ isset($information['cats_name21']) ? $information['cats_name21'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age21"
                                            value="{{ isset($information['cats_age21']) ? $information['cats_age21'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age21" value="{{ isset($information['cats_age21']) ? $information['cats_age21'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_21']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_21']) ? $information['vaccine_uploaded_documents_21'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions21" value="{{ isset($information['special_dietary_needs_or_restrictions21']) ? $information['special_dietary_needs_or_restrictions21'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary21" >{{ isset($information['add_special_dietary21']) ? $information['add_special_dietary21'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference21" value="{{ isset($information['litter_preference21']) ? $information['litter_preference21'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter21" >{{ isset($information['otherslitter21']) ? $information['otherslitter21'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req21"  value="{{ isset($information['medication_req21']) ? $information['medication_req21'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications21" >{{ isset($information['list_medications21']) ? $information['list_medications21'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
								<?php if(isset($information['cats_name22']) && !empty($information['cats_name22'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 22 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name22"
                                            value="{{ isset($information['cats_name22']) ? $information['cats_name22'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age22"
                                            value="{{ isset($information['cats_age22']) ? $information['cats_age22'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age22" value="{{ isset($information['cats_age22']) ? $information['cats_age22'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_22']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_22']) ? $information['vaccine_uploaded_documents_22'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions22" value="{{ isset($information['special_dietary_needs_or_restrictions22']) ? $information['special_dietary_needs_or_restrictions22'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary22" >{{ isset($information['add_special_dietary22']) ? $information['add_special_dietary22'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference22" value="{{ isset($information['litter_preference22']) ? $information['litter_preference22'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter22" >{{ isset($information['otherslitter22']) ? $information['otherslitter22'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req22"  value="{{ isset($information['medication_req22']) ? $information['medication_req22'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications22" >{{ isset($information['list_medications22']) ? $information['list_medications22'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
							
								<?php if(isset($information['cats_name23']) && !empty($information['cats_name23'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 23 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name23"
                                            value="{{ isset($information['cats_name23']) ? $information['cats_name23'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age23"
                                            value="{{ isset($information['cats_age23']) ? $information['cats_age23'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age23" value="{{ isset($information['cats_age23']) ? $information['cats_age23'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_23']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_23']) ? $information['vaccine_uploaded_documents_23'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions23" value="{{ isset($information['special_dietary_needs_or_restrictions23']) ? $information['special_dietary_needs_or_restrictions23'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary23" >{{ isset($information['add_special_dietary23']) ? $information['add_special_dietary23'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference23" value="{{ isset($information['litter_preference23']) ? $information['litter_preference23'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter23" >{{ isset($information['otherslitter23']) ? $information['otherslitter23'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req23"  value="{{ isset($information['medication_req23']) ? $information['medication_req23'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications23" >{{ isset($information['list_medications23']) ? $information['list_medications23'] : '' }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
							
							<?php } ?>
							
							
							
							
							
								<?php if(isset($information['cats_name24']) && !empty($information['cats_name24'])){ ?>
						   
						   <hr class="horizontal dark">
                            <p class="text-sm">Cats 24 Information</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Name</label>
                                        <input class="form-control" type="text" readonly name="cats_name24"
                                            value="{{ isset($information['cats_name24']) ? $information['cats_name24'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat Age</label>
                                        <input class="form-control" readonly type="text" name="cats_age24"
                                            value="{{ isset($information['cats_age24']) ? $information['cats_age24'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cat's weight</label>
                                        <input class="form-control" type="text" readonly name="cats_age24" value="{{ isset($information['cats_age24']) ? $information['cats_age24'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Vaccine & Negative FeLV</label>
										<?php 
											if(isset($information['vaccine_uploaded_documents_24']))
											{
											?>
												<br><a class="btn btn-blue" href="{{ isset($information['vaccine_uploaded_documents_24']) ? $information['vaccine_uploaded_documents_24'] : '' }}" target="blank">View</a>
											<?php											
											}
											
										?>
										
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Special Dietary Needs or Restriction?</label>
                                        <input class="form-control" type="text" readonly name="special_dietary_needs_or_restrictions24" value="{{ isset($information['special_dietary_needs_or_restrictions24']) ? $information['special_dietary_needs_or_restrictions24'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Add Special Dietary:</label>
                                        <textarea class="form-control"  readonly name="add_special_dietary24" >{{ isset($information['add_special_dietary24']) ? $information['add_special_dietary24'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Litter Preference:</label>
                                        <input class="form-control" type="text" readonly name="litter_preference24" value="{{ isset($information['litter_preference24']) ? $information['litter_preference24'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Others(Litter):</label>
										 <textarea class="form-control"  readonly name="otherslitter24" >{{ isset($information['otherslitter24']) ? $information['otherslitter24'] : '' }}</textarea>
										 
										 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Medication Req:</label>
                                        <input class="form-control" type="text" readonly  name="medication_req24"  value="{{ isset($information['medication_req24']) ? $information['medication_req24'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">List Medications: </label>
										<textarea class="form-control"  readonly name="list_medications24" >{{ isset($information['list_medications24']) ? $information['list_medications24'] : '' }}</textarea>
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
    
