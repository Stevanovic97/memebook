<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- SIDEBAR library imports -->
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/sidebar.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/toastr.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/applayout.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500&display=swap">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!--Toast css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

        <title>MemeBook</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    </head>
    <body>
        <nav class="navbar navbar-dark navbar-expand-md bg-dark fixed-top">
            <a class="navbar-brand text-white" href="{{ route('memes.index') }}"><i>MemeBook</i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="{{ route('memes.index') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('meme.create') }}">Upload meme</a>
                    </li>
                </ul>
            </div>

            @auth
            <div class="float-right">
                <div class="icon">
                    <img src="{{ URL::asset('images/Notification_image.png') }}" alt="none" width="100%" height="100%" />
                    <div class="txt">15</div>
                </div>
            </div>
            @endauth
            <div class="float-right">
                @if (Route::has('login'))
                    @auth
                        <div class="dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"> {{ Auth::user()->name }} </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <div>
                                    <a class="dropdown-item" href="{{ route('user.single', [ 'id' => Auth::user()->id ]) }}">
                                        My profile
                                    </a>
                                </div>
                                <div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a class="btn btn-outline-primary" href="{{ route('login') }}">Login</a>
                        @if (Route::has('register'))
                            <a class="btn btn-outline-danger" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>



        <!-- Wrapper -->
        <div class="wrapper" style="background-color:gray">
            <!-- Sidebar -->
            <nav class="sidebar">
                <!-- open sidebar menu -->
                <a class="btn btn-primary btn-customized open-menu" style="margin-top: 60px" href="#" role="button">
                    <i class="fas fa-align-left"></i> <span>Menu</span>
                </a>
                <!-- close sidebar menu -->
                <div class="dismiss">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <ul class="list-unstyled menu-elements">
                    <li class="active">
                        <a class="scroll-link" href="#top-content"><i class="fas fa-home"></i> My Profile</a>
                    </li>

                    <li>
                        <a class="scroll-link" href="#section-6"><i class="fas fa-envelope"></i> Contact us</a>
                    </li>
                    <li>
                        <a href="#otherSections" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="otherSections">
                            <i class="fab fa-buffer"></i>Meme categories
                        </a>
                        <ul class="collapse list-unstyled" id="otherSections">
                        @if (!empty($categories))
                            @foreach($categories as $category)
                                <li>
                                    <a class="scroll-link" href="#section-3">{{$category->name}}</a>
                                </li>
                            @endforeach
                        @endif
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- End sidebar -->

            <!-- Dark overlay -->
            <div class="overlay"></div>
        </div>
        <!-- End wrapper -->

        <!-- Content -->
        <div class="content">
            <main class="py-4"> 
                @yield('content')
            </main>
        </div>
        <!-- End content -->

        <!-- Javascript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.5/waypoints.min.js"></script>
        <script src="//malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
        <script type="text/javascript" src="{{ URL::asset('js/sidebar.js') }}"></script>

        <!-- Toastr js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.js.map"></script>

        @if (session('flashType'))
            <script>
                toastr.options.onShown = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": true, 
                    "progressBar": false, 
                    "positionClass": "toast-container",
                    "preventDuplicates": false, 
                    "onclick": null,
                    "showDuration": "300", 
                    "hideDuration": "1000", 
                    "timeOut": "5000", 
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "autohide": false,
                };
                @if (session('flashType') == 'success')
                    toastr.success("{{ Session::get('flashMessage') }}", 'Success');
                @elseif (session('flashType') == 'error')
                    toastr.error("{{ Session::get('flashMessage') }}", 'Error');
                @endif
            </script>
        @endif
    </body>
</html>