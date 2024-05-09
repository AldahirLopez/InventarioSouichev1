@extends('layouts.app1')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading" style="margin-bottom: 10px;">Bienvenido {{ $usuario->name }} Operación Y Mantenimiento</h3>
    </div>

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
                    <div class="card-body">
                    </div>
                    <div class="section-body">


                        <div class="row">
                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-c-blue order-card">
                                    <div class="card-block">
                                        <h5>Operacion y Mantenimiento</h5>
                                        @php
                                        use App\Models\Obras;
                                        $cant_obras = Obras::count();
                                        @endphp
                                        <h2 class="text-right"><i class="fa-solid fa-person-digging f-left"></i><span>{{$cant_obras}}</span></h2>
                                        @can('crear-obras')
                                        <p class="m-b-0 text-right"><a href="{{ route('dictamen.index') }}" class="text-white">Ver más</a></p>
                                        @endcan
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