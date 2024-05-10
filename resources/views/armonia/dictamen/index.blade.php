@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Dictamenes de el verificador {{ $usuario->name }}</h3>
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

                        <a href="{{ route('operacion.index') }}" class="btn btn-danger">Regresar</a>

                        <a class="btn btn-warning" href="{{ route('dictamen.create')}}">Nuevo</a>


                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="display: none;">ID</th>
                                <th style="color:#fff;">Nombre</th>
                                <th style="color:#fff;">Dictamenes</th>
                                <th style="color:#fff;">Usuario</th>
                                <th style="color:#fff;">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($dictamenes as $dictamen)
                                <tr>
                                    <td style="display: none;">{{ $dictamen->id }}</td>
                                    <td>{{ $dictamen->numero_dictamen}}</td>
                                    <td>
                                        <a href="{{ route('archivos.index', ['dictamen_id' => $dictamen->id]) }}" class="btn btn-primary">Listar Archivos</a>
                                    </td>
                                    <td>{{ $dictamen->usuario->name }}</td>
                                    <td>
                                        <form action="{{ route('dictamen.destroy',$dictamen->id) }}" method="POST">
                                            @can('editar-dictamen')
                                            <a class="btn btn-info" href="{{ route('dictamen.edit', ['dictamen' => $dictamen->id]) }}">Editar</a>
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

                        <!-- Ubicamos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $dictamenes->appends(['usuario_id' => $usuario->id])->links() !!}
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