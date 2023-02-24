@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Salidas de material</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        @can('crear-productos')
                        <a class="btn btn-info" href="{{ route('salidas.create') }}">Nueva Salida</a>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
@endsection