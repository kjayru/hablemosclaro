<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Configuration;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


       view()->composer('layouts.frontend.app', function($view) {
            $menu =  Category::where('parent_id',null)->get();
            $global = Configuration::find(1);
        $view->with(['menu'=>$menu,'global'=>$global]);
       });


    }
}
