@extends('layouts.base')
@section('pagetitle', 'Api ключи')
@section('body')
    <div class="section-group">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Список добавленных
                </div>
            </div>
            <div class="card-body">
                <form class="form" method="POST" action="{{ route('settings.gpt-api-keys') }}">
                    @csrf
                    @method('PUT')

                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Ключ</th>
                                    <th>Дата создания</th>
                                    <th>Активный</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($api_keys as $index => $api_key)
                                    <tr data-api-key-id="{{ $api_key->id }}">
                                        <td>{{ $api_key->name }}</td>
                                        <td>{{ $api_key->key }}</td>
                                        <td>{{ $api_key->created_at }}</td>
                                        <td>
                                            <input id="active_{{ $index }}" type="radio" name="active_api_id"
                                                value="{{ $api_key->id }}" {{ $api_key->active ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" data-delete-api-key="{{ $api_key->id }}">Удалить</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <button class="btn btn-primary mt-1" type="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>

    <div class="section-group">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Добавить новый
                </div>
            </div>
            <div class="card-body">
                <form class="form" method="POST" action="{{ route('settings.gpt-api-keys') }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Название</label>
                        <input class="form-control" type="text" name="name">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Ключ</label>
                        <input class="form-control" type="text" name="key">
                        <div class="form-error">
                            @error('key')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" id="active" type="checkbox" name="active" value="true">
                            <label class="form-label" for="active">Активен</label>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Создать</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/modules/gpt-api-key.js'])
@endsection
