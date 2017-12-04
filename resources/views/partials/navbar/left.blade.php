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
            <li><a href="{{ route('legislative.create') }}">New Tracking</a></li>
            <li><a href="{{ route('legislative.index') }}">View all legislative measures</a></li>
        </ul>
    </li>
@endguest
