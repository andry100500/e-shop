<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class PaymentMethod extends Model
{
    use HasFactory;
    public function paymentMethodDescription()
    {
        $lang = App::getLocale();
        return $this->hasOne(PaymentMethodDescription::class)->where('lang', $lang);
    }
}
