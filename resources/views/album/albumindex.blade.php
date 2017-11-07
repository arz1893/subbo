@extends('home')

@section('main')

    <h3 class="center grey-text">Your album list</h3>

    <div class="fixed-action-btn">
        <a id="btnCreateAlbum" href="{{ route('create_album_first') }}" class="btn-floating btn-large waves-effect waves-light red darken-1">
            <i class="material-icons">add</i>
        </a>

        @if(count($albums) == 0)
            <!-- Tap Target Structure -->
            <div class="tap-target" data-activates="btnCreateAlbum">
                <div class="tap-target-content">
                    <h5 class="white-text">Info</h5>
                    <p class="white-text">Click here to create your first album</p>
                </div>
            </div>
        @endif
    </div>

    @if(\Session::has('message'))
        <div class="col s12">
            <div class="chip center green white-text" id="notifChip">
                {{ Session::get('message') }}
                <i class="close material-icons">close</i>
            </div>
        </div>
    @endif

    <div class="row">
        @php $counter = 0; @endphp
        @foreach($albums as $album)
            <div class="col s12 m6 l3">
                <div class="card small" style="width: 100%">
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
                                        <img src="{{asset($imageThumbnail->image->path)}}">
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

                        <button
                           data-url="{!! 'http://' . $host . '/guest/showcase-album/' . $album->id !!}"
                           onclick="facebookShare(this)"
                           class="btn-floating waves-effect waves-light blue">
                            <i class="fa fa-facebook"></i>
                        </button>


                        <a class="btn-floating waves-effect waves-light blue lighten-2"
                           href="https://twitter.com/intent/tweet?text={{ $album->title }}&url={!! 'http://'. $host .'/guest/showcase-album/'.$album->id !!}">
                            <i class="fa fa-twitter"></i>
                        </a>

                        @if($os == 'iOS')
                            <button class="btn-floating waves-effect waves-light blue-grey"
                                    id="btn-share-link-ios"
                                    data-id="{{ $counter }}"
                                    onclick="showCopyUrl(this)">
                                <i class="fa fa-link"></i>
                            </button>
                        @else
                            <button class="btn-floating waves-effect waves-light blue-grey"
                                    id="btn-share-link"
                                    data-id="{{ $counter }}"
                                    onclick="copyLinkAddress(this)">
                                <i class="fa fa-link"></i>
                            </button>
                        @endif

                        @if($album->is_published == 1)
                            <span class="new badge blue right" data-badge-caption="published"></span>
                        @else
                            <span class="new badge red" data-badge-caption="not published"></span>
                        @endif

                        <textarea id="{{ "copy" . $counter }}" class="hide" onfocus="copy_text_address(this)">{{'http://' . $host . '/guest/showcase-album/' . $album->id }}</textarea>

                    </div>

                </div>
            </div>
            @php $counter++; @endphp
        @endforeach
    </div>

    <div class="container">
        <div class="center-align">
            @include('layouts.paginator.paginator', ['paginator' => $albums])
        </div>
    </div>

    @include('layouts.popup.popup')
@endsection