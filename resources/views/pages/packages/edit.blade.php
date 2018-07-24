@extends('layouts.main', [ 'packagesActive' => true ])

@section('content')
    <div class="row gutter-xs">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-l-offset-3">
            <div class="card">
                <div class="card-body">
                    {!! Form::open([ 'url' => route('packages.update', $package->id), 'method' => 'PUT', 'data-toggle' => 'validator', 'class' => 'form form-horizontal' ]) !!}
                        <div class="row gutter-xs">
                            <div class="col-sm-12">
                                {{ Form::label('package_name', 'Название пакета', [ 'class' => 'col-sm-3 col-md-3 control-label' ]) }}
                                <div class="col-sm-6 col-md-6">
                                    {{ Form::text('package_name', $package->package_name, [ 'class' => 'form-control', 'required' => 'required', 'spellcheck' => false, 'data-msg-required' => 'Введите название пакета.', 'placeholder' => 'Введите название проекта' ]) }}
                                </div>
                            </div>
                        </div>
                        <hr>
                        @foreach($projects as $project)
                            <div class="row gutter-xs">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        {{ Form::label('project_name', $project->project_name, [ 'class' => 'col-sm-3 col-md-3 control-label' ]) }}
                                        <div class="col-sm-6 col-md-6">
                                            <div class="slider slider-circle" data-slider="primary" data-step="1" data-tooltips="true" data-max="{{ $project->project_max_discount }}" data-start="{{ count($project->discounts) > 0 ? $project->discounts[0]->discount_amount : 0 }}" data-target="{{ '#slider-target-'.$project->id }}"></div>                                        
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            {{ Form::text('discount_amounts['.$project->id.']', '', [ 'id' => 'slider-target-'.$project->id, 'class' => 'form-control' ]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        @endforeach                   
                        {{ Form::button('Добавить', [ 'class' => 'btn btn-outline-primary btn-block', 'type' => 'submit' ]) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection