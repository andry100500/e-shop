<?php


namespace App\Http\Services;


class UrlManager
{
    /**
     * Возвращает адрес текущей страницы без http/https и домена - начиная со слеша
     * @return array|false|mixed|string|string[]
     */

    public static function getUrl()
    {
        $url = $_SERVER['REQUEST_URI'];

        if (strpos($url, '/ru/') !== false) {
            $url = str_replace('/ru/', '/', $url);
        }
        if (strpos($url, '?') !== false) {
            $url = strstr($url, '?', true);
        }
        if (strpos($url, '#') !== false) {
            $url = strstr($url, '#', true);
        }
        return $url;
    }

    public static function getDomain()
    {
        return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
    }
}
