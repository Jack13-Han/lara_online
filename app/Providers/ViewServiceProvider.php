<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        if (Schema::hasTable('categories')){
            View::share('categories',Category::all());
        }

//        Blade::if('onlyAdmin',function (){
//            Auth::user()-role === 'admin';
//        });

        Blade::if('onlyAdmin',fn()=>auth()->user()->role === "admin");

        Blade::directive('hwh',function (){
            return "<h1>Han Wai Htun</h1>";
        });

        View::composer("home",function (){
            View::share('categories',Category::all());
        });
    }
}
