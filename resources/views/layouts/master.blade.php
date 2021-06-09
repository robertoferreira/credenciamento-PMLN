<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <link href="{{ asset('_assets/fontawesome/css/all.css') }}" rel="stylesheet">

    <title>Credenciamento CPL - Lagoa Nova</title>
  </head>
  <body>
      <!-- HEADER -->
    <div class="container">
        <div class="row my-3">
            <div class="col-12 text-center">
                <img src="{{ asset('_assets/img/logo-prefeitura-de-lagoa-nova.png') }}" alt="Prefeitura de Lagoa Nova" class="img-fluid">
            </div>
        </div>
    </div>
    <!-- FIM HEADER -->

    @yield('content')

    <footer class="bg-light">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12">
                    <p class="text-center text-muted">Sistema desenvolvido por: <a href="https://housecriative.com.br" target="_blank">House Criative</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('https://code.jquery.com/jquery-3.2.1.slim.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js') }}"></script>
    <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js') }}"></script>

    <!-- Fontawesome JavaScript -->
    <script defer src="{{ asset('_assets/fontawesome/js/all.js') }}"></script>

    <script src="{{ asset('_assets/js/jquery.mask.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#share_capital').mask('000.000.000,00', {reverse: true});
            $('#document').mask('00.000.000/0000-00', {reverse: true});
            $('#zipcode').mask('00000-000', {reverse: true});
            $('#document_person_owner').mask('000.000.000-00', {reverse: true});

            $('#phone_business').mask('(00) 00000-0000');
            $('#phone_person').mask('(00) 00000-0000');


        });
    </script>
  </body>
</html>
