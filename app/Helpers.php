<?php

if (!function_exists('asset')) {
    function asset($path)
    {
        return env('APP_URL') . '/' . $path;
    }
}
