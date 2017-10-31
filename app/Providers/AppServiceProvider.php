<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Blade;
use App\manageCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $menu = new manageCategory;
        $data1 = $menu::where('parentId','0')->get();
        $data2 = $menu::all();
        View::share(['menu'=> $data1,'child'=>$data2]);
    }

    

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
        $this->app->register('Hesto\MultiAuth\MultiAuthServiceProvider');
        }
    }
}
