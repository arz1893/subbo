@extends('home')
@section('main')
    <div class="container">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="http://subboapp2.esy.es/showcatalog/{{$album->id}}">
        <meta name="twitter:title" content="{{$album->title}}">
        <meta name="twitter:description" content="{{$album->description}}">
        <br/><br/>

        @if(\Session::has('message'))
            <div class="col s12">
                <div class="chip center green white-text" id="notifChip">
                    {{ \Session::get('message') }}
                    <i class="close material-icons">close</i>
                </div>
            </div>
        @endif

        {{--<h3 class="center blue-grey-text">{{$album->title}}</h3>--}}

        @foreach($imageThumbnails as $imageThumbnail)
            @if($imageThumbnail->id == $album->album_cover_id)
                <div class="col s12 m4 l4">
                    <img src="{{ asset($imageThumbnail->thumbnail_path) }}" width="100%">
                </div>
            @endif
        @endforeach

        @if($album->is_published == 0)
            <a
                    href="#popUpSetPublish"
                    data-id="{{$album->id}}"
                    class="col s12 m4 l5 btn green modal-trigger"
                    style="width: 100%;"
                    onclick="setPublishTargetAlbum(this)">
                Publish <i class="fa fa-check" aria-hidden="true"></i>
            </a>
            <a  href="#popUpDeleteAlbum"
                class="btn waves-effect waves-light red modal-trigger"
                data-id="{{$album->id}}"
                style="width: 100%"
                onclick="setDeleteTargetAlbum(this)">
                Delete Album <i class="fa fa-trash"></i>
            </a>
            <a href="{{ route('album.edit', $album) }}"
               class="btn waves-effect waves-light amber modal-trigger"
               style="width: 100%">
                Edit Album <i class="fa fa-pencil-square"></i>
            </a>
        @else
            <a
                    href="#popUpSetUnpublish"
                    data-target="#popUpSetUnpublish"
                    data-id="{{$album->id}}"
                    class="btn waves-effect waves-light blue-grey modal-trigger"
                    style="width: 100%"
                    onclick="setUnpublishTargetAlbum(this)">
                Unpublish <i class="fa fa-power-off" aria-hidden="true"></i>
            </a>
            <a  href="#popUpDeleteAlbum"
                class="btn waves-effect waves-light red modal-trigger"
                data-id="{{$album->id}}"
                style="width: 100%"
                onclick="setDeleteTargetAlbum(this)">
                Delete Album <i class="fa fa-trash"></i>
            </a>
        @endif

        <ul class="collapsible" data-collapsible="accordion">
            <li>
                <div class="collapsible-header"><i class="material-icons">comment</i>Content</div>
                <div class="collapsible-body">
                    <p align="justify">{!! nl2br(html_entity_decode($album->description)) !!}</p>
                </div>
            </li>
        </ul>

        <p class="flow-text">
        @if($album->price == 0)
            <h5 class="green-text">Free to download</h5>
        @else
            <h5 class="red-text darken-1">Price : <?php echo "Rp " . number_format( $album->price , 2 , ',', '.' ); ?></h5>
            @endif
            </p>

            @unless($album->categories->isEmpty())
                <h5>Category : </h5>
                <ul>
                    @foreach($album->categories as $category)
                        <div class="chip">
                            <img src="{{ asset('images/default/' . $category->image) }}">
                            {{ $category->category_name }}
                        </div>
                    @endforeach
                </ul>
            @endunless

            <div class="row">

                @if($album->is_published == 1)
                    <ul class="image-viewer">
                        @foreach($imageThumbnails as $imageThumbnail)
                            <li>
                                <img src="{{ asset($imageThumbnail->thumbnail_path) }}"
                                 class="col s4 m2 l2 image-thumbnails" height="75px">
                            </li>
                        @endforeach
                    </ul>

                @else
                    @foreach($imageThumbnails as $imageThumbnail)
                        @if($imageThumbnail->id == $album->album_cover_id)
                            <div class="col s12 m4 l4">
                                <div class="card">
                                    <div class="card-image">
                                        <a href="#!" onclick="Materialize.toast('Already a cover image', 2000)" >
                                            <img src="{{asset($imageThumbnail->thumbnail_path)}}" height="300">
                                            <span class="card-title">
                                                <h4>Album Cover</h4>
                                            </span>
                                        </a>
                                    </div>
                                    {{--<div class="card-content">--}}
                                        {{--<a  href="#popUpDeleteImage" class="red-text modal-trigger"--}}
                                            {{--data-id="{{$imageThumbnail->id}}" onclick="setDeleteTarget(this)">--}}
                                            {{--Delete <i class="fa fa-trash" aria-hidden="true"></i>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        @else
                            <div class="col s12 m4 l4">
                                <div class="card">
                                    <div class="card-image">
                                        <a href="#popUpConfirm" class="modal-trigger" data-target="#popUpConfirm"
                                           data-id="{{$imageThumbnail->id}}" onClick="selectCover(this);">
                                            <img src="{{asset($imageThumbnail->thumbnail_path)}}" height="300">
                                        </a>
                                    </div>
                                    {{--<div class="card-content">--}}
                                        {{--<a  href="#popUpDeleteImage" class="red-text modal-trigger"--}}
                                            {{--data-id="{{$imageThumbnail->id}}" onclick="setDeleteTarget(this)">--}}
                                            {{--Delete <i class="fa fa-trash" aria-hidden="true"></i>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

            </div>
            @include('layouts.popup.popup')
    </div>
@endsection