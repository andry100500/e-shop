<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    public function menuItemDescription()
    {
        return $this->hasOne(MenuItemDescription::class)->where('lang', app()->getLocale());
    }
}
