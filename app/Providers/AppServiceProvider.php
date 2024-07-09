<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Feature;
use App\Models\Product;
use App\Models\Slider;
use App\Observers\CategoryObserver;
use App\Observers\FeatureObserver;
use App\Observers\ProductObserver;
use App\Observers\SliderObserver;
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
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Slider::observe(SliderObserver::class);
        Feature::observe(FeatureObserver::class);

    }
}
