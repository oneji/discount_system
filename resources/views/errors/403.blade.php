<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Страница не найдена &middot; IT Nova</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="description" content="">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="{{ asset('css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elephant.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/errors.min.css') }}">
</head>
<body>
    <div class="error">
        <div class="error-body">
            <h1 class="error-heading">Доступ запрещен</h1>
            <h4 class="error-subheading">У вас нет доступа для доступа к данной странице.</h4>
            <p><a class="btn btn-primary btn-pill btn-thick" href="{{ route('home') }}">Вернуться на главную</a></p>
        </div>
        <div class="error-footer">
            <p><small>© 2018 IT Nova</small></p>
        </div>
    </div>
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/elephant.min.js') }}"></script>
</body>
</html>