<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Discount System') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="{{ asset('css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elephant.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/application.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/demo.min.css') }}">
    @yield('stylesheets')
</head>
<body class="layout layout-header-fixed layout-sidebar-fixed">
    <div class="layout-header">
        <div class="navbar navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#sidenav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="bars">
                        <span class="bar-line bar-line-1 out"></span>
                        <span class="bar-line bar-line-2 out"></span>
                        <span class="bar-line bar-line-3 out"></span>
                    </span>
                    <span class="bars bars-x">
                        <span class="bar-line bar-line-4"></span>
                        <span class="bar-line bar-line-5"></span>
                    </span>
                </button>
                <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="arrow-up"></span>
                    <span class="ellipsis ellipsis-vertical">
                        <img class="ellipsis-object" width="32" height="32" src="{{ asset('img/0180441436.jpg') }}" alt="Teddy Wilson">
                    </span>
                </button>
            </div>
            
            <div class="navbar-toggleable">
                <nav id="navbar" class="navbar-collapse collapse">
                    <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="bars">
                            <span class="bar-line bar-line-1 out"></span>
                            <span class="bar-line bar-line-2 out"></span>
                            <span class="bar-line bar-line-3 out"></span>
                            <span class="bar-line bar-line-4 in"></span>
                            <span class="bar-line bar-line-5 in"></span>
                            <span class="bar-line bar-line-6 in"></span>
                        </span>
                    </button>
                    {{-- Mobile menu --}}
                    <ul class="nav navbar-nav navbar-right">
                        <li class="visible-xs-block">
                            <h4 class="navbar-text text-center">{{ Auth::user()->fullname }}</h4>
                        </li>
                        <li class="dropdown hidden-xs">
                            <button class="navbar-account-btn" data-toggle="dropdown" aria-haspopup="true">
                                <img class="circle" width="36" height="36" src="{{ asset('img/default_user.png') }}" alt="{{ Auth::user()->fullname }}"> {{ Auth::user()->fullname }}
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="{{ route('logout') }}">Выйти</a></li>
                            </ul>
                        </li>
                        <li class="visible-xs-block">
                            <a href="login-1.html">
                                <span class="icon icon-power-off icon-lg icon-fw"></span>
                                Выйти
                            </a>
                        </li>
                    </ul>
                    {{-- Mobile menu end --}}
                </nav>
            </div>
        </div>
    </div>


    <div class="layout-main">
        <div class="layout-sidebar">
            <div class="layout-sidebar-backdrop"></div>
            <div class="layout-sidebar-body">
                <div class="custom-scrollbar">
                    {{-- Main menu --}}
                    <nav id="sidenav" class="sidenav-collapse collapse">
                        <ul class="sidenav level-1">
                            <li class="sidenav-heading">Меню</li>
                            @role('superadministrator|administrator')
                                <li class="{{ isset($projectsActive) ? 'sidenav-item active' : 'sidenav-item' }}">
                                    <a href="{{ route('projects') }}">
                                        <span class="sidenav-icon icon icon-building"></span>
                                        <span class="sidenav-label">Проекты</span>
                                    </a>                                
                                </li>
                                <li class="{{ isset($packagesActive) ? 'sidenav-item active' : 'sidenav-item' }}">
                                    <a href="{{ route('packages.index') }}">
                                        <span class="sidenav-icon icon icon-shopping-basket"></span>
                                        <span class="sidenav-label">Пакеты скидок</span>
                                    </a>                           
                                </li>
                                <li class="{{ isset($employeesActive) ? 'sidenav-item active' : 'sidenav-item' }}">
                                    <a href="{{ route('employees.index') }}">
                                        <span class="sidenav-icon icon icon-users"></span>
                                        <span class="sidenav-label">Сотрудники</span>
                                    </a>                           
                                </li>
                            @endrole
                            {{-- @role('operator') --}}
                                <li class="{{ isset($salesActive) ? 'sidenav-item active' : 'sidenav-item' }}">
                                    <a href="{{ route('sales.index') }}">
                                        <span class="sidenav-icon icon icon-list-alt"></span>
                                        <span class="sidenav-label">Продажи</span>
                                    </a>                           
                                </li>
                            {{-- @endrole --}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        {{-- Content --}}
        <div class="layout-content">
            <div class="layout-content-body">
                @yield('content')
            </div>
        </div>
        {{-- Content end --}}
        <div class="layout-footer">
            <div class="layout-footer-body">
            <small class="copyright">2018 &copy; IT Nova</small>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/elephant.min.js') }}"></script>
    <script src="{{ asset('js/application.min.js') }}"></script>
    <script src="{{ asset('js/demo.min.js') }}"></script>
    @yield('scripts')
    @yield('modals')
</body>
</html>
