<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Configuration;
use Carbon\Carbon;

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

    Carbon::setUTF8(true);
    Carbon::setLocale(config('app.locale'));
    setlocale(LC_ALL, 'es_ES', 'es', 'ES', 'es_ES.utf8');

       view()->composer('layouts.frontend.app', function($view) {
            $menu =  Category::where('parent_id',null)->get();
            $global = Configuration::find(1);
        $view->with(['menu'=>$menu,'global'=>$global]);
       });


    }
}
