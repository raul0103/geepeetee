@extends('layouts.guest')
@section('body')
    <div class="card half">
        <div class="card-header">
            Авторизация
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf


                <div class="form-group">
                    <input placeholder="Логин" class="form-control" type="text" name="login" required autofocus />
                    <div class="form-error">
                        @error('login')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <input id="password" placeholder="Пароль" class="form-control" type="password" name="password" required
                        autocomplete="current-password" />
                    <div class="form-error">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="remember">
                        <input id="remember" type="checkbox" name="remember">
                        Запомнить меня
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Войти</button>
            </form>

        </div>
    </div>
@endsection
