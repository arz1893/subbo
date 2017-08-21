@extends('home')

@section('main')
    <div id="add_album_container" style="">

        <p class="red-text" align="center" id="dz-error-message"></p>
        @include('errors.errorlist')
        {!! Form::open(['action' => 'AlbumController@store', 'files' => true, 'id' => 'album-form-ios']) !!}
        {{ Form::hidden('id', $album->id) }}
        @include('layouts.album.albumform')
        {!! Form::close() !!}

        <div class="container" id="dropzone_container">
            <span style="font-size: 1.2em">Add Image</span> <br>
            <a class="waves-effect waves-light blue lighten-2 btn btn-add-image-ios">
                <i class="fa fa-plus-square"></i>
            </a> <br> <br>

            {!! Form::open(['action' => ['AlbumController@uploadImageIos'], 'class' => 'dropzone', 'files' => true, 'id'=>'upload-image-ios', 'style' => 'display:none']) !!}
                {{ Form::hidden('album_id', $album->id, ['id' => 'album_id']) }}
            {!! Form::close() !!}

            {{ Form::hidden('is_image', 0, ['id' => 'is_image']) }}

            <br>

            <div class="row">
                <button id="btnSubmitImageIos" type="submit" class="btn-large waves-effect teal lighten-1" style="width: 100%;">
                    Create album
                </button>
            </div>
        </div>
    </div>
@endsection