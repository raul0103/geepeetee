<?php

if (!function_exists('activeLink')) {
    function activeLink($link)
    {
        if (request()->is($link)) {
            return 'active';
        }
    }
}

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
