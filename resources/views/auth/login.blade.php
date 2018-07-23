<!DOCTYPE html>
<html lang="ru">  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Авторизация &middot; IT Nova</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="description" content="">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="{{ asset('css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elephant.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login-2.min.css') }}">
</head>
<body>
    <div class="login">
        <div class="login-body">
            <div class="login-brand">
                <img class="img-responsive" src="{{ asset('img/logo.png') }}" alt="Logo">
            </div>
            <div class="login-form">
                {!! Form::open(['url' => '/login', 'method' => 'POST', 'data-toggle' => 'validator']) !!}
                    <div class="form-group">
                        @if(Session::has('user.error'))
                            <div class="alert alert-success" role="alert">{{ Session::get('user.error') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label('username', 'Имя пользователя', [ 'class' => 'control-label' ]) }}
                        {{ Form::text('username', '', [ 'class' => 'form-control', 'required' => 'required', 'spellcheck' => false, 'autocomplete' => 'off', 'data-msg-required' => 'Введите имя пользователя.' ]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', 'Пароль', [ 'class' => 'control-label' ]) }}
                        {{ Form::password('password', [ 'class' => 'form-control', 'required' => 'required', 'spellcheck' => false, 'minlength' => '6', 'data-msg-minlength' => 'Пароль должен содержать минимум 6 символов', 'data-msg-required' => 'Введите имя пользователя.' ]) }}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Войти</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/elephant.min.js') }}"></script>
</body>
</html>