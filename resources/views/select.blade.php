@extends('layouts.auth_app')
@section('title')
Razon Social
@endsection
@section('content')
<div class="row justify-content-center"> <!-- Agrega la clase 'justify-content-center' para centrar los elementos dentro de la fila -->
    <ul class="navbar-nav navbar-right">

        @auth
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user" style="color: black;">
                <div class="d-sm-none d-lg-inline-block">
                    Hola, {{ \Illuminate\Support\Facades\Auth::user()->name}}</div>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">
                    Bienvenido, {{\Illuminate\Support\Facades\Auth::user()->name}}</div>
                <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>
        @else
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                {{-- <img alt="image" src="#" class="rounded-circle mr-1">--}}
                <div class="d-sm-none d-lg-inline-block">{{ __('messages.common.hello') }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">{{ __('messages.common.login') }}
                    / {{ __('messages.common.register') }}</div>
                <a href="{{ route('login') }}" class="dropdown-item has-icon">
                    <i class="fas fa-sign-in-alt"></i> {{ __('messages.common.login') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('register') }}" class="dropdown-item has-icon">
                    <i class="fas fa-user-plus"></i> {{ __('messages.common.register') }}
                </a>
            </div>
        </li>
        @endauth
    </ul>
    <div class="section-header text-center"> <!-- Agrega la clase 'text-center' para centrar -->
        <h3 class="page__heading">Seleccione una razon social</h3>
    </div>

    <div class="row justify-content-center">

        @auth
        <div class="card bg-c-blue order-card" style="width: 400px;"> <!-- Ajusta la altura según tus necesidades -->
            <div class="card-block bg-dark">
                <img src="{{ asset('img/souichi.png') }}" alt="logo" width="150" class="mx-auto d-block p-1">
                <h5>Souichi Mexico SA de CV</h5>
                <h2 class="text-right"><i class="fa-solid fa-trowel-bricks f-left"></i><span></span></h2>
                <p class="m-b-0 text-right"><a href="{{ route('souichi.index') }}" class="text-white">Ver más</a></p>

            </div>
        </div>

        <div class="card bg-c-blue order-card" style="width: 400px;"> <!-- Ajusta la altura según tus necesidades -->
            <div class="card-block bg-success">
                <img src="{{ asset('img/armonia.png') }}" alt="logo" height="70" width="150" class="mx-auto d-block p-2">
                <h5>Armonia y Contraste Ambiental</h5>
                <h2 class="text-right"><i class="fa-solid fa-folder-open f-left"></i><span></span></h2>
                <p class="m-b-0 text-right"><a href="{{ route('armonia.index') }}" class="text-white">Ver más</a></p>
            </div>
        </div>
        @endauth
    </div>

</div>

@endsection