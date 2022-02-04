<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Characteristic extends Model
{
    use HasFactory;

    public function characteristicDescriptions()
    {
        $lang = App::getLocale();
        return $this->hasOne(ChahacteristicDescription::class)->where('lang', $lang);
    }
}
