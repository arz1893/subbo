@extends('home')

@section('main')

    {{--<div class="container" style="margin-top: 3%">--}}
        {{--<div id="is_browser"></div>--}}
        {{--<button onclick="getBrowser()" class="btn blue lighten-1">Detect browser</button>--}}
    {{--</div>--}}

    <div id="add_album_container" style="">

        <p class="red-text" align="center" id="dz-error-message"></p>
        @include('errors.errorlist')
        {!! Form::open(['action' => 'AlbumController@store', 'files' => true, 'id' => 'album-form']) !!}
            {{ Form::hidden('id', $album->id) }}
            @include('layouts.album.albumform')
        {!! Form::close() !!}

        <div class="container" id="dropzone_container" style="margin-top: -10px;">
            <span class="blue-grey-text">
                @if($os == 'android')
                    <span class="red-text">For android user, please use file explorer to choose image</span>
                @endif
                <br>
                *note: maximum 25 image/photos
            </span> <br>

            <span style="font-size: 1.2em">Add Image</span> <br>
            <a class="waves-effect waves-light blue lighten-2 btn btn-add-image">
                <i class="fa fa-plus-square"></i>
            </a> <br> <br>

            {!! Form::open(['action' => ['AlbumController@uploadAllImages'], 'class' => 'dropzone', 'files' => true, 'id'=>'upload-image', 'style' => 'display:none']) !!}
                {{ Form::hidden('album_id', $album->id, ['id' => 'album_id']) }}
            {!! Form::close() !!}

            <br>

            <div class="row">
                <button id="upload_validation_button" type="button" class="btn-large waves-effect teal lighten-1" style="width: 100%;">
                    Create album
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="upload_confirm" class="modal">
        <div class="modal-content">
            <h4 class="blue-text text-lighten-2">Info !</h4>
            <p class="flow-text">
                Make sure your album info and images are correct, once you create this album you can't edit images
                that you have been uploaded
            </p>
        </div>
        <div class="modal-footer">
            <button id="btnSubmitImage" class="modal-action modal-close waves-effect waves-green btn-flat">Yes</button>
            <button class="modal-action modal-close waves-effect waves-green btn-flat">No</button>
        </div>
    </div>
@endsection