<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
   <style>

   </style>
</head>
<body>
    <div class="container">
        @if (Session::has('one') && Session::has('user'))
                @php $user = Session::get('user');@endphp
                <div class="text-center">
                <img src="{{public_path('argon/img/W&S_logo_login.jpg')}}" class="center" alt="main_logo"/>
                </div>
             <h2 class="text-center mt-5 mb-3">Transactions</h2>
           
             <p class='text-center'>Full Name: <span>{{$user['first_name']}} {{$user['last_name']}}</span></p>
             <p class='text-center'>Transaction ID: <span>{{$payment['arm_transaction_id']}} </span></p>
             <p class='text-center'>Plan Name: <span> {{$payment['arm_plan']}}   </span></p>
             <p class='text-center'>Payment Type: <span>{{$payment['arm_payment_type']}} </span></p>
             <p class='text-center'>Amount: <span>{{html_entity_decode($payment['arm_paid_amount'], ENT_QUOTES, "UTF-8")}} </span></p> 
               @php
                $d=strtotime($payment['arm_payment_date']);
                $date = date("m-d-Y", $d)@endphp
             <p class='text-center'>Payment Date: <span> {{$date}}  </span></p>       
              <p class='text-center'>  Payment Status: <span> {{$payment['arm_payment_status']}}  </span></p>      
                

        @endif
            
      
       
       
       
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>