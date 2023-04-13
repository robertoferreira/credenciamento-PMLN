@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="row-fluid justify-content-center">
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

            <!-- MENSAGEM DE OBSERVAÇÃO -->
            <div class="container">
                <div class="col-md-12">
                    @if($company->observation)
                        <div class="alert alert-warning">
                            {{ $company->observation }}
                        </div>
                    @endif
                </div>
            </div>
            <!-- FIM MENSAGEM DE OBSERVAÇÃO -->


            @if(isset(Auth::user()->company->id))
                <h3>Bem vindo! <b>{{ auth()->user()->company()->first()->name_business }}</b></h3>
            @else
                <h3>Bem vindo! <b>{{ auth()->user()->name }}</b></h3>
            @endif

                <hr>
            <div class="container">
                <div class="row">
                    <div class="col-2 bg-light-2 p-2">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Informações</a>
                            <a class="nav-link" id="v-pills-certificate-tab" data-toggle="pill" href="#v-pills-certificate" role="tab" aria-controls="v-pills-certificate" aria-selected="false">Certificados</a>
                        </div>
                    </div><!-- FIM COL 5 -->


                    <div class="col-10">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <!-- DADOS DO FORNECEDOR -->
                                <div class="col-12 bg-light p-2 mb-1 rounded">
                                    <h3 class="text-muted"><i class="fas fa-briefcase"></i> Dados do Fornecedor</h3>
                                    <br>
                                    <p><b>Razão Social:</b> {{ $company->name_business }}</p>
                                    <p><b>CNPJ:</b> {{ $company->document }}</p>
                                    <p><b>Tipo:</b> {{ ($company->provider == 'me_epp' ? 'Micro Empresa' : ($company->provider == 'ltda_limitada' ? 'LTDA' : ($company->provider == 'outros' ? 'Outros' : ($company->provider == 'eireli' ? 'Eireli' : '')))) }}</p>
                                </div>
                                <!-- FIM DADOS DO FORNECEDOR -->
                                <hr>

                                <!-- DADOS DO ENDEREÇO -->
                                <div class="col-12 bg-light p-2 mb-1 rounded">
                                    <h3 class="text-muted"><i class="fas fa-home"></i> Endereço</h3>
                                    <br>
                                    <p><b>Telefone:</b> {{ $company->phone_business }}</p>
                                    <p><b>CEP:</b> {{ $company->zipcode }}</p>
                                    <p><b>Endereço:</b> {{ $company->address }}</p>
                                    <p><b>Número:</b> {{ $company->number_address }}</p>
                                    <p><b>Complmento:</b> {{ $company->complement }}</p>
                                    <p><b>Bairro:</b> {{ $company->neighborhood }}</p>
                                    <p><b>Cidade:</b> {{ $company->city }}</p>
                                    <p><b>Estado:</b> {{ $company->state }}</p>

                                </div>
                                <!-- FIM DADOS DO ENDEREÇO -->

                                <hr>

                                <!-- DADOS DO DONO -->
                                <div class="col-12 bg-light p-2 mb-1 rounded">
                                    <h3 class="text-muted"><i class="fas fa-user-check"></i> Informações de Contato</h3>
                                    <br>
                                    <p><b>Nome:</b> {{ $company->user->name }}</p>
                                    <p><b>CPF:</b> {{ $company->user->document_person_owner }}</p>
                                    <p><b>Data de Nascimento:</b> {{ $company->user->birthday }}</p>
                                    <p><b>E-mail:</b> {{ $company->user->email }}</p>
                                    <p><b>Telefone Celular:</b> {{ $company->user->phone_person }}</p>
                                </div>
                                <!-- FIM DADOS DO DONO -->

                                <hr>

                                <div class="col-12 bg-light p-2 mb-1 rounded">
                                    <a class="btn btn-lg btn-success" href="{{ Storage::disk('s3')->url($company->docs) }}" target="_blank">
                                        <i class="fas fa-file-download"></i> Baixar Arquivo
                                    </a>
                                </div>

                                <hr>



                                <!-- DADOS DO OBSERVAÇÃO -->
                                <div class="col-12 bg-light p-2 mb-1 rounded">
                                    <h3 class="text-muted"><i class="fas fa-exclamation-triangle"></i> Observações</h3>
                                    <form action="{{ route('company.observation.update', $company->id) }}" method="POST">

                                        {{ csrf_field() }}

                                        <!-- STATUS DA EMPRESA -->
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Status:<span class="text-danger">*</span> </label>
                                            <div class="col-sm-10">
                                                <select name="status" class="form-control" id="state">
                                                    <option value="">Selecone um Status</option>
                                                    <option value="Ativa" {{ ($company->status === 'Ativa' ? 'selected' : '') }}>Ativa</option>
                                                    <option value="Pendente" {{ ($company->status === 'Pendente' ? 'selected' : '') }}>Pendente</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- FIM STATUS DA EMPRESA -->

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Adicione observações sobre a empresa</label>
                                            <textarea class="form-control" name="observation" id="exampleFormControlTextarea1" rows="3">@if($company->observation) {{ $company->observation  }} @endif</textarea>
                                        </div>
                                        <button class="btn btn-success">Enviar Observação</button>
                                    </form>
                                </div>
                                <!-- FIM DADOS DO OBSERVAÇÃO -->
                            </div>

                            <div class="tab-pane fade" id="v-pills-certificate" role="tabpanel" aria-labelledby="v-pills-certificate-tab">

                                @if(Auth::user()->level >= 2)
                                <div class="row">
                                    <div class="container mb-4">
                                        <a href="{{ route('company.certificate.create', $company->id) }}" class="btn btn-success btn-lg float-right">Emitir certificado</a>
                                    </div>
                                </div>
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
                                            <td>{{ $certificate->created_at }} </td>
                                            <td>{{ $certificate->expired_at }} </td>
                                            <td>
                                                <a href="{{ route('company.certificate.final', $certificate->uuid ) }}" class="btn btn-success" target="window"><i class="fas fa-eye"></i> Ver Certificado</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!-- FIM TABELA DE CERTIFICADOS -->
                            </div><!-- FIM TAB CERTIFICADOS -->

                        </div>
                    </div><!-- FIM COL 7 -->
                </div>
            </div>





            </div>
            <!-- INFO USABILIDADE -->
        </div>
    </div>
</div>

@endsection
