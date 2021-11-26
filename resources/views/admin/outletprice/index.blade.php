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
        <div class="col-12">
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

            @if(isset(Auth::user()->company->id))
                <h3>Bem vindo! <b>{{ auth()->user()->company()->first()->name_business }}</b></h3>
            @else
                <h3>Bem vindo! <b>{{ auth()->user()->name }}</b></h3>
            @endif
                <hr>
                <h2 class="text-center">Tomada de Preços Cadastradas</b></h2>

                <div class="col-12 m-5 p-5 bg-light">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Objeto</th>
                                <th>Abertura</th>
                                <th>Encerramento</th>
                                <th>Ação</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($outletPrices as $outletPrice)
                                <tr>

                                    <td>
                                        @if($outletPrice->status == 'Em Andamento')
                                            <span class="badge badge-success">Em Andamento</span>
                                        @elseif ($outletPrice->status == 'Recebimento de Envelope')
                                            <span class="badge badge-info">Recebimento de Envelope</span>
                                        @else
                                            <span class="badge badge-danger">Encerrado</span>
                                        @endif
                                    </td>
                                    <td>{{ $outletPrice->object }}</td>
                                    <td>{{ date( 'd/m/Y' , strtotime($outletPrice->published)) }}</td>
                                    <td>{{ date( 'd/m/Y' , strtotime($outletPrice->closing)) }}</td>
                                    <td>
                                        <a href="{{ Storage::disk('s3')->url($outletPrice->docs ) }}" class="btn btn-info float-left mr-2"><i class="fas fa-cloud-download-alt"></i></a>
                                        <a href="{{ route('outletprice.edit', $outletPrice->id ) }}" class="btn btn-success float-left mr-2"><i class="fas fa-edit"></i></a>
                                        <form method="post" action="{{ route('outletprice.delete', $outletPrice->id ) }}" class="float-left">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Status</th>
                                <th>Objeto</th>
                                <th>Abertura</th>
                                <th>Encerramento</th>
                                <th>Ação</th>

                            </tr>
                        </tfoot>
                    </table>

                </div>


            </div>
            <!-- INFO USABILIDADE -->
        </div>
    </div>
</div>

@endsection
