<?php

/**
 * Помечает активные ссылки в меню
 */
if (!function_exists('activeLink')) {
    function activeLink($link)
    {
        if (request()->is($link)) {
            return 'active';
        }
    }
}

/**
 * Помечает цветом статусы
 */
if (!function_exists('getBadgeColor')) {
    function getBadgeColor($status)
    {
        if ($status == 'success') {
            return 'badge-success';
        } elseif ($status == 'error') {
            return 'badge-danger';
        }
    }
}

/**
 * Выделяет активный option в select
 */
if (!function_exists('optionSelect')) {
    function optionSelect($comparison)
    {
        if ($comparison) {
            return 'selected';
        } else {
            return null;
        }
    }
}
