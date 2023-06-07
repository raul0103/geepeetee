@extends('layouts.guest')

@section('body')
    <div class="login-page" style="min-height: 496.781px;">
        <div class="login-box">
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Введите свои учетные данные</p>

                    @if ($errors->any())
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input placeholder="Логин" class="form-control" type="text" name="login" required
                                autofocus />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input id="password" placeholder="Пароль" class="form-control" type="password" name="password"
                                required autocomplete="current-password" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">

                                    <label for="remember">
                                        <input id="remember" type="checkbox" name="remember">
                                        Запомнить меня
                                    </label>
                                </div>
                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Войти</button>
                            </div>

                        </div>
                    </form>


                    {{-- <p class="mb-1">
                        <a href="{{ route('password.request') }}">
                            Забыли пароль?
                        </a>
                    </p> 
                  <p class="mb-0">
                        <a href="{{ route('register') }}">
                            Регистрация
                        </a>
                    </p> --}}
                </div>

            </div>
        </div>
    </div>
@endsection
