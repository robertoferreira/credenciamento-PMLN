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
                <h2 class="text-center mb-5 mt-5">Lista de Certificados da Empresa</h2>

               
                @if(count($certificates) > 0)
                
                    @if(date('Y-m-d', strtotime(now())) > date('Y-m-d', strtotime($lastCertificate->expired_at)))

                        @if(Auth::user()->company->status != 'Pendente')

                                <div class="text-center my-5">
                                    <div class="col-4 offset-4">
                                        <form action="{{ route('company.certificate.store') }}" method="post" class="my-5">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="company_id" value="{{ Auth::user()->company->id }}">
                                            <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fas fa-file-pdf"></i> Emitir Novo Certificado</button>
                                        </form>
                                    </div>
                                </div>


                        @else
                            <div class="alert alert-danger">
                                Não é possível emitir certificado, sua empresa está com a documentação pendente!
                            </div>
                        @endif
                    @endif

                
                
                <!-- TABELA DE CERTIFICADOS -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Chave</th>
                            <th scope="col">Emitido Em:</th>
                            <th scope="col">Data da Validade</th>
                            <th scope="col">Visualizar</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($certificates as $certificate)
                        <tr>
                            <th scope="row">{{ $certificate->id }}</th>
                            <td>{{ $certificate->uuid }}</td>
                            <td>{{ date('d/m/Y', strtotime($certificate->created_at)) }} </td>
                            <td>{{ date('d/m/Y', strtotime($certificate->expired_at)) }} </td>
                            <td>
                                <a href="{{ route('company.certificate.final', $certificate->uuid ) }}" class="btn btn-success" target="window"><i class="fas fa-eye"></i> Ver Certificado</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- FIM TABELA DE CERTIFICADOS -->
                

                @else
                    @if(Auth::user()->company->status != 'Pendente')
                        
                        <div class="col-4 offset-4">

                            <form action="{{ route('company.certificate.store') }}" method="post" class="my-5">
                                {{ csrf_field() }}
                                <input type="hidden" name="company_id" value="{{ Auth::user()->company->id }}">
                                <button type="submit" class="btn btn-success btn-lg btn-block">Emitir Certificado</button>
                            </form>
                        </div>
                        
                    @else
                        <div class="alert alert-danger mt-5 mb-5">
                            Não é possível emitir certificado, sua empresa está com a documentação pendente! Entre em contato com a CPL pelo e-mail <b>cpl@lagoanova.rn.gov.br</b>.
                        </div>
                    @endif
                @endif

            </div>
            <!-- INFO USABILIDADE -->
        </div>
    </div>
</div>

@endsection
