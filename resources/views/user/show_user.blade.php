@extends('home')

@section('main')
    <div class="center">
        <br/><br/>

        @if($user->avatar != null)
            <img src="{{$user->avatar}}"
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

    <div class="container">

        <h5 class="blue-grey-text">Name : </h5>
        <div>
            {{ $user->name }}
            <a href="#modal_edit_profile">
                <i class="fa fa-pencil-square fa-lg"></i>
            </a>
        </div>

        <h5 class="blue-grey-text">About : </h5>
        <div>
            {{ $user->about }}
            <a href="#modal_edit_profile">
                <i class="fa fa-pencil-square fa-lg"></i>
            </a>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="modal_edit_profile" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Edit your information</h4> <br>
            {{ Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user], 'id' => 'user-form']) }}
                @include('layouts.user.user_form')
            {{ Form::close() }}
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" onclick="$('#user-form').submit();">Update</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
        </div>
    </div>

@endsection