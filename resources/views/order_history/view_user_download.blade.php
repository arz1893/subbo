@extends('home')

@section('main')
    <div class="container">
        <h5>Peoples who download your album</h5>
        <hr>

        @foreach($viewUsers as $viewUser)
            <ul class="collection">
                <li class="collection-item avatar">
                    @if($viewUser->provider_id == null)
                        <img src="{{ asset('profile_picture/' . $viewUser->avatar) }}" alt="" class="circle">
                    @elseif($viewUser->provider_id != null)
                        <img src="https://graph.facebook.com/v2.8/{{$viewUser->provider_id}}/picture?type=large"
                             id="profilePicture" class="circle">
                    @endif
                    <span class="title">{{ $viewUser->name }}</span>
                    <p>
                        <a href="#!">
                            View user <i class="fa fa-eye"></i>
                        </a>
                    </p>
                    <a href="#!" class="secondary-content"><i class="fa fa-user-plus"></i></a>
                </li>
            </ul>
        @endforeach
    </div>
@endsection