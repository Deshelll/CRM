@if(Auth::user() && Auth::user()->hasRole('admin'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.index') }}">Админ панель</a>
    </li>
@endif
