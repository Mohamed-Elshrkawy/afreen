<?php

namespace App\Providers;

use App\Models\About;
use App\Models\Category;
use App\Models\Feature;
use App\Models\OurTeam;
use App\Models\Product;
use App\Models\Review;
use App\Models\Service;
use App\Models\setting;
use App\Models\Slider;
use App\Observers\AboutObserver;
use App\Observers\CategoryObserver;
use App\Observers\FeatureObserver;
use App\Observers\OurTeamObserver;
use App\Observers\ProductObserver;
use App\Observers\ServiceObserver;
use App\Observers\SettingObserver;
use App\Observers\SliderObserver;
use App\Observers\ReviewObserver;
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
        setting::observe(SettingObserver::class);
        Service::observe(ServiceObserver::class);
        Review::observe(ReviewObserver::class);
        About::observe(AboutObserver::class);
        OurTeam::observe(OurTeamObserver::class);
    }
}
