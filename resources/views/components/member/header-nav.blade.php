<header>
    <ul>
        <li>
            <a href="{{ route('home') }}" class="{{ activeLink('/') }}">Главная</a>
        </li>
        <li>
            <a href="{{ route('query-list') }}" class="{{ activeLink('query-list') }}">Список запросов</a>
        </li>
        <li>
            <a href="{{ route('logout') }}">Выйти</a>
        </li>
    </ul>
</header>
