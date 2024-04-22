@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Dashboard</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-c-blue order-card">
                                    <div class="card-block">
                                        <h5>Planos</h5>
                                        @php
                                        use App\Models\User;
                                        $cant_usuarios = User::count();
                                        @endphp
                                        <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{$cant_usuarios}}</span></h2>
                                        <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a></p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">


                @can('crear-obras')
                <a class="btn btn-warning" href="{{ route('obras.create') }}">Nuevo</a>
                @endcan

                <table class="table table-striped mt-2">
                    <thead style="background-color:#6777ef">
                        <th style="display: none;">ID</th>
                        <th style="color:#fff;">Usuario</th>
                        <th style="color:#fff;">Fecha de Actualización</th>
                        <th style="color:#fff;">Documento Actualizado</th>
                        <th style="color:#fff;">Ver</th>
                        <th style="color:#fff;">Acciones</th>
                    </thead>
                    <tbody>
                        @foreach ($obras as $obra)
                        <tr>
                            <td style="display: none;">{{ $obra->id }}</td>
                            <td>{{ $obra->nombre }}</td>
                            <td>{{ $obra->direccion }}</td>
                            <td>{{ $obra->estacionservicio }}</td>
                            <td></td>
                            <td>
                                <form action="{{ route('obras.destroy',$obra->id) }}" method="POST">
                                    @can('editar-obras')
                                    <a class="btn btn-info" href="{{ route('obras.edit',$obra->id) }}">Editar</a>
                                    @endcan

                                    @csrf
                                    @method('DELETE')
                                    @can('borrar-obras')
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
                    {!! $obras->links() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

</section>

@endsection