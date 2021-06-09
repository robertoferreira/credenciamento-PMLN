@extends('admin.layout')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="text-center">
                <!-- HEADER -->
                @include('inc.header')
                <!-- FIM HEADER -->
            </div>
        </div>
        <div class="col-md-12">
            <!-- INFO USABILIDADE -->

            <!-- MENU -->
            <div class="row">
                <div class="col-12 my-3">
                    @include('inc.menu')
                </div>
            </div>
            <!-- FIM MENU -->

            <div class="col-12">
            @if(isset(Auth::user()->company->id))
                <h3>Bem vindo! <b>{{ auth()->user()->company()->first()->name_business }}</b></h3>
            @else
                <h3>Bem vindo! <b>{{ auth()->user()->name }}</b></h3>
            @endif
                <hr>
                <h2 class="text-center">Tomada de Preço - {{ $outletPrice->title }}</b></h2>

                <div class="m-5 p-5 bg-light">

                    
                    
                        <div class="row">
                            <p class="h3"><b>Objeto:</b> {{ $outletPrice->object }}</p>
                        </div>

                        <hr>
                        <div class="row">
                            <p class="h3"><b>Núemro/Ano:</b> {{ $outletPrice->number }}</p>
                        </div>

                        <hr>
                        <div class="row">
                            <p class="h3"><b>Publicado em:</b> {{ date('d/m/Y', strtotime($outletPrice->published)) }}</p>
                        </div>

                        <hr>
                        <div class="row">
                            <p class="h3"><b>Encerra em:</b> {{ date('d/m/Y', strtotime($outletPrice->closing)) }}</p>
                        </div>

                        <hr>
                        <div class="row">
                            <p class="h3"><b>Status:</b> <span class="badge badge-{{ ($outletPrice->status == 'Em Andamento' ? 'success' : 'danger') }}"> {{ $outletPrice->status }}</span></p>
                        </div>

                        <hr>
                        <div class="row">
                            <p class="h3"><b>Documentos:</b> <a href="{{ url('storage/' . $outletPrice->docs) }}" class="btn btn-lg btn-primary" target="_blank"> Baixar Documentos</a></p>
                        </div>

                </div>
                
            </div>
            <!-- INFO USABILIDADE -->
        </div>
    </div>
</div>

@endsection