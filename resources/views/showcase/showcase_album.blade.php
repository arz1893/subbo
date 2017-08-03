@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top: 5%">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="http://subboapp2.esy.es/showcatalog/{{$album->id}}">
        <meta name="twitter:title" content="{{$album->title}}">
        <meta name="twitter:description" content="{{$album->description}}">

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

        <!-- Page Contents -->
        <div class="page animated fadeinup">

            <!-- Hero Header -->
            <div class="hero-header animated fadein">
                <!-- Slider -->
                <div class="swiper-container swiper-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="#!">
                                @foreach($imageThumbnails as $imageThumbnail)
                                    @if($imageThumbnail->id == $album->album_cover_id)
                                        <div class="col s12 m4 l4">
                                            <img src="{{ asset($imageThumbnail->thumbnail_path) }}" width="100%">
                                        </div>
                                    @endif
                                @endforeach
                            </a>
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
                <!-- End of Slider -->

                <!-- Floating Action Button -->
                @if($status == true)
                    <a href="{{ route('show_download', $album) }}" class="btn grey" style="width: 100%">
                        Download <i class="fa fa-download" aria-hidden="true"></i>
                    </a>
                @else
                    <a href="{{ route('show_payment', $album) }}" class="btn amber" style="width: 100%">
                        Purchase <i class="fa fa-cart-plus"></i>
                    </a>
                @endif
            </div>

            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <div class="collapsible-header"><i class="fa fa-question-circle-o"></i>Album's info</div>
                    <div class="collapsible-body">
                        <!-- Product Title -->
                        <div class="center-align p-20">
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
                            <h4 class="m-0"><strong>{{ $album->title }}</strong></h4>
                            <h4>{{ $currency->code . " " .number_format( $album->price , 2 , ',', '.' ) }}</h4>
                            <p class="flow-text" style="text-align: justify;">
                                <span><b>Description: </b></span><br>
                                {{ $album->description }}
                            </p>
                        </div>
                    </div>
                </li>
            </ul>

            <div class="row">
                <ul>
                    @foreach($imageThumbnails as $imageThumbnail)
                        <li>
                            <img src="{{ asset($imageThumbnail->thumbnail_path) }}" class="col s4 m2 l2 image-thumbnails" height="75px">
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection