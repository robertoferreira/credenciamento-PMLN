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
                            <div class="alert alert-warning">
                                {{ Auth::user()->company->observation }}
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


                        
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Título</th>
                                    <th>Data</th>
                                    <th>Válido até</th>
                                    <th>Objeto</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($outletPrices as $outletPrice)
                                @if(count($outletPrices) > 0)
                                <tr>
                                    <td>
                                        @if(!empty($outletPrice->status == 'ativo'))
                                            <span class="badge badge-success">Ativo</span>
                                        @else
                                            <span class="badge badge-danger">Inativo</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('outletprice.show', $outletPrice->uuid) }}"> {{ $outletPrice->title }} </a></td>
                                    <td>{{ date( 'd/m/Y' , strtotime($outletPrice->published)) }}</td>
                                    <td>{{ date( 'd/m/Y' , strtotime($outletPrice->open)) }}</td>
                                    <td>{{ $outletPrice->object }}</td>

                                </tr>
                                @endif

                            @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Status</th>
                                    <th>Título</th>
                                    <th>Data</th>
                                    <th>Válido até</th>
                                    <th>Objeto</th>

                                </tr>
                            </tfoot>
                        </table>
                        
                    </div>

                </div>
                <!-- INFO USABILIDADE -->
            </div><!-- FIM COL LG 12 -->

        </div><!-- FIM COL LG 12 -->

    </div><!-- FIM ROW -->
</div><!-- FIM CONTAINER -->

@endsection
