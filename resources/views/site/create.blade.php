@extends('layouts.master')

@section('content')

    <!-- INFO USABILIDADE -->
    <div class="container">
        <div class="row my-3">
            <div class="col-12">
                <h3>Sistema Cadastramento de Fornecedor</h3>
                <hr>
                <p>PARA EFETIVAR O CADASTRO ou RENOVAÇAO, SIGA OS PASSOS ABAIXO:</p>
                <ul>
                    <li> 1 - Coloque seus dados para iniciar o processo de Credenciamento Digital - Licitações </li>
                    <li> 2 - Enviar toda documentação através do Portal Digital disponibilizado em formato PDF.</li>
                    <li> 3 - Para novos cadastro ou Renovações, o processo poderá ser concluído no máximo <b>24 Horas</b>.</li>
                    <li> 4 - As credenciais do Sistema serão enviadas por e-mail e o acesso é via WEB.</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- INFO USABILIDADE -->

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

    <!-- ERROS -->
    <div class="container">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <!-- FIM ERROS -->

    <!-- FORM -->
    <div class="container">
        <div class="row my-3">
            <form action="{{ route('site.store') }}" method="POST" enctype="multipart/form-data" class="form-group row">
                <div class="col-12 bg-light p-5 mb-5 rounded">
                    <h5 class="text-muted"><i class="fas fa-briefcase"></i> Dados do Fornecedor</h5>
                    {{ csrf_field() }}
                    <hr>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Fornecedor:<span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                            <select name="provider" class="form-control" id="exampleFormControlSelect1">
                                <option value="">Selecione uma opção</option>
                                <option value="me_epp" {{ (old('provider') == 'me_epp' ? 'selected' : '') }}>ME ou EPP
                                </option>
                                <option
                                    value="ltda_limitada" {{ (old('provider') == 'ltda_limitada' ? 'selected' : '') }}>
                                    LTDA - LIMITADA
                                </option>
                                <option value="outros" {{ (old('provider') == 'outros' ? 'selected' : '') }}>OUTROS
                                </option>
                                <option value="eireli" {{ (old('provider') == 'eireli' ? 'selected' : '') }}>EIRELI
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">CNPJ:<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <input type="text" name="document" class="form-control" id="document"
                                   value="{{ old('document') }}" placeholder="Ex.: xx.xxx.xxx/xxxx-xx">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Razão/Nome:<span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="name_business" class="form-control"
                                   value="{{ old('name_business') }}" id="" placeholder="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Capital Social:<span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">R$</div>
                                </div>
                                <input type="text" name="share_capital" class="form-control"
                                       value="{{ old('share_capital') }}" id="share_capital" placeholder="">
                            </div>

                        </div>
                    </div>


                </div> <!-- fim div  -->

                <div class="col-12 bg-light mb-5 p-5 rounded">
                    <h5 class="text-muted"><i class="fas fa-home"></i> Endereço</h5>
                    <hr>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">CEP:<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <input type="text" name="zipcode" class="form-control" id="zipcode"
                                   value="{{ old('zipcode') }}" placeholder="Ex.: xxxxx-xxx">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Endereço:<span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="address" class="form-control" value="{{ old('address') }}" id=""
                                   placeholder="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Número:<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <input type="number" name="number_address" class="form-control"
                                   value="{{ old('number_address') }}" id="" placeholder="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Complemento:</label>
                        <div class="col-sm-10">
                            <input type="text" name="complement" class="form-control" value="{{ old('complement') }}"
                                   id="" placeholder="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Bairro:<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <input type="text" name="neighborhood" class="form-control"
                                   value="{{ old('neighborhood') }}" id="" placeholder="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Cidade:<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <input type="text" name="city" class="form-control" value="{{ old('city') }}" id=""
                                   placeholder="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Estado:<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <select name="state" class="form-control" id="state">
                                <option value="">Selecone um Estado</option>
                                <option value="AC" {{ (old('state') === 'AC' ? 'selected' : 'AC') }}>AC</option>
                                <option value="AL" {{ (old('state') === 'AL' ? 'selected' : 'AL') }}>AL</option>
                                <option value="AP" {{ (old('state') === 'AP' ? 'selected' : 'AP') }}>AP</option>
                                <option value="AM" {{ (old('state') === 'AM' ? 'selected' : 'AM') }}>AM</option>
                                <option value="BA" {{ (old('state') === 'BA' ? 'selected' : 'BA') }}>BA</option>
                                <option value="CE" {{ (old('state') === 'CE' ? 'selected' : 'CE') }}>CE</option>
                                <option value="DF" {{ (old('state') === 'DF' ? 'selected' : 'DF') }}>DF</option>
                                <option value="ES" {{ (old('state') === 'ES' ? 'selected' : 'ES') }}>ES</option>
                                <option value="GO" {{ (old('state') === 'GO' ? 'selected' : 'GO') }}>GO</option>
                                <option value="MA" {{ (old('state') === 'MA' ? 'selected' : 'MA') }}>MA</option>
                                <option value="MT" {{ (old('state') === 'MT' ? 'selected' : 'MT') }}>MT</option>
                                <option value="MS" {{ (old('state') === 'MS' ? 'selected' : 'MS') }}>MS</option>
                                <option value="MG" {{ (old('state') === 'MG' ? 'selected' : 'MG') }}>MG</option>
                                <option value="PA" {{ (old('state') === 'PA' ? 'selected' : 'PA') }}>PA</option>
                                <option value="PB" {{ (old('state') === 'PB' ? 'selected' : 'PB') }}>PB</option>
                                <option value="PR" {{ (old('state') === 'PR' ? 'selected' : 'PR') }}>PR</option>
                                <option value="PE" {{ (old('state') === 'PE' ? 'selected' : 'PE') }}>PE</option>
                                <option value="PI" {{ (old('state') === 'PI' ? 'selected' : 'PI') }}>PI</option>
                                <option value="RJ" {{ (old('state') === 'RJ' ? 'selected' : 'RJ') }}>RJ</option>
                                <option value="RN" {{ (old('state') === 'RN' ? 'selected' : 'RN') }}>RN</option>
                                <option value="RO" {{ (old('state') === 'RO' ? 'selected' : 'RO') }}>RO</option>
                                <option value="RR" {{ (old('state') === 'RR' ? 'selected' : 'RR') }}>RR</option>
                                <option value="SC" {{ (old('state') === 'SC' ? 'selected' : 'SC') }}>SC</option>
                                <option value="SP" {{ (old('state') === 'SP' ? 'selected' : 'SP') }}>SP</option>
                                <option value="SE" {{ (old('state') === 'SE' ? 'selected' : 'SE') }}>SE</option>
                                <option value="TO" {{ (old('state') === 'TO' ? 'selected' : 'TO') }}>TO</option>
                            </select>
                        </div>
                    </div>

                </div> <!-- fim div  -->

                <div class="col-12 bg-light mb-5 p-5 rounded">
                    <h5 class="text-muted"><i class="fas fa-user"></i> Dados do usário responsável pelo <b>Cadastro /
                            Renovação</b></h5>
                    <hr>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">CPF:<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <input type="text" name="document_person_owner" class="form-control"
                                   id="document_person_owner" value="{{ old('document_person_owner') }}"
                                   placeholder="Ex.: xxx.xxx.xxx-xx">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Nome:<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" id=""
                                   placeholder="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Data de Nascimento:<span
                                class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <input type="date" name="birthday" value="{{ old('birthday') }}" class="form-control" id=""
                                   placeholder="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">E-mail de Cadastro:<span
                                class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" id=""
                                   placeholder="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Senha de Acesso:<span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" id="" placeholder="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Telefone Comercial:<span
                                class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <input type="text" name="phone_business" class="form-control"
                                   value="{{ old('phone_business') }}" id="phone_business"
                                   placeholder="(00) 00000-0000">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Telefone Celular:<span
                                class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <input type="text" name="phone_person" class="form-control"
                                   value="{{ old('phone_person') }}" id="phone_person" placeholder="(00) 00000-0000">
                        </div>
                    </div>


                </div> <!-- fim div  -->

                <div class="col-12 bg-light mb-5 p-5 rounded">
                    <h5 class="text-muted"><i class="fas fa-user"></i> Atividade(s) da Empresa</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Documentação:<span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-10">
                            <!-- fim div  <textarea class="form-control" id="" placeholder="Ex.: 95.11-8-00 - Reparação e manutenção de computadores e de equipamentos periféricos" rows="10"></textarea>-->
                            <input type="file" name="docs" id="" class="form-control">
                            <small id="emailHelp" class="form-text text-muted">Envie um PDF ou ZIP com os dados da sua
                                empresa.</small>

                        </div>
                    </div>

                </div> <!-- fim div  -->

                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-lg btn-right">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- FORM -->



@endsection
