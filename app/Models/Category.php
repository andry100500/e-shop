<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;

    public $timestamps = null;

    public function categoryDescription()
    {
        $lang = App::getLocale();
        return $this->hasOne(CategoryDescription::class)->where('lang', $lang);
    }

    public function parentCategories()
    {
        return $this->belongsTo(Category::class, 'category_id')
            ->where('status', 1)
            ->with('parentCategories');
    }

    /**
     * Возвращает все вложеные категории (всех уровней)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subCategories()
    {
        return $this->hasMany(Category::class, 'category_id')
            ->with('subCategories')
            ->where('status', 1)
            ->orderBy('sort_order', 'asc');
    }

    /**
     * Возвращает плодкатегории первого уровня
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function firstChildCategories()
    {
        return $this->hasMany(Category::class, 'category_id')
            ->where('status', 1)->orderBy('sort_order', 'asc');
    }


    public function subCategory()
    {
        return $this->hasMany(Category::class, 'category_id')->orderBy('sort_order', 'asc');
    }
}
