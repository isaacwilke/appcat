@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Webcam'])
    <div class="container-fluid py-4">
      @include('components.alert')
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="min-height: 415px;">
                    <div class="card-body">
                        <div class="col-md-6">
                                <h6>Webcam</h6>
                            </div>
                                <div class="row">
                                     <div class="col-md-12">
									 <input type="hidden" id="playedroomno">
											<div class="row kl_webcam">
										<?php
										$roomArr=array();
										$roomArr['1'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=01_FFB06_ROOM1&media=video+audio+microphone&micmute=1';
										$roomArr['2'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=02_FF680_ROOM2&media=video+audio+microphone&micmute=1';
										$roomArr['3'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=03_FFB6E_ROOM3&media=video+audio+microphone&micmute=1';
										$roomArr['4'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=04_FFF2D_ROOM4&media=video+audio+microphone&micmute=1';
										$roomArr['5'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=05_FF96F_ROOM5&media=video+audio+microphone&micmute=1';
										$roomArr['6'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=06_FFB3D_ROOM6&media=video+audio+microphone&micmute=1';
										$roomArr['7'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=07_FFF31_ROOM7&media=video+audio+microphone&micmute=1';
										$roomArr['8'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=08_FFCCD_ROOM8&media=video+audio+microphone&micmute=1';
										$roomArr['9'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=09_00081_ROOM9&media=video+audio+microphone&micmute=1';
										$roomArr['10'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=10_FFB78_ROOM10&media=video+audio+microphone&micmute=1';
										$roomArr['11'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=11_FFF7C_ROOM11&media=video+audio+microphone&micmute=1';
										$roomArr['12'] = 'wss://cams.griffinrockcatretreat.com/b/api/ws?src=12_CCF346_ROOM12&media=video+audio+microphone&micmute=1';
										?>
										

										<?php if (!empty($booking)){ 
										
										   // dd($booking);
											$counter = 1;
											$klisbook = 0;
											foreach ($booking as $bookings){
												if($bookings['status'] == 'confirmed' && strtotime(date('Y-m-d'))  <=  strtotime(date('Y-m-d',strtotime($bookings['check_out']))))
												{
												    $klisbook =1;
													if($bookings['row_type'] == 'single-room')
													{
														?>
														 <div class="col-md-2 col-sm-6">
															 <button type="button" class="btn btn-blue" 
															 onclick="viewcam('<?php echo $bookings['room_no']; ?>','<?php echo $roomArr[$bookings['room_no']]; ?>');">Play Feed - Room <?php echo $bookings['room_no']; ?></button>
														 </div> 
														 
														 
														<?php
													}
													if($bookings['row_type'] == 'multiple-room')
													{
														$roomnoArr = explode(",",$bookings['room_no']);
														foreach($roomnoArr as $room)
														{
														?>
														 <div class="col-md-2 col-sm-6">
															 <button type="button" class="btn btn-blue" 
															 onclick="viewcam('<?php echo $room; ?>','<?php echo $roomArr[$room]; ?>');">Play Feed - Room <?php echo $room; ?></button>
														 </div> 
														<?php
														}
													}
													$counter++;
												}
												
											}
										} 
										
										if(empty($klisbook))
										{
										    	?>
											<div class="col-md-12">
												 <p>The webcam feature becomes available once you fully check in at Griffin Rock Cat Retreat at the start of your reservation.  If you have not checked in yet, please come back after check-in to view the live webcam feature. </p>
											 </div> 
											<?php
										}
									
										?>
                                         
                                       	</div> 
                                       </div>  
                                
								
								<video style="margin-bottom:20px" id="video" autoplay controls playsinline muted></video>
									<div class="row kl_webcamyes">
								<?php
									if(!empty($klisbook))
									{
    								    	?>
    									<div class="col-md-12">
												 <p>If you are having issues with the webcam feed, please try the following:  </p>
												 <ol>
												     <li>Fully reboot the device that you are using to view the webcam feed and try again.</li>
												     <li>Try deactivating any VPN's that you have active on your device, as they may impact the feed connection. </li>
												     <li>If you are on a mobile phone, try turning off wifi and then attempting to view the webcam feed again. </li>
												 </ol>
												 <p>If none of these steps help resolve the issue you are facing, please fill out the <a href="{{route('griffin.contactus')}}">HELP FORM</a> to notify our staff that you need additional support. </p>
											 </div>
    									<?php
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
 

<script>
$("#video").hide();
	async function PeerConnection(media) {
	if(stopcamflag == 0)
	{
        const pc = new RTCPeerConnection({
            iceServers: [{urls: 'stun:stun.l.google.com:19302'}]
        })

        const localTracks = []

        if (/camera|microphone/.test(media)) {
            const tracks = await getMediaTracks('user', {
                video: media.indexOf('camera') >= 0,
                audio: media.indexOf('microphone') >= 0,
            })
            tracks.forEach(track => {
                pc.addTransceiver(track, {direction: 'sendonly'})
                if (track.kind === 'video') localTracks.push(track)
            })
        }

        if (media.indexOf('display') >= 0) {
            const tracks = await getMediaTracks('display', {
                video: true,
                audio: media.indexOf('speaker') >= 0,
            })
            tracks.forEach(track => {
                pc.addTransceiver(track, {direction: 'sendonly'})
                if (track.kind === 'video') localTracks.push(track)
            })
        }

        if (/video|audio/.test(media)) {
            const tracks = ['video', 'audio']
                .filter(kind => media.indexOf(kind) >= 0)
                .map(kind => pc.addTransceiver(kind, {direction: 'recvonly'}).receiver.track)
            localTracks.push(...tracks)
        }

        document.getElementById('video').srcObject = new MediaStream(localTracks)

        return pc
		}
    }

    async function getMediaTracks(media, constraints) {
        try {
            const stream = media === 'user'
                ? await navigator.mediaDevices.getUserMedia(constraints)
                : await navigator.mediaDevices.getDisplayMedia(constraints)
            return stream.getTracks()
        } catch (e) {
            console.warn(e)
            return []
        }
    }

var pc;
    async function connect(media,kl_socketurl) {
       if(stopcamflag == 0)
		{
        pc = await PeerConnection(media)
        const url = new URL('api/ws' + location.search, location.href)
        const ws = new WebSocket(kl_socketurl)  
        ws.addEventListener('open', () => {
            pc.addEventListener('icecandidate', ev => {
                if (!ev.candidate) return
                const msg = {type: 'webrtc/candidate', value: ev.candidate.candidate}
                ws.send(JSON.stringify(msg))
            })

            pc.createOffer().then(offer => pc.setLocalDescription(offer)).then(() => {
                const msg = {type: 'webrtc/offer', value: pc.localDescription.sdp}
                ws.send(JSON.stringify(msg))
            })
        })

        ws.addEventListener('message', ev => {
            const msg = JSON.parse(ev.data)
            if (msg.type === 'webrtc/candidate') {
                pc.addIceCandidate({candidate: msg.value, sdpMid: '0'})
            } else if (msg.type === 'webrtc/answer') {
                pc.setRemoteDescription({type: 'answer', sdp: msg.value})
            }
        })
       }
    }

    const media = new URLSearchParams(location.search).get('media');
	var stopcamflag = 0;
	function viewcam(roomno,link){
		$("#video").show();
		$("#playedroomno").val(roomno);
		stopcamflag = 0;
		connect(media || 'video+audio+microphone',link);
	}
	
    
	
	function stopcam()
	{
		document.getElementById('video').srcObject = null;
		document.getElementById('video').reset;
		stopcamflag = 1;
	}
	
	
    
   
	setInterval(function(){
		$.ajax({
			url: "{{route('webcam.ajax')}}",
			method: 'POST',
			data: {"_token": "{{ csrf_token() }}"},
			dataType: "json",
			success: function (res) {
				 var playedroomno = $("#playedroomno").val();
				var roomno = res.roomno;
				var roomnolink = res.roomnolink;
				if(roomno != '')
				{
				   
					 $('.kl_webcam').empty();
				   var roomnoArr = roomno.split(',');
				   var roomnolinkArr = roomnolink.split(',');
				   
				  
					for (let i = 0; i < roomnoArr.length; ++i) {
					  var roomn = "'"+roomnoArr[i]+"'";
					  var roomnl = "'"+roomnolinkArr[i]+"'";
					  $htmltemp='<div class="col-md-2 col-sm-6"><button type="button" class="btn btn-blue"  onclick="viewcam('+roomn+','+roomnl+');">Play Feed - Room '+roomnoArr[i]+'</button></div>';
					  $('.kl_webcam').append($htmltemp); 								 
											console.log(playedroomno);		 
					  console.log(roomnoArr[i]+'-------'+roomnolinkArr[i]);
					}
					if(roomnoArr.includes(playedroomno))
					{
						console.log("if");
					}
					else
					{
						if(playedroomno != '')
						{
							location.reload();
						}
						console.log("else");
					}
					
					$('.kl_webcamyes').empty();
                    	var helplink = '{{route('griffin.contactus')}}';
					 $('.kl_webcamyes').append("<div class='col-md-12'><p>If you are having issues with the webcam feed, please try the following:  </p><ol><li>Fully reboot the device that you are using to view the webcam feed and try again.</li><li>Try deactivating any VPN's that you have active on your device, as they may impact the feed connection. </li><li>If you are on a mobile phone, try turning off wifi and then attempting to view the webcam feed again. </li></ol><p>If none of these steps help resolve the issue you are facing, please fill out the <a href='"+helplink+"'>HELP FORM</a> to notify our staff that you need additional support. </p></div> "); 	
				}
				else
				{
				    $("#video").hide();
					$('.kl_webcam').empty();
					$('.kl_webcamyes').empty();
                    var htmltemp = '<p>The webcam feature becomes available once you fully check in at Griffin Rock Cat Retreat at the start of your reservation.  If you have not checked in yet, please come back after check-in to view the live webcam feature. </p></div> ';
					 $('.kl_webcam').append(htmltemp); 
				}
			},
		});

	},300000);
	
	// microphone control addition
	var micmute = 1;
	function hasMicTrack(){
		return pc.getSenders()[0].track !== null;
	}
	function enableMic(){
		if(hasMicTrack()){
			pc.getSenders()[0].track.enabled = true;
		}
	}
	function disableMic(){
		if(hasMicTrack()){
			pc.getSenders()[0].track.enabled = false;
		}
	}
	setTimeout(function(){
		(micmute) ? disableMic() : enableMic();
	},300);
	setInterval(function(){
		if(micmute){
			disableMic();
		} else {
			enableMic();
		}
	},1200);	
			
     //setPlayerSource('rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c1/s0/live');
</script>
@endpush
