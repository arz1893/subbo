<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Subbo</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('css/selectize/selectize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dropzone/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('css/viewer/viewer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/mycss.css') }}" rel="stylesheet">
</head>
<body>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=1273185049434795";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    @if(!Auth::guest())
        <ul id="dropdown-album1" class="dropdown-content">
            <li>
                <a href="{{ route('album.index') }}" class="black-text">
                    My album
                </a>
            </li>
            <li>
                <a href="#!" class="black-text">
                    Purchased
                </a>
            </li>
        </ul>

        <ul id="dropdown-album2" class="dropdown-content">
            <li>
                <a href="{{ route('album.index') }}" class="black-text">
                    My album
                </a>
            </li>
            <li>
                <a href="#!" class="black-text">
                    Purchased
                </a>
            </li>
        </ul>

        <ul id="dropdown1" class="dropdown-content" style="width: 200px">
            <li>
                <a href="{{ route('show_as_guest', Auth::user()->id) }}" class="black-text">
                    <i class="fa fa-blind"></i> Guest Preview
                </a>
            </li>
            <li>
                <a href="{{ route('user.show', Auth::user()->id) }}" class="black-text">
                    <i class="fa fa-address-card" aria-hidden="true"></i> Profile
                </a>
            </li>
            <li>
                <a href="{{ route('account_setting', Auth::user()) }}" class="black-text">
                    <i class="fa fa-cogs" aria-hidden="true"></i> Setting
                </a>
            </li>
            <li>
                <a href="{{route('logout')}}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="black-text">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
            </li>
        </ul>

        <ul id="dropdown2" class="dropdown-content">
            <li>
                <a href="{{ route('show_as_guest', Auth::user()->id) }}" class="black-text">
                    Guest Preview
                </a>
            </li>
            <li>
                <a href="{{ route('user.show', Auth::user()->id) }}" class="black-text">
                    Profile
                </a>
            </li>
            <li>
                <a href="{{route('logout')}}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="black-text">
                    Logout
                </a>
            </li>
        </ul>

        <ul id="walletdrop" class="dropdown-content col m4">
            <a href="{{ route('order_history', Auth::user()) }}" class="black-text">
                <i class="fa fa-history" aria-hidden="true"></i> Order History
            </a>

            <a href="{{ route('show_sales', Auth::user()) }}" class="black-text">
                <i class="fa fa-dollar" aria-hidden="true"></i> Sales
            </a>
        </ul>
    @endif

    <nav>
        <div class="nav-wrapper teal lighten-1">
            {{--@if(Route::currentRouteName() == 'album.show' || Route::currentRouteName() == 'album.create' ||--}}
            {{--Route::currentRouteName() == 'album.edit' || Route::currentRouteName() == 'showcase_album')--}}
                {{----}}
            {{--@else--}}
            @if(Route::currentRouteName() == 'album.show')
                <div class="brand-logo center">
                    <a href="{{ route('album.index') }}" class="breadcrumb white-text">
                        <i id="homeBrand" class="fa fa-home"></i>
                    </a>
                    <a href="{{ route('album.show', $album->id) }}" class="breadcrumb text-limiter">
                        {{ $album->title }}
                    </a>
                </div>
            @elseif(Route::currentRouteName() == 'create_album' && !Auth::guest())
                <div class="brand-logo center">
                    <a href="{{ route('album.index') }}" class="breadcrumb white-text">
                        <i id="homeBrand" class="fa fa-home"></i>
                    </a>
                    <a href="#!" class="breadcrumb text-limiter">
                        New Album
                    </a>
                </div>
            @elseif(Route::currentRouteName() == 'album.edit' && !Auth::guest())
                <div class="brand-logo center">
                    <a href="{{ route('album.index') }}" class="breadcrumb white-text">
                        <i id="homeBrand" class="fa fa-home"></i>
                    </a>
                    <a href="{{ route('album.edit', $album->id) }}" class="breadcrumb text-limiter">
                        Edit Album
                    </a>
                </div>
            @elseif(Route::currentRouteName() == 'showcase_album')
                <div class="brand-logo center">
                    <a href="{{ route('show_as_guest', $user->id) }}" class="breadcrumb white-text">
                        <i id="homeBrand" class="fa fa-user-circle"></i>
                    </a>
                    <a href="{{ route('showcase_album', $album->id) }}" class="breadcrumb text-limiter">
                        {{ $album->title }}
                    </a>
                </div>
            @elseif(Route::currentRouteName() == 'add_bank_account' && !Auth::guest())
                <div class="brand-logo center">
                    <a href="{{ route('user.show', Auth::user()->id) }}" class="breadcrumb white-text">
                        <i id="homeBrand" class="fa fa-user-circle"></i>
                    </a>
                    <a href="{{ route('add_bank_account', Auth::user()->id) }}" class="breadcrumb text-limiter">
                        Add bank account
                    </a>
                </div>
            @elseif(Route::currentRouteName() == 'account_setting' && !Auth::guest())
                <div class="brand-logo center">
                    <a href="{{ route('user.show', Auth::user()->id) }}" class="breadcrumb white-text">
                        <i id="homeBrand" class="fa fa-user-circle"></i>
                    </a>
                    <a href="{{ route('account_setting', Auth::user()->id) }}" class="breadcrumb text-limiter">
                        Account Setting
                    </a>
                </div>
            @elseif(Route::currentRouteName() == 'show_payment' && !Auth::guest())
                <div class="brand-logo center">
                    <a href="{{ route('showcase_album', $album->id) }}" class="breadcrumb white-text">
                        <i id="homeBrand" class="fa fa-camera-retro"></i>
                    </a>
                    <a href="{{ route('show_payment', $album->id) }}" class="breadcrumb text-limiter">
                        Payment
                    </a>
                </div>
            @elseif(Route::currentRouteName() == 'show_download' && !Auth::guest())
                <div class="brand-logo center">
                    <a href="{{ route('showcase_album', $album->id) }}" class="breadcrumb white-text">
                        <i id="homeBrand" class="fa fa-camera-retro"></i>
                    </a>
                    <a href="#!" class="breadcrumb text-limiter">
                        Download
                    </a>
                </div>
            @else
                @if(Auth::guest())
                    <a href="{{url('/')}}" class="brand-logo center white-text">Subbo</a>
                @else
                    <a href="{{url('/home')}}" class="brand-logo center white-text">Subbo</a>
                @endif
                {{--<a href="{{url('/')}}" class="brand-logo center white-text">Subbo<i class="large material-icons">polymer</i></a>--}}
            @endif

            <a href="#" data-activates="mobile-demo" class="button-collapse white-text"><i class="fa fa-bars" aria-hidden="true"></i></a>
            @if(!Auth::guest())
                <ul class="left hide-on-med-and-down">
                    <li>
                        <a href="#!" class="white-text dropdown-button" data-activates="dropdown-album1">
                            <i class="fa fa-camera-retro" aria-hidden="true"></i>
                            Album
                            <i class="material-icons right">arrow_drop_down</i>
                        </a>
                    </li>
                    {{--<li>--}}
                        {{--<a href="{{ url('/home') }}" class="white-text">--}}
                            {{--<i class="fa fa-home" aria-hidden="true"></i> Home--}}
                        {{--</a>--}}
                    {{--</li>--}}
                </ul>
            @endif
            <ul class="right hide-on-med-and-down">
                @if(Auth::guest())

                @else
                    <li>
                        <a class="dropdown-button white-text" href="#!" data-activates="walletdrop">
                            &nbsp; &nbsp; &nbsp; &nbsp; <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                            My Wallet
                            <i class="material-icons right">arrow_drop_down</i>
                        </a>
                    </li>

                    {{--<li>--}}
                    {{--<a href="{{route('logout')}}" onclick="event.preventDefault();--}}
                    {{--document.getElementById('logout-form').submit();" class="white-text">--}}
                    {{--<i class="fa fa-sign-out" aria-hidden="true"></i>Logout--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    <li>
                        <a class="dropdown-button right" href="#!" data-activates="dropdown1" style="width: 200px;">
                            {{Auth::user()->name}}
                            <i class="fa fa-user-circle"></i>
                        </a>
                    </li>

                    <!-- Dropdown Trigger -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endif

            </ul>
            <ul class="side-nav" id="mobile-demo">
                @if(Auth::guest())
                    <a href="{{route('login')}}">
                        <i class="fa fa-sign-in" aria-hidden="true"></i> Login
                    </a>

                    <a href="{{route('register')}}">
                        <i class="fa fa-user-circle" aria-hidden="true"></i> Register
                    </a>
                @else
                    <li>
                        <a href="#!" class="dropdown-button" data-activates="dropdown-album2">
                            <i class="fa fa-camera-retro" aria-hidden="true"></i>
                            Album
                            <i class="material-icons right">arrow_drop_down</i>
                        </a>

                        {{--<a href="{{ url('/home') }}" class="black-text">--}}
                            {{--<i class="fa fa-home" aria-hidden="true"></i> Home--}}
                        {{--</a>--}}

                        <a href="{{ route('show_sales', Auth::user()) }}">
                            <i class="fa fa-usd" aria-hidden="true"></i> Sales
                        </a>

                        <a href="{{ route('order_history', Auth::user()) }}" class="black-text">
                            <i class="fa fa-history" aria-hidden="true"></i> Order History
                        </a>

                        <a href="{{ route('account_setting', Auth::user()) }}">
                            <i class="fa fa-cogs" aria-hidden="true"></i> Setting
                        </a>

                        <a href="#!">
                            <i class="fa fa-question-circle-o" aria-hidden="true"></i> Help / FAQ
                        </a>

                        <a class="dropdown-button profile-name-limiter" href="#!" data-activates="dropdown2">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            {{Auth::user()->name}}
                            <i class="material-icons right">arrow_drop_down</i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                @endif
            </ul>
        </div>
    </nav>


    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dropzone/dropzone.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/selectize/selectize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery_validation/jquery.validate.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/viewer/viewer.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/custom/myjs.js') }}" type="text/javascript"></script>
</body>
</html>