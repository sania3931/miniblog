            <!-- MENU SIDEBAR-->
            <aside class="menu-sidebar d-none d-lg-block">
                <div class="logo">
                    <a href="#">
                        <img src="{{ asset('images/logo-genius.png') }}" alt=""></a>
                    {{-- <i class="fas fa-user m-3"></i>{{Auth::user()->role}}</a> --}}
                </div>

                <div class="menu-sidebar__content js-scrollbar1">
                    <nav class="navbar-sidebar">
                        <hr class="sidebar-divider my-0">
                        <li class="active has-sub list-unstyled navbar__list">
                            <a href="#">
                                <img src="{{ asset('images/profile.png') }}" alt="" width="30px"
                                    class="m-2">{{ Auth::user()->role }}
                            </a>
                        </li>
                        <hr class="sidebar-divider my-0">
                        {{-- <h4 class="menu-text">
                            <span>DASHBOARD</span>
                        </h4>
                        <ul>
                            <a href="{{ url('Admin/dashboard') }}">
                                <i class=" m-3 fas fa-tachometer-alt"></i>Dashboard</a>
                        </ul>
                        <h4 class="menu-text">
                            <span>STARTER</span>
                        </h4> --}}
                        <ul class="list-unstyled navbar__list">
                            @if (Auth::user()->role == 'Admin')
                                <h4 class="menu-text">
                                    <span>@lang('sidebar.dashboard')</span>
                                </h4>
                                <hr class="sidebar-divider my-0">
                                {{-- <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <i class="fas fa-tachometer-alt"></i>@lang('sidebar.dashboard')
                                    </li>
                                </ul> --}}
                                <li class="active has-sub">
                                    <a href="{{ url('Admin/dashboard') }}">
                                        <i class="fas fa-tachometer-alt"></i>@lang('sidebar.dashboard')</a>
                                </li>
                                <hr class="sidebar-divider my-0">
                                <h4 class="menu-text">
                                    <span>@lang('sidebar.menu')</span>
                                </h4>
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fa fa-users"></i>@lang('sidebar.user')</a>
                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                        <li>
                                            <a href="{{ url('Admin/users') }}">
                                                <i class="fa fa-users"></i>@lang('sidebar.user')</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa-fw fa-folder"></i>@lang('sidebar.main')</a>
                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                        <li>
                                            <a href="{{ url(Auth::user()->role . '/artikels') }}">
                                                <i class="fa fa-book"></i>@lang('sidebar.article')</a>
                                        </li>
                                        <li>
                                            <a href="{{ url(Auth::user()->role . '/post_pictures') }}">
                                                <i class="fa fa-picture-o"></i>@lang('sidebar.postPicture')</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('Admin/categories') }}">
                                                <i class="fa fa-list"></i>@lang('sidebar.category')</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('Admin/tag') }}">
                                                <i class="fa fa-tags"></i>@lang('sidebar.tags')</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('Admin/comment') }}">
                                                <i class="fa fa-comments""></i>@lang('sidebar.comment')</a>
                                        </li>
                                    </ul>
                                </li>
                                {{-- <li class="active has-sub">
                                    <a href="{{ url('Admin/users') }}">
                                        <i class="fa fa-users"></i>@lang('sidebar.user')</a>
                                </li> --}}

                                {{-- <li>
                                    <a href="{{ url('Admin/categories') }}">
                                        <i class="fa fa-list"></i>@lang('sidebar.category')</a>
                                </li>
                                <li>
                                    <a href="{{ url('Admin/tag') }}">
                                        <i class="fa fa-tags"></i>@lang('sidebar.tags')</a>
                                </li>
                                <li>
                                    <a href="{{ url('Admin/comment') }}">
                                        <i class="fa fa-comments""></i>@lang('sidebar.comment')</a>
                                </li> --}}

                                {{-- <li>
                                    <a  class="nav-link @yield('about')" href="{{ url('Admin/about') }}">
                                        <i class="fa fa-info"></i>@lang('sidebar.about')</a>
                                </li> --}}
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa-fw fa-wrench"></i>@lang('sidebar.settings')</a>
                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                        <li>
                                            <a href="{{ url('Admin/about') }}">
                                                <i class="fa fa-info"></i>@lang('sidebar.about')</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if (Auth::user()->role == 'Member')
                                <h4 class="menu-text">
                                    <span>@lang('sidebar.menu')</span>
                                </h4>
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa-fw fa-folder"></i>@lang('sidebar.main')</a>
                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                        <li>
                                            <a href="{{ url(Auth::user()->role . '/post_pictures') }}">
                                                <i class="fa fa-picture-o"></i>@lang('sidebar.postPicture')</a>
                                        </li>
                                        <li>
                                            <a href="{{ url(Auth::user()->role . '/artikels') }}">
                                                <i class="fa fa-book"></i>@lang('sidebar.article')</a>
                                        </li>
                                    </ul>
                            @endif
                            <hr class="sidebar-divider">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>@lang('sidebar.frontPage')</span></a>
                            </li>
                            <hr class="sidebar-divider d-none d-md-block">
                            {{-- <li>
                                    <a href="calendar.html">
                                        <i class="fa fa-picture-o"></i>Gallery</a>
                                </li>
                                <li>
                                    <a href="map.html">
                                        <i class="fa fa-video-camera"></i>Video</a>
                                </li>
                                <li>
                                    <a href="map.html">
                                    <i class="fa fa-comment"></i>Comment</a>
                                </li>
                                <li>
                                    <a href="map.html">
                                        <i class="fa fa-gift"></i>Gift</a>
                                </li> --}}
                            {{-- <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa-copy"></i>Pages</a>
                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                        <li>
                                            <a href="login.html">Login</a>
                                        </li>
                                        <li>
                                            <a href="register.html">Register</a>
                                        </li>
                                        <li>
                                            <a href="forget-pass.html">Forget Password</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa-desktop"></i>UI Elements</a>
                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                        <li>
                                            <a href="button.html">Button</a>
                                        </li>
                                        <li>
                                            <a href="badge.html">Badges</a>
                                        </li>
                                        <li>
                                            <a href="tab.html">Tabs</a>
                                        </li>
                                        <li>
                                            <a href="card.html">Cards</a>
                                        </li>
                                        <li>
                                            <a href="alert.html">Alerts</a>
                                        </li>
                                        <li>
                                            <a href="progress-bar.html">Progress Bars</a>
                                        </li>
                                        <li>
                                            <a href="modal.html">Modals</a>
                                        </li>
                                        <li>
                                            <a href="switch.html">Switchs</a>
                                        </li>
                                        <li>
                                            <a href="grid.html">Grids</a>
                                        </li>
                                        <li>
                                            <a href="fontawesome.html">Fontawesome Icon</a>
                                        </li>
                                        <li>
                                            <a href="typo.html">Typography</a>
                                        </li> --}}
                        </ul>
                    </nav>
                </div>
            </aside>
            <!-- END MENU SIDEBAR-->
