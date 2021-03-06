<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/subboicon.png') }}">

    @stack('meta-tags')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Subbo</title>

    <!-- Materialize CSS -->
    <link rel="stylesheet" href="{{ asset('css/materialize/materialize.min.css') }}">
    <!-- Fonts -->
    <link href="{{ asset('css/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Datatables css -->
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Selectize css -->
    <link href="{{ asset('css/selectize/selectize.css') }}" rel="stylesheet">
    <!-- Dropzone css -->
    <link href="{{ asset('css/dropzone/dropzone.css') }}" rel="stylesheet">
    <!-- Viewer css -->
    <link href="{{ asset('css/viewer/viewer.css') }}" rel="stylesheet">
    <!-- Venobox css -->
    <link href="{{ asset('css/venobox/venobox.css') }}" rel="stylesheet">
    <!-- Tel input css -->
    <link href="{{ asset('css/tel-input/intlTelInput.css') }}" rel="stylesheet">
    <!-- Application stylesheet -->
    <link href="{{ asset('css/custom/mycss.css') }}" rel="stylesheet">
    <!-- Device Compatibility css -->
    <link href="{{ asset('css/custom/media-screen.css') }}" rel="stylesheet">
    <!-- Page Specific Stylesheet -->
    @stack('stylesheet')

</head>
<body onload="urlChecking()">
<!-- Facebook SDK -->
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=277825625980540';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!-- Twitter SDK -->
<script type="text/javascript" async src="https://platform.twitter.com/widgets.js"></script>
<!-- Paypal sdk -->
<script src="https://www.paypalobjects.com/api/checkout.js"></script>


