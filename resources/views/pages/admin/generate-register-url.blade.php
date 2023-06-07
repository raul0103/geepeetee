@extends('layouts.base')

@section('body')
    <ul>
        <li>
            <a href="{{ route('settings.generate-register-url.admin') }}">Ссылка для пользователя с правами
                "Администратор"</a>
        </li>
        <li>
            <a href="{{ route('settings.generate-register-url.member') }}">Ссылка для обычного пользователя </a>
        </li>
    </ul>

    @if ($register_url)
        <h2>Ссылка для регистрации доступна до {{ $access_time }}</h2>
        <div>{{ $register_url }}</div>
    @endif
@endsection
