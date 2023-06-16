@extends('layouts.base')
@section('pagetitle', 'Импорт запросов')
@section('body')
    <div class="mt-1"><b>{{ isset($message) ? $message : '' }}</b></div>

    @if (!isset($access_closed))
        <section>
            <form class="form" method="POST" action="{{ route('parser.import') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="form-label">Название импорта <small>(не обязательно)</small></label>
                    <input value="Импорт {{ date('Y-m-d') }}" class="form-control" type="text" name="import_name"
                        autofocus />
                    <div class="form-error">
                        @error('import_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <input type="file" name="file">
                    <div class="form-error">
                        @error('file')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <button class="btn btn-primary">Отправить</button>
            </form>
        </section>
    @endif

    <section>
        <h2>Список импортов</h2>
        <div class="section-group">
            @if (($imports ?? false) && $imports->count())
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Название</th>
                                <th>Выполненых</th>
                                <th>С ошибками</th>
                                <th>В работе</th>
                                <th>В очереди</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($imports as $import)
                                <tr>
                                    <td>{{ $import->created_at }}</td>
                                    <td>{{ $import->name }}</td>
                                    <td>{{ $import->statuses->where('status', 'success')->count() }}</td>
                                    <td>{{ $import->statuses->where('status', 'error')->count() }}</td>
                                    <td>{{ $import->statuses->where('status', 'working')->count() }}</td>
                                    <td>{{ $import->statuses->where('status', 'await')->count() }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('parser.status', ['import_id' => $import->id]) }}"
                                                class="btn btn-light small">Статус</a>
                                            <a href="{{ route('parser.results', ['import_id' => $import->id]) }}"
                                                class="btn btn-light small">Результаты</a>
                                            <a title="Скачать результаты Excel"
                                                href="{{ route('parser.results.excel', ['import_id' => $import->id]) }}"
                                                class="icon-link">
                                                <img src="{{ url('/assets/img/icons/excel.svg') }}">
                                            </a>

                                            <form
                                                action="{{ route('parser.import.delete', ['import_id' => $import->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button data-confirmation
                                                    data-confirmation-text="Подтвердите удаление импорта и всех его результатов"
                                                    title="Удалить. Удалит и импорт и результаты импорта"
                                                    class="btn icon-link" style="max-width: 25px;padding: 0;">
                                                    <img src="{{ url('/assets/img/icons/delete.png') }}">
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                Вы еще ничего не импортировали
            @endif
        </div>
    </section>

@endsection
