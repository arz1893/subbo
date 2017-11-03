@extends('home')

@section('main')
    <div class="center">
        <br/><br/>
        @if($user->provider_id != null)
            <img src="https://graph.facebook.com/v2.8/{{$user->provider_id}}/picture?type=large"
                 width="150" height="150" id="profilePicture" class="circle">
        @elseif($user->avatar != null)
            <img src="{{asset('profile_picture/' . $user->avatar)}}"
                 width="150" height="150" id="profilePicture" class="circle">
        @else
            <img src="{{asset('images/default/default-avatar.png')}}"
                 width="150" height="150" id="profilePicture" class="circle">
        @endif
        <h4>{{$user->name}}</h4>
    </div>

    <ul class="collapsible popout" data-collapsible="accordion">
        <li>
            <div class="collapsible-header">About <i class="fa fa-align-left" aria-hidden="true"></i></div>
            <div class="collapsible-body">
                @if(is_null($user->about))
                    <p align="justify">
                        No information has been added yet
                    </p>
                @else
                    {!! html_entity_decode(nl2br($user->about)) !!}
                @endif
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">contact_phone</i>Contact</div>
            <div class="collapsible-body">
                <a href="#!">E-mail creator</a> <br>
                <a href="#!">Call / send message to creator</a>
            </div>
        </li>
    </ul>

    <div class="row">
        @php $counter = 1; @endphp
        @foreach($albums as $album)
            <div class="col s12 m6 l4">
                <div class="card small z-depth-3">
                    <div class="card-image">
                        @if($album->album_cover_id == null)
                            <a href="{{route('guest_showcase', $album->id)}}">
                                <img src="{{asset('images/default/unknown.png')}}">
                            </a>
                        @else
                            @foreach($imageThumbnails as $imageThumbnail)
                                @if($imageThumbnail->id == $album->album_cover_id)
                                    <a href="{{route('guest_showcase', $album->id)}}">
                                        <img src="{{asset($imageThumbnail->thumbnail_path)}}">
                                        <span class="card-title">
                                            {{$album->title}}
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
                           href="https://twitter.com/intent/tweet?text={{ $album->title }}%20&url=http://139.59.101.119/guest/showcase-album/{{ $album->id }}">
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
                        <textarea id="{{ "copy" . $counter }}" class="hide" onfocus="copy_text_address(this)">{{'http://' . $host . '/guest/showcase-album/' . $album->id }}</textarea>
                    </div>
                </div>
            </div>
            @php $counter++; @endphp
        @endforeach
    </div>

    <div class="center">
        @include('layouts.paginator.paginator', ['paginator' => $albums])
    </div>
@endsection