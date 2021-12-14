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
        <div class="col-lg-12">
            <!-- INFO USABILIDADE -->

            <!-- MENU -->
            <div class="row">
                <div class="col-12 my-3">
                    @include('inc.menu')
                </div>
            </div>
            <!-- FIM MENU -->

            <div class="col-12">

            <!-- MENSAGEM DE SUCESSO -->
            <div class="container">
                <div class="col-md-12">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                </div>
            </div>
            <!-- FIM MENSAGEM DE SUCESSO -->

            <!-- MENSAGEM DE WARNING -->
            <div class="container">
                <div class="col-md-12">
                    @if(session('warning'))
                        <div class="alert alert-warning">
                            {{session('warning')}}
                        </div>
                    @endif
                </div>
            </div>
            <!-- FIM MENSAGEM DE WARNING -->

            @if(isset(Auth::user()->company->id))
                <h3>Bem vindo! <b>{{ auth()->user()->company()->first()->name_business }}</b></h3>
            @else
                <h3>Bem vindo! <b>{{ auth()->user()->name }}</b></h3>
            @endif

                <hr>
                <h2 class="text-center mb-5 mt-5">Certificado da Empresa - <b>{{ $company->name_business }}</b></h2>

                @if(Auth::user()->level >= 2)

                    <div class="text-center my-5">
                        <div class="col-4 offset-4">
                            <form action="{{ route('company.certificate.store') }}" method="post" class="my-5">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="start_date">Data de Início</label>
                                    <input type="date" name="start_date" class="form-control" id="start_date" aria-describedby="dateHelp">
                                    <small id="dateHelp" class="form-text text-muted">Escolha uma data de íncio.</small>
                                    </div>

                                    <div class="form-group">
                                    <label for="end_date">Data de Fim</label>
                                    <input type="date" name="end_date" class="form-control" id="end_date" aria-describedby="dateHelp">
                                    <small id="dateHelp" class="form-text text-muted">Escolha uma data de término.</small>
                                    </div>

                                <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fas fa-file-pdf"></i> Emitir Novo Certificado</button>
                            </form>
                        </div>
                    </div>

                @else
                    <div class="alert alert-danger">
                        Não é possível emitir certificado, você não tem permissão para realizar esta ação!
                    </div>
                @endif

            </div>
            <!-- INFO USABILIDADE -->
        </div>
    </div>
</div>

@endsection
