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
										
										<?php if (!empty($booking)){ 
											$counter = 1;
											foreach ($booking as $bookings){
												if($bookings['status'] == 'confirmed' && strtotime(date('Y-m-d'))  <=  strtotime(date('Y-m-d',strtotime($bookings['check_out']))))
												{
													?>
													<div class="reservation_list">
													
													<h3><?php echo "Reservation: ".$counter; ?></h3>
													<div class="reservation_list_data">
													<div class="col-full"><div><?php echo "Check In Date: </div><span>".date('m-d-Y',strtotime($bookings['check_in'])); ?></span></div>
													<div class="col-full"><div><?php echo "Check Out Date: </div><span>".date('m-d-Y',strtotime($bookings['check_out'])); ?></span></div>
													<div class="col-full"><div><?php echo "Number of Cats: </div><span>".(float)$bookings['adults'] + (float)$bookings['children']; ?></span></div>
													
													</div>
													<div class="room_btn"><div class="btn btn-blue text-uppercase btn-lg"><?php echo "Room Number: ".$bookings['room_no']; ?></div></div>
													</div>
													
													
													<?php
													$counter++;
												}
												
											}
										} 
										?>
									
                                        
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