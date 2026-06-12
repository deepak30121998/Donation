<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        $categories = [
            ['name' => 'Gau Sewa',           'slug' => 'gau-sewa'],
            ['name' => 'Women Empowerment',   'slug' => 'women-empowerment'],
            ['name' => 'Child Education',     'slug' => 'child-education'],
            ['name' => 'Hunger Eradication',  'slug' => 'hunger-eradication'],
            ['name' => 'Foundation News',     'slug' => 'foundation-news'],
        ];

        $createdCategories = [];
        foreach ($categories as $cat) {
            $createdCategories[$cat['slug']] = PostCategory::firstOrCreate(
                ['slug' => $cat['slug']],
                ['name' => $cat['name']]
            );
        }

        $posts = [
            [
                'category'     => 'gau-sewa',
                'title'        => '22,500 Cows Served — Our Gau Sewa Journey',
                'excerpt'      => 'From rescuing a single abandoned cow in 2015 to running a full gaushala serving over 22,500 cows — here is the story of our Gau Sewa mission.',
                'body'         => '<p>When Ujjawal Unnati Foundation was founded in 2015, one of our first acts was to rescue an abandoned, injured cow from the roadside in Noida Sector 12. That single act of compassion sparked what has grown into one of our most impactful programs — the Gau Sewa initiative.</p>

<p>Today, our gaushala provides round-the-clock care to hundreds of cows at a time. With a team of dedicated handlers, veterinary professionals, and volunteers, we ensure every animal receives nutritious fodder, clean water, medical attention, and a safe, clean environment.</p>

<h3>What Our Gau Sewa Program Covers</h3>
<ul>
<li><strong>Emergency Rescue:</strong> We respond to calls about injured, sick, or abandoned cows on roads and in urban areas.</li>
<li><strong>Daily Care:</strong> Feeding, grooming, and medical monitoring for every animal in our shelter.</li>
<li><strong>Veterinary Services:</strong> Partnering with licensed veterinarians for regular checkups, vaccinations, and treatments.</li>
<li><strong>Adoption Program:</strong> Placing healthy cows with responsible farming families who commit to their long-term welfare.</li>
</ul>

<p>Over the years, we have served over 22,500 cows — each one a life saved, a piece of our heritage protected. We believe cow protection is not just a religious duty but a humanitarian and environmental responsibility.</p>

<p>If you would like to sponsor fodder for a cow, contribute to our veterinary fund, or volunteer at our gaushala, please contact us at +91-8130789837 or visit our Donation page.</p>',
                'published_at' => now()->subDays(5),
            ],
            [
                'category'     => 'women-empowerment',
                'title'        => '1,15,000 Women Entrepreneurs — The Power of Skill Training',
                'excerpt'      => 'How a simple 6-month tailoring course changed the lives of thousands of women across Noida and UP — and why we are just getting started.',
                'body'         => '<p>When we launched our first Women Empowerment training batch in 2016, we had 12 women in a small room with two sewing machines. Today, that program has grown to train thousands of women every year across multiple skill tracks, and over 1,15,000 women have graduated and gone on to build independent livelihoods.</p>

<p>The transformation is extraordinary. Women who once depended entirely on others for their daily needs are now running their own tailoring businesses, beauty parlours, and food processing units. They have formed Self-Help Groups (SHGs), taken microfinance loans, and mentored the next batch of trainees.</p>

<h3>Skills We Teach</h3>
<ul>
<li><strong>Tailoring & Stitching:</strong> From basics to advanced garment making.</li>
<li><strong>Beauty & Wellness:</strong> Hair care, skincare, and salon management.</li>
<li><strong>Food Processing:</strong> Pickles, preserves, baking, and packaging.</li>
<li><strong>Handicrafts:</strong> Embroidery, jute craft, and home décor items.</li>
<li><strong>Digital Literacy:</strong> Mobile banking, online selling, and basic computer skills.</li>
</ul>

<p>Every graduate receives a certificate of completion, access to our SHG network, and microfinance linkage through our banking partners. We also help them find markets for their products through local fairs and online platforms.</p>

<p>Our goal is to reach 2,00,000 women by 2027. If you want to sponsor a training batch or donate equipment, reach out to us today.</p>',
                'published_at' => now()->subDays(12),
            ],
            [
                'category'     => 'child-education',
                'title'        => 'Back to School — Our Annual Notebook Distribution Drive',
                'excerpt'      => 'Every year before the school season, we distribute notebooks, bags, and stationery to hundreds of underprivileged children. Here is a look at this year\'s drive.',
                'body'         => '<p>The beginning of a new school year should be a time of excitement for every child. But for many families in our area, the cost of notebooks, bags, and basic stationery is a genuine barrier. That is why every year, before schools reopen, we run our Annual Notebook and School Supply Distribution Drive.</p>

<p>This year, our volunteers distributed kits to over 800 children across 12 schools and community centres in Noida and neighbouring areas. Each kit included:</p>
<ul>
<li>4 notebooks (ruled, unruled, and graph)</li>
<li>A school bag</li>
<li>Pens, pencils, erasers, and a sharpener</li>
<li>A geometry box</li>
<li>A water bottle</li>
</ul>

<p>The smiles on the children\'s faces made every minute of planning and every rupee donated worth it. One of our volunteers, Ravi Mishra, shared: "When a little girl picked up her new bag and put it on, she stood a little taller. That moment is why we do this work."</p>

<h3>Our Free Coaching Centres</h3>
<p>Beyond the supply drives, we run free coaching centres in Noida and 50+ surrounding villages, offering Classes 1–12 tuition in Maths, Science, Hindi, and English. Over 2,000 students attend our centres regularly. If you want to sponsor a student\'s education or volunteer as a teacher, contact us today.</p>',
                'published_at' => now()->subDays(20),
            ],
            [
                'category'     => 'hunger-eradication',
                'title'        => 'Feeding 500+ Families Every Month — Our Ration Distribution Drive',
                'excerpt'      => 'No one should sleep hungry. Our monthly ration distribution program ensures 500+ families in Noida receive essential food supplies every month.',
                'body'         => '<p>Food security is a basic human right. Yet in the urban and peri-urban areas around Noida, thousands of families — daily-wage workers, widows, elderly individuals living alone — struggle to meet their basic nutritional needs. Our monthly Ration Distribution Drive is our answer to this crisis.</p>

<p>Every month, our team of 50+ volunteers packs and distributes ration kits to over 500 families. Each kit typically includes:</p>
<ul>
<li>5 kg rice</li>
<li>2 kg dal (lentils)</li>
<li>1 litre cooking oil</li>
<li>2 kg wheat flour (atta)</li>
<li>Salt, sugar, and spices</li>
</ul>

<p>We prioritise the most vulnerable: widows, families with disabled members, daily-wage workers who have lost employment, and elderly individuals with no support network.</p>

<h3>Festival Special Drives</h3>
<p>During Diwali, Eid, and other festivals, we scale up our operations with special cooked meal camps, serving hundreds of homeless individuals and families in need. Last Diwali, we served over 1,200 cooked meals in a single day.</p>

<p>If you would like to sponsor a ration kit (approximately ₹500 per family) or volunteer for our next distribution drive, please contact us at +91-8130789837.</p>',
                'published_at' => now()->subDays(30),
            ],
            [
                'category'     => 'foundation-news',
                'title'        => 'Ujjawal Unnati Foundation Reaches 2,500 Supporters Milestone',
                'excerpt'      => 'We are proud to announce that our community of supporters has crossed 2,500 — individuals and organisations who believe in our mission of empowering communities across India.',
                'body'         => '<p>We are thrilled to share a milestone that fills our hearts with gratitude and determination: Ujjawal Unnati Foundation now has over 2,500 supporters — individuals, families, and organisations who believe in our mission and contribute through donations, volunteering, and advocacy.</p>

<p>This milestone is not just a number. It represents 2,500 acts of faith in the work we do — the early mornings at the gaushala, the skill training classes, the distribution drives, the awareness campaigns that change minds and open hearts.</p>

<h3>Thank You to Our Community</h3>
<p>Every supporter has played a role in our journey:</p>
<ul>
<li>The donor who sponsors a cow\'s fodder for a month.</li>
<li>The volunteer who gives up their Sunday to pack ration kits.</li>
<li>The corporate partner who funds a training batch for women.</li>
<li>The student who shares our work on social media and inspires others to join.</li>
</ul>

<p>Together, we have served 22,500+ cows, empowered 1,15,000+ women, transformed 12,000+ lives, and fought hunger for thousands of families. And we are just getting started.</p>

<p>If you are not yet a part of our community, we invite you to join us. Donate, volunteer, or simply follow us on Facebook and YouTube. Every action counts.</p>

<p><em>With gratitude,<br>Dipa Devi<br>President, Ujjawal Unnati Foundation</em></p>',
                'published_at' => now()->subDays(45),
            ],
        ];

        foreach ($posts as $postData) {
            $categorySlug = $postData['category'];
            unset($postData['category']);

            $category = $createdCategories[$categorySlug];
            $slug     = Str::slug($postData['title']);

            Post::firstOrCreate(
                ['slug' => $slug],
                array_merge($postData, [
                    'slug'             => $slug,
                    'post_category_id' => $category->id,
                    'author_id'        => $admin?->id,
                    'is_published'     => true,
                    'meta_title'       => $postData['title'] . ' — Ujjawal Unnati Foundation',
                    'meta_description' => $postData['excerpt'],
                ])
            );
        }
    }
}
