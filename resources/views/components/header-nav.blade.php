<header>
    <ul>
        <li>
            <a href="{{ route('home') }}" class="{{ activeLink('/') }}">Главная</a>
        </li>
        <li>
            <a href="{{ route('query-list') }}" class="{{ activeLink('query-list') }}">Список запросов</a>
        </li>
        <li>
            Настройки
            <ul>
                <li><a href="{{ route('settings.gpt-api-keys') }}" class="{{ activeLink('admin/settings') }}">Api
                        ключи</a></li>
                @admin
                    <li>
                        <a href="{{ route('settings.generate-register-url') }}"
                            class="{{ activeLink('admin/settings') }}">Ссылка на регистрацию</a>
                    </li>
                @endadmin
            </ul>
        </li>

        <li>
            <a href="{{ route('logout') }}">Выйти</a>
        </li>
    </ul>
</header>
