<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf_token" content="{{csrf_token()}}">
    <title>Genius.id</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <!-- MDB -->
    <link rel="stylesheet" href="{{ asset('user/css/mdb.min.css')}}" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('user/css/style.css')}}" />
    @yield('style')
</head>
