@extends('layouts.app1')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Dictamenes PDF de el verificador {{ $usuario->name }}</h3>
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

                        <a href="{{ route('dictamen.index', ['dictamen_id' => $dictamen_id]) }}" class="btn btn-danger">Regresar</a>

                        <a class="btn btn-warning" href="{{ route('archivos.create', ['dictamen_id' => $dictamen_id]) }}">Nuevo</a>

                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="display: none;">ID</th>
                                <th style="color:#fff;">Nombre</th>
                                <th style="color:#fff;">Archivos</th>
                                <th style="color:#fff;">Usuario</th>
                                <th style="color:#fff;">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($archivos as $archivo)
                                <tr>
                                    <td style="display: none;">{{ $archivo->id }}</td>
                                    <td>{{ $archivo->numero_dictamen}}</td>
                                    <td>
                                        <button onclick="mostrarPDF('{{ $archivo->rutadoc }}')">Mostrar PDF</button>
                                    </td>
                                    <td>{{ $archivo->usuario->name }}</td>
                                    <td>
                                        <form action="{{ route('archivos.destroy',$archivo->id) }}" method="POST">
                                            @can('editar-dictamen')
                                            <a class="btn btn-info" href="{{ route('archivos.edit', ['archivo' => $archivo->id]) }}">Editar</a>
                                            @endcan
                                            @csrf
                                            @method('DELETE')
                                            @can('borrar-dictamen')
                                            <button type="submit" class="btn btn-danger">Borrar</button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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