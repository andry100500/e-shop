<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;


    public function productDescription()
    {
        $lang = App::getLocale();
        return $this
            ->hasOne(ProductDescription::class, 'product_id')
            ->where('lang', $lang);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function characteristicProduct()
    {
        $lang = App::getLocale();
        return $this->hasMany(ChahacteristicProduct::class)->where('lang', $lang);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order', 'asc');
    }
}
