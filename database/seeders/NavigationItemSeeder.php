<?php

namespace Database\Seeders;

use App\Models\NavigationItem;
use Illuminate\Database\Seeder;

class NavigationItemSeeder extends Seeder
{
    public function run(): void
    {
        NavigationItem::truncate();

        $topLevel = [
            ['label' => 'Home',         'route_name' => 'home',            'order' => 1],
            ['label' => 'About Us',     'route_name' => 'about',           'order' => 2],
            ['label' => 'Services',     'route_name' => 'services.index',  'order' => 3],
            ['label' => 'Our Team',     'route_name' => 'team',            'order' => 4],
            ['label' => 'Gallery',      'route_name' => 'gallery',         'order' => 5],
            ['label' => 'Testimonials', 'route_name' => 'testimonials',    'order' => 6],
            ['label' => 'Contact Us',   'route_name' => 'contact.index',   'order' => 7],
            ['label' => 'Donate',       'route_name' => 'donation.index',  'order' => 8],
        ];

        foreach ($topLevel as $item) {
            NavigationItem::create(array_merge($item, [
                'is_active' => true,
                'target'    => '_self',
            ]));
        }

        // Pages dropdown (optional sub-items for fuller menu)
        $pagesParent = NavigationItem::create([
            'label'      => 'Pages',
            'route_name' => null,
            'url'        => '#',
            'order'      => 9,
            'is_active'  => true,
            'target'     => '_self',
        ]);

        $subItems = [
            ['label' => 'Our Programs',   'route_name' => 'programs.index', 'order' => 1],
            ['label' => 'Blog',           'route_name' => 'blog.index',     'order' => 2],
            ['label' => 'FAQs',           'route_name' => 'faqs',           'order' => 3],
            ['label' => 'Donation',       'route_name' => 'donation.index', 'order' => 4],
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
