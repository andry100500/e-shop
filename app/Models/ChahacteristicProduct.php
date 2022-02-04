<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChahacteristicProduct extends Model
{
    use HasFactory;

    public function characteristic()
    {
        return $this->belongsTo(Characteristic::class);
    }
}
