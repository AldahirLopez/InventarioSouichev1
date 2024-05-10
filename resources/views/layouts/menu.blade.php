<li class="side-menus" style="background-color: #495057;">

    @if($opcion == 'souichi' || Auth::user()->hasRole('Administrador'))
    @if(Auth::user()->hasRole('Administrador'))
    @else
    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="/souichi">
        <i class="fas fa-house"></i><span>Dashboard Souichi</span>
    </a>
    @endif

    <a class="nav-link {{ Request::is('obras') ? 'active' : '' }} text-dark" href="/obras">
        <i class="fas fa-building"></i><span>Obras</span>
    </a>
    @endif

    @if($opcion == 'armonia' || Auth::user()->hasRole('Administrador'))

    @if(Auth::user()->hasRole('Administrador'))
    @else
    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="/armonia">
        <i class="fas fa-house"></i><span>Dashboard Armonia</span>
    </a>
    @endif
    <a class="nav-link {{ Request::is('operacion') ? 'active' : '' }}" href="/operacion">
        <i class="fas fa-building"></i><span>Operacion y Mantenimiento</span>
    </a>
    @endif

    @if(Auth::user()->hasRole('Administrador'))

    <a class="nav-link {{ Request::is('usuarios') ? 'active' : '' }}" href="/usuarios">
        <i class=" fas fa-users"></i><span>Usuarios</span>
    </a>

    <a class="nav-link {{ Request::is('roles') ? 'active' : '' }} " href="/roles">
        <i class="fas fa-user-lock"></i><span>Roles</span>
    </a>
    @endif

</li>