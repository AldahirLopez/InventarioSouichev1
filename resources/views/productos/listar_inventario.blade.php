@extends('livewire-layout')

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

                        @foreach ($categorias as $categoria)
                        <a class="btn btn-warning" href="#">{{ $categoria->nombre }}</a>
                        @endforeach

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
                                            <a class="btn btn-info" href="{{ route('productos.edit',$producto->id) }}">Editar</a>
                                            @endcan

                                            @csrf
                                            @method('DELETE')
                                            @can('borrar-productos')
                                            <button type="submit" class="btn btn-danger">Borrar</button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Ubicamos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $productos->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('eliminar') == 'ok')
<script>
    Swal.fire(
      'Eliminado!',
      'Producto eliminado',
      'success'
    )
</script>
@endif

<script>
    $('.form-eliminar').submit(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de eliminar?',
            text: "Esta accion no es reversible",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });
</script>

@endsection