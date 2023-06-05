<?php

if (!function_exists('activeLink')) {
    function activeLink($link)
    {
        if (request()->is($link)) {
            return 'active';
        }
    }
}
