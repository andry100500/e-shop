<?php

return [
    /**
     * Размеры картинок для вывода на сайте
     */
    'imageSizes' => [
        'small' => ['width' => 70, 'height' => 70], // просмотренные, корзина и т.д.
        'middle' => ['width' => 260, 'height' => 260], // карточки товаров (картинки в каталоге, популярные, рекомендации и т.д.)
        'big' => ['width' => 600, 'height' => 600], // главное изображение на странице товара
        'bigest' => ['width' => 800, 'height' => 800], // увеличенное изображение на товаре
        'category_header_menu' => ['width' => 90, 'height' => 90], // картинки категорий в меню шапки
        'category_subcategories_menu' => ['width' => 140, 'height' => 90], // картинки подкатегорий на странице категории над товарами
        'blod_preview' => ['width' => 355, 'height' => 142], // превью статей блога
        'blod_main_mage' => ['width' => 1000, 'height' => 400] // Большое изображение статьи
    ]

];