<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'title'             => 'Gau Sewa Program',
                'short_description' => 'Daily cow care, medical treatment, and fodder distribution at our gaushala.',
                'body'              => '<p>Our flagship Gau Sewa program operates a dedicated gaushala where abandoned, injured, and elderly cows receive round-the-clock care. Our trained staff and veterinary partners provide daily medical attention, balanced nutrition, and a safe, clean environment.</p><p>Over 22,500 cows have been served since we began. The gaushala also runs an adoption program, placing healthy cows with responsible farming families who commit to their long-term welfare.</p><h4>What We Do</h4><ul><li>Daily feeding and medical checkups</li><li>Emergency veterinary care</li><li>Cow adoption drives</li><li>Community awareness on Gau Raksha</li></ul>',
                'order'             => 1,
                'is_active'         => true,
            ],
            [
                'title'             => 'Women Entrepreneur Program',
                'short_description' => '6-month skill training and microfinance support for women entrepreneurs.',
                'body'              => '<p>This intensive 6-month program transforms underprivileged women into confident, self-reliant entrepreneurs. Training covers tailoring, beauty & wellness, food processing, handicrafts, and digital business skills.</p><p>Upon completion, graduates gain access to our microfinance network, SHG (Self-Help Group) membership, and business mentorship. Over 1,15,000 women have been empowered through this program.</p><h4>Program Highlights</h4><ul><li>6 months hands-on skill training</li><li>Microfinance linkage</li><li>SHG formation and leadership</li><li>Market linkage for products</li><li>Certificate of completion</li></ul>',
                'order'             => 2,
                'is_active'         => true,
            ],
            [
                'title'             => 'Child Education Program',
                'short_description' => 'Free coaching centres and school enrollment drives across 50+ villages.',
                'body'              => '<p>Education is the most powerful tool for breaking the poverty cycle. Our Child Education Program runs free tuition centres across Noida and 50+ surrounding villages, providing quality after-school coaching to children from Classes 1 to 12.</p><p>We also conduct annual school supply distribution drives — notebooks, bags, stationery — and work with schools to ensure enrolled children stay in school.</p><h4>Activities</h4><ul><li>Free coaching in Maths, Science, Hindi, English</li><li>Annual notebook and school bag distribution</li><li>School enrollment drives for out-of-school children</li><li>Scholarship support for higher education</li></ul>',
                'order'             => 3,
                'is_active'         => true,
            ],
            [
                'title'             => 'Ration Distribution Drive',
                'short_description' => 'Monthly ration kits to 500+ families and emergency food relief.',
                'body'              => '<p>Every month, our volunteers distribute ration kits — rice, dal, oil, flour, and spices — to over 500 families who face food insecurity. We prioritise widows, daily-wage workers, elderly individuals living alone, and families with disabled members.</p><p>During festivals, natural disasters, and heatwaves, we scale up our operations with special food camps serving cooked meals to thousands of people.</p><h4>What\'s Included</h4><ul><li>Monthly ration kits for 500+ families</li><li>Festival special food camps</li><li>Cooked meal drives for homeless individuals</li><li>Emergency food relief during disasters</li></ul>',
                'order'             => 4,
                'is_active'         => true,
            ],
        ];

        foreach ($programs as $data) {
            Program::firstOrCreate(
                ['slug' => Str::slug($data['title'])],
                $data
            );
        }
    }
}
