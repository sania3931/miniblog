<!DOCTYPE html>
<html lang="en">
@include('templates.admin.head')
    <body class="animation">
        <div class="page-wrapper">
            @include('templates.admin.nav')
            @include('templates.admin.sidebar')




            <!-- PAGE CONTAINER-->
            <div class="page-container">
                <!-- HEADER DESKTOP-->
                <header class="header-desktop">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="header-wrap">
                                <form class="form-header" action="" method="POST">
                                    <input class="au-input au-input--xl" type="text" name="search" placeholder="@lang('nav.searchEverything')" />
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                                <div class="header-button">
                                    {{-- <div class="lang-dropdown">
                                        <li class="nav-item dropdown">
                                            <a class="{{url('lang')}}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              {{ strtoupper(app()->getLocale())}}
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                              <a class="dropdown-item" href="{{url('lang', 'en')}}">EN</a>
                                              <a class="dropdown-item" href=""{{url('lang', 'id')}}>ID</a>
                                              <div class="dropdown-divider"></div>
                                              <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                          </li>
                                    </div> --}}
                                    {{-- <div class="noti-wrap">
                                        <div class="noti__item js-item-menu">
                                            <i class="zmdi zmdi-comment-more"></i>
                                            <span class="quantity">1</span>
                                            <div class="mess-dropdown js-dropdown">
                                                <div class="mess__title">
                                                    <p>You have 2 news message</p>
                                                </div>
                                                <div class="mess__item">
                                                    <div class="image img-cir img-40">
                                                        <img src="images/icon/avatar-06.jpg" alt="Michelle Moreno" />
                                                    </div>
                                                    <div class="content">
                                                        <h6>Michelle Moreno</h6>
                                                        <p>Have sent a photo</p>
                                                        <span class="time">3 min ago</span>
                                                    </div>
                                                </div>
                                                <div class="mess__item">
                                                    <div class="image img-cir img-40">
                                                        <img src="images/icon/avatar-04.jpg" alt="Diane Myers" />
                                                    </div>
                                                    <div class="content">
                                                        <h6>Diane Myers</h6>
                                                        <p>You are now connected on message</p>
                                                        <span class="time">Yesterday</span>
                                                    </div>
                                                </div>
                                                <div class="mess__footer">
                                                    <a href="#">View all messages</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="noti__item js-item-menu">
                                            <i class="zmdi zmdi-email"></i>
                                            <span class="quantity">1</span>
                                            <div class="email-dropdown js-dropdown">
                                                <div class="email__title">
                                                    <p>You have 3 New Emails</p>
                                                </div>
                                                <div class="email__item">
                                                    <div class="image img-cir img-40">
                                                        <img src="images/icon/avatar-06.jpg" alt="Cynthia Harvey" />
                                                    </div>
                                                    <div class="content">
                                                        <p>Meeting about new dashboard...</p>
                                                        <span>Cynthia Harvey, 3 min ago</span>
                                                    </div>
                                                </div>
                                                <div class="email__item">
                                                    <div class="image img-cir img-40">
                                                        <img src="images/icon/avatar-05.jpg" alt="Cynthia Harvey" />
                                                    </div>
                                                    <div class="content">
                                                        <p>Meeting about new dashboard...</p>
                                                        <span>Cynthia Harvey, Yesterday</span>
                                                    </div>
                                                </div>
                                                <div class="email__item">
                                                    <div class="image img-cir img-40">
                                                        <img src="images/icon/avatar-04.jpg" alt="Cynthia Harvey" />
                                                    </div>
                                                    <div class="content">
                                                        <p>Meeting about new dashboard...</p>
                                                        <span>Cynthia Harvey, April 12,,2018</span>
                                                    </div>
                                                </div>
                                                <div class="email__footer">
                                                    <a href="#">See all emails</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="noti__item js-item-menu">
                                            <i class="zmdi zmdi-notifications"></i>
                                            <span class="quantity">3</span>
                                            <div class="notifi-dropdown js-dropdown">
                                                <div class="notifi__title">
                                                    <p>You have 3 Notifications</p>
                                                </div>
                                                <div class="notifi__item">
                                                    <div class="bg-c1 img-cir img-40">
                                                        <i class="zmdi zmdi-email-open"></i>
                                                    </div>
                                                    <div class="content">
                                                        <p>You got a email notification</p>
                                                        <span class="date">April 12, 2018 06:50</span>
                                                    </div>
                                                </div>
                                                <div class="notifi__item">
                                                    <div class="bg-c2 img-cir img-40">
                                                        <i class="zmdi zmdi-account-box"></i>
                                                    </div>
                                                    <div class="content">
                                                        <p>Your account has been blocked</p>
                                                        <span class="date">April 12, 2018 06:50</span>
                                                    </div>
                                                </div>
                                                <div class="notifi__item">
                                                    <div class="bg-c3 img-cir img-40">
                                                        <i class="zmdi zmdi-file-text"></i>
                                                    </div>
                                                    <div class="content">
                                                        <p>You got a new file</p>
                                                        <span class="date">April 12, 2018 06:50</span>
                                                    </div>
                                                </div>
                                                <div class="notifi__footer">
                                                    <a href="#">All notifications</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="lang-dropdown">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="{{ url('lang/{locale}')}}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              {{ strtoupper(app()->getLocale())}}
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                              <a class="dropdown-item" href="{{ url('lang/en')}}">EN</a>
                                              <a class="dropdown-item" href="{{ url('lang/id')}}">ID</a>
                                            </div>
                                          </li>
                                    </div> --}}

                                    <div class="account-wrap">
                                        <div class="account-item clearfix js-item-menu">
                                             <div class="content">
                                                <a class="js-acc-btn" href="#">
                                                    @if (app()->getlocale() == 'id')
                                                    <img src="{{ asset('images/indonesia.png') }}" width="20px" class="m-2">
                                                    @elseif (app()->getlocale()== 'en')
                                                    <img src="{{ asset('images/united-kingdom.png') }}" width="20px" class="m-2">
                                                    @endif
                                                    {{ strtoupper(app()->getLocale())}}
                                                </a>
                                            </div>
                                            <div class="language-dropdown js-dropdown">
                                                <div class="account-dropdown__body">
                                                    <div class="language-dropdown__item">
                                                            <a href="{{ url('lang/id')}}"><img src="{{ asset('images/indonesia.png') }}" width="20px" class="m-2">ID</a>
                                                            <a href="{{ url('lang/en')}}"><img src="{{ asset('images/united-kingdom.png') }}" width="20px" class="m-2">EN</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="account-wrap">
                                        <div class="account-item clearfix js-item-menu">
                                            <div class="image">
                                                <a href="/">
                                                    <img src="{{ asset('images/profile.png') }}" alt="" class="me-2"></a>
                                            </div>
                                             <div class="content">
                                                <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                            </div>
                                            <div class="account-dropdown js-dropdown">
                                                <div class="info clearfix">
                                                    <div class="image">
                                                        <a href="#">
                                                            <img src="{{ asset('images/profile.png') }}" alt="">
                                                            {{-- <i class="fas fa-user m-4"></i></a> --}}</a>
                                                    </div>
                                                    <div class="content">
                                                        <h5 class="name">
                                                            <a href="#">{{Auth::user()->name}}</a>
                                                        </h5>
                                                        <span class="email">{{Auth::user()->email}}</span>
                                                    </div>
                                                </div>
                                                <div class="account-dropdown__body">
                                                    <div class="account-dropdown__item">
                                                        <a href="{{ url('') }}">
                                                            <i class="zmdi zmdi-account"></i>Account</a>
                                                    </div>
                                                </div>
                                                <div class="account-dropdown__footer">
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <a class="nav-link" data-widget="navbar-search" href="{{ route('logout') }}" role="button" onclick="event.preventDefault(); this.closest('form').submit();" ><i class="zmdi zmdi-power"></i>
                                                            @lang('button.logout')
                                                        </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- HEADER DESKTOP-->

                <!-- MAIN CONTENT-->
                <div class="main-content">
                    @include('templates.admin.alert')
                    @yield('content')
                </div>
                <!-- END MAIN CONTENT-->
                <!-- END PAGE CONTAINER-->
            </div>

        </div>

@include('templates.admin.footer')

    </body>

    </html>
