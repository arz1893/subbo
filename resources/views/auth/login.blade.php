@extends('layouts.app')

@section('content')
    <div id="login_container">
        <div class="section"></div>
        <main>
            <center>
                <h5 class="indigo-text">Please, login into your account</h5>

                {{--<img id="get_country_loader" src="{{ asset('images/default/loading-icon.gif') }}" width="150">--}}

                <div class="container">
                    <div class="row" style="display: inline-block; padding: 32px 48px 0px 48px;">

                        <form class="col s12 m12 l12 " role="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class='row'>
                                <div class='input-field col s12 {{ $errors->has('email') ? ' has-error' : '' }}'>
                                    <input id="email" name="email" type="email" class="validate blue-grey-text" value="{{ old('email') }}" placeholder="E-Mail">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong class="red-text">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class='row'>
                                <div class='input-field col s12'>
                                    <input id="password" name="password" type="password" class="validate blue-grey-text" placeholder="Password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong class="red-text">{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <label style='float: right;'>
                                    <a class='pink-text' href='#!'><b>Forgot Password?</b></a>
                                </label>
                            </div>

                            <br />
                            <center>
                                <div class='row'>
                                    <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect cyan darken-2'>Login</button>
                                </div>
                            </center>
                        </form>
                    </div>
                </div>
                don't have an account ? register <a href="{{ route('register') }}">here</a> <br> <br>

                <div class="row center">
                    <div class="col s5 m5 l5"><hr></div>
                    <div class="col s2 m2 l2">or</div>
                    <div class="col s5 m5 l5"><hr></div>
                </div>

                <a href="{{url('auth/facebook')}}" class="btn blue darken-2 white-text">
                    <i class="fa fa-facebook" aria-hidden="true"></i> |
                    Facebook
                </a>
            </center>

            <div class="section"></div>
            <div class="section"></div>
        </main>

    </div>

    @include('footer')


@endsection
