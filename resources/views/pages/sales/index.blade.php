@extends('layouts.main', [ 'salesActive' => true ])

@section('content')
    <div class="row gutter-xs">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#check-card-modal" type="button">Новая продажа</button>
            </div>
        </div>
    </div>
    @if(Session::has('sales.created'))
        <div class="row gutter-xs">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-xs-offset-3">
                <div class="alert alert-success" role="alert">{{ Session::get('sales.created') }}</div>
            </div>
        </div>
    @endif
    @if(Session::has('sales.check.failed'))
        <div class="row gutter-xs">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-xs-offset-3">
                <div class="alert alert-danger" role="alert">{{ Session::get('sales.check.failed') }}</div>
            </div>
        </div>
    @endif
    <div class="row gutter-xs">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-actions">
                        <button type="button" class="card-action card-toggler"></button>
                    </div>
                    <strong>Список продаж</strong>
                </div>
                <div class="card-body">
                    <table id="sales-table" class="table table-striped table-bordered table-nowrap dataTable" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Номер карты</th>
                                <th>Покупатель</th>
                                <th>Номер счета</th>
                                <th>Общая сумма</th>
                                <th>Скидка</th>
                                <th>Сумма со скидкой</th>
                                <th>Дата продажи</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales as $sale)
                                <tr>
                                    <td class="text-center">
                                        <label class="custom-control custom-control-primary custom-checkbox">
                                            <input class="custom-control-input" type="checkbox">
                                            <span class="custom-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td>{{ $sale->card_number }}</td>
                                    <td>{{ $sale->employee_name }}</td>
                                    <td>{{ $sale->receipt_number }}</td>
                                    <td>{{ $sale->total_sum }} сомони</td>
                                    <td>{{ $sale->discount_amount }}%</td>
                                    <td>{{ $sale->discount_sum }} сомони</td>
                                    <td>{{ $sale->sale_date }}</td>
                                </tr>   
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('modals')
    <div id="check-card-modal" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Закрыть</span>
                    </button>
                    <h4 class="modal-title">Проверка номера карты</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open([ 'url' => route('sales.check'), 'method' => 'POST', 'data-toggle' => 'validator' ]) !!}
                        <div class="row gutter-xs">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('total_sum', 'Сумма продажи', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('total_sum', '', [ 'class' => 'form-control', 'required' => 'required', 'spellcheck' => false, 'autofocus' => true, 'data-msg-required' => 'Введите сумму продажи.', 'placeholder' => 'Введите сумму продажи' ]) }}
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('account_num', 'Номер счета', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('account_num', '', [ 'class' => 'form-control', 'required' => 'required', 'spellcheck' => false, 'autofocus' => true, 'data-msg-required' => 'Введите номер счета.', 'placeholder' => 'Введите номер счета' ]) }}
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('card_number', 'Номер карты', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('card_number', '', [ 'class' => 'form-control', 'required' => 'required', 'spellcheck' => false, 'autofocus' => true, 'data-msg-required' => 'Введите номер карты.', 'placeholder' => 'Введите номер карты' ]) }}
                                </div>
                            </div>                            
                        </div>                     
                        {{ Form::button('Проверить', [ 'class' => 'btn btn-outline-primary btn-block', 'type' => 'submit' ]) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#sales-table').DataTable({
                responsive: true,
                language: {
                    search:         'Поиск',
                    info:           'Показано _START_ до _END_ из _TOTAL_ записей',
                    emptyTable:     'Данные в таблице не доступны',
                    infoEmpty:      'Показано 0 до 0 из 0 записей',
                    lengthMenu:     'Показано _MENU_ записей',
                    zeroRecords:    'Ни одной записи не найдено',
                    paginate: {
                        first:      'Первая',
                        last:       'Посл.',
                        next:       'След.',
                        previous:   'Пред.'
                    },
                }
            });
        });
    </script>
@endsection