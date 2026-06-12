<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'author_name'     => 'Geeta Devi',
                'author_position' => 'Partner, Child Education — Ghaziabad',
                'quote'           => 'Their expertise and dedication have been invaluable in advancing our shared goals. The foundation truly walks its talk. Every child they help is a testament to their commitment.',
                'rating'          => 5,
                'order'           => 1,
                'is_active'       => true,
            ],
            [
                'author_name'     => 'Sarita Chand',
                'author_position' => 'Volunteer — Noida',
                'quote'           => 'Their team is passionate, knowledgeable, and genuinely cares about making a difference. It is an honour to volunteer here. The work they do for women and animals is truly inspiring.',
                'rating'          => 5,
                'order'           => 2,
                'is_active'       => true,
            ],
            [
                'author_name'     => 'Sunita Sharma',
                'author_position' => 'Partner/Collaborator — Noida',
                'quote'           => 'They are truly dedicated to their mission with a commitment to excellence and integrity. Proud to be associated with Ujjawal Unnati Foundation. A model NGO for all of us.',
                'rating'          => 5,
                'order'           => 3,
                'is_active'       => true,
            ],
            [
                'author_name'     => 'Dr Suraj Sharma',
                'author_position' => 'Volunteer — Noida',
                'quote'           => 'Impressed by their professionalism, attention to detail, and transparency throughout. This is how an NGO should be run — with accountability, heart, and measurable impact.',
                'rating'          => 5,
                'order'           => 4,
                'is_active'       => true,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::firstOrCreate(
                ['author_name' => $data['author_name']],
                $data
            );
        }
    }
}
