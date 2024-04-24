@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Planos de la obra {{ $obra->nombre }}</h3>
    </div>
    <div class="section-body">
        <!-- Agregar el código para mostrar el mensaje de éxito aquí -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">


                        @can('crear-planos')
                        <a class="btn btn-warning" href="{{ route('planos.create', ['obra_id' => $obra->id]) }}">Nuevo</a>
                        @endcan

                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="display: none;">ID</th>
                                <th style="color:#fff;">Nombre</th>
                                <th style="color:#fff;">Archivo</th>
                                <th style="color:#fff;">Descripcion</th>
                                <th style="color:#fff;">Usuario</th>
                                <th style="color:#fff;">N. Estacion</th>
                                <th style="color:#fff;">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($planos as $plano)
                                <tr>
                                    <td style="display: none;">{{ $plano->id }}</td>
                                    <td>{{ $plano->nombre }}</td>
                                    <td>
                                        <button onclick="mostrarPDF('{{ $plano->rutaplano }}')">Mostrar PDF</button>
                                    </td>
                                    <td>{{ $plano->descripcion }}</td>
                                    <td>{{ $plano->usuario->name }}</td>
                                    <td>{{ $obra->estacionservicio }}</td>
                                    <td>
                                        <form action="{{ route('planos.destroy',$plano->id) }}" method="POST">
                                            @can('editar-planos')
                                            <a class="btn btn-info" href="{{ route('planos.edit', ['plano' => $plano->id]) }}">Editar</a>
                                            @endcan
                                            @csrf
                                            @method('DELETE')
                                            @can('borrar-planos')
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
                            {!! $planos->appends(['obra_id' => $obra->id])->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<script>
    function mostrarPDF(rutaArchivo) {
        try {
            // Construir la URL del archivo PDF
            var url = '/storage/' + rutaArchivo;

            // Abrir una nueva ventana o pestaña y cargar el PDF
            window.open(url, '_blank');
        } catch (error) {
            console.error('Error al mostrar el PDF:', error);
        }
    }
</script>