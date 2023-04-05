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
                                     <div class="col-md-12">
										<div class="row kl_webcam">
										<?php
										$roomArr=array();
										$roomArr['1'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c8/s0/live';
										$roomArr['2'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c9/s0/live';
										$roomArr['3'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c6/s0/live';
										$roomArr['4'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c5/s0/live';
										$roomArr['5'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c4/s0/live';
										$roomArr['6'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c3/s0/live';
										$roomArr['7'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c7/s0/live';
										$roomArr['8'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c10/s0/live';
										$roomArr['9'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c11/s0/live';
										$roomArr['10'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c12/s0/live';
										$roomArr['11'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c13/s0/live';
										$roomArr['12'] = 'rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c14/s0/live';
										?>
										<?php if (!empty($booking)){ 
										   // dd($booking);
											$counter = 1;
											foreach ($booking as $bookings){
												if($bookings['status'] == 'confirmed' && strtotime(date('Y-m-d'))  <=  strtotime(date('Y-m-d',strtotime($bookings['check_out']))))
												{
													if($bookings['row_type'] == 'single-room')
													{
														?>
														 <div class="col-md-2 col-sm-6">
															 <button type="button" class="btn btn-blue" 
															 onclick="viewcam('<?php echo $roomArr[$bookings['room_no']]; ?>');">Play Feed - Room <?php echo $bookings['room_no']; ?></button>
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
															 onclick="viewcam('<?php echo $roomArr[$room]; ?>');">Play Feed - Room <?php echo $room; ?></button>
														 </div> 
														<?php
														}
													}
													$counter++;
												}
												
											}
										} 
										?>
                                         
                                       </div>  
                                       </div>  
                                    <div class="col-12 m-auto">
<div id="sourcesNode"></div>

<input id="continuous_file_length" type="hidden"  value="180000" >
<input id="event_file_length" type="hidden"  value="180000" >
<input id="buffer_duration" type="hidden" >
<input id="rate" class="input" type="hidden"  value="1.0" >
<div id="pllogs" class="logs"></div>


<div style="text-align:center">
    
<canvas id="video_canvas" width="0" height="0" style="width:80%;"></canvas>

<div id="vloader" style="display:none;width:80%;min-height:200px;text-align:center;border:2px solid #043F5D;margin: auto;border-radius: 1rem;"><p style="padding-top:80px;color:#043F5D;
    font-weight: 800;">Processing....</p></div>
<video id="test_video" controls autoplay  style="display:none">
<!--<source src="rtsp://192.168.10.205:554/ch01.264" type="application/x-rtsp">-->
<!--<source src="rtsp://wowzaec2demo.streamlock.net/vod/mp4:BigBuckBunny_115k.mov" type="application/x-rtsp">-->
</video>

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
 
<script src="{{ asset('argon/assets/js/libde265.js') }}"></script>
<script src="{{ asset('argon/assets/js/free.player.3.1.js') }}"></script>
<script>

    var scrollStatPl = true;
    var scrollStatWs = true;
    var pllogs = document.getElementById("pllogs");
    var wslogs = document.getElementById("wslogs");

    // define a new console
    var console=(function(oldConsole){
        return {
            log: function(){
                oldConsole.log(newConsole(arguments, "black", "#A9F5A9"));
            },
            info: function () {
                oldConsole.info(newConsole(arguments, "black", "#A9F5A9"));
            },
            warn: function () {
                oldConsole.warn(newConsole(arguments, "black", "#F3F781"));
            },
            error: function () {
                oldConsole.error(newConsole(arguments, "black", "#F5A9A9"));
            }
        };
    }(window.console));

    function newConsole(args, textColor, backColor){
        let text = '';
        let node = document.createElement("div");
        for (let arg in args){
            text +=' ' + args[arg];
        }
        node.appendChild(document.createTextNode(text));
        node.style.color = textColor;
        node.style.backgroundColor = backColor;
       // pllogs.appendChild(node);
       // autoscroll(pllogs);
        return text;
    }

    //Then redefine the old console
    window.console = console;

    function cleanLog(element){
        while (element.firstChild) {
            element.removeChild(element.firstChild);
        }
    }

    function autoscroll(element){
        if(scrollStatus(element)){
            element.scrollTop = element.scrollHeight;
        }
        if(element.childElementCount > 1000){
            element.removeChild(element.firstChild);
        }
    }

    function scrollset(element, state){
        if(state){
            element.scrollTop = 0;
            scrollChange(element, false);
        } else {
            element.scrollTop = element.scrollHeight;
            scrollChange(element, true);
        }
    }

    function scrollswitch(element){
        if(scrollStatus(element)){
            scrollChange(element, false);
        } else {
            scrollChange(element, true);
        }
    }

    function scrollChange(element, status){
        if(scrollStatus(element)){
            scrollStatPl = false;
            document.getElementById("scrollSetPl").innerText = "Scroll on";
        } else {
            scrollStatPl = true;
            document.getElementById("scrollSetPl").innerText = "Scroll off";
        }
    }

    function scrollStatus(element){
        if(element.id === "pllogs"){
            return scrollStatPl;
        } else {
            return scrollStatWs;
        }
    }


</script>

<script>
    if (window.Streamedian) {
        let errHandler = function(err){
            alert(err.message);
        };

        let infHandler = function(inf) {
            let sourcesNode = document.getElementById("sourcesNode");
            let clients = inf.clients;
            sourcesNode.innerHTML = "";

            for (let client in clients) {
                clients[client].forEach((sources) => {
                    let nodeButton = document.createElement("button");
                    nodeButton.setAttribute('data', sources.url + ' ' + client);
                    nodeButton.appendChild(document.createTextNode(sources.description));
                    nodeButton.onclick = (event)=> {
                        setPlayerSource(event.target.getAttribute('data'));
                    };
                    sourcesNode.appendChild(nodeButton);
                });
            }
        };
    
        var link = document.createElement('a');
        let dataHandler = function(data, prefix) {
            let blob = new Blob([data], {type: "application/mp4"});
            link.href = window.URL.createObjectURL(blob);
            link.download = `${prefix}_${formatDate(new Date())}.mp4`;
            link.click();
        }

        let formatHandler = function (format) {
            if (html5Player && html5Canvas) {
                if (format === 'h265') {
                    $("#vloader").hide();
                    html5Player.setAttribute('hidden', true);
                    html5Canvas.removeAttribute('hidden');
                } else if (format === 'h264') {
                    html5Player.removeAttribute('hidden');
                    html5Canvas.setAttribute('hidden', true);
                }
            }
        }

        function formatDate(dateObj) {
            let month = String(dateObj.getMonth() + 1).padStart(2, '0');
            let date = String(dateObj.getDate()).padStart(2, '0');
            let hours = String(dateObj.getHours()).padStart(2, '0');
            let minutes = String(dateObj.getMinutes()).padStart(2, '0');
            let seconds = String(dateObj.getSeconds()).padStart(2, '0');
            return`${dateObj.getFullYear()}-${month}-${date} ${hours}:${minutes}:${seconds}`;
        }

        var playerOptions = {
            socket: "wss://webproxy.griffinrockcatretreat.com:8088/ws/",
            redirectNativeMediaErrors : true,
            bufferDuration: 30,
            errorHandler: errHandler,
            infoHandler: infHandler,
            dataHandler: dataHandler,
            videoFormatHandler: formatHandler,
            continuousFileLength: 180000,
            eventFileLength: 10000,
            canvas: 'video_canvas',
        };

        var html5Player  = document.getElementById("test_video");
        var html5Canvas  = document.getElementById("video_canvas");
        var bufferRange  = document.getElementById("buffer_duration");
        var bufferValue  = document.getElementById("buffer_value");
        var eventRecording = document.getElementById("event_recording");
        var continuousFileLength  = document.getElementById("continuous_file_length");
        var continuousFileLengthLabel  = document.getElementById("continuous_file_length_label");
        var eventFileLength  = document.getElementById("event_file_length");
        var eventFileLengthLabel  = document.getElementById("event_file_length_label");

        var player = Streamedian.player('test_video', playerOptions);
        var nativePlayer = document.getElementById('test_video');
        var range = document.getElementById('rate');
        var range_out = document.getElementById('rate_res');

        var socket;
        var keepAliveTimer;
        var password = btoa('streamedian');

        range.addEventListener('input', function () {
            nativePlayer.playbackRate = range.value;
            range_out.innerHTML = `x${range.value}`;
        });
       
        
        // Tab switching and window minimization processing 
        // for browsers that use the chrome rendering engine.
        if (!!window.chrome) {
            document.addEventListener('visibilitychange', function() {
                if(document.visibilityState === 'hidden') {
                    nativePlayer.pause()
                } else {
                    nativePlayer.play();

                    // Automatic jump to buffer end for view live video when returning to the web page. 
                    setTimeout(function() {
                        nativePlayer.currentTime = nativePlayer.buffered.end(0)
                    }, 3000); // Delay for a few seconds is required for the player has time to update the timeline.
                }
            });
        }

       

       

        bufferRange.innerHTML = player.bufferDuration + "sec.";



        function setPlayerSource(newSource) {
            player.destroy();
            player = null;
            html5Player.src = newSource;
            player = Streamedian.player("test_video", playerOptions);
            player.continuousRecording.record(continuousRecording.checked);
            
            eventRecording.removeAttribute('disabled');
            set_live.removeAttribute('disabled');
        }

        window.addEventListener('unload', function() {
            player.continuousRecording.record(false);
            player.eventRecording.record(false);
        });

        function statisticRequest(cmd) {
            if (socket == undefined || socket.readyState != 1) {
                socket = new WebSocket(playerOptions.socket, "statistic");
                socket.onmessage = onStatistic;
                socket.onopen = function() {
                    socket.send(`WSP/1.1 ${cmd}\nAuthorization: ${password}\nseq: 1\n\n`);

                    keepAliveTimer = setInterval(()=>{
                        socket.send(`WSP/1.1 KEEPALIVE\nAuthorization: ${password}\nseq: 1\n\n`);
                    }, 30000); // Every 30 seconds
                }

                socket.onclose = function() {
                    clearInterval(keepAliveTimer);
                }
            } else {
                socket.send(`WSP/1.1 ${cmd}\nAuthorization: ${password}\nseq: 1\n\n`);
            }
        }

        function onStatistic(msg) {
            if (msg.data.length) {
                let data = msg.data.split('\r\n\r\n');

                if (data.length > 1) {
                    parseStatistic(JSON.parse(data[1]));
                } else {
                    console.log("------------- Info -------------");
                    parseSession(JSON.parse(data[0]));
                }

            }
        };

        function parseSession(session) {
            console.log(`Requested domain: ${session.user.requestedDomain}`);
            console.log(`User address: ${session.user.address}`);
            console.log(`RTSP address: ${session.rtsp.host}:${session.rtsp.port}`);
            console.log(`Session start time: ${new Date(Number(session.connectionTime + '000'))}`);

            if (session.disconnectionTime) {
                console.log(`Session end time: ${new Date(Number(session.disconnectionTime + '000'))}`);
            }

            console.log('---');
        }

        function parseStatistic(data) {
            for (let i = 0; i < data.licenses.length; i++) {
                let license = data.licenses[i].license;
                let sessions = data.licenses[i].sessions;
                let sessionNumber = data.licenses[i].sessionNumber;

                console.log("------------- Info -------------");
                console.log('              License ' + i);
                console.log(`Activation Key: ${license.key}`)
                console.log(`Expires: ${license.expiresAt}`);
                console.log(`License max posible watchers: ${license.maxWatchers}`);
                
                if (license.maxWatchers !== 'unlimited') {
                    console.log(`Remain watchers: ${license.maxWatchers - sessionNumber}`);
                }

                console.log('Sessions:');
                for (let j = 0; j < sessions.length; j++) {
                    parseSession(sessions[j]);
                }
            }
        }

        function getStatistic() {
            statisticRequest('GET_INFO', password);
            socket.onmessage = statisticInfoParse;
        }

        function subscribeStatistic() {
            statisticRequest('SUBSCRIBE', password);
        }
    }
	function viewcam(link)
	{
		//alert(link);
		$("#vloader").show();
		setPlayerSource(link);
	}
     //setPlayerSource('rtsp://viewer:s3cr3tc0d3!@104.180.246.245:554/unicast/c1/s0/live');
</script>
@endpush
