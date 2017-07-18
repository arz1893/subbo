@extends('home')

@section('main')

    @include('errors.errorlist')
    {!! Form::model($album, ['method' => 'PATCH', 'action' => ['AlbumController@update', $album]]) !!}
        @include('layouts.album.withoutupload')
    {!! Form::close() !!}


@endsection