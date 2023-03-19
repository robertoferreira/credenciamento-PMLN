@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-12">
            <div class="text-center">
                <!-- HEADER -->
                @include('inc.header')
                <!-- FIM HEADER -->
            </div>
        </div>

        <!-- MENU -->
        <div class="col-12 my-3">
            @include('inc.menu')
        </div>
        <!-- FIM MENU -->

    </div><!-- ROW -->

    <div class="row justify-content-center">
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

                <!-- MENSAGEM DE error -->
                <div class="container">
                    <div class="col-md-12">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{session('error')}}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- FIM MENSAGEM DE error -->

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            @if(isset(Auth::user()->company->id))
                            <h3>Bem vindo! <b>{{ auth()->user()->company()->first()->name_business }}</b></h3>
                            @else
                            <h3>Bem vindo! <b>{{ auth()->user()->name }}</b></h3>
                            @endif
                        </div>
                    </div>
                    <hr>

                </div><!-- FIM CONTAINER -->


                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-center">Usuários e Empresas Cadastradas no Sistema</b></h2>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-12">

                            <div class="m-5 p-5 bg-light">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Empresas Cadastradas</a>
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Usuários do Sistema</a>
                                        @if(Auth::user()->level > 1)
                                        <a class="nav-item nav-link" id="nav-admin-tab" data-toggle="tab" href="#nav-admin" role="tab" aria-controls="nav-admin" aria-selected="false">Super Usuários do Sistema</a>
                                        @endif
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active pb-5" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                                        <div class="my-5">
                                            <h4 class="text-success">Empresas e Usuários Cadastros</h4>
                                            <hr>
                                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nome</th>
                                                        <th>Responsável</th>
                                                        <th>Telefone</th>
                                                        <th>Situação</th>
                                                        <th>Ver</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($companiesActive as $company)
                                                        <tr>
                                                            <td>{{ $company->name_business ?? 'Admin do sistema' }}</td>
                                                            <td>{{ $company->user->name ?? '' }}</td>
                                                            <td>
                                                                {{ $company->phone_business ?? '' }}
                                                            </td>
                                                            <td>
                                                                @if ($company != null)
                                                                    <span class="badge badge-{{ ($company->status == 'Ativa' ? 'success' : 'danger') }}">{{ $company->status ?? '' }}</span>
                                                                @else
                                                                    <span class="badge badge-info">Admin do sistema</span>
                                                                @endif
                                                                {{-- <span class="badge badge-{{ ($company->company->status == 'Ativa' ? 'success' : 'danger') }}">{{ $company->company->status ?? '' }}</span> --}}
                                                            </td>
                                                            <td>
                                                                @if ($company != null)
                                                                    <a href="{{ route('company.show', $company->id) }}" class="btn btn-sm btn-info text-white"><i class="far fa-eye"></i></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Nome</th>
                                                        <th>Responsável</th>
                                                        <th>Telefone</th>
                                                        <th>Situação</th>
                                                        <th>Ver</th>
                                                    </tr>
                                                </tfoot>
                                            </table><!-- FIM TABLE -->
                                        </div> <!-- fim div -->

                                    </div><!-- FIM TAB PANE -->

                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <table id="example" class="table table-striped table-bordered my-5" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Nome</th>
                                                    <th>E-mail</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($usersSystem as $userSystem)
                                                <tr>
                                                    <td>
                                                        @if($userSystem->status == 'ativo')
                                                            <span class="badge badge-success">Ativo</span>
                                                        @else
                                                            <span class="badge badge-danger">Inativo</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $userSystem->name }}</td>
                                                    <td>{{ $userSystem->email }}</td>
                                                    <td>
                                                        <a href="{{ route('usuario.edit', $userSystem->uuid) }}" class="btn btn-primary"><i class="far fa-edit"></i> Editar</a>
                                                    </td>
                                                </tr>
                                            @endforeach


                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Nome</th>
                                                    <th>E-mail</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    @if(Auth::user()->level > 1)
                                    <!-- inicio tab super admins -->
                                    <div class="tab-pane fade" id="nav-admin" role="tabpanel" aria-labelledby="nav-admin-tab">
                                        <table id="example" class="table table-striped table-bordered my-5" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Nome</th>
                                                    <th>E-mail</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($usersSuperAdmins as $usersSuperAdmin)
                                                <tr>
                                                    <td>
                                                        @if($usersSuperAdmin->status == 'ativo')
                                                            <span class="badge badge-success">Ativo</span>
                                                        @else
                                                        <span class="badge badge-danger">Inativo</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $usersSuperAdmin->name }}</td>
                                                    <td>{{ $usersSuperAdmin->email }}</td>
                                                    <td>
                                                        <a href="{{ route('usuario.edit', $usersSuperAdmin->uuid) }}" class="btn btn-primary"><i class="far fa-edit"></i> Editar</a>
                                                        {{-- <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach


                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Nome</th>
                                                    <th>E-mail</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- fim tab super admins -->
                                    @endif

                                </div> <!-- TAB CONTENT -->

                            </div><!-- BG LIGHT -->

                        </div><!-- FIM COL 12 -->
                    </div><!-- FIM ROW -->
                </div><!-- FIM CONTAINER -->

            <!-- INFO USABILIDADE -->

    </div><!-- FIM ROW -->
</div><!-- FIM CONTAINER -->

@endsection
