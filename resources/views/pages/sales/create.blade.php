@extends('layouts.main', [ 'salesActive' => true ])

@section('content')
    <div class="row gutter-xs">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-l-offset-3">
            <div class="card">
                <div class="card-body">
                    {!! Form::open([ 'url' => route('sales.store'), 'method' => 'POST', 'data-toggle' => 'validator' ]) !!}
                        <div class="row gutter-xs">
                            <div class="col-sm-3 col-sm-offset-4">
                                @if($saleData[0]['employee']->photo !== null)
                                    <img src="{{ asset('uploads/employee_photos/'.$saleData[0]['employee']->photo) }}" alt="" class="img-responsive img-rounded">
                                @else
                                    <img src="{{ asset('img/no-photo.png') }}" alt="" class="img-responsive img-rounded">
                                @endif    
                            </div>
                        </div>
                        <div class="row gutter-xs">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('card_number', 'Номер карты', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('card_number', $saleData[0]['employee']->card_number, [ 'disabled' => 'disabled', 'class' => 'form-control', 'required' => 'required', 'spellcheck' => false, 'data-msg-required' => 'Введите номер карты.', 'placeholder' => 'Введите номер карты' ]) }}                                    
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('fullname', 'ФИО', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('fullname', $saleData[0]['employee']->fullname, [ 'disabled' => 'disabled', 'class' => 'form-control', 'required' => 'required', 'spellcheck' => false, 'data-msg-required' => 'Введите ФИО.', 'placeholder' => 'Введите ФИО' ]) }}                                    
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('account_num', 'Номер счета', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('account_num', $saleData[0]['account_num'], [ 'disabled' => 'disabled', 'class' => 'form-control', 'spellcheck' => false, 'placeholder' => 'Введите номер счета' ]) }}                                    
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('total_sum', 'Сумма продажи', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('total_sum', $saleData[0]['total_sum'].' сомони', [ 'disabled' => 'disabled', 'class' => 'form-control', 'spellcheck' => false, 'data-msg-required' => 'Введите сумму продажи.', 'placeholder' => 'Введите сумму продажи' ]) }}                                    
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('discount_amount', 'Скидка', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('discount_amount', $saleData[0]['discount_amount'].'%', [ 'disabled' => 'disabled', 'class' => 'form-control', 'spellcheck' => false, 'data-msg-required' => 'Введите скидку.', 'placeholder' => 'Введите скидку' ]) }}                                    
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('discount_sum', 'Сумма со скидкой', [ 'class' => 'control-label' ]) }}
                                    {{ Form::text('discount_sum', $saleData[0]['discount_sum'].' сомони', [ 'disabled' => 'disabled', 'class' => 'form-control', 'spellcheck' => false, 'data-msg-required' => 'Введите сумму со скидкой.', 'placeholder' => 'Введите сумму со скидкой' ]) }}                                    
                                </div>
                            </div>
                        </div>                
                        {{ Form::button('Оформить продажу', [ 'class' => 'btn btn-outline-primary btn-block', 'type' => 'submit' ]) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
