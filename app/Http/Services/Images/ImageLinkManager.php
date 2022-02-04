<?php

namespace App\Http\Services\Images;

/**
 * Клас отвечает за предоставление урла картинки нужно размера для вывода на сайте
 */
class ImageLinkManager
{
    public static function getImageUrl($image, $size){

        $imageNameArr = explode('.', $image);
        $neededSize = config('app_settings.imageSizes.' . $size);

        $url = '/image/cache/' . $imageNameArr[0] . '-' . $neededSize['width'] . 'x' . $neededSize['height'] . '.' . $imageNameArr[1];

        return $url;
    }

}
