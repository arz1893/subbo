@extends('home')

@section('main')
    <div class="container">
        <h4 class="blue-grey-text">Choose your album cover</h4>
        <hr>

        {{ Form::open(['action' => ['AlbumController@applyAlbumCover', $album]]) }}
            @foreach($imageThumbnails as $imageThumbnail)
                <div class="inline">
                    <input value="{{ $imageThumbnail->id }}" type="radio" name="image_cover_id" id="{{ $imageThumbnail->id }}" class="input-hidden" />
                    <label for="{{ $imageThumbnail->id }}">
                        <img src="{{ asset($imageThumbnail->thumbnail_path) }}" />
                    </label>
                </div>
            @endforeach
            <br><br>
            {{ Form::submit('Publish album', ['class' => 'btn blue lighten-2', 'style' => 'width: 100%']) }}
        {{ Form::close() }}

    </div>
    @include('layouts.popup.popup')
@endsection