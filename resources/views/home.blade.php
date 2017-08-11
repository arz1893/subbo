@extends('layouts.app')

@section('content')
    <div class="container">
        @if(\Illuminate\Support\Facades\Request::path() == 'home')
            @include('prolog')
        @endif
    </div>

    @yield('main')

    @if(Route::currentRouteName() == 'album.index')
        <div class="fixed-action-btn">
            {{--<a href="{{ route('create_album_first') }}" class="btn-floating btn-large waves-effect waves-light red darken-1">--}}
                {{--<i class="material-icons">add</i>--}}
            {{--</a>--}}
            <a onclick="getOS()" href="#!" class="btn-floating btn-large waves-effect waves-light red darken-1">
                <i class="material-icons">add</i>
            </a>
        </div>
    @endif
@endsection