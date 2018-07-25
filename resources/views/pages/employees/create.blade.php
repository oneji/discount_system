@extends('layouts.main', [ 'employeesActive' => true ])

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('plugins/dropify/dist/css/dropify.css') }}">
    <style>
        .projects-list {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="row gutter-xs">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-l-offset-3">
            <div class="card">
                <div class="card-body">
                    {!! Form::open([ 'url' => route('employees.store'), 'method' => 'POST', 'data-toggle' => 'validator', 'enctype' => 'multipart/form-data' ]) !!}
                        {{-- Photo, fullname, card number and birthday --}}
                        <div class="row gutter-xs">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-group">
                                        {{ Form::label('photo', 'Фото', [ 'class' => 'control-label' ]) }}
                                        {{ Form::file('photo', [ 'class' => 'dropify', 'data-max-filesize' => '1M', 'data-height' => '200' ]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        {{ Form::label('fullname', 'ФИО', [ 'class' => 'control-label' ]) }}
                                        {{ Form::text('fullname', '', [ 'class' => 'form-control', 'required' => 'required', 'spellcheck' => false, 'data-msg-required' => 'Введите ФИО.', 'placeholder' => 'Введите ФИО' ]) }}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        {{ Form::label('card_number', 'Номер карты', [ 'class' => 'control-label' ]) }}
                                        {{ Form::text('card_number', '', [ 'class' => 'form-control', 'required' => 'required', 'spellcheck' => false, 'data-msg-required' => 'Введите номер карты.', 'placeholder' => 'Введите номер карты' ]) }}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        {{ Form::label('birthday', 'День рождения', [ 'class' => 'control-label' ]) }}
                                        <div class="input-with-icon">
                                            {{ Form::text('birthday', '', [ 'class' => 'form-control', 'placeholder' => 'Выберите день рождения', 'data-provide' => 'datepicker' ]) }}
                                            <span class="icon icon-calendar input-icon"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        {{-- Gender and address --}}
                        <div class="row gutter-xs">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('gender', 'Пол', [ 'class' => 'control-label' ]) }}
                                    {{ Form::select('gender', [ 1 => 'Мужской', 2 => 'Женский' ], null, [ 'class' => 'form-control', 'placeholder' => 'Выберите пол' ]) }}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('address', 'Адрес', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('address', '', [ 'class' => 'form-control', 'spellcheck' => false, 'placeholder' => 'Введите адрес' ]) }}
                                </div>
                            </div>
                        </div>
                        {{-- Phone and email --}}
                        <div class="row gutter-xs">                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('phone', 'Телефон', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('phone', '', [ 'class' => 'form-control', 'spellcheck' => false, 'placeholder' => 'Введите телефон' ]) }}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('email', 'Email', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('email', '', [ 'class' => 'form-control', 'spellcheck' => false, 'placeholder' => 'Введите email адрес' ]) }}
                                </div>
                            </div>
                        </div>                
                        {{-- Project and occupation --}}
                        <div class="row gutter-xs">                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('project_name', 'Проект', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('project_name', '', [ 'class' => 'form-control', 'spellcheck' => false, 'placeholder' => 'Введите проект', 'required' => 'required', 'data-msg-required' => 'Введите проект.' ]) }}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        {{ Form::label('occupation', 'Должность', [ 'class' => 'control-label' ]) }}
                                        {{ Form::text('occupation', '', [ 'class' => 'form-control', 'spellcheck' => false, 'placeholder' => 'Введите должность', 'required' => 'required', 'data-msg-required' => 'Введите должность.' ]) }}
                                    </div>
                                </div>
                        </div>    
                        {{-- Work start date and discount package --}}
                        <div class="row gutter-xs">                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('work_start_date', 'Дата начала работы', [ 'class' => 'control-label' ]) }}
                                    <div class="input-with-icon">
                                        {{ Form::text('work_start_date', '', [ 'class' => 'form-control', 'placeholder' => 'Выберите дату начала работы', 'data-provide' => 'datepicker' ]) }}
                                        <span class="icon icon-calendar input-icon"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('discount_package_id', 'Пакет скидок', [ 'class' => 'control-label' ]) }}
                                    {{-- {{ Form::select('discount_package_id', $packages, null, [ 'class' => 'form-control', 'placeholder' => 'Выберите пакет' ]) }} --}}
                                    <select name="discount_package_id" class="form-control" id="discount_package_id">
                                        <option disabled selected>Выберите пакет</option>
                                        <option value="">Кастомный</option>
                                        @foreach($packages as $package)
                                            <option value="{{ $package->id }}">{{ $package->package_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Status --}}
                        <div class="row gutter-xs">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="custom-control custom-control-primary custom-radio">
                                        <input class="custom-control-input" type="radio" name="active" value="1" checked>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-label">Активен</span>
                                    </label>
                                    <label class="custom-control custom-control-primary custom-radio">
                                        <input class="custom-control-input" type="radio" name="active" value="0">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-label">Не активен</span>
                                    </label>
                                </div>
                            </div>
                        </div> 
                        <div class="projects-list">
                            <div class="divider">
                                <div class="divider-content">Компании</div>
                            </div>
                            @foreach($projects as $project)
                                <div class="row gutter-xs">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            {{ Form::label('project_name', $project->project_name, [ 'class' => 'col-sm-3 col-md-3 control-label' ]) }}
                                            <div class="col-sm-6 col-md-6">
                                                <div class="slider slider-circle" data-slider="primary" data-step="1" data-tooltips="true" data-max="{{ $project->project_max_discount }}" data-start="1" data-target="{{ '#slider-target-'.$project->id }}"></div>                                        
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                {{ Form::text('discount_amounts['.$project->id.']', '', [ 'id' => 'slider-target-'.$project->id, 'class' => 'form-control' ]) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            @endforeach
                            <hr>
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
    <script src="{{ asset('js/employees.js') }}"></script>
@endsection