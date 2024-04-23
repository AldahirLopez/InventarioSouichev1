@extends('livewire-layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Informacion de la obra {{ $obra->nombre }}</h3>
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
                                        use App\Models\Planos;
                                        $cant_planos = Planos::count();
                                        @endphp
                                        <h2 class="text-right"><i class="fa-solid fa-map f-left"></i><span>{{$cant_planos}}</span></h2>
                                        <p class="m-b-0 text-right"><a href="{{ route('planos.show', $obra->id) }}" class="text-white">Ver más</a></p>
                                    </div>
                                </div>
                            </div>
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