<nav class="navbar navbar-dark bg-primary navbar-expand-lg">
    <a class="navbar-brand" href="#">Credenciamento PMLN</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item link-person mr-2">
                <a class="nav-link" href="{{ route('company.index') }}">Início</a>
            </li>
            

            @if(isset(Auth::user()->company->id))
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Meus dados
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('usuario.edit', Auth::user()->uuid ) }}">Editar meus Dados</a>
                <a class="dropdown-item" href="{{ route('company.edit', Auth::user()->company->id ) }}">Editar Dados da Empresa</a>
                <a class="dropdown-item" href="{{ route('company.certificate.index') }}">Ver Certificados</a>
            </li>
            @endif

            @if(Auth::user()->level >= 1)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuários
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('usuario.create') }}">Cadastrar Usuário</a>
                <a class="dropdown-item" href="{{ route('usuario.index') }}">Listar Usuários</a>
            </li>
            @endif

            @if(Auth::user()->level > 0)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tomada de Preço
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('outletprice.create') }}">Cadastrar</a>
                <a class="dropdown-item" href="{{ route('outletprice.index') }}">Listar Todas</a>
            </li>
            @endif

            <li class="nav-item">
                <a class="nav-link btn btn-light text-dark"href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    Sair
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>