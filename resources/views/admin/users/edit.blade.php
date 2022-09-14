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
                <h2 class="text-center">Usuários e Empresas Cadastradas no Sistema</b></h2>

                <div class="m-5 p-5 bg-light">

                    <form method="POST" action="{{ route('usuario.update', $userEdit->uuid) }}">
                    {{ csrf_field() }}
                    @method('PUT')
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nome</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="{{ $userEdit->name }}" class="form-control @error('name') is-invalid @enderror" id="inputEmail3" placeholder="Fulano de tal">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" value="{{ $userEdit->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="fulano@seuemail.com.br">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        {{-- <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="exampleFormControlSelect1">
                                    <option value="">Selecione um status</option>
                                    <option value="ativo" {{ ($userEdit->status == 'ativo' ? 'selected' : '') }}>Ativo</option>
                                    <option value="inativo" {{ ($userEdit->status == 'inativo' ? 'selected' : '') }}>Inativo</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div> --}}

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Senha</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputEmail3" placeholder="Use números e letras">
                                <small id="emailHelp" class="form-text text-muted">Só insira algo se for trocar a senha.</small>
                                @error('password')
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
