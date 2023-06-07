<header>
    <ul>
        <li>
            <a href="{{ route('home') }}" class="{{ activeLink('/') }}">Главная</a>
        </li>
        <li>
            Парсер
            <ul>
                <li><a href="{{ route('parser.import') }}" class="{{ activeLink('parser/import') }}">Импорт</a></li>
                <li><a href="{{ route('parser.status') }}" class="{{ activeLink('parser/status') }}">Статус</a></li>
                <li><a href="{{ route('parser.results') }}" class="{{ activeLink('parser/results') }}">Результаты</a></li>
            </ul>
        </li>
        <li>
            Настройки
            <ul>
                <li>
                    <a href="{{ route('settings.gpt-api-keys') }}" class="{{ activeLink('admin/settings') }}">Api
                        ключи</a>
                </li>
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