<nav>
    <div class="nav-wrapper cyan darken-2">
        @if(Route::currentRouteName() == 'album.show')
            <div class="brand-logo center" id="bread-nav">
                <a href="{{ route('album.index') }}" class="breadcrumb white-text">
                    <i id="homeBrand" class="fa fa-home"></i>
                </a>
                <a href="{{ route('album.show', $album->id) }}" class="breadcrumb text-limiter">
                    {{ $album->title }}
                </a>
            </div>
        @elseif(Route::currentRouteName() == 'create_album' && !Auth::guest())
            <div class="brand-logo center" id="bread-nav">
                <div class="row">
                    <a href="{{ route('album.index') }}" class="breadcrumb white-text">
                        <i id="homeBrand" class="fa fa-home"></i>
                    </a>
                    <a href="#!" class="breadcrumb text-limiter">
                        New Album
                    </a>
                </div>
            </div>
        @elseif(Route::currentRouteName() == 'album.edit' && !Auth::guest())
            <div class="brand-logo center" id="bread-nav">
                <a href="{{ route('album.index') }}" class="breadcrumb white-text">
                    <i id="homeBrand" class="fa fa-home"></i>
                </a>
                <a href="{{ route('album.edit', $album->id) }}" class="breadcrumb text-limiter">
                    Edit Album
                </a>
            </div>
        @elseif(Route::currentRouteName() == 'showcase_album')
            <div class="brand-logo center" id="bread-nav">
                @if($status)
                    <a href="{{ route('order_history', Auth::user()) }}" class="breadcrumb white-text">
                        <i id="homeBrand" class="fa fa-object-group"></i>
                    </a>
                    <a href="#!" class="breadcrumb text-limiter">
                        {{ $album->title }}
                    </a>
                @else
                    <a href="#!"
                       id="showcase-title"
                       class="tooltipped"
                       data-position="bottom"
                       data-delay="50"
                       data-tooltip="{{ $album->title }}">
                        {{ $album->title }}
                    </a>
                @endif
            </div>
        @elseif(Route::currentRouteName() == 'guest_showcase')
            <div class="brand-logo center white-text">
                <a href="#!"
                   id="guest-brand"
                   class="tooltipped"
                   data-position="bottom"
                   data-delay="50"
                   data-tooltip="{{ $album->title }}">
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
                <a href="{{ route('guest_showcase', $album->id) }}" class="breadcrumb white-text">
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
        @elseif(Route::currentRouteName() == 'user_download' && !Auth::guest())
            <div class="brand-logo center">
                <a href="{{ route('sold_album', Auth::user()) }}" class="breadcrumb white-text">
                    <i id="homeBrand" class="fa fa-area-chart" aria-hidden="true"></i>
                </a>
                <a href="#!" class="breadcrumb text-limiter">
                    View all user
                </a>
            </div>
        @elseif(Route::currentRouteName() == 'show_sales' && !Auth::guest())
            <div class="brand-logo center" id="sales-nav">
                <a href="#!">Sales</a>
            </div>
        @elseif(Route::currentRouteName() == 'order_history' && !Auth::guest())
            <div class="brand-logo center" id="history-nav">
                <a href="#!">Purchased</a>
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
                    <a href="#!" class="dropdown-button white-text" data-activates="dropdown_album_pc">
                        <i class="fa fa-camera-retro" aria-hidden="true"></i>
                        Album
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>

                <ul id="dropdown_album_pc" class="dropdown-content">
                    <li>
                        <a href="{{ route('album.index') }}" class="black-text">
                            My Album
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('order_history', Auth::user()) }}" class="black-text">
                            Purchased
                        </a>
                    </li>
                </ul>
                {{--<li>--}}
                {{--<a href="{{ url('/home') }}" class="white-text">--}}
                {{--<i class="fa fa-home" aria-hidden="true"></i> Home--}}
                {{--</a>--}}
                {{--</li>--}}
            </ul>
        @endif
        <ul class="right hide-on-med-and-down">
            @if(Auth::guest())
                <li>
                    <a href="{{ route('login') }}">
                        <i class="fa fa-sign-in"></i> Login
                    </a>
                </li>
                <li>
                    <a href="{{ route('register') }}">
                        <i class="fa fa-user-plus"></i> Register
                    </a>
                </li>
            @else
                <li>
                    <a class="dropdown-button white-text" href="#!" data-activates="walletdrop">
                        &nbsp; &nbsp; &nbsp; &nbsp; <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                        My Wallet
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>

                <ul id="walletdrop" class="dropdown-content col m4">
                    <a href="{{ route('show_sales', Auth::user()) }}" class="black-text">
                        <i class="fa fa-dollar" aria-hidden="true"></i> Sales
                    </a>

                    <a href="{{ route('sold_album', Auth::user()) }}" class="black-text">
                        <i class="fa fa-area-chart" aria-hidden="true"></i> Sold album
                    </a>
                </ul>

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

                    <ul id="dropdown1" class="dropdown-content" style="width: 200px">
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
                </li>

                <!-- Dropdown Trigger -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @endif

        </ul>
        <ul class="side-nav" id="mobile-demo">
            @if(Auth::guest())
                <li>
                    <a href="{{route('login')}}" class="black-text">
                        <i class="fa fa-sign-in" aria-hidden="true"></i> Login
                    </a>
                </li>
                <li>
                    <a href="{{route('register')}}" class="black-text">
                        <i class="fa fa-user-circle" aria-hidden="true"></i> Register
                    </a>
                </li>
            @else
                <li>
                    <a class="dropdown-button" data-activates="dropdown_album-mobile">
                        <i class="fa fa-camera-retro" aria-hidden="true"></i>
                        Albums
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>

                    <ul id="dropdown_album-mobile" class="dropdown-content">
                        <li>
                            <a href="{{ route('album.index') }}" class="black-text">
                                My Album
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('order_history', Auth::user()) }}" class="black-text">
                                Purchased
                            </a>
                        </li>
                    </ul>

                    {{--<a href="{{ url('/home') }}" class="black-text">--}}
                    {{--<i class="fa fa-home" aria-hidden="true"></i> Home--}}
                    {{--</a>--}}

                    <a class="dropdown-button" data-activates="dropdown_sales">
                        <i class="fa fa-usd" aria-hidden="true"></i>
                        Sales
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>

                    <ul id="dropdown_sales" class="dropdown-content">
                        <li>
                            <a href="{{ route('show_sales', Auth::user()) }}" class="black-text">
                                My Wallet
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sold_album', Auth::user()) }}" class="black-text">
                                Sold album
                            </a>
                        </li>
                    </ul>

                    <a href="{{ route('account_setting', Auth::user()) }}">
                        <i class="fa fa-cogs" aria-hidden="true"></i> Account Setting
                    </a>

                    <a href="#!">
                        <i class="fa fa-question-circle-o" aria-hidden="true"></i> Help / FAQ
                    </a>

                    <a class="dropdown-button profile-name-limiter" href="#!" data-activates="dropdown_user">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        {{Auth::user()->name}}
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>

                    <ul id="dropdown_user" class="dropdown-content">
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

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
            @endif
        </ul>
    </div>
</nav>


@yield('content')

<!-- Jquery js -->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<!-- Vue js -->
<script src="{{ asset('js/vue/vue.min.js') }}" type="text/javascript"></script>
<!-- Materialize js -->
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<!-- Dropzone js -->
<script src="{{ asset('js/dropzone/dropzone.js') }}" type="text/javascript"></script>
<!-- Selectize js -->
<script src="{{ asset('js/selectize/selectize.min.js') }}" type="text/javascript"></script>
<!-- Jquery Validation -->
<script src="{{ asset('js/jquery_validation/jquery.validate.js') }}" type="text/javascript"></script>
<!-- Viewer js -->
<script src="{{ asset('js/viewer/viewer.js') }}" type="text/javascript"></script>
<!-- Venobox js -->
<script src="{{ asset('js/venobox/venobox.js') }}" type="text/javascript"></script>
<!-- Tel input js -->
<script src="{{ asset('js/tel-input/intlTelInput.js') }}" type="text/javascript"></script>
<!-- Datatable js -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<!-- Twitter widget js -->
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<!-- Application javascript -->
<script src="{{ asset('js/custom/myjs.js') }}" type="text/javascript"></script>
<!-- Function javascript -->
<script src="{{ asset('js/custom/function.js') }}"></script>
<!-- Form validation js -->
<script src="{{ asset('js/custom/form_validation.js') }}" type="text/javascript"></script>
<!-- Specific Page Script -->
@stack('page-script')

</body>
</html>
