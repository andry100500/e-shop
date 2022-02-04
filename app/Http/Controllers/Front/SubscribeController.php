<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function subscribe(){
			if(request()->email){
				$subscribe =  new App\Models\Subscribe();
				$subscribe->email = request()->email;
				$subscribe->save();
			}
		}
}
