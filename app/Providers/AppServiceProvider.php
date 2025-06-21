<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Slider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $categories = Category::where('active', 1)->get();
            $view->with('categories', $categories);

            $view->with('sliders', Slider::where('active', 1)->get());
        });

        View::share('categories', Category::all());
    }
}
