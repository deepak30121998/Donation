<?php

namespace Database\Seeders;

use App\Models\PageSection;
use Illuminate\Database\Seeder;

class PageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'page'        => 'home',
                'section_key' => 'hero',
                'title'       => 'Empower change, one act of kindness at a time',
                'subtitle'    => 'Together we can make a difference',
                'button_text' => 'Donate Now',
                'button_url'  => '/donation',
                'is_active'   => true,
            ],
            [
                'page'        => 'home',
                'section_key' => 'about',
                'title'       => 'We Are Dedicated To Helping People In Need',
                'subtitle'    => 'About Our Organization',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],
            [
                'page'        => 'home',
                'section_key' => 'cta',
                'title'       => 'Small gifts, big changes',
                'subtitle'    => 'Join us in empowering communities',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],
            [
                'page'        => 'about',
                'section_key' => 'hero',
                'title'       => 'About Us',
                'subtitle'    => 'Learn about our mission and values',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],
        ];

        foreach ($sections as $section) {
            PageSection::firstOrCreate(
                [
                    'page'        => $section['page'],
                    'section_key' => $section['section_key'],
                ],
                $section
            );
        }
    }
}
