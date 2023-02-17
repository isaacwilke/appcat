<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    
    
   
   
</head>
<body>

<style>
 @font-face {
            font-family: 'Hudson';
            src: url('storage/Hudson.ttf');
            font-weight: 400; 
            font-style: normal;
        }
       
        .pa{
            font-family: 'Hudson';
            
        }
        .font{
         font-family: Arial, Helvetica, sans-serif;
        }

   </style>
    <div class="container">
        @if (Session::has('one') && Session::has('user'))
                @php $user = Session::get('user');@endphp
                <div class="text-center">
                <img src="{{public_path('argon/img/W&S_logo_login.jpg')}}" class="center" alt="main_logo"/>
                </div>
             <p class="text-center mt-5 mb-3 pa ">Transactions</p>
           
             <p class='text-center font text-sm'>Full Name: <span class="font">{{$user['first_name']}} {{$user['last_name']}}</span></p>
             <p class='text-center font'>Transaction ID: <span class='font'>{{$payment['arm_transaction_id']}} </span></p>
             <p class='text-center font'>Plan Name: <span class='font'> {{$payment['arm_plan']}}   </span></p>
             <p class='text-center font'>Payment Type: <span class='font'>{{$payment['arm_payment_type']}} </span></p>
             <p class='text-center font'>Amount: <span class="font">{{html_entity_decode($payment['arm_paid_amount'], ENT_QUOTES, "UTF-8")}} </span></p> 
               @php
                $d=strtotime($payment['arm_payment_date']);
                $date = date("m-d-Y", $d)@endphp
             <p class='text-center font'>Payment Date: <span class="font"> {{$date}}  </span></p>       
              <p class='text-center font'>  Payment Status: <span class="font"> {{$payment['arm_payment_status']}}  </span></p>      
                

        @endif
            
      
       
       
       
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>