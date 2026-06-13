<?php

namespace App\Providers;

use App\Models\NavigationItem;
use App\Models\Post;
use App\Models\Service;
use App\Observers\PostObserver;
use App\Observers\ServiceObserver;
use App\Settings\SiteSettings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Post::observe(PostObserver::class);
        Service::observe(ServiceObserver::class);

        // Site settings
        View::composer('*', function ($view) {
            try {
                $view->with('siteSettings', app(SiteSettings::class));
            } catch (\Exception) {
                $view->with('siteSettings', null);
            }
        });

        // All active page sections keyed as "page.section_key"
        View::composer('*', function ($view) {
            if (!Schema::hasTable('page_sections')) {
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

        // Dynamic navigation menu (top-level + children)
        View::composer('*', function ($view) {
            if (!Schema::hasTable('navigation_items')) {
                $view->with('navItems', collect());
                $view->with('footerNavItems', collect());
                return;
            }
            static $navItems = null;
            if ($navItems === null) {
                $navItems = NavigationItem::whereNull('parent_id')
                    ->where('is_active', true)
                    ->with(['children' => fn ($q) => $q->where('is_active', true)->orderBy('order')])
                    ->orderBy('order')
                    ->get();
            }
            $view->with('navItems', $navItems);
            $view->with('footerNavItems', $navItems->filter(fn ($i) => $i->children->isEmpty())->take(6)->values());
        });

        // Top 4 active services for footer/header nav
        View::composer('*', function ($view) {
            if (!Schema::hasTable('services')) {
                return;
            }
            static $navServices = null;
            if ($navServices === null) {
                $navServices = Service::where('is_active', true)
                    ->orderBy('order')
                    ->take(4)
                    ->get(['id', 'title', 'slug']);
            }
            $view->with('navServices', $navServices);
        });

        // All counters for stats sections
        View::composer('*', function ($view) {
            if (!Schema::hasTable('site_counters')) {
                return;
            }
            static $counters = null;
            if ($counters === null) {
                $counters = \App\Models\SiteCounter::orderBy('order')->get();
            }
            $view->with('counters', $counters);
        });
    }
}
