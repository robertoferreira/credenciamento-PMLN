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
                <h2 class="text-center">Cadastro de Tomada de Preço</b></h2>

                <div class="m-5 p-5 bg-light">

                    <form method="POST" action="{{ route('outletprice.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Título</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Número/Ano</label>
                            <div class="col-sm-10">
                                <input type="text" name="number" class="form-control @error('number') is-invalid @enderror">
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
                                <input type="date" name="published" class="form-control @error('published') is-invalid @enderror">
                                @error('published')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Abertura em:</label>
                            <div class="col-sm-10">
                                <input type="date" name="open" class="form-control @error('open') is-invalid @enderror">
                                @error('open')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Objeto</label>
                            <div class="col-sm-10">
                                <input type="text" name="object" class="form-control @error('object') is-invalid @enderror">
                                @error('object')
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
                                    <option value="ativo">Ativo</option>
                                    <option value="inativo">Inativo</option>
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
                                <input type="file" name="docs" id="" class="form-control @error('docs') is-invalid @enderror">
                                <small id="emailHelp" class="form-text text-muted ">Envie um PDF ou ZIP.</small>
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
                                <button type="submit" class="btn btn-lg btn-primary">Cadastrar</button>
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