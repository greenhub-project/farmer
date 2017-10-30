<?php

use Illuminate\Support\Facades\Request;

/**
 * Flash Helper.
 *
 * @param  string|null  $title
 * @param  string|null  $text
 * @return mixed
 */
function flash($title = null, $text = null)
{
    $flash = app('App\Http\Flash');

    if (func_num_args() == 0) {
        return $flash;
    }

    return $flash->info($title, $text);
}

function set_active($path, $active = 'active')
{
    return Request::is($path) ? $active : '';
}
