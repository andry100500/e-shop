<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class DeliveryMethod extends Model
{
    use HasFactory;

    public function deliveryMethodDescription()
    {
        $lang = App::getLocale();
        return $this->hasOne(DeliveryMethodDescription::class)->where('lang', $lang);
    }


}
