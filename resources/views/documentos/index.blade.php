@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Documentos de la obra {{ $obra->nombre }}</h3>
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

                        <a href="javascript:window.history.back()" class="btn btn-danger">Regresar</a>

                        @can('crear-documentos')
                        <a class="btn btn-warning" href="{{ route('documentos.create', ['obra_id' => $obra->id]) }}">Nuevo</a>
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
                                @foreach ($documentos as $doc)
                                <tr>
                                    <td style="display: none;">{{ $doc->id }}</td>
                                    <td>{{ $doc->nombre }}</td>
                                    <td>
                                        <button onclick="mostrarPDF('{{ $doc->rutadoc }}')">Mostrar PDF</button>
                                    </td>
                                    <td>{{ $doc->descripcion }}</td>
                                    <td>{{ $doc->usuario->name }}</td>
                                    <td>{{ $doc->estacionservicio }}</td>
                                    <td>
                                        <form action="{{ route('documentos.destroy',$doc->id) }}" method="POST">
                                            @can('editar-documentos')
                                            <a class="btn btn-info" href="{{ route('documentos.edit', ['documento' => $doc->id]) }}">Editar</a>
                                            @endcan
                                            @csrf
                                            @method('DELETE')
                                            @can('borrar-documentos')
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
                            {!! $documentos->appends(['obra_id' => $obra->id])->links() !!}
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