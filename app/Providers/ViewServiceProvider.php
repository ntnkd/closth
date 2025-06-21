<?php

namespace App\Providers;

use App\Http\View\Composers\MenuComposer;
use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
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
        });
        // View::composer('header', MenuComposer::class);
        // View::composer('cart', CartComposer::class);
    }
}
