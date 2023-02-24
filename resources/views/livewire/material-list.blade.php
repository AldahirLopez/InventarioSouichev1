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
                        <div style="display: flex; align-items: center;justify-content: center; margin-top: 10px">
                        <label style="margin-bottom: 0rem;font-size:20px; margin-right:10px;"for="precio">Buscar</label>
                        <input wire:model="digitos" style="width:30%;"class="form-control" type="text" placeholder="Buscar">
                        </div>
                        <div class="card-body">

                        </div>

                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="display: none;">ID</th>
                                <th style="color:#fff;">Nombre</th>
                                <th style="color:#fff;">Categoria</th>
                                <th style="color:#fff;">Cantidad</th>
                                <th style="color:#fff;">Precio</th>
                                <th style="color:#fff;">Descripcion</th>
                                <th style="color:#fff;">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                <tr>
                                    <td style="display: none;">{{ $producto->id }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ $producto->categoria }}</td>
                                    <td>{{ $producto->cantidad }}</td>
                                    <td>{{ $producto->precio }}</td>
                                    <td>{{ $producto->descripcion }}</td>
                                    <td>
                                        <form action="{{ route('productos.destroy',$producto->id) }}" class="form-eliminar" method="POST">
                                            @can('editar-productos')
                                            <a class="btn btn-info" href="{{ route('productos.edit',$producto->id) }}">Agregar</a>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Ubicamos la paginacion a la derecha -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection