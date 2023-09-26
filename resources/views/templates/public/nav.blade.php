<header>
    <!-- Intro settings -->
    <style>
      #intro {
        /* Margin to fix overlapping fixed navbar */
        margin-top: 58px;
      }
      @media (max-width: 991px) {
        #intro {
          /* Margin to fix overlapping fixed navbar */
          margin-top: 45px;
        }
      }
    </style>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <div class="container-fluid">
        <!-- Navbar brand -->
        <a class="navbar-brand" target="_blank" href="https://mdbootstrap.com/docs/standard/">
          <img src="{{ asset('images/logo-genius.png') }}" width="75px" alt="" loading="lazy"
            style="margin-top: -3px;" />
        </a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
          aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarExample01">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item active">
              <a class="nav-link" aria-current="page" href="{{('/')}}"> @lang('nav.home')</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" aria-current="page" href="{{url('artikel-tentang')}}"> @lang('contact.aboutUs')</a>
            </li>
          </ul>
          <ul class="navbar-nav d-flex flex-row">
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                    role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    @if (app()->getlocale() == 'id')
                    <img src="{{ asset('images/indonesia.png') }}" width="20px" class="m-2">
                    @elseif (app()->getlocale()== 'en')
                    <img src="{{ asset('images/united-kingdom.png') }}" width="20px" class="m-2">
                    @endif
                    {{ strtoupper(app()->getLocale())}}
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li>
                        <a href="{{ url('lang/id')}}"><img src="{{ asset('images/indonesia.png') }}" width="20px" class="m-2">ID</a>
                    </li>
                    <li>
                        <a href="{{ url('lang/en')}}"><img src="{{ asset('images/united-kingdom.png') }}" width="20px" class="m-2">EN</a>
                  </ul>
                </li>
            <!-- Icons -->
            @if (Auth::check())
                        <li class="nav-item me-3 me-lg-0">
                            <a class="nav-link" href="{{ url(Auth::user()->role.'/artikels')}}" rel="nofollow">
                                {{Auth::user()->name}}
                            </a>
                        </li>
                        </li>
                    @else
                        <li class="nav-item me-3 me-lg-0">
                                <a class="nav-link" href="{{url('login')}}" rel="nofollow">
                                    @lang('nav.login')
                                </a>
                            </li>
                            <li class="nav-item me-3 me-lg-0">
                                <a class="nav-link" href="{{url('register')}}" rel="nofollow">
                                    @lang('nav.register')
                                </a>
                            </li>
                    @endif
            {{-- <li class="nav-item me-3 me-lg-0">
              <a class="nav-link" href="{{ route('login') }}" rel="nofollow">
                @lang('nav.login')
              </a>
            </li>
            <li class="nav-item me-3 me-lg-0">
              <a class="nav-link" href="{{ route('register') }}" rel="nofollow">
                @lang('nav.register')
              </a>
            </li> --}}
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar -->

    <!-- Jumbotron -->
    <div id="intro" class="p-3 text-center bg-light">

    </div>
    <!-- Jumbotron -->
  </header>
