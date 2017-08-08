@extends('home')

@section('main')
    <div id="add_album_container" style="">
        <p class="red-text" align="center" id="dz-error-message"></p>
        @include('errors.errorlist')
        {!! Form::open(['action' => 'AlbumController@store', 'files' => true, 'id' => 'album-form']) !!}
            {{ Form::hidden('id', $album->id) }}
            @include('layouts.album.albumform')
        {!! Form::close() !!}

        <div class="container" id="dropzone_container">
            <span style="font-size: 1.2em">Add Image</span> <br>
            <a class="waves-effect waves-light grey btn btn-add-image">
                <i class="fa fa-plus-square"></i>
            </a> <br> <br>

            {!! Form::open(['action' => ['AlbumController@uploadAllImages'], 'class' => 'dropzone', 'files' => true, 'id'=>'upload-image', 'style' => 'display:none']) !!}
                {{ Form::hidden('album_id', $album->id, ['id' => 'album_id']) }}
            {!! Form::close() !!}

            <br>

            <div class="row">
                <button id="btnSubmitImage" type="button" class="btn-large waves-effect teal lighten-1" style="width: 100%;">
                    Create album
                </button>
            </div>
        </div>
    </div>
@endsection