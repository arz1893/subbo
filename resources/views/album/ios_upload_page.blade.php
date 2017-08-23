@extends('home')

@section('main')
    <div id="add_album_container" style="">

        <p class="red-text" align="center" id="dz-error-message"></p>
        @include('errors.errorlist')
        {!! Form::open(['action' => 'AlbumController@store', 'files' => true, 'id' => 'album-form-ios']) !!}
            {{ Form::hidden('id', $album->id) }}
        @include('layouts.album.albumform')
        {!! Form::close() !!}
        <br>

        <div class="container" id="dropzone_container">

            <p class="blue-grey-text">
                *note: maximum 25 image/photo
            </p>

            <span style="font-size: 1.2em;">Add Image</span> <br>
            <a class="waves-effect waves-light blue lighten-2 btn btn-add-image-ios">
                <i class="fa fa-plus-square"></i>
            </a> <br> <br>

            {!! Form::open(['action' => ['AlbumController@uploadImageIos'], 'class' => 'dropzone', 'files' => true, 'id'=>'upload-image-ios', 'style' => 'display:none']) !!}
                {{ Form::hidden('album_id', $album->id, ['id' => 'album_id']) }}
            {!! Form::close() !!}

            {{ Form::hidden('is_image', 0, ['id' => 'is_image']) }}

            <div class="row">
                <a id="upload_validation_button_ios" class="btn-large waves-effect teal lighten-1" style="width: 100%;">
                    Create album
                </a>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="upload_confirm_ios" class="modal">
        <div class="modal-content">
            <h4 class="blue-text text-lighten-2">Info !</h4>
            <p class="flow-text">
                Make sure your album info and images are correct, once you create this album you can't edit images
                that you have been uploaded
            </p>
        </div>
        <div class="modal-footer">
            <button id="btnSubmitImageIos" class="modal-action modal-close waves-effect waves-green btn-flat">Yes</button>
            <button class="modal-action modal-close waves-effect waves-green btn-flat">No</button>
        </div>
    </div>
@endsection