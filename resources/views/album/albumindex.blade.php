@extends('home')

@section('main')

    <h3 class="center grey-text">Your album list</h3>

    @if(\Session::has('message'))
        <div class="col s12">
            <div class="chip center green white-text" id="notifChip">
                {{ Session::get('message') }}
                <i class="close material-icons">close</i>
            </div>
        </div>
    @endif

    <div class="row">
        @foreach($albums as $album)
            <div class="col m6 l4">
                <div class="card small">
                    <div class="card-image">
                        @if($album->album_cover_id == null)
                            <a href="{{route('album.show', $album->id)}}">
                                <img src="{{asset('images/default/unknown.png')}}">

                                <span class="card-title">
                                    <h5>{{$album->title}}</h5>
                                </span>
                            </a>
                        @else
                            @foreach($imageThumbnails as $imageThumbnail)
                                @if($imageThumbnail->id == $album->album_cover_id)
                                    <a href="{{route('album.show', $album->id)}}">
                                        <img src="{{asset($imageThumbnail->thumbnail_path)}}">

                                        <span class="card-title">
                                            @if($album->is_published == 1)
                                                <h5>{{$album->title}}</h5>
                                            @else
                                                <h5>{{$album->title}}</h5>
                                            @endif
                                        </span>
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="card-content">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($host . '/showcase/show-album/' . $album->id) }}"
                           target="_blank"
                           class="btn-floating waves-effect waves-light blue">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="#!" class="btn-floating waves-effect waves-light blue lighten-2">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="#!" class="btn-floating waves-effect waves-light purple">
                            <i class="fa fa-instagram"></i>
                        </a>
                        <a href="#!"
                           class="btn-floating waves-effect waves-light blue-grey"
                           id="btn-share-link"
                           data-url="{{ $host . '/showcase/show-album/' . $album->id }}"
                           onclick="copyLinkAddress(this)">
                            <i class="fa fa-link"></i>
                        </a>
                        @if($album->is_published == 1)
                            <span class="new badge blue right" data-badge-caption="published"></span>
                        @else
                            <span class="new badge red" data-badge-caption="not published"></span>
                        @endif
                    </div>

                </div>
            </div>
        @endforeach
    </div>

    @include('layouts.popup.popup')
@endsection