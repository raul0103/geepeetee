@extends('layouts.base')
@section('pagetitle', 'Генерация URL для регистрации')
@section('body')
    <ul class="list-style-inside">
        <li>
            <a class="link" href="{{ route('settings.generate-register-url.admin') }}">Ссылка для пользователя с правами
                "Администратор"</a>
        </li>
        <li>
            <a class="link" href="{{ route('settings.generate-register-url.member') }}">Ссылка для обычного пользователя
            </a>
        </li>
    </ul>

    @if ($register_url)
        <div class="section-group">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Ссылка для регистрации доступна до {{ $access_time }}
                    </div>
                </div>
                <div class="card-body">
                    {{ $register_url }}
                </div>
            </div>
        </div>
    @endif
@endsection
