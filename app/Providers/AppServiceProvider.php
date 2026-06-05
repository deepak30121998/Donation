<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Service;
use App\Observers\PostObserver;
use App\Observers\ServiceObserver;
use App\Settings\SiteSettings;
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
        // Register observers
        Post::observe(PostObserver::class);
        Service::observe(ServiceObserver::class);

        // Share site settings with all views
        View::composer('*', function ($view) {
            try {
                $settings = app(SiteSettings::class);
                $view->with('siteSettings', $settings);
            } catch (\Exception $e) {
                $view->with('siteSettings', null);
            }
        });
    }
}
