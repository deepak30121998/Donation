<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GalleryItemSeeder extends Seeder
{
    public function run(): void
    {
        // Resolve category slugs to IDs
        $cats = GalleryCategory::pluck('id', 'slug');

        $items = [
            ['title' => 'Gau Sewa — Daily Feeding',          'category' => 'gau-sewa',            'order' => 1],
            ['title' => 'Gau Sewa — Veterinary Care',        'category' => 'gau-sewa',            'order' => 2],
            ['title' => 'Education — Free Coaching Centre',  'category' => 'education',           'order' => 3],
            ['title' => 'Education — Notebook Distribution', 'category' => 'education',           'order' => 4],
            ['title' => 'Ration Distribution Drive',         'category' => 'ration-distribution', 'order' => 5],
            ['title' => 'Monthly Ration Kit Campaign',       'category' => 'ration-distribution', 'order' => 6],
            ['title' => 'Clothes Distribution — Winter',     'category' => 'clothes-distribution','order' => 7],
            ['title' => 'Food Camp — Festival Season',       'category' => 'food-distribution',   'order' => 8],
            ['title' => 'Women Empowerment Training',        'category' => 'women-empowerment',   'order' => 9],
            ['title' => 'Child Labour Awareness Drive',      'category' => 'education',           'order' => 10],
            ['title' => 'Community Health Camp',             'category' => 'gau-sewa',            'order' => 11],
            ['title' => 'Skill Training — Tailoring Batch',  'category' => 'women-empowerment',   'order' => 12],
        ];

        foreach ($items as $data) {
            GalleryItem::firstOrCreate(
                ['title' => $data['title']],
                [
                    'gallery_category_id' => $cats[$data['category']] ?? null,
                    'order'               => $data['order'],
                    'is_active'           => true,
                ]
            );
        }
    }
}
