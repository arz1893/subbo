@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top: 5%">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="http://subboapp2.esy.es/showcatalog/{{$album->id}}">
        <meta name="twitter:title" content="{{$album->title}}">
        <meta name="twitter:description" content="{{$album->description}}">

        @if(\Session::has('message'))
            <div class="chip green lighten-1 white-text center" style="width: 100%;">
                Success! {{ \Session::get('message') }}
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
                            <h4><?php echo "Rp " . number_format( $album->price , 2 , ',', '.' ); ?></h4>
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
            {{--<!-- Prduct Description -->--}}
            {{--<div class="product-description">--}}
                {{--<ul class="tabs">--}}
                    {{--<li class="tab col s3"><a class="active" href="#product1">Info</a></li>--}}
                    {{--<li class="tab col s3"><a href="#product2">About</a></li>--}}
                {{--</ul>--}}

                {{--<div id="product1" class="p-20">--}}
                    {{--<p class="text-flow">It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.</p>--}}
                {{--</div>--}}
                {{--<div id="product2" class="p-20">--}}
                    {{--<p class="text-flow">what a strenuous career it is that I've chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there's the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!</p>--}}
                {{--</div>--}}
            {{--</div>--}}



        {{--<h5 class="center blue-grey-text">{{$album->title}}</h5>--}}

        {{--@foreach($imageThumbnails as $imageThumbnail)--}}
            {{--@if($imageThumbnail->id == $album->album_cover_id)--}}
                {{--<div class="col s12 m4 l4">--}}
                    {{--<img src="{{ asset($imageThumbnail->thumbnail_path) }}" width="100%">--}}
                {{--</div>--}}
            {{--@endif--}}
        {{--@endforeach--}}

        {{--<a--}}
                {{--href="{{ route('show_payment', $album) }}"--}}
                {{--class="btn amber waves-effect waves-light col s12 m12 l12"--}}
                {{--style="width: 100%">--}}
            {{--Purchase <i class="fa fa-cart-plus"></i>--}}
        {{--</a>--}}
    {{--</div>--}}

    {{--<ul class="collapsible" data-collapsible="accordion">--}}
        {{--<li>--}}
            {{--<div class="collapsible-header"><i class="material-icons">comment</i>Konten</div>--}}
            {{--<div class="collapsible-body">--}}
                {{--Creator : <a href="#!">{{ $user->name }}</a> <br>--}}
                {{--<p align="justify">--}}
                {{--@if($album->price == 0)--}}
                    {{--<h5 class="green-text">Free to download</h5>--}}
                {{--@else--}}
                    {{--@endif--}}
                    {{--</p>--}}

                    {{--@unless($album->categories->isEmpty())--}}
                        {{--<h5>Category : </h5>--}}
                        {{--<ul>--}}
                            {{--@foreach($album->categories as $category)--}}
                                {{--<div class="chip">--}}
                                    {{--<img src="{{ asset('images/default/' . $category->image) }}">--}}
                                    {{--{{ $category->category_name }}--}}
                                {{--</div>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--@endunless--}}

                    {{--<p class="flow-text" style="text-align: justify">{!! nl2br(html_entity_decode($album->description)) !!}</p>--}}
            {{--</div>--}}
        {{--</li>--}}
    {{--</ul>--}}


@endsection