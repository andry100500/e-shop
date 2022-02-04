<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Page extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function pageDescription()
    {
        $lang = App::getLocale();
        return $this->hasOne(PageDescription::class)->where('lang', $lang);
    }
}
