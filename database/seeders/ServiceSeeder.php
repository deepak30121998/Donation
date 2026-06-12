<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title'             => 'Advocacy for Women\'s Rights',
                'short_description' => 'Fighting for legal rights, safety, and equal opportunities for every woman.',
                'body'              => '<p>We provide legal aid, counselling, and awareness drives to ensure women know and can exercise their rights. Our team works directly in communities to address domestic violence, discrimination, and unequal access to resources.</p><p>Through partnerships with legal professionals and government bodies, we have helped hundreds of women access justice and rebuild their lives with dignity.</p>',
                'order'             => 1,
                'is_active'         => true,
            ],
            [
                'title'             => 'Protection of Cows (Gau Sewa)',
                'short_description' => 'Running shelters for abandoned and injured cows across the region.',
                'body'              => '<p>Our Gau Sewa initiative runs dedicated cow shelters providing medical care, nutritious feed, and safe housing for abandoned, injured, and aged cows. We have served over 22,500 cows since our founding.</p><p>We also educate communities about the cultural and environmental significance of cow protection and run adoption drives for healthy cows with responsible farming families.</p>',
                'order'             => 2,
                'is_active'         => true,
            ],
            [
                'title'             => 'Child Labour Eradication',
                'short_description' => 'Rescuing children from labour and bringing them back to education.',
                'body'              => '<p>We identify and rescue children trapped in hazardous labour, working with district authorities to prosecute exploiters and restore children to safe environments. Each rescued child receives rehabilitation support, counselling, and school enrollment assistance.</p><p>Our awareness programs target parents, employers, and local leaders to prevent child labour before it begins.</p>',
                'order'             => 3,
                'is_active'         => true,
            ],
            [
                'title'             => 'Women Empowerment',
                'short_description' => 'Skill training, self-help groups, and entrepreneurship support for women.',
                'body'              => '<p>Our Women Empowerment program provides vocational training in tailoring, beauty, food processing, handicrafts, and digital literacy. We have empowered over 1,15,000 women entrepreneurs through our self-help group network and microfinance partnerships.</p><p>Regular workshops on financial literacy, legal rights, and health ensure our women graduates thrive independently.</p>',
                'order'             => 4,
                'is_active'         => true,
            ],
            [
                'title'             => 'Education for Everyone',
                'short_description' => 'Free tuition centres, books, and scholarships for underprivileged children.',
                'body'              => '<p>We operate free coaching centres in Noida and surrounding districts, providing quality education to children who cannot afford private tuition. We also run notebook, stationery, and school bag distribution drives at the start of every academic year.</p><p>Merit scholarships and exam support help deserving children pursue higher education and break the cycle of poverty.</p>',
                'order'             => 5,
                'is_active'         => true,
            ],
            [
                'title'             => 'Fight for Hunger-Free India',
                'short_description' => 'Regular ration kits, food camps, and cooked meals for those in need.',
                'body'              => '<p>No one should sleep hungry. Our hunger eradication program runs monthly ration distribution drives, daily cooked meal camps for the homeless, and emergency food relief during floods, heatwaves, and festival periods.</p><p>We partner with local temples, businesses, and volunteers to ensure consistent food security for the most vulnerable families in our area.</p>',
                'order'             => 6,
                'is_active'         => true,
            ],
        ];

        foreach ($services as $data) {
            Service::firstOrCreate(
                ['slug' => Str::slug($data['title'])],
                $data
            );
        }
    }
}
