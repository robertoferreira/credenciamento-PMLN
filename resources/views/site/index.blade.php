@extends('layouts.master')

@section('content')

    <!-- INFO USABILIDADE -->
    <div class="container">
        <div class="row my-3">
            <div class="col-12">
                <h3>Sistema de Cadastramento de Fornecedor</h3>
                <hr>
                <p>Confira abaixo a lista de tomadas de preços disponíveis da Prefeitura Municipal de Lagoa Nova/RN. Valide os dados <a href="{{ route('site.create') }}" class="">cadastrando aqui</a>.</p>

            </div>
        </div>
    </div>
    <!-- INFO USABILIDADE -->


    <!-- FORM -->
    <div class="container">
        <div class="row my-3">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
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
        </div>
    </div>
    <!-- FORM -->



@endsection
