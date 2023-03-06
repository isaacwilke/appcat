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
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Reservations</h6>
                            </div>
                            <div class="col-md-6 text-end">
                              
                                    {{-- <button type="button" class="btn btn-blue" name="status" id="btn_name" value="All" onclick="document.getElementById('myForm').submit();">All</button> --}}
                                    @if(Session::get('Status')=="All")
                                    <a  class="btn btn-filter" name="status" id="btn_name" href="{{route('home',['status'=>'All'])}}">All</a>
                                    @else
                                     <a  class="btn btn-blue" name="status" id="btn_name" href="{{route('home',['status'=>'All'])}}">All</a>
                                    @endif
                                    @if(Session::get("Status")=='Current')
                                    <a  class="btn btn-filter" name="status" id="btn_class" value="Current" href="{{route('home',['status'=>'Current'])}}">Current</a>
                                    @else
                                    <a  class="btn btn-blue" name="status" id="btn_class" value="Current" href="{{route('home',['status'=>'Current'])}}">Current</a>
                                    @endif
                                    @if(Session::get('Status')=="Past")
                                    <a  class="btn btn-filter" name="status" id="btn_tag" value="Past" href="{{route('home',['status'=>'Past'])}}">Past</a>
                                    @else
                                    <a  class="btn btn-blue" name="status" id="btn_tag" value="Past" href="{{route('home',['status'=>'Past'])}}">Past</a>
                                    @endif
                                  
                                 

                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            TO </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            From</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No of Rooms</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            status</th>

                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($filterBooking))
                                        @foreach ($filterBooking as $filterBookings)
                                            <tr>
                                                <td class="text-center">
                                               
                                                    {{ Carbon\Carbon::parse($filterBookings['check_in'])->format('m-d-Y')}}
                                                </td>
                                                <td class="text-center">
                                               
                                                    {{ Carbon\Carbon::parse($filterBookings['check_out'])->format('m-d-Y') }}
                                                </td>

                                                <td class="text-center">
                                                    {{ $filterBookings['no_of_rooms'] }}
                                                </td>
                                                <td class="text-center">
                                               
                                                    {{ucfirst($filterBookings['status']) }}
                                                </td>

                                                {{-- <td class="text-center">
                                                    {{$bookings['received_on']}}
                                                </td> --}}
                                                <td>
                                                    <a href="{{ route('griffin.bookingsview', ['id' => $filterBookings['unique_id']]) }}"
                                                        class="btn btn-blue">
                                                        View
                                                    </a>

                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                    

                                        <tr>
                                            <td colspan="5" class="text-center">
                                                No Records Found
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




       

    </div>
        @include('layouts.footers.auth.footer')
@endsection

@push('js')
    <script></script>
@endpush
