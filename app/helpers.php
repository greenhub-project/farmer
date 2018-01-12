<?php

use Illuminate\Support\Facades\Request;

/**
 * Flash Helper.
 *
 * @param string|null $title
 * @param string|null $text
 *
 * @return mixed
 */
function flash($title = null, $text = null)
{
    $flash = app('App\Http\Flash');

    if (0 == func_num_args()) {
        return $flash;
    }

    return $flash->info($title, $text);
}

function set_active($path, $active = 'active')
{
    return Request::is($path) ? $active : '';
}
