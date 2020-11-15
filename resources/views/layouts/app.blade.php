<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>@yield('title')</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- SIDEBAR library imports -->
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/sidebar.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/toastr.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/notifications.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/user-profile.css') }}">
        <!-- Meme style -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/applayout.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/memes.css') }}">
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500&display=swap">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Comments style imports -->
        <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/icon.min.css" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/comment.min.css" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/form.min.css" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/button.min.css" rel="stylesheet">
        <link href="{{ asset('/vendor/laravelLikeComment/css/style.css') }}" rel="stylesheet">

        <!--Toast css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.css">

        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        <!-- This makes the current user's id available in javascript -->
        @if(!auth()->guest())
            <script>
                window.Laravel.userId = <?php echo auth()->user()->id; ?>
            </script>
        @endif
    </head>
    <body>
        <div id="app">
            <!-- Main Navbar -->
                @yield('navbar')
            <!-- End Main Navbar -->
            <!-- Sidebar -->
                @yield('sidebar')
            <!-- End Sidebar -->
            <!-- Content -->
                @yield('content')
            <!-- End content -->
            @if (session('flashType'))
                <toast message="{{ session('flashMessage') }}"
                       title="{{ session('flashTitle') }}"
                       type="{{ session('flashType') }}">
                </toast>
            @endif
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.5/waypoints.min.js"></script>
    <script src="//malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="{{ asset('/vendor/laravelLikeComment/js/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ URL::asset('js/sidebar.js') }}"></script>
</html>

