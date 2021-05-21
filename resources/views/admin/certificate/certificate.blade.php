<!doctype html>
<html lang="pt-br">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Custom CSS Certificate -->
    <link rel="stylesheet" href="{{ asset('_assets/css/certificate.css') }}" media="print">

    <link href="{{ asset('_assets/fontawesome/css/all.css') }}" rel="stylesheet">


    <title>Credenciamento CPL - Lagoa Nova</title>
    </head>
<body>
<page size="A4">
<div class="container">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4 text-center">
            <a href="#" onClick="window.print()" class="btn btn-success btn-lg btn-print"> Imprimir</a>
            <a href="{{ route('company.certificate.index') }}" class="btn btn-info btn-lg btn-print"> Voltar</a>
        </div>
        <div class="col-4"></div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="certificate">

                <div class="border-certificate">

                <div class="row">
                    <div class="col-4">
                        <div class="text-right">
                            <div class="logo">
                                <img src="{{ asset('_assets/img/logo-prefeitura-de-lagoa-nova.png') }}" alt="Logo Prefeitura de Lagoa Nova" width="150">
                            </div>

                        </div>
                    </div>

                    <div class="col-8">
                        <div class="title-2 text-left mt-2">
                            <p class="text-1"><b>COMISSÃO PERMANENTE DE LICITAÇÃO </b></p>
                        </div>
                    </div>


                </div><!-- FIM ROW -->

                    <div class="title-3">
                        <p class="text-3 text-center"><b>CERTIFICADO DE REGISTRO CADASTRAL</b></p>
                    </div>

                    <br>

                    <p class="text-4">Certificamos para os devidos fins que a Empresa abaixo identificada, encontra se cadastrada no rol de
                        Fornecedores / Prestadores de Serviços desta Prefeitura, estando apta a participar de processos
                        licitatórios promovidos por esta Municipalidade.</p>

                    <div class="info">
                        <p class="name_business">
                            <b>Nome:</b> {{ $certificate->company->name_business }}
                        </p>

                        <p class="address">
                            <b>Endereço:</b> {{ $certificate->company->address }}, Nº {{ $certificate->company->number_address }}, {{ $certificate->company->neighborhood }}, {{ $certificate->company->city }}/{{ $certificate->company->state }}
                        </p>

                        <p class="CNPJ">
                            <b>CNPJ:</b> {{ $certificate->company->document }}
                        </p>

                        <p class="main_active">
                            <b>Atividade Principal:</b>
                            @foreach($mainActivity as $m)
                                <p class="info-activity"><i class="fas fa-caret-right"></i> {{ $m->text }}: {{ $m->code }}</p>
                            @endforeach
                        </p>

                        <p class="secundary_active">
                            <b>Atividade(s) Secundária(s):</b>
                            @foreach($secondaryActivity as $s)
                                <p class="info-activity"><i class="fas fa-caret-right"></i> {{ $s->text }}: {{ $s->code }}</p>
                            @endforeach
                        </p>

                    </div><!-- FIM INFO  -->

                    <div class="row mt-5 footer-certificate">

                        <div class="col-md-6">
                            <p class="text-right">
                                <b>Sua chave:</b> {{ $certificate->uuid }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <p class="text-left">
                                Este registro é válido de <b>{{ $certificate->created_at  }}</b> até <b>{{ $certificate->expired_at }}</b>
                            </p>
                        </div>
                    </div>

                </div><!-- FIM BOERDER  -->

            </div><!-- FIM CERTIFICATE -->
        </div>
    </div>
</div>
</page>

<!-- Fontawesome JavaScript -->
<script defer src="{{ asset('_assets/fontawesome/js/all.js') }}"></script>
</body>
</html>
