@guest
    &nbsp;
@else
    {{-- <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Documents <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('documents.create') }}">Create Document</a></li>
            <li><a href="{{ route('documents.index') }}">View all documents</a></li>
        </ul>
    </li> --}}
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Tracking <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('legislative.create') }}">New record</a></li>
            <li><a href="{{ route('legislative.index') }}">View records</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Forms <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li class="dropdown-header">Franform</li>
            <li><a href="{{ route('franform.create') }}">New record</a></li>
            <li><a href="{{ route('franform.index') }}">View records</a></li>
            <div class="divider"></div>
            <li class="dropdown-header">Ordform</li>
            <li><a href="{{ route('ordform.create') }}">New record</a></li>
            <li><a href="{{ route('ordform.index') }}">View records</a></li>
            <div class="divider"></div>
            <li class="dropdown-header">Resform</li>
            <li><a href="{{ route('resform.create') }}">New record</a></li>
            <li><a href="{{ route('resform.index') }}">View records</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Session <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('sessions.create') }}">New session</a></li>
            <li><a href="{{ route('sessions.index') }}">View sessions</a></li>
        </ul>
    </li>

    {{-- <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Franform <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('franform.create') }}">New record</a></li>
            <li><a href="{{ route('franform.index') }}">View records</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Ordform <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('ordform.create') }}">New record</a></li>
            <li><a href="{{ route('ordform.index') }}">View records</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Resform <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('resform.create') }}">New record</a></li>
            <li><a href="{{ route('resform.index') }}">View records</a></li>
        </ul>
    </li> --}}
@endguest
