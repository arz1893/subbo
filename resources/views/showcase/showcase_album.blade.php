@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top: 5%">
        {{--<meta name="twitter:card" content="summary_large_image">--}}
        {{--<meta name="twitter:site" content="{{ $host . '/showcase/show-album/' . $album->id }}">--}}
        {{--<meta name="twitter:creator" content="{{ Auth::user()->name }}">--}}
        {{--<meta name="twitter:title" content="{{ $album->title }}">--}}
        {{--<meta name="twitter:description" content="{{ $album->description }}">--}}
        {{--@foreach($imageThumbnails as $imageThumbnail)--}}
            {{--@if($album->album_cover_id == $imageThumbnail->id)--}}
                {{--<meta name="twitter:image" content="{{ asset($imageThumbnail->thumbnail_path) }}">--}}
            {{--@endif--}}
        {{--@endforeach--}}

        @if(\Session::has('info'))
            <div class="chip green lighten-1 white-text center" style="width: 100%;">
                Success! {{ \Session::get('info') }}
                <i class="close material-icons">close</i>
            </div>
        @elseif(\Session::has('error'))
            <div class="chip red lighten-1 white-text center" style="width: 100%;">
                Success! {{ \Session::get('error') }}
                <i class="close material-icons">close</i>
            </div>
        @endif
        @if($status == true)
            <div class="row">
                <div class="center">
                    <div class="col s12 m6 l6 offset-m3 offset-l3">
                        <img src="{{ asset($coverImage->image->path) }}" class="responsive-img">
                    </div>
                </div>
            </div>
        @else
            @foreach($imageThumbnails as $imageThumbnail)
                @if($imageThumbnail->id == $album->album_cover_id)
                    <div class="row">
                        <div class="center">
                            <div class="col s12 m6 l6 offset-m3 offset-l3">
                                <img src="{{ asset($imageThumbnail->thumbnail_path) }}" class="responsive-img">
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif


        @if($status == true)
            <div class="row">
                <div class="col s12 m6 l6 offset-m3 offset-l3">
                    <a href="{{ route('show_download', $album) }}" class="btn grey" style="width: 100%">
                        Download <i class="fa fa-download" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col s12 m6 l6 offset-m3 offset-l3">
                    <a href="{{ route('show_payment', $album) }}" class="btn amber" style="width: 100%">
                        Purchase <i class="fa fa-cart-plus"></i>
                    </a>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col s12 m6 l6 offset-m3 offset-l3">
                <ul class="collapsible" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header"><i class="fa fa-question-circle-o"></i>Album's info</div>
                        <div class="collapsible-body">
                            <p>
                                <span>
                                    <b>Creator:</b> <br/>
                                    <a href="{{ route('show_as_guest', $album->user_id) }}">{{ $album->user->name }}</a>
                                </span>
                            </p>
                            <p>
                                <span>
                                    <b>Title:</b> <br/>
                                    {{ $album->title }}
                                </span>
                            </p>
                            <p style="text-align: justify;">
                                <span><b>Description: </b></span><br>
                                {{ $album->description }}
                            </p>
                            <p>
                                <span>
                                    <b>Category:</b> <br/>
                                </span>
                            </p>
                            @unless($album->categories->isEmpty())
                                <ul>
                                    @foreach($album->categories as $category)
                                        <div class="chip">
                                            <img src="{{ asset('images/default/' . $category->image) }}">
                                            {{ $category->category_name }}
                                        </div>
                                    @endforeach
                                </ul>
                            @endunless
                            <p>
                                <span>
                                    <b>Price:</b> <br/>
                                    {{ $currency->code . " " .number_format( $album->price , 2 , ',', '.' ) }}
                                </span>
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">

            @if($status == true)
                <ul class="">
                    @foreach($images as $image)
                        <li>
                            <a class="venobox" data-gall="showcaseGallery" data-overlay="rgba(95,164,255,0.8)" href="{{ asset($image->path) }}">
                                <img src="{{ asset($image->path) }}"
                                     class="col s4 m2 l1 image-thumbnails" height="75px">
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <ul>
                    @foreach($imageThumbnails as $imageThumbnail)
                        <li>
                            <img src="{{ asset($imageThumbnail->thumbnail_path) }}" class="col s4 m2 l2 image-thumbnails">
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection