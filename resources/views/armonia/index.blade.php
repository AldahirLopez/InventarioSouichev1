@extends('livewire-layout1')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Armonia y Contraste Ambiental</h3>
    </div>
    <div class="section-body">
        <div class="row">
            @if(Auth::user()->hasRole('Administrador'))
            <div class="col-md-4 col-xl-4">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h5>Usuarios</h5>
                        @php
                        $cant_usuarios = \App\Models\User::count();
                        @endphp
                        <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{$cant_usuarios}}</span></h2>
                        <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-4">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h5>Roles</h5>
                        @php
                        $cant_roles = \Spatie\Permission\Models\Role::count();
                        @endphp
                        <h2 class="text-right"><i class="fa fa-user-lock f-left"></i><span>{{$cant_roles}}</span></h2>
                        <p class="m-b-0 text-right"><a href="/roles" class="text-white">Ver más</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-4">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h5>Obras</h5>
                        @php
                        $cant_obras = \App\Models\Obras::count();
                        @endphp
                        <h2 class="text-right"><i class="fa-solid fa-person-digging f-left"></i><span>{{$cant_obras}}</span></h2>
                        <p class="m-b-0 text-right"><a href="/obras" class="text-white">Ver más</a></p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection