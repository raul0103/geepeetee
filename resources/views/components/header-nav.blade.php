<header class="header">
    <nav class="navbar">
        <div class="container">
            <div class="navbar-row">
                <div class="navbar-left">
                    <div class="header-logo">
                        <a href="/">
                            <img src="{{ url('assets/img/logo/geepeetee.png') }}" alt="logo">
                        </a>
                    </div>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="link {{ activeLink('/') }}" href="{{ route('home') }}">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="link {{ activeLink('parser/import') }}"
                                href="{{ route('parser.import') }}">Импорт</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="link">Настройки</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a class="link {{ activeLink('settings/gpt-api-keys') }}"
                                        href="{{ route('settings.gpt-api-keys') }}">Api
                                        ключи</a>
                                </li>
                                <li class="nav-item">
                                    <a class="link {{ activeLink('settings/common') }}"
                                        href="{{ route('settings.common') }}">Общие</a>
                                </li>
                                @admin
                                    <li class="nav-item">
                                        <a class="link {{ activeLink('admin/settings') }}"
                                            href="{{ route('settings.generate-register-url') }}">Ссылка на регистрацию</a>
                                    </li>
                                @endadmin
                            </ul>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="link">{{ Auth::user()->name }}</a>
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
