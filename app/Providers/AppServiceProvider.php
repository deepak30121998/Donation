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

        // Share all active page sections with every view, keyed by "page.section_key"
        View::composer('*', function ($view) {
            if (!\Illuminate\Support\Facades\Schema::hasTable('page_sections')) {
                return;
            }
            static $sections = null;
            if ($sections === null) {
                $sections = \App\Models\PageSection::where('is_active', true)
                    ->with('media')
                    ->get()
                    ->keyBy(fn ($s) => $s->page . '.' . $s->section_key);
            }
            $view->with('sections', $sections);
        });

        // Share nav services (footer + header dropdowns)
        View::composer('*', function ($view) {
            if (!\Illuminate\Support\Facades\Schema::hasTable('services')) {
                return;
            }
            static $navServices = null;
            if ($navServices === null) {
                $navServices = \App\Models\Service::where('is_active', true)
                    ->orderBy('order')
                    ->take(4)
                    ->get(['id', 'title', 'slug']);
            }
            $view->with('navServices', $navServices);
        });
    }
}
