@extends('layouts.main', [ 'packagesActive' => true ])

@section('content')
    <div class="row gutter-xs">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <a href="{{ route('packages.create') }}" class="btn btn-outline-primary">Добавить пакет скидок</a>
            </div>
        </div>
    </div>
    @if(Session::has('packages.created'))
        <div class="row gutter-xs">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-xs-offset-3">
                <div class="alert alert-success" role="alert">{{ Session::get('packages.created') }}</div>
            </div>
        </div>
    @endif
    @if(Session::has('packages.updated'))
        <div class="row gutter-xs">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-xs-offset-3">
                <div class="alert alert-success" role="alert">{{ Session::get('packages.updated') }}</div>
            </div>
        </div>
    @endif
    <div class="row gutter-xs">
        @foreach($packages as $package)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-actions">
                            <a href="{{ route('packages.edit', $package->id) }}" class="card-action icon icon-pencil"></a>
                            <button type="button" class="card-action card-toggler"></button>
                        </div>
                        <strong>{{ $package->package_name }}</strong>
                    </div>
                    <div class="card-body" data-toggle="match-height">
                        <ul class="list-group list-group-divided">
                            @foreach($package->discounts as $discount)
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="media-middle media-body">
                                            <h6 class="media-heading">
                                                <span>{{ $discount->project_name }}</span>
                                            </h6>
                                            <h4 class="media-heading">{{ $discount->discount_amount }}%</h4>
                                        </div>
                                        <div class="media-middle media-right">
                                                @if($discount->project_logo !== null)
                                                    <img class="media-object img-circle" width="32" height="32" src="{{ asset('/uploads/project_logos/'.$discount->project_logo) }}" alt="{{ $discount->project_name }}">
                                                @else
                                                    <img class="media-object img-circle" width="32" height="32" src="{{ asset('img/no-photo.png') }}" alt="Нет лого">
                                                @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection