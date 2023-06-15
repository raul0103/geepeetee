<header>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-row">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="link"href="{{ route('home') }}" class="{{ activeLink('/') }}">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="link"href="{{ route('parser.import') }}"
                            class="{{ activeLink('parser/import') }}">Импорт</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a>Настройки</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="link"href="{{ route('settings.gpt-api-keys') }}"
                                    class="{{ activeLink('admin/settings') }}">Api
                                    ключи</a>
                            </li>
                            @admin
                                <li class="nav-item">
                                    <a class="link"href="{{ route('settings.generate-register-url') }}"
                                        class="{{ activeLink('admin/settings') }}">Ссылка на регистрацию</a>
                                </li>
                            @endadmin
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a>{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="link"href="{{ route('logout') }}">Выйти</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>
