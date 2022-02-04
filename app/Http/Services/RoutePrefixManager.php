<?php

namespace App\Http\Services;
class RoutePrefixManager
{
    public static function getPrifix()
    {
        if (request()->segment(1,) === 'ru') {
            return 'ru';
        }
        return '';
    }
}
