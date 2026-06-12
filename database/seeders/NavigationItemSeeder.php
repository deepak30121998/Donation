<?php

namespace Database\Seeders;

use App\Models\NavigationItem;
use Illuminate\Database\Seeder;

class NavigationItemSeeder extends Seeder
{
    public function run(): void
    {
        NavigationItem::truncate();

        // Top-level: 6 items max so they fit on one navbar row
        $topLevel = [
            ['label' => 'Home',     'route_name' => 'home',           'order' => 1],
            ['label' => 'About Us', 'route_name' => 'about',          'order' => 2],
            ['label' => 'Services', 'route_name' => 'services.index', 'order' => 3],
            ['label' => 'Donate',   'route_name' => 'donation.index', 'order' => 4],
            // Pages dropdown inserted at order 5 below
            ['label' => 'Contact Us', 'route_name' => 'contact.index', 'order' => 6],
        ];

        foreach ($topLevel as $item) {
            NavigationItem::create(array_merge($item, [
                'is_active' => true,
                'target'    => '_self',
            ]));
        }

        // Pages dropdown
        $pagesParent = NavigationItem::create([
            'label'      => 'Pages',
            'route_name' => null,
            'url'        => '#',
            'order'      => 5,
            'is_active'  => true,
            'target'     => '_self',
        ]);

        $subItems = [
            ['label' => 'Our Programs',  'route_name' => 'programs.index', 'order' => 1],
            ['label' => 'Blog',          'route_name' => 'blog.index',     'order' => 2],
            ['label' => 'Our Team',      'route_name' => 'team',           'order' => 3],
            ['label' => 'Gallery',       'route_name' => 'gallery',        'order' => 4],
            ['label' => 'Testimonials',  'route_name' => 'testimonials',   'order' => 5],
            ['label' => 'FAQs',          'route_name' => 'faqs',           'order' => 6],
        ];

        foreach ($subItems as $sub) {
            NavigationItem::create(array_merge($sub, [
                'parent_id' => $pagesParent->id,
                'is_active' => true,
                'target'    => '_self',
            ]));
        }
    }
}
