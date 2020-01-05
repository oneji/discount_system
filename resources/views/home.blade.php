@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="media">
                        <div class="media-middle media-left">
                            <span class="bg-primary-inverse circle sq-48">
                                <span class="icon icon-works">&#80;</span>
                            </span>
                        </div>
                        <div class="media-middle media-body">
                            <h6 class="media-heading">Сотрудники</h6>
                            <h3 class="media-heading">
                                <span class="fw-l">{{ $employees->count() }}</span>
                            </h3>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="media">
                        <div class="media-middle media-left">
                            <span class="bg-primary-inverse circle sq-48">
                                <span class="icon icon-works">&#93;</span>
                            </span>
                        </div>
                        <div class="media-middle media-body">
                            <h6 class="media-heading">Проекты</h6>
                            <h3 class="media-heading">
                                <span class="fw-l">{{ $projects->count() }}</span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger">
                <div class="card-body">
                    <div class="media">
                        <div class="media-middle media-left">
                            <span class="bg-danger-inverse circle sq-48">
                                <span class="icon icon-works">&#93;</span>
                            </span>
                        </div>
                        <div class="media-middle media-body">
                            <h6 class="media-heading">Пакеты скидок</h6>
                            <h3 class="media-heading">
                                <span class="fw-l">{{ $discountPacks->count() }}</span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger">
                <div class="card-body">
                    <div class="media">
                        <div class="media-middle media-left">
                            <span class="bg-danger-inverse circle sq-48">
                                <span class="icon icon-works">&#35;</span>
                            </span>
                        </div>
                        <div class="media-middle media-body">
                            <h6 class="media-heading">Количество продаж</h6>
                            <h3 class="media-heading">
                                <span class="fw-l">{{ $sales->count() }}</span>
                            </h3>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Сумма продаж</h4>
                </div>
                <div class="card-body">
                    <div class="card-chart">
                        <canvas 
                            data-chart="bar" 
                            data-animation="false" 
                            data-labels='["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"]' 
                            data-values='[
                                {"label": "Эта неделя", "backgroundColor": "#1c90fb", "borderColor": "#1c90fb", "data": [ {{ implode(', ', $salesPrices) }}]}
                            ]' 
                            data-tooltips='{"mode": "label"}' 
                            data-hide='["gridLinesX", "legend", "points"]' 
                            data-scales='{"yAxes": [{"gridLines": {"color": "#f5f5f5"}, "ticks": {"fontColor": "#bcc1c6", "maxTicksLimit": 5}}], "xAxes": [{ "gridLines": {"color": "#f5f5f5"}, "ticks": {"fontColor": "#bcc1c6"}} ]}' 
                            height="128">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-actions">
                        <button type="button" class="card-action card-toggler" title="Collapse"></button>
                    </div>
                    <strong>История продаж</strong>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-segment">
                                <span class="timeline-divider"></span>
                            </div>
                            <div class="timeline-content"></div>
                        </div>
                        @for ($i = 0; $i < 5; $i++)
                            <div class="timeline-item">
                                <div class="timeline-segment">
                                    <img class="timeline-media img-circle" width="40" height="40" src="{{ asset('uploads/employee_photos/'.$sales[$i]->photo) }}" alt="{{ $sales[$i]->employee_name }}">
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-row">
                                        <a href="#">{{ $sales[$i]->employee_name }}</a>
                                        <small>{{ Carbon\Carbon::parse($sales[$i]->created_at)->toFormattedDateString() }} - {{ Carbon\Carbon::parse($sales[$i]->created_at)->toTimeString() }}</small>
                                    </div>
                                    <div class="timeline-row">
                                        Сделал покупку на сумму <strong>{{ $sales[$i]->discount_sum }}</strong> сомони со скидкой в <strong>{{ $sales[$i]->discount_amount }}%</strong>.
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <a href="{{ route('sales.index') }}" class="btn btn-primary btn-sm btn-block" type="button">Смотреть все</a>
                </div>
            </div>
        </div>
    </div>
@endsection
