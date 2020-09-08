<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!--FontAwesome -->
    <script src="https://kit.fontawesome.com/a51364b666.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



</head>
<body>

    <!-- ELEMENTO CHE CI PERMETTE DI PRENDERE DALL TAB USER, L ID CHE DELL'UTENTE LOGGATO, LO INSERIEMO NELL LAYOUT PER AVER IL DATO IN OGNI VIEWS -->
    @if (Auth::check())
         <meta name="user_id" content="{{ Auth::user()->id }}" />
         @else
          <meta name="user_id" content="null" />
    @endif

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="z-index:999;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    <h3 style="color: red;">Eshop <i class="fab fa-laravel"></i>  <i class="fab fa-vuejs"></i> </h3>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto" >
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
                            <li class="nav-item dropdown" id="nav-right">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <!-- COMPONENETE FRATELLO -->
                                <cart-component></cart-component>

                                <!-- se ADMIN compare può accedere al link ADMIN PANEL-->
                                @if(Auth::user()->admin)
                                  <a class="admin-panel btn" href="{{route('admin.products.index')}}">Admin Dashboard</a>
                                @endif


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <!-- passo alla rotta history lo user id per stampare i recond relativi agli order passando dal welcome controller -->
                                    <a class="dropdown-item" href="{{route('history', Auth::user()->id)}}">I tuoi ordini</a>

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


<style leng="scss">
  .py-4 {
    /* background-color: pink; */
    background-image: url('https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Ffg-a.com%2Fwallpapers%2F2018-white-texture-background-image.jpg&f=1&nofb=1');
    /* background-repeat: no-repeat; */
    background-size: auto;

  }

  .admin-panel {
    background-color: white;
    border: 1px solid black;
    padding: 2px;
    border-radius: 3px;
  }

  #nav-right {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;
  }
</style>
