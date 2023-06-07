@extends('layouts.guest')

@section('body')
    <div>Ссылка для регистрации доступна до {{ $access_time }}</div>
    <div class="login-page" style="min-height: 496.781px;">
        <div class="login-box">
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Заполните учетные данные</p>

                    @if ($errors->any())
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    @endif

                    <form method="POST"
                        action="{{ route('register', ['expires' => Request::get('expires'), 'signature' => Request::get('signature'), 'role' => Request::get('role')]) }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input placeholder="Имя" class="form-control" type="text" name="name" autofocus
                                autocomplete="current-name" />
                        </div>

                        <div class="input-group mb-3">
                            <input placeholder="Логин" class="form-control" type="text" name="login" required
                                autocomplete="current-login" />
                        </div>

                        <div class="input-group mb-3">
                            <input placeholder="email" class="form-control" type="text" name="email" required
                                autocomplete="current-email" />
                        </div>

                        <div class="input-group mb-3">
                            <input id="password" type="password" class="form-control" name="password" required>
                            <input id="password" type="password" placeholder="Пароль"
                                class="form-control "name="password_confirmation" required>

                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
