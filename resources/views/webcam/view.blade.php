@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Webcam'])
    <div class="container-fluid py-4">
      <div id="alert">
            @include('components.alert')
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="min-height: 415px;">
                    <div class="card-body">
                        <div class="col-md-6">
                                <h6>Webcam</h6>
                            </div>
                                <div class="row">
                                    <div class="col-12 m-auto">
{{--									<h3 style="text-align: center;margin-top: 100px;">COMING SOON</h3>--}}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <iframe marginwidth='0' marginheight='0' frameborder='0' width="720" height="480" scrolling='no' allowfullscreen='allowfullscreen' src="https://streamedian.com/embed?s=cnRzcDovL3ZpZXdlcjpzM2NyM3RjMGQzIUAxMDQuMTgwLjI0Ni4yNDU6NTU0L3VuaWNhc3QvYzEvczAvbGl2ZQ==&r=NzIweDQ4MA=="></iframe>
                                            </div>
                                            <div class="col-md-12">
                                                <iframe marginwidth='0' marginheight='0' frameborder='0' width="720" height="480" scrolling='no' allowfullscreen='allowfullscreen' src="https://rtsp.me/embed/TSBSieZr/"></iframe>
                                            </div>
                                            <div class="col-md-12">
                                                <iframe marginwidth='0' marginheight='0' frameborder='0' width="720" height="480" scrolling='no' allowfullscreen='allowfullscreen' src='https://demo.flashphoner.com:8888/embed_player?urlServer=wss://demo.flashphoner.com:8443&streamName=rtsp%3A%2F%2Fviewer%3As3cr3tc0d3!%40104.180.246.245%3A554%2Funicast%2Fc1%2Fs0%2Flive&mediaProviders=WebRTC,MSE'></iframe>
                                            </div>
                                        </div>

										<?php if(1 == 2){ ?>
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
													<?php
													if($bookings['row_type'] == 'single-room')
													{
														?>
														<div class="room_btn"><div class="btn btn-blue text-uppercase btn-lg"><?php echo "Room Number: ".$bookings['room_no']; ?></div></div>
														<?php
													}
													?>


													<?php
													if($bookings['row_type'] == 'multiple-room')
													{
														$roomnoArr = explode(",",$bookings['room_no']);
														?>
														<div class="room_btn">
														<?php
														foreach($roomnoArr as $room)
														{
														?>
														<div class="btn btn-blue text-uppercase btn-lg"><?php echo "Room Number: ".$room; ?></div>
														<?php
														}
														?>
														</div>
														<?php
													}
													?>





													</div>


													<?php
													$counter++;
												}

											}
										}
										?>
									<?php } ?>

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
