<?php

namespace App\Providers;

use App\ViewComposers\Sidebar;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
//        view()->composer([
//            'parts.machines-categories',
//            'ru.parts.machines-categories',
//            'parts.search',
//            'ru.parts.search',
//        ], Sidebar::class);
    }
}
