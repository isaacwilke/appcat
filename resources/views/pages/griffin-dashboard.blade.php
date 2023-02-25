@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
      <div id="alert">
        @include('components.alert')
    </div>
        

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Reservations</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            TO  </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            From</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No of Rooms</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            status</th>
                                            {{-- <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Booking Date</th> --}}
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($booking))
                                   
                                        @foreach($booking as $bookings )
                                       
                                            <tr>
                                                <td class="text-center"> 
                                                    {{$bookings['check_in']}}  
                                                </td>
                                                <td class="text-center">
                                                    {{$bookings['check_out']}}   
                                                </td>
                                        
                                                <td class="text-center">
                                                    {{$bookings['no_of_rooms']}}   
                                                </td>
                                                <td class="text-center">
                                                    {{$bookings['status']}} 
                                                </td>
                                        
                                                {{-- <td class="text-center">
                                                    {{$bookings['received_on']}}
                                                </td> --}}
                                                <td>
                                                  <button type="button" class="btn btn-blue" data-id="{{$bookings['unique_id']}}" id ="bookings{{$bookings['unique_id']}}">
                                                    View
                                                    </button>

                                                </td>
                                         
                                            </tr>
                                            

                                        @endforeach  

                                        
                                    @else
                                        <tr >
                                            <td class="text-center"> 
                                                {{" No Records Found"}}   
                                            </td>
                                        </tr>                                    
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade " id="your-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modal-body">
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <p class="text-start text-bolder">checkin_time: <span id="check_in"></span></p>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
               <p class="text-end">checkout_time: <span id="check_out"></span></p>
            </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                     <h1 class="text-center">cat 1 Information</h1>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-start">Cat Name:<span id="cat_name"></span></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-end">Cat Age:<span id="cat_age"></span></p>
                    </div>
                </div>
            </div>

             <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-start">Cat's weight:<span id="cat_weight"></span></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-end">Vaccine & Negative FeLV: <span id="vaccine"></span></p>
                    </div>
                </div>
            </div>

               <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-start">Special Dietary Needs or Restriction? <span id="special_dietary"></span></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-end">Add Special Dietary: <span id="aspecial"></span></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-start">Litter Preferencev: <span id="litter"></span></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-end">Others(Litter): <span id="olitter"></span></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-start">Medication Req: <span id="medication"></span></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-end">List Medications: <span id="lMedication"></span></p>
                    </div>
                </div>
            </div>
              <div class="row">
                <div class="col-md-12">
                     <h1 class="text-center">Owner Information</h1>
                </div>

                </div>
                  <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-start">phone:<span id="phone"></span></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-end">Address Street:<span id="address_street"></span></p>
                    </div>
                </div>
            </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-start">City: <span id="city"></span></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-end">State:<span id="state"></span></p>
                    </div>
                </div>
            </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-start">Zip<span id="zip"></span></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-end">Preferred Method of Contact<span id="preMethod"></span></p>
                    </div>
                </div>
            </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-start">Emergency Contact<span id="Emergency"></span></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-end">Phone<span id="phone2"></span></p>
                    </div>
                </div>
            </div>
            

           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
           
          </div>
        </div>
      </div>
    </div>
  </div>

           
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Sales by Country</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center ">
                            <tbody>
                                <tr>
                                    <td class="w-30">
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div>
                                                <img src="{{asset('argon/img/icons/flags/US.png')}}" alt="Country flag">
                                            </div>
                                            <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">Country:</p>
                                                <h6 class="text-sm mb-0">United States</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                            <h6 class="text-sm mb-0">2500</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Value:</p>
                                            <h6 class="text-sm mb-0">$230,900</h6>
                                        </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <div class="col text-center">
                                            <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                            <h6 class="text-sm mb-0">29.9%</h6>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-30">
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div>
                                                <img src="{{asset('argon/img/icons/flags/DE.png')}}" alt="Country flag">
                                            </div>
                                            <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">Country:</p>
                                                <h6 class="text-sm mb-0">Germany</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                            <h6 class="text-sm mb-0">3.900</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Value:</p>
                                            <h6 class="text-sm mb-0">$440,000</h6>
                                        </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <div class="col text-center">
                                            <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                            <h6 class="text-sm mb-0">40.22%</h6>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-30">
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div>
                                                <img src="{{asset('argon/img/icons/flags/GB.png')}}" alt="Country flag">
                                            </div>
                                            <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">Country:</p>
                                                <h6 class="text-sm mb-0">Great Britain</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                            <h6 class="text-sm mb-0">1.400</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Value:</p>
                                            <h6 class="text-sm mb-0">$190,700</h6>
                                        </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <div class="col text-center">
                                            <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                            <h6 class="text-sm mb-0">23.44%</h6>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-30">
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div>
                                                <img src="{{asset('argon/img/icons/flags/BR.png')}}" alt="Country flag">
                                            </div>
                                            <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">Country:</p>
                                                <h6 class="text-sm mb-0">Brasil</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                            <h6 class="text-sm mb-0">562</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Value:</p>
                                            <h6 class="text-sm mb-0">$143,960</h6>
                                        </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <div class="col text-center">
                                            <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                            <h6 class="text-sm mb-0">32.14%</h6>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Categories</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-mobile-button text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Devices</h6>
                                        <span class="text-xs">250 in stock, <span class="font-weight-bold">346+
                                                sold</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-tag text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Tickets</h6>
                                        <span class="text-xs">123 closed, <span class="font-weight-bold">15
                                                open</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-box-2 text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Error logs</h6>
                                        <span class="text-xs">1 is active, <span class="font-weight-bold">40
                                                closed</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-satisfied text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Happy users</h6>
                                        <span class="text-xs font-weight-bold">+ 430</span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
  </script>
    @if(!empty($booking))
    @foreach($booking as $bookings)

    <script>
   
    $(document).ready(function() {
        $("#bookings{{$bookings['unique_id']}}").click(function(e) {
              var token = '{{ csrf_token() }}';
           e.preventDefault();
          
            $.ajax({
                type: "POST",
                url: "{{route('griffin.bookingsview')}}",
                data: {
                 _token:token,
                id: $(this).attr('data-id'),
                
                },
                success: function(result) {
                    alert(result.success.checkin_time);
                 $('#your-modal').modal('toggle');
                 $("#check_in").html(result.success.checkin_time);
                 $('#check_out').html(result.success.checkout_time);
                 $('#cat_name').html(result.success.cats_name);
                 $("#cat_age").html(result.success.cats_age);
                 $('#cat_weight').html(result.success.cats_weight);
                },
                error: function(result) {
                    alert('error');
                }
            });
        });

    });
   
    
    </script>
    @endforeach
    @endif
@endpush
