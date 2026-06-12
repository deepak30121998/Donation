<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GalleryItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title' => 'Gau Sewa — Daily Feeding',          'category' => 'health',    'order' => 1],
            ['title' => 'Gau Sewa — Veterinary Care',        'category' => 'health',    'order' => 2],
            ['title' => 'Education — Free Coaching Centre',  'category' => 'education', 'order' => 3],
            ['title' => 'Education — Notebook Distribution', 'category' => 'education', 'order' => 4],
            ['title' => 'Ration Distribution Drive',         'category' => 'food',      'order' => 5],
            ['title' => 'Monthly Ration Kit Campaign',       'category' => 'food',      'order' => 6],
            ['title' => 'Clothes Distribution — Winter',     'category' => 'all',       'order' => 7],
            ['title' => 'Food Camp — Festival Season',       'category' => 'food',      'order' => 8],
            ['title' => 'Women Empowerment Training',        'category' => 'all',       'order' => 9],
            ['title' => 'Child Labour Awareness Drive',      'category' => 'education', 'order' => 10],
            ['title' => 'Community Health Camp',             'category' => 'health',    'order' => 11],
            ['title' => 'Skill Training — Tailoring Batch',  'category' => 'all',       'order' => 12],
        ];

        foreach ($items as $data) {
            GalleryItem::firstOrCreate(
                ['title' => $data['title']],
                array_merge($data, ['is_active' => true])
            );
        }
    }
}
