<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/off-canvas.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
    <title> Entrar - WebHorário</title>
    <link rel="icon" href="{{ asset('/img/webhorario.ico') }}" type="image/x-icon">
    @yield('css')
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <header class="col-xs-12 col-sm-12">
                <div class="col-xs-6 col-sm-6">
                    <a href="{{ route('login') }}">
                        <img class="img-responsive webhorario-logo pull-left" src="{{ asset('/img/webhorario.png') }}">
                        <h3 class="hidden-xs">WebHorário</h3>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-6">
                    <a href="http://www.ifspcaraguatatuba.edu.br" target="_blank"><img class="img-responsive ifsp-logo pull-right" src="{{ asset('/img/ifsp.png') }}"></a>
                </div>
            </header>
        </div>
        
        <div class="col-lg-12" style="height: 450px">
            @include('layout.alerts')
            <div class="hidden-xs hidden-sm col-lg-3"></div>
            <div class="col-lg-6" style="margin-top: 100px">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open(["method" => "post", "route" => "logar"]) !!}
                        {{ csrf_field() }}
                        <div class="control-group form-group">
                            {!! Form::label('prontuario', 'Prontuário', ['class' => 'control-label']) !!}
                            {!! Form::text('prontuario', null, ['class' => 'form-control', 'required', 'autofocus', 'tabindex' => 1]) !!}
                        </div>

                        <div class="control-group form-group">
                            {!! Form::label('password', 'Senha', ['class' => 'control-label']) !!}
                            <a class="right control-label" href="#">Esqueceu sua senha?</a>
                            <div class="input-group">
                                {!! Form::password('password', ['class' => 'form-control senha', 'required', 'tabindex' => 2]) !!}
                                <span class="input-group-addon" data-show="0" style="cursor: pointer">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </span>
                            </div>
                        </div>

                        <button type="submit" tabindex='3' class="btn btn-success right"><span class="glyphicon glyphicon-log-in"></span> Entrar</button>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<footer class="text-center">
    <div class="container">
        <p>
            IFSP - Instituto Federal de Educação, Ciência e Tecnologia de São Paulo Campus
            Caraguatatuba
        </p>
        <p>
            Avenida Bahia, 1739 - Indaiá - Caraguatatuba/SP - CEP: 11665-071 - Telefone: +55 (12)
            3885-2130
        </p>
        <p class="text-center">
            Desenvolvimento: ACME & Brains Working
        </p>
    </div>
</footer>

<script type="text/javascript" src="{{ asset('/js/jquery-3.2.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/login.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/footer.js') }}"></script>
@yield('scripts')

</body>

</html>
