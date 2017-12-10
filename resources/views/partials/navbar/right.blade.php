@guest
    <li><a href="{{ route('session_index') }}">Find Session</a></li>
    <li><a href="{{ route('login') }}">Login</a></li>
    {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
@else

    @if ( Auth::user()->isAdmin() )
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                Offices <span class="caret"></span>
            </a>

            <ul class="dropdown-menu">
                <li><a href="{{ route('offices.create') }}">Create Office</a></li>
                <li><a href="{{ route('offices.index') }}">Manage Offices</a></li>
            </ul>
        </li>
        {{-- <li><a href="#">Departments</a></li> --}}
    @endif

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </li>
@endguest
