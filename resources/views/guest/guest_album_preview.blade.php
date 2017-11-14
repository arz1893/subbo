@extends('layouts.app')
@section('content')
    @push('meta-tags')
    <!-- Facebook Meta Tags -->
    <meta property="fb:app_id" content="277825625980540">
    <meta property="og:url" content="http://{{ $host }}/guest/showcase-album/{{ $album->id }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $album->title }}" />
    <meta property="og:description" content="{{ $album->description }}" />
    <meta property="og:image" content="{{ asset($coverImage->image->path) }}" />
    <meta property="og:image:alt" content="{{ $album->title }}">
    <meta property="oh:image:width" content="350">
    <meta property="oh:image:height" content="350">
    <!-- End of facebook Meta Tags -->

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="http://{{ $host }}/guest/showcase-album/{{ $album->id }}" />
    <meta name="twitter:title" content="{{ $album->title }}" />
    <meta name="twitter:description" content="{{ $album->description }}" />
    <meta name="twitter:image" content="{{ asset($coverImage->thumbnail_path) }}" />
    <!-- End of twitter Meta Tags -->
    @endpush

    <div class="container" style="margin-top: 2%">

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


        <div class="row">
            <div class="col s12 m6 l6 offset-m3 offset-l3">
                <a href="{{ route('show_payment', $album) }}" class="btn amber" style="width: 100%">
                    Purchase <i class="fa fa-cart-plus"></i>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m6 l6 offset-m3 offset-l3">
                <ul class="collapsible" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header"><i class="fa fa-question-circle-o"></i>Album's info</div>
                        <div class="collapsible-body">
                            <b>Creator:</b> <br/>
                            <a>{{ $album->user->name }}</a>
                            <p>
                        <span class="">
                            <b>Title:</b> <br/>
                            {{ $album->title }}
                        </span>
                            </p>
                            <p class="" style="text-align: justify;">
                                <span><b>Description: </b></span><br>
                                {{ $album->description }}
                            </p>
                            <p>
                        <span class="">
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
                        <span class="">
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
            <ul>
                @foreach($imageThumbnails as $imageThumbnail)
                    <li>
                        <img src="{{ asset($imageThumbnail->thumbnail_path) }}" class="col s4 m2 l1 image-thumbnails" height="75px">
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection