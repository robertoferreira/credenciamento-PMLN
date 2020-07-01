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

            <!-- INFORMAÇÕES DA SITUAÇÃO DA EMPRESA -->
            @if($companyActive == 'ATIVO')
            <div class="row">
                <div class="col-12 my-3">
                    <div class="alert alert-danger">
                        A empresa está com como INVATIVA na Receita Federal
                    </div>

                </div>
            </div>
            @endif
            <!-- INFORMAÇÕES DA SITUAÇÃO DA EMPRESA -->


            <div class="col-12">
                <h3>Bem vindo! <b>{{ auth()->user()->company()->first()->name_business }}</b></h3>

                <hr>
                <h5 class="text-cetner">Editar Empresa: <b>{{ $company->name_business }}</b></h5>



            </div>
            <!-- INFO USABILIDADE -->
        </div>
    </div>
</div>

@endsection
