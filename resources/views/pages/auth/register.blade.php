@extends('layouts.guest')

@section('body')
    <div class="card half">
        <div class="card-header">
            Ссылка для регистрации доступна до {{ $access_time }}
        </div>
        <div class="card-body">
            <form method="POST"
                action="{{ route('register', ['expires' => Request::get('expires'), 'signature' => Request::get('signature'), 'role' => Request::get('role')]) }}">
                @csrf

                <div class="form-group">
                    <input placeholder="Имя" class="form-control" type="text" name="name" autofocus
                        autocomplete="current-name" />
                    <div class="form-error">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <input placeholder="Логин" class="form-control" type="text" name="login" required
                        autocomplete="current-login" />
                    <div class="form-error">
                        @error('login')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <input placeholder="email" class="form-control" type="text" name="email" required
                        autocomplete="current-email" />
                    <div class="form-error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Пароль" name="password" required>

                    <input type="password" placeholder="Повторите пароль" class="form-control "name="password_confirmation"
                        required>

                    <div class="form-error">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
