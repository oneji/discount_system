<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Регистрация &middot; IT Nova</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="{{ asset('css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elephant.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/signup-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/parsley/parsley.css') }}">
</head>
<body>
    <div class="signup">
        @if(Session::has('user.created'))
            <div class="alert alert-success" role="alert">{{ Session::get('user.created') }}</div>
        @endif
        <div class="signup-body">            
            <div class="signup-form">                
                {!! Form::open(['url' => '/register', 'method' => 'POST', 'id' => 'register-form', 'data-parsley-validate' => '']) !!}
                    <div class="row gutter-xs">
                        <div class="col-sm-12">
                            <div class="form-group">
                                {{ Form::label('fullname', 'ФИО', [ 'class' => 'control-label' ]) }}
                                {{ Form::text('fullname', '', [ 'class' => 'form-control', 'required' => 'required', 'spellcheck' => false ]) }}
                            </div>
                        </div>                        
                    </div>
                    <div class="row gutter-xs">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{ Form::label('phone', 'Телефон', [ 'class' => 'control-label' ]) }}
                                {{ Form::text('phone', '', [ 'class' => 'form-control', 'spellcheck' => false, 'autocomplete' => 'off' ]) }}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{ Form::label('email', 'Email', [ 'class' => 'control-label' ]) }}
                                {{ Form::text('email', '', [ 'class' => 'form-control', 'spellcheck' => false, 'autocomplete' => 'off' ]) }}
                            </div>
                        </div>
                    </div>
                    <div class="row gutter-xs">
                        <div class="col-sm-12">
                            <div class="form-group">
                                {{ Form::label('username', 'Имя пользователя', [ 'class' => 'control-label' ]) }}
                                {{ Form::text('username', '', [ 'class' => 'form-control', 'required' => 'required', 'spellcheck' => false, 'autocomplete' => 'off', 'data-msg-required' => 'Введите имя пользователя.' ]) }}
                            </div>
                        </div>
                    </div>
                    <div class="row gutter-xs">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{ Form::label('password', 'Пароль', [ 'class' => 'control-label' ]) }}
                                {{ Form::password('password', [ 'class' => 'form-control', 'required' => 'required', 'spellcheck' => false, 'autocomplete' => 'off', 'minlength' => '6', 'data-parsley-minlength' => '6' ]) }}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{ Form::label('password_confirmation', 'Подтвердите пароль', [ 'class' => 'control-label' ]) }}
                                {{ Form::password('password_confirmation', [ 'class' => 'form-control', 'required' => 'required', 'spellcheck' => false, 'autocomplete' => 'off', 'minlength' => '6', 'data-parsley-minlength' => '6', 'data-parsley-equalto' => '#password' ]) }}
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Зарегистрировать</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/elephant.min.js') }}"></script>
    <script src="{{ asset('plugins/parsley/parsley.min.js') }}"></script>
    <script src="{{ asset('plugins/parsley/i18n/ru.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#register-form').parsley();
        });
    </script>
</body>
</html>