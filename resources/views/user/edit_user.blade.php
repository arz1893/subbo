@extends('layouts.app')

@section('content')
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
        <br><br>
        <a href="#!" onclick="$('#select_profile_picture').trigger('click')">
            change profile picture <i class="fa fa-upload"></i>
        </a>
        {{ Form::open(['action' => 'UserController@changeProfilePicture', 'files' => true, 'id' => 'form_upload_profile_picture'])}}
        {{ Form::hidden('user_id', Auth::user()->id) }}
        <input type="file" name="profile_picture" id="select_profile_picture" style="display: none;">
        {{ Form::close() }}
    </div>

    {{ Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id]]) }}
        @include('layouts.user.user_form')
    {{ Form::close() }}
@endsection