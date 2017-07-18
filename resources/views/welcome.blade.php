@extends('layouts.app')

@section('content')
    <div id="panel1">
        <div class="center" style="padding-top: 15%;">
            <a href="{{ route('register') }}" class="btn waves-effect teal white-text darken-text-2">sign up for free</a> <br> <br>
            <span class="white-text">or </span> <a href="{{ route('login') }}" class="blue-text text-lighten-2">sign in</a>
        </div>
    </div>

    @include('footer')
@endsection