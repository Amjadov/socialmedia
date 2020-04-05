<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
   <script src="{{ asset('js/app.js') }}" ></script>
    <script type="text/javascript" src={{ asset("/js/plugins/loaders/pace.min.js") }}></script>
    <script type="text/javascript" src={{ asset("/js/core/libraries/jquery.min.js") }}></script>
    <script type="text/javascript" src={{ asset("/js/jquery.chained.min.js") }}></script>
    <script type="text/javascript" src={{ asset("/js/core/libraries/bootstrap.min.js") }}></script>
    <script type="text/javascript" src={{ asset("/js/datatables/datatables.min.js") }} ></script>
    <script type="text/javascript" src={{ asset("/js/plugins/forms/selects/select2.min.js") }} ></script>
    <script type="text/javascript" src={{ asset("/js/datatables/extensions/jszip/jszip.min.js") }} ></script>
    <script type="text/javascript" src={{ asset("/js/datatables/extensions/pdfmake/pdfmake.min.js") }} ></script>
    <script type="text/javascript" src={{ asset("/js/datatables/extensions/pdfmake/vfs_fonts.min.js") }} ></script>
    <script type="text/javascript" src={{ asset("/js/datatables/extensions/buttons.min.js") }} ></script>
    <script type="text/javascript" src={{ asset("/js/pages/datatables_extension_buttons_html5.js") }} ></script>
    <script type="text/javascript" src={{ asset("/js/plugins/forms/styling/switchery.min.js") }} ></script>
    <script type="text/javascript" src={{ asset("/js/plugins/forms/styling/switch.min.js") }} ></script>
    <script type="text/javascript" src={{ asset("/js/plugins/forms/styling/uniform.min.js") }} ></script>
    <script type="text/javascript" src={{ asset("/js/plugins/forms/selects/bootstrap_multiselect.js") }} ></script>
    <script type="text/javascript" src={{ asset("/js/pages/form_checkboxes_radios.js") }} ></script>
    <script type="text/javascript" src={{ asset("/js/plugins/forms/validation/validate.min.js") }} ></script>
    <!-- Scripts -->
 

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset("/css/icons/icomoon/styles.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/css/core.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/css/components_2.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/css/colors.css")}}" rel="stylesheet" type="text/css" /
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
