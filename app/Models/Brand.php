<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Brand extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function brandDescription()
    {
        $lang = App::getLocale();
        return $this->hasOne(BrandDescription::class)->where('lang', $lang);
    }
}
