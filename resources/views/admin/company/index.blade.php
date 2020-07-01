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

            
            @if(isset(Auth::user()->company->id))
                <h3>Bem vindo! <b>{{ auth()->user()->company()->first()->name_business }}</b></h3>
            @else
                <h3>Bem vindo! <b>{{ auth()->user()->name }}</b></h3>
            @endif

                <hr>


                <form action="{{ route('company.update', Auth::user()->company->id) }}" method="POST" enctype="multipart/form-data" class="form-group row">
                    <div class="col-12 bg-light p-5 mb-5 rounded">
                        <h5 class="text-muted"><i class="fas fa-briefcase"></i> Dados do Fornecedor</h5>
                        {{ csrf_field() }}

                        @method('PUT')
                        <hr>

                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Fornecedor:<span class="text-danger">*</span> </label>
                                <div class="col-sm-10">
                                    <select name="provider" class="form-control" id="exampleFormControlSelect1">
                                        <option value="">Selecione uma opção</option>
                                        <option value="me_epp" {{ ($company->provider == 'me_epp' ? 'selected' : '') }}>ME ou EPP</option>
                                        <option value="ltda_limitada" {{ ($company->provider == 'ltda_limitada' ? 'selected' : '') }}>LTDA - LIMITADA</option>
                                        <option value="outros" {{ ($company->provider == 'outros' ? 'selected' : '') }}>OUTROS</option>
                                        <option value="eireli" {{ ($company->provider == 'eireli' ? 'selected' : '') }}>EIRELI</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">CNPJ:<span class="text-danger">*</span> </label>
                                <div class="col-sm-10">
                                    <input type="text" name="document" class="form-control" id="document" value="{{ $company->document }}" placeholder="Ex.: xx.xxx.xxx/xxxx-xx">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Razão/Nome:<span class="text-danger">*</span> </label>
                                <div class="col-sm-10">
                                    <input type="text" name="name_business" class="form-control" value="{{ $company->name_business }}" id="" placeholder="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label" data-toggle="atividade-receita-federal" data-placement="bottom" title="Situação de acordo com a Receita Federal.">Situação na RF:<span class="text-danger">*</span> <i class="fas fa-info-circle text-info"></i> </label>
                                <div class="col-sm-10">
                                    <h3><span class="badge badge-{{ ($company->status == 'Pendente' ? 'danger' : 'success') }}">{{ $company->status }}</span></h3>
                                    <input type="hidden" name="status" class="form-control" value="{{ $company->status }}">
                                </div>
                            </div>


                    </div> <!-- fim div  -->

                    <div class="col-12 bg-light mb-5 p-5 rounded">
                        <h5 class="text-muted"><i class="fas fa-home"></i> Endereço</h5>
                        <hr>

                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">CEP:<span class="text-danger">*</span> </label>
                                <div class="col-sm-10">
                                    <input type="text" name="zipcode" class="form-control" id="zipcode"  value="{{ $company->zipcode }}" placeholder="Ex.: xxxxx-xxx">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Endereço:<span class="text-danger">*</span> </label>
                                <div class="col-sm-10">
                                    <input type="text" name="address" class="form-control" value="{{ $company->address }}" id="" placeholder="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Número:<span class="text-danger">*</span> </label>
                                <div class="col-sm-10">
                                    <input type="number" name="number_address" class="form-control" value="{{ $company->number_address }}" id="" placeholder="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Complemento:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="complement" class="form-control" value="{{ $company->complement }}" id="" placeholder="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Bairro:<span class="text-danger">*</span> </label>
                                <div class="col-sm-10">
                                    <input type="text" name="neighborhood" class="form-control" value="{{ $company->neighborhood }}" id="" placeholder="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Cidade:<span class="text-danger">*</span> </label>
                                <div class="col-sm-10">
                                    <input type="text" name="city" class="form-control" value="{{ $company->city }}" id="" placeholder="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Estado:<span class="text-danger">*</span> </label>
                                <div class="col-sm-10">
                                    <select name="state" class="form-control" id="state">
                                        <option value="">Selecone um Estado</option>
                                        <option value="AC" {{ ($company->state === 'AC' ? 'selected' : 'AC') }}>AC</option>
                                        <option value="AL" {{ ($company->state === 'AL' ? 'selected' : '') }}>AL</option>
                                        <option value="AP" {{ ($company->state === 'AP' ? 'selected' : '') }}>AP</option>
                                        <option value="AM" {{ ($company->state === 'AM' ? 'selected' : '') }}>AM</option>
                                        <option value="BA" {{ ($company->state === 'BA' ? 'selected' : '') }}>BA</option>
                                        <option value="CE" {{ ($company->state === 'CE' ? 'selected' : '') }}>CE</option>
                                        <option value="DF" {{ ($company->state === 'DF' ? 'selected' : '') }}>DF</option>
                                        <option value="ES" {{ ($company->state === 'ES' ? 'selected' : '') }}>ES</option>
                                        <option value="GO" {{ ($company->state === 'GO' ? 'selected' : '') }}>GO</option>
                                        <option value="MA" {{ ($company->state === 'MA' ? 'selected' : '') }}>MA</option>
                                        <option value="MT" {{ ($company->state === 'MT' ? 'selected' : '') }}>MT</option>
                                        <option value="MS" {{ ($company->state === 'MS' ? 'selected' : '') }}>MS</option>
                                        <option value="MG" {{ ($company->state === 'MG' ? 'selected' : '') }}>MG</option>
                                        <option value="PA" {{ ($company->state === 'PA' ? 'selected' : '') }}>PA</option>
                                        <option value="PB" {{ ($company->state === 'PB' ? 'selected' : '') }}>PB</option>
                                        <option value="PR" {{ ($company->state === 'PR' ? 'selected' : '') }}>PR</option>
                                        <option value="PE" {{ ($company->state === 'PE' ? 'selected' : '') }}>PE</option>
                                        <option value="PI" {{ ($company->state === 'PI' ? 'selected' : '') }}>PI</option>
                                        <option value="RJ" {{ ($company->state === 'RJ' ? 'selected' : '') }}>RJ</option>
                                        <option value="RN" {{ ($company->state === 'RN' ? 'selected' : '') }}>RN</option>
                                        <option value="RO" {{ ($company->state === 'RO' ? 'selected' : '') }}>RO</option>
                                        <option value="RR" {{ ($company->state === 'RR' ? 'selected' : '') }}>RR</option>
                                        <option value="SC" {{ ($company->state === 'SC' ? 'selected' : '') }}>SC</option>
                                        <option value="SP" {{ ($company->state === 'SP' ? 'selected' : '') }}>SP</option>
                                        <option value="SE" {{ ($company->state === 'SE' ? 'selected' : '') }}>SE</option>
                                        <option value="TO" {{ ($company->state === 'TO' ? 'selected' : '') }}>TO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Telefone Comercial:<span class="text-danger">*</span> </label>

                                <div class="col-sm-10">
                                    <input type="text" name="phone_business" class="form-control" value="{{ $company->phone_business }}" id="phone_business" placeholder="(00) 00000-0000">
                                </div>
                            </div>

                    </div> <!-- fim div  -->


                    <div class="col-12 bg-light mb-5 p-5 rounded">
                        <h5 class="text-muted"><i class="fas fa-user"></i> Atividade(s) da Empresa</h5>
                        <hr>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">CNAI:<span class="text-danger">*</span> </label>
                                <div class="col-sm-10">

                                    <a class="btn btn-lg btn-success" href="{{ url('storage/' . $company->cnai) }}" target="_blank"><i class="fas fa-file-download"></i> Baixar Arquivo</a>
                                    <hr>
                                    <!-- fim div  <textarea class="form-control" id="" placeholder="Ex.: 95.11-8-00 - Reparação e manutenção de computadores e de equipamentos periféricos" rows="10"></textarea>-->
                                    <p class="text-muted">Caso queira substituir o arquivo existente é só enviar um novo arquivo.</p>
                                    <input type="file" name="docs" id="" class="form-control">
                                    <input type="hidden" name="docs_old"  value="{{ $company->docs }}" class="form-control">
                                    <small id="emailHelp" class="form-text text-muted">Envie um PDF ou ZIP com os dados da sua empresa.</small>

                                </div>
                            </div>

                    </div> <!-- fim div  -->

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-lg btn-right">Cadastrar</button>
                    </div>
                </form>



            </div>
            <!-- INFO USABILIDADE -->
        </div>
    </div>
</div>

@endsection
