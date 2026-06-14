<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use Illuminate\Database\Seeder;

class GalleryCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Gau Sewa',           'slug' => 'gau-sewa',           'order' => 1],
            ['name' => 'Education',           'slug' => 'education',          'order' => 2],
            ['name' => 'Ration Distribution', 'slug' => 'ration-distribution','order' => 3],
            ['name' => 'Clothes Distribution','slug' => 'clothes-distribution','order' => 4],
            ['name' => 'Food Distribution',   'slug' => 'food-distribution',  'order' => 5],
            ['name' => 'Women Empowerment',   'slug' => 'women-empowerment',  'order' => 6],
        ];

        foreach ($categories as $cat) {
            GalleryCategory::firstOrCreate(
                ['slug' => $cat['slug']],
                array_merge($cat, ['is_active' => true])
            );
        }
    }
}
