<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
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
        view()->composer("*", function($view){
            $view->with("calculateReduction", function(Product $product){
                return number_format((($product->regularPrice - $product->soldePrice) / $product->regularPrice) * 100, 0);
            });
             $view->with("format_price", function($soldePrice){
                return number_format($soldePrice, 2, '.', ' ') . 'FCFA';
            });
        });
    }
}
