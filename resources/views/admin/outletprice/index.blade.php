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

            @if(isset(Auth::user()->company->id))
                <h3>Bem vindo! <b>{{ auth()->user()->company()->first()->name_business }}</b></h3>
            @else
                <h3>Bem vindo! <b>{{ auth()->user()->name }}</b></h3>
            @endif
                <hr>
                <h2 class="text-center">Tomada de Preços Cadastradas</b></h2>

                <div class="m-5 p-5 bg-light">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Título</th>
                                <th>Publicado</th>
                                <th>Número/Ano</th>
                                <th>Ação</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($outletPrices as $outletPrice)
                                <tr>
                                
                                    <td>
                                    @if($outletPrice->status == 'ativo')
                                        <span class="badge badge-success">Ativo</span>
                                    @else
                                        <span class="badge badge-danger">Inativo</span>
                                    @endif
                                    </td>
                                    <td>{{ $outletPrice->title }}</td>
                                    <td>{{ date( 'd/m/Y' , strtotime($outletPrice->published)) }}</td>
                                    <td>{{ $outletPrice->number }}</td>
                                    <td>
                                        <a href="{{ route('outletprice.edit', $outletPrice->id ) }}" class="btn btn-info float-left mr-2"><i class="fas fa-edit"></i> Editar</a>
                                        <form method="post" action="{{ route('outletprice.delete', $outletPrice->id ) }}" class="float-left">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Excluir</button>
                                        </form>
                                    </td>    
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Status</th>
                                <th>Título</th>
                                <th>Publicado</th>
                                <th>Número/Ano</th>
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