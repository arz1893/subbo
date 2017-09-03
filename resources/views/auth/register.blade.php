@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="center">
                <h4>Create an account</h4>
            </div>
            <div class="center">
                or <a href="{{ route('login') }}">login</a>
            </div>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="input-field{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Name</label>

                <input id="name" type="text" class="browser-default" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="input-field">
                <input type="tel" id="phone_number" name="phone_number" placeholder="Phone Number (optional)" value="{{ old('phone_number') }}">
            </div>

            <div class="input-field {{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="input-field">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                <input id="password-confirm" type="password" class="validate" name="password_confirmation" required>
            </div>

            <div class="row">
                <div class="left">
                    <div class="col s12">
                        <input type="checkbox" class="filled-in" id="filled-in-box" />
                        <label for="filled-in-box">
                            I agree to <a href="#!">Subbo terms</a>
                        </label>
                    </div>
                </div>
                <div class="right">
                    <div class="col s12">
                        <button type="submit" class="btn blue">
                            Register
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="row center">
            <div class="col s5 m5 l5"><hr></div>
            <div class="col s2 m2 l2">or</div>
            <div class="col s5 m5 l5"><hr></div>
        </div>

        <div class="row">
            <a href="{{url('auth/facebook')}}" class="btn blue darken-2 white-text col s12">
                <i class="fa fa-facebook" aria-hidden="true"></i> |
                Facebook
            </a>
        </div>
    </div>

    @include('footer')
@endsection
