@extends('layouts.main')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('plugins/dropify/dist/css/dropify.css') }}">
@endsection

@section('content')
    <div class="row gutter-xs">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#add-project-modal" type="button">Добавить проект</button>
            </div>
        </div>
    </div>
    @if(Session::has('projects.added'))
        <div class="row gutter-xs">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-xs-offset-3">
                <div class="alert alert-success" role="alert">{{ Session::get('projects.added') }}</div>
            </div>
        </div>
    @endif

    <div class="row gutter-xs">
        @foreach($projects as $project)
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header no-border">
                        <div class="media">
                            <div class="media-middle media-left">
                                <a href="#">
                                    @if($project->project_logo !== null)
                                        <img class="media-object img-circle" width="32" height="32" src="{{ asset('/uploads/project_logos/'.$project->project_logo) }}" alt="{{ $project->project_name }}">
                                    @else
                                        <img class="media-object img-circle" width="32" height="32" src="{{ asset('img/no-photo.png') }}" alt="Нет лого">
                                    @endif
                                </a>
                            </div>
                            <div class="media-middle media-body">
                                <a class="link-muted" href="#">
                                    <strong>{{ $project->project_name }}</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title fw-l">
                            <p>Описание проекта</p>
                        </h4>
                        <small>{{ $project->project_description !== null ? $project->project_description : 'Описания нет.' }}</small>
                    </div>
                    <div class="card-footer no-border">
                        <small>
                            <span class="icon icon-map-marker"></span>
                            {{ $project->project_address !== null ? $project->project_address : 'Адрес не указан.' }}
                        </small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('modals')
    <div id="add-project-modal" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Закрыть</span>
                    </button>
                    <h4 class="modal-title">Добавить проект</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open([ 'url' => route('projects.store'), 'method' => 'POST', 'data-toggle' => 'validator', 'enctype' => 'multipart/form-data' ]) !!}
                        <div class="row gutter-xs">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('project_name', 'Название проекта', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('project_name', '', [ 'class' => 'form-control', 'required' => 'required', 'spellcheck' => false, 'data-msg-required' => 'Введите название проекта.' ]) }}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('project_address', 'Адрес проекта', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('project_address', '', [ 'class' => 'form-control', 'spellcheck' => false ]) }}
                                </div>
                            </div>
                        </div>
                        <div class="row gutter-xs">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('project_contact', 'Контакт проекта', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('project_contact', '', [ 'class' => 'form-control', 'spellcheck' => false ]) }}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        {{ Form::label('projec_max_discount', 'Максимальный процент скидки', [ 'class' => 'control-label' ]) }}
                                        <div class="input-group">
                                            <span class="input-group-addon">%</span>
                                            {{ Form::text('projec_max_discount', '', [ 'class' => 'form-control', 'required' => 'required', 'data-msg-required' => 'Введите процент.' ]) }}
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('project_description', 'Описание проекта', [ 'class' => 'control-label' ]) }}
                                    {{ Form::textarea('project_description', '', [ 'class' => 'form-control', 'spellcheck' => false, 'rows' => 4 ]) }}
                                </div>
                            </div>
                        </div>
                        <div class="row gutter-xs">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('projec_logo', 'Логотип проекта', [ 'class' => 'control-label' ]) }}
                                    {{ Form::file('project_logo', [ 'class' => 'dropify', 'data-max-filesize' => '1M', 'data-height' => '100' ]) }}
                                </div>
                            </div>
                        </div>                       
                        {{ Form::button('Добавить', [ 'class' => 'btn btn-outline-primary btn-block', 'type' => 'submit' ]) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify({
                messages: {
                    'default': 'Перетащите файл сюда или кликните',
                    'replace': 'Перетащите файл сюда или кликните для замены',
                    'remove':  'Удалить',
                    'error':   'Упс, что то пошло не так.'
                }
            });
        });
    </script>
@endsection
