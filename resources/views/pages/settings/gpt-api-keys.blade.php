@extends('layouts.base')

@section('body')
    <h2>Ключи GPT API</h2>
    <p>Добавить ключ</p>

    @if ($errors->any())
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    @endif

    <form method="POST" action="{{ route('settings.gpt-api-keys.create') }}">
        @csrf

        <label>Название</label>
        <input type="text" name="name">

        <label>Ключ</label>
        <input type="text" name="key">

        <label>Активен</label>
        <input type="checkbox" name="active" value="true">

        <button type="submit">Создать</button>
    </form>
    <br>
    <table>
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
                <tr>
                    <td>{{ $api_key->name }}</td>
                    <td>{{ $api_key->key }}</td>
                    <td>{{ $api_key->created_at }}</td>
                    <td>
                        <input id="active_{{ $index }}" type="radio" name="active" value="{{ $api_key->id }}"
                            {{ $api_key->active ? 'checked' : '' }}>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
