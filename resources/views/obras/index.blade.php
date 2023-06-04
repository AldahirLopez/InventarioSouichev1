@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Obras</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                
            
                        @can('crear-obras')
                        <a class="btn btn-warning" href="{{ route('obras.create') }}">Nuevo</a>
                        @endcan

                        <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                     
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Direccion</th>  
                                    <th style="color:#fff;">NEstacion</th>                                                                  
                              </thead>
                              <tbody>
                              @foreach ($obras as $obra)
                            <tr>
                                <td style="display: none;">{{ $obra->id }}</td>                                
                                <td>{{ $obra->nombre }}</td>
                                <td>{{ $obra->categoria }}</td>
                                <td>{{ $obra->cantidad }}</td>
                                <td>{{ $obra->precio }}</td>
                                <td>{{ $obra->descripcion }}</td>
                                <td>
                                    <form action="{{ route('productos.destroy',$producto->id) }}" method="POST">                                        
                                        @can('editar-obras')
                                        <a class="btn btn-info" href="{{ route('productos.edit',$producto->id) }}">Editar</a>
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