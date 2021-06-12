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

            <div class="col-12">
            @if(isset(Auth::user()->company->id))
                <h3>Bem vindo! <b>{{ auth()->user()->company()->first()->name_business }}</b></h3>
            @else
                <h3>Bem vindo! <b>{{ auth()->user()->name }}</b></h3>
            @endif
                <hr>
                <h2 class="text-center">Editar Tomada de Preço - {{ $outletPrice->title }}</b></h2>

                <div class="m-5 p-5 bg-light">

                    <form method="POST" action="{{ route('outletprice.update', $outletPrice->id ) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Objeto</label>
                        <div class="col-sm-10">
                            <input type="text" name="object" value="{{ $outletPrice->object }}" class="form-control @error('object') is-invalid @enderror">
                            @error('object')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Número/Ano</label>
                        <div class="col-sm-10">
                            <input type="text" name="number" value="{{ $outletPrice->number }}" class="form-control @error('number') is-invalid @enderror">
                            @error('number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Publicado em:</label>
                        <div class="col-sm-10">
                            <input type="date" name="published" value="{{ date('Y-m-d', strtotime($outletPrice->published)) }}" class="form-control @error('published') is-invalid @enderror">
                            @error('published')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Encerramento em:</label>
                        <div class="col-sm-10">
                            <input type="date" name="closing" value="{{ date('Y-m-d', strtotime($outletPrice->closing)) }}" class="form-control @error('closing') is-invalid @enderror">
                            @error('closing')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control @error('status') is-invalid @enderror" name="status" id="exampleFormControlSelect1">
                                <option value="">Selecione um status</option>
                                <option value="Em Andamento" {{ ($outletPrice->status == 'Em Andamento' ? 'selected' : '') }}>Em Andamento</option>
                                <option value="Encerrado" {{ ($outletPrice->status == 'Encerrado' ? 'selected' : '') }}>Encerrado</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Documentos:<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <div class="py-2">
                                <a href="{{ Storage::disk('s3')->url($outletPrice->docs) }}" class="btn btn-success btn-lg" target="_blank">
                                    <i class="fas fa-cloud-download-alt fa-2x"></i> Baixe o arquivo
                                </a>
                            </div>

                            <input type="file" name="docs" id="" class="form-control @error('docs') is-invalid @enderror">
                            <small id="emailHelp" class="form-text text-muted ">Só utilize este campo se for atualziar o substituir o arquivo já existente. Envie um PDF ou ZIP.</small>
                            @error('docs')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="text-right">
                                <button type="submit" class="btn btn-lg btn-primary">Atualizar</button>
                                </div>
                                
                            </div>
                        </div>
                    </form>

                </div>
                
            </div>
            <!-- INFO USABILIDADE -->
        </div>
    </div>
</div>

@endsection