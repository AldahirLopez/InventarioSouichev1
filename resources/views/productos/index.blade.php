@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Productos</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        @can('crear-productos')
                        <a class="btn btn-info" href="{{ route('productos.create') }}">Nuevo</a>
                        @endcan
                        <div class="card">
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-c-pink order-card">
                                    <div class="card-block">
                                        <h5>Inventario</h5>
                                        @php
                                        use App\Models\Productos;
                                        $cant_productos = Productos::count();
                                        @endphp
                                        <h2 class="text-right"><i class="fa fa-boxes f-left"></i><span>{{$cant_productos}}</span></h2>
                                        <p class="m-b-0 text-right"><a href="{{ route('productos.listar_inventario') }}" class="text-white">Ver más</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection