@extends('home')

@section('main')
    <div class="container">
            <div class="nav-wrapper">
                {{ Form::open(['action' => ['OrderHistoryController@showOrderHistory', Auth::user()]]) }}
                    <div class="input-field">
                        <input id="search_purchased" name="search_purchased" type="search">
                        <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                        <i class="material-icons" onclick="$('#search_purchased').val('')">close</i>
                    </div>

                    <div class="col s6 m6 l6 center">
                        <button type="submit" class="btn blue lighten-3 waves-effect waves-light" style="width: 100%">Search</button>
                    </div>
                {{ Form::close() }}
            </div>
        <div class="row">
            @if(count($purchasedAlbums) == 0)
                <p align="center">We couldn't find anything</p>
            @endif
            @php $counter = 0; @endphp
            @foreach($purchasedAlbums as $purchasedAlbum)
                <div class="col s12 m4 l4">
                    <div class="card small" style="width: 100%">
                        <div class="card-image">
                            @foreach($purchasedAlbum->image_thumbnails as $image_thumbnail)
                                @if($purchasedAlbum->album_cover_id == $image_thumbnail->id)
                                    <a href="{{ route('showcase_album', $purchasedAlbum) }}">
                                        <img src="{{ asset($image_thumbnail->image->path) }}">
                                        <span class="card-title">{{ $purchasedAlbum->title }}</span>
                                    </a>
                                @endif
                            @endforeach

                            <span class="card-title">{{ $purchasedAlbum->title }}</span>
                        </div>
                        <div class="card-content">
                            <button
                                    data-url="{!! 'http://' . $host . '/guest/showcase-album/' . $purchasedAlbum->id !!}"
                                    onclick="facebookShare(this)"
                                    class="btn-floating waves-effect waves-light blue">
                                <i class="fa fa-facebook"></i>
                            </button>

                            <a class="btn-floating waves-effect waves-light blue lighten-2"
                               href="https://twitter.com/intent/tweet?text={{ $purchasedAlbum->title }}&url={!! 'http://'. $host .'/guest/showcase-album/'. $purchasedAlbum->id !!}">
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

                            <a href="{{ route('show_download', $purchasedAlbum) }}" class="btn-floating waves-effect waves-light grey right">
                                <i class="fa fa-download"></i>
                            </a>

                            <textarea id="{{ "copy" . $counter }}" class="hide" onfocus="copy_text_address(this)">{{'http://' . $host . '/guest/showcase-album/' . $purchasedAlbum->id }}</textarea>
                        </div>
                    </div>
                </div>
                @php $counter++; @endphp
            @endforeach
        </div>

        <div class="container">
            <div class="center-align">
                @include('layouts.paginator.paginator', ['paginator' => $purchasedAlbums])
            </div>
        </div>
    </div>
@endsection