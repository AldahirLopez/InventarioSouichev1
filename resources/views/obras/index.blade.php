@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Obras</h3>
    </div>
    <div class="section-body">
        @include('layouts.bannernotification')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">

                        <a href="{{ route('home') }}" class="btn btn-danger">Home</a>

                        @can('crear-obras')
                        <a class="btn btn-success" href="{{ route('obras.create') }}">Nuevo</a>
                        @endcan

                        <table class="table table-striped mt-2">
                            <thead style="background-color: #495057;"> 
                                <th style="display: none;">ID</th>
                                <th style="color:#fff;">Nombre</th>
                                <th style="color:#fff;">Direccion</th>
                                <th style="color:#fff;">Informacion</th>
                                <th style="color:#fff;">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($obras as $obra)
                                <tr>
                                    <td style="display: none;">{{ $obra->id }}</td>
                                    <td>{{ $obra->nombre }}</td>
                                    <td>{{ $obra->direccion }}</td>
                                    <td>
                                        <form action="{{ route('obras-info.index') }}" method="GET">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $obra->id }}">
                                            <button type="submit" class="btn btn-info">Ver Detalles</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form id="delete-form-{{ $obra->id }}" action="{{ route('obras.destroy',$obra->id) }}" method="POST">
                                            @can('editar-obras')
                                            <a class="btn btn-success" href="{{ route('obras.edit',$obra->id) }}">Editar</a>
                                            @endcan

                                            @csrf
                                            @method('DELETE')
                                            @can('borrar-obras')
                                            <button type="button" class="btn btn-danger delete-btn" data-id="{{ $obra->id }}">Borrar</button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Ubicamos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $obras->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const id = this.getAttribute('data-id');
                const form = document.querySelector(`#delete-form-${id}`);

                if (confirm('¿Estás seguro de que deseas eliminar esta obra?')) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection