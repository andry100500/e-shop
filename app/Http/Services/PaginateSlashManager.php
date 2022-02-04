<?php


namespace App\Http\Services;


class PaginateSlashManager
{
    public static function addSlash($url)
    {
        return str_replace('?', '/?', $url);
    }
}
