<?php

namespace App\Http\Services;

use App\Models\Menu;
use App\Models\MenuItem;

class MenuManager
{

    public static function getMenu($code)
    {
        $menu = Menu::where('code', $code)->first();
        $links = MenuItem::where('menu_id', $menu->id)
            ->with('menuItemDescription')
            ->orderBy('sort_order', 'asc')->get();
        return $links;
    }

}
