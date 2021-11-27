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

                <!-- MENSAGEM DE OBSERVAÇÃO -->
                <div class="container">
                    <div class="col-md-12">
                        @if(isset(Auth::user()->company->observation))
                            <div class="alert alert-danger">
                                <b><i class="fas fa-exclamation-circle"></i> Alerta:</b> {{ Auth::user()->company->observation }}
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
                    <h5 class="text-cetner">Tomadas de Preços em Aberto</h5>

                    <div class="m-5 p-5 bg-light">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="recebendo-envelope-tab" data-toggle="tab" href="#recebendo-envelope" role="tab" aria-controls="recebendo-envelope" aria-selected="true">Recebendo Envelope</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="opening-tab" data-toggle="tab" href="#opening" role="tab" aria-controls="opening" aria-selected="false">Em Andamento</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="closed-tab" data-toggle="tab" href="#closed" role="tab" aria-controls="closed" aria-selected="false">Encerrado</a>
                            </li>
                        </ul>
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="recebendo-envelope" role="tabpanel" aria-labelledby="recebendo-envelope-tab">
                                <div class="mt-5">
                                    @if($company->status == 'Ativa')
                                        <table id="example" class="table table-striped table-bordered mt-5" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Objeto</th>
                                                    <th>Abertura</th>
                                                    <th>Encerrametno</th>
                                                    <th>Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($outletPrices as $outletPrice)
                                                @if(count($outletPrices) > 0)
                                                <tr>
                                                    <td>
                                                        <span class="badge badge-info">{{ $outletPrice->status }}</span>
                                                    </td>
                                                    <td>{{ $outletPrice->object }}</td>
                                                    <td>{{ date( 'd/m/Y' , strtotime($outletPrice->published)) }}</td>
                                                    <td>{{ date( 'd/m/Y' , strtotime($outletPrice->closing)) }}</td>
                                                    <td>
                                                        <a href="{{ url('storage', $outletPrice->docs ) }}" class="btn btn-info float-left mr-2"><i class="fas fa-cloud-download-alt"></i></a>
                                                    </td>

                                                </tr>
                                                @endif

                                            @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Objeto</th>
                                                    <th>Abertura</th>
                                                    <th>Encerrametno</th>
                                                    <th>Download</th>

                                                </tr>
                                            </tfoot>
                                        </table>
                                    @else
                                        <div class="alert alert-danger">
                                            Existem pendências no seu cadastro, para ver as <b>Tomadas de Preços</b> em vigor favor
                                            entrar em contato com a Prefeitura de Lagoa Nova através do e-mail <b>cpl@lagoanova.rn.gov.br</b>
                                            ou pelo telefone: <b>(84) 3431-2102</b>.
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="opening" role="tabpanel" aria-labelledby="opening-tab">
                                <div class="mt-5">
                                    @if($company->status == 'Ativa')
                                        <table id="example" class="table table-striped table-bordered mt-5" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Objeto</th>
                                                    <th>Abertura</th>
                                                    <th>Encerrametno</th>
                                                    <th>Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($outletPricesOpen as $outletPrice)
                                                @if(count($outletPrices) > 0)
                                                <tr>
                                                    <td>
                                                        <span class="badge badge-info">{{ $outletPrice->status }}</span>
                                                    </td>
                                                    <td>{{ $outletPrice->object }}</td>
                                                    <td>{{ date( 'd/m/Y' , strtotime($outletPrice->published)) }}</td>
                                                    <td>{{ date( 'd/m/Y' , strtotime($outletPrice->closing)) }}</td>
                                                    <td>
                                                        <a href="{{ url('storage', $outletPrice->docs ) }}" class="btn btn-info float-left mr-2"><i class="fas fa-cloud-download-alt"></i></a>
                                                    </td>

                                                </tr>
                                                @endif

                                            @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Objeto</th>
                                                    <th>Abertura</th>
                                                    <th>Encerrametno</th>
                                                    <th>Download</th>

                                                </tr>
                                            </tfoot>
                                        </table>
                                    @else
                                        <div class="alert alert-danger">
                                            Existem pendências no seu cadastro, para ver as <b>Tomadas de Preços</b> em vigor favor
                                            entrar em contato com a Prefeitura de Lagoa Nova através do e-mail <b>cpl@lagoanova.rn.gov.br</b>
                                            ou pelo telefone: <b>(84) 3431-2102</b>.
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="closed" role="tabpanel" aria-labelledby="closed-tab">
                                <div class="mt-5">
                                    @if($company->status == 'Ativa')
                                        <table id="example" class="table table-striped table-bordered mt-5" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Objeto</th>
                                                    <th>Abertura</th>
                                                    <th>Encerrametno</th>
                                                    <th>Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($outletPricesClosed as $outletPrice)
                                                @if(count($outletPrices) > 0)
                                                <tr>
                                                    <td>
                                                        <span class="badge badge-info">{{ $outletPrice->status }}</span>
                                                    </td>
                                                    <td>{{ $outletPrice->object }}</td>
                                                    <td>{{ date( 'd/m/Y' , strtotime($outletPrice->published)) }}</td>
                                                    <td>{{ date( 'd/m/Y' , strtotime($outletPrice->closing)) }}</td>
                                                    <td>
                                                        <a href="{{ url('storage', $outletPrice->docs ) }}" class="btn btn-info float-left mr-2"><i class="fas fa-cloud-download-alt"></i></a>
                                                    </td>

                                                </tr>
                                                @endif

                                            @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Objeto</th>
                                                    <th>Abertura</th>
                                                    <th>Encerrametno</th>
                                                    <th>Download</th>

                                                </tr>
                                            </tfoot>
                                        </table>
                                    @else
                                        <div class="alert alert-danger">
                                            Existem pendências no seu cadastro, para ver as <b>Tomadas de Preços</b> em vigor favor
                                            entrar em contato com a Prefeitura de Lagoa Nova através do e-mail <b>cpl@lagoanova.rn.gov.br</b>
                                            ou pelo telefone: <b>(84) 3431-2102</b>.
                                        </div>
                                    @endif
                                </div>
                            </div>
                          </div>



                    </div>

                </div>
                <!-- INFO USABILIDADE -->
            </div><!-- FIM COL LG 12 -->

        </div><!-- FIM COL LG 12 -->

    </div><!-- FIM ROW -->
</div><!-- FIM CONTAINER -->

@endsection
