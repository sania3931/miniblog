<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Register</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <img src="{{asset('images/logo-genius.png')}}" alt="@lang('register.welcome')" width="200px">
                            <br>@lang('register.welcome')</br>

                            {{-- <a href="#">
                                <img src="{{ asset('images/article.png')}}" alt="Wedding" width="50px">
                            </a> --}}
                        </div>
                        <div class="login-form">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label>@lang('form.username')</label>
                                    <input class="au-input au-input--full @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" placeholder="@lang('form.name')">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label>@lang('form.emailAdress')</label>
                                    <input class="au-input au-input--full @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="@lang('form.email')">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>@lang('form.password')</label>
                                    <input class="au-input au-input--full @error('password') is-invalid @enderror" type="password" name="password" placeholder="@lang('form.password')">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label>@lang('form.phone')</label>
                                    <input class="au-input au-input--full @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="@lang('form.phone')">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="captcha" class="col-md-4 col-form-label text-md-right">Captcha</label>
                                    <div class="col-md-6 captcha">
                                        <span>{!! captcha_img('flat') !!}</span>
                                        <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        &#x21bb;
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="captcha" class="col-md-4 col-form-label text-md-right">Enter Captcha</label>
                                    <div class="col-md-6">
                                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                                    </div>
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="aggree">@lang('register.agreeTheTermsAndPolicy')
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">@lang('button.register')</button>
                            </form>
                            <div class="register-link">
                                <p>
                                    @lang('register.alreadyHaveAccount?')
                                    <a href="{{ route('login') }}">@lang('register.signIn')</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js')}}"></script>
    <script src="{{ asset('admin/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{ asset('admin/vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js')}}"></script>
    <script type="text/javascript">
        $('#reload').click(function () {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function (data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>

</body>

</html>
<!-- end document-->
