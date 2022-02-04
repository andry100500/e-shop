<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;


    public function postsDescription()
    {
        $lang = App::getLocale();
        return $this->hasOne(PostDescription::class)->where('lang', $lang);
    }
}
