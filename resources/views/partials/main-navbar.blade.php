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
        @include('partials.notifications-dropdown') 
        <notification-alert user_id = "{{ auth()->user()->id }}"></notification-alert>
    @endauth
    <div class="float-right">
        @auth
            <div onclick="toggleLoggedInUserDropdown()">
                <a class="nav-link" href="#" role="button">
                    <span class="caret dropbtn"> {{ Auth::user()->name }} </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" id="loggedInDropdown">
                    <div>
                        <a class="dropdown-item" href="{{ route('user.show', [ 'id' => Auth::user()->id ]) }}">
                            User Profile
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
        @endauth
        @guest
            @if (\Request::is('login'))
                <a class="btn btn-outline-danger" href="{{ route('register') }}">Register</a>
            @elseif (\Request::is('register'))
                <a class="btn btn-outline-primary" href="{{ route('login') }}">Login</a>
            @else
                <a class="btn btn-outline-primary" href="{{ route('login') }}">Login</a>
                <a class="btn btn-outline-danger" href="{{ route('register') }}">Register</a>
            @endif
        @endguest
    </div>
</nav>