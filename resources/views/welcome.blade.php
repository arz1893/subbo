@extends('layouts.app')

@section('content')
    <div class="parallax-container">
        <div class="center">
            <h4 class="white-text">Monetize Your Camera Roll Now</h4>
            <div style="margin-top: 10%">
                <a href="{{ route('register') }}" class="btn waves-effect cyan darken-2" style="border-radius: 10px;">sign up for free</a> <br> <br>
                <span class="white-text">or </span> <a href="{{ route('login') }}" class="blue-text text-lighten-2">sign in</a>
            </div>
        </div>
        <div class="">
            <div class="parallax"><img src="{{ asset('images/bg1.jpg') }}"></div>
        </div>
    </div>

    @include('footer')

@endsection