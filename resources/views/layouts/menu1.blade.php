<li class="side-menus">
    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="/armonia">
        <i class="fas fa-house"></i><span>Dashboard</span>
    </a>

    @if(Auth::user()->hasRole('Administrador'))
    <a class="nav-link {{ Request::is('obras') ? 'active' : '' }}" href="/obras">
        <i class="fas fa-building"></i><span>Obras</span>
    </a>

    <a class="nav-link {{ Request::is('usuarios') ? 'active' : '' }}" href="/usuarios">
        <i class=" fas fa-users"></i><span>Usuarios</span>
    </a>


    <a class="nav-link {{ Request::is('roles') ? 'active' : '' }} " href="/roles">
        <i class="fas fa-user-lock"></i><span>Roles</span>
    </a>
    @endif

    <a class="nav-link {{ Request::is('operacion') ? 'active' : '' }} " href="/operacion">
        <i class="fas fa-user-lock"></i><span>Operacion Y Mantenimiento</span>
    </a>

</li>