@extends('layouts.main', [ 'employeesActive' => true ])

@section('content')
    <div class="row gutter-xs">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <a href="{{ route('employees.create') }}" class="btn btn-outline-primary">Добавить сотрудника</a>
            </div>
        </div>
    </div>
    @if(Session::has('employees.created'))
        <div class="row gutter-xs">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-xs-offset-3">
                <div class="alert alert-success" role="alert">{{ Session::get('employees.created') }}</div>
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
                    <strong>Список сотрудников</strong>
                </div>
                <div class="card-body">
                    <table id="employees-table" class="table table-striped table-bordered table-nowrap dataTable" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>ФИО</th>
                                <th>Номер карты</th>
                                <th>Социальный пакет</th>
                                <th>Проект</th>
                                <th>Должность</th>
                                <th>Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td class="text-center">
                                        <label class="custom-control custom-control-primary custom-checkbox">
                                            <input class="custom-control-input" type="checkbox">
                                            <span class="custom-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td>{{ $employee->fullname }}</td>
                                    <td>{{ $employee->card_number }}</td>
                                    <td>{{ $employee->package_name !== null ? $employee->package_name : 'Кастомный' }}</td>
                                    <td>{{ $employee->project_name }}</td>
                                    <td>{{ $employee->occupation }}</td>
                                    <td>
                                        <span class="{{ $employee->active === 1 ? 'badge badge-outline-success' : 'badge badge-outline-danger' }}">{{ $employee->active === 1 ? 'Активен' : 'Не активен' }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#employees-table').DataTable({
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