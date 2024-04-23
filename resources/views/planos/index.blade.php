@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Planos de la obra {{ $obra->nombre }}</h3>
    </div>
    <div class="section-body">
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
                                        <button onclick="mostrarPDF('{{ base64_encode($plano->plano) }}')">Mostrar PDF</button>
                                    </td>


                                    <td>{{ $plano->descripcion }}</td>
                                    <td>
                                        <form action="{{ route('planos.destroy',$plano->id) }}" method="POST">
                                            @can('editar-planos')
                                            <a class="btn btn-info" href="{{ route('planos.edit',$plano->id) }}">Editar</a>
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
                            {!! $planos->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<script>
    function mostrarPDF(contenidoPDF) {
        try {
            // Decodificar el contenido base64 del PDF
            var contenidoPDFDecodificado = atob(contenidoPDF);
            console.log("Contenido del PDF decodificado:", contenidoPDFDecodificado);

            // Convertir la cadena a un array de bytes
            var bytes = new Uint8Array(contenidoPDFDecodificado.length);
            for (var i = 0; i < contenidoPDFDecodificado.length; i++) {
                bytes[i] = contenidoPDFDecodificado.charCodeAt(i);
            }

            // Crear un objeto Blob a partir del array de bytes
            var blob = new Blob([bytes], { type: 'application/pdf' });

            // Crear una URL del objeto Blob
            var url = URL.createObjectURL(blob);
            console.log("URL del objeto BLOB:", url);

            // Abrir una nueva ventana o pestaña y cargar el PDF
            window.open(url, '_blank');
        } catch (error) {
            console.error('Error al mostrar el PDF:', error);
        }
    }
</script>