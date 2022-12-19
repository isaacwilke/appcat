@extends('layouts.app', ['class' => 'g-sidenav-show bg-primary'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
@foreach($posts as $post)

    {{ $post->user_email }}<br/>
  
@endforeach


        @include('layouts.footers.auth.footer')
    
@endsection