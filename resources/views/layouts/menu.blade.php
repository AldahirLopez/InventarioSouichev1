<li class="side-menus">
    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="/home">
    <i class="fas fa-house"></i><span>Dashboard</span>
    </a>

    <a class="nav-link {{ Request::is('obras') ? 'active' : '' }}" href="/obras">
        <i class="fas fa-building"></i><span>Obras</span>     
    </a>

    <a class="nav-link {{ Request::is('usuarios') ? 'active' : '' }}" href="/usuarios">
        <i class=" fas fa-users"></i><span>Usuarios</span>
    </a>

    <a class="nav-link {{ Request::is('roles') ? 'active' : '' }} " href="/roles">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a> 

</li>
