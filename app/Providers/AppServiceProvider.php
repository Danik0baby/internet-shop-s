<?php

namespace App\Providers;

use App\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('partials.header', function ($view): void {
            $view->with('cartCount', app(Cart::class)->count());
        });

        View::composer('partials.footer', function ($view): void {
            $view->with(
                'footerCategories',
                Category::query()
                    ->orderBy('sort_order')
                    ->orderBy('name')
                    ->take(6)
                    ->get()
            );
        });
    }
}
