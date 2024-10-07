<?php

if (!function_exists('set_active')) {
    function set_active($uri, $output = 'active')
    {
        if (is_array($uri)) {
            foreach ($uri as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if (Route::is($uri)) {
                return $output;
            }
        }

        return '';
    }
}

// Example
// function set_active($routeName, $output = 'active')
// {
//     return request()->routeIs($routeName) ? $output : '';
// }

