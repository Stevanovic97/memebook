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
        <!-- <div class="dropdown">
            <a class="dropdown-toggle" id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span class="glyphicon glyphicon-user"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="notificationsMenu" id="notificationsMenu">
                <li class="dropdown-header">No notifications</li> 
            </ul>
        </li> -->
        <div class="float-right icon dropdown">
            <a id="notificationsDropdown" class="" href="#" role="button" data-toggle="dropdown" data-target="#notificationsMenu" aria-haspopup="true" aria-expanded="false">
                <img src="{{ URL::asset('images/Notification_image.png') }}" alt="none" width="100%" height="100%"/>
            </a>
            <div class="txt">15</div>
            <ul class="dropdown-menu dropdown-menu-right" id="notificationsMenu" aria-labelledby="notificationsDropdown">
            </ul>
        </div>
    @endauth
    <div class="float-right">
        @if (Route::has('login'))
            @auth
                <div class="dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" data-target="#dropdown-options" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"> {{ Auth::user()->name }} </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" id="dropdown-options" aria-labelledby="navbarDropdown">
                        <div>
                            <a class="dropdown-item" href="{{ route('user.show', [ 'id' => Auth::user()->id ]) }}">
                                Show Profile
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