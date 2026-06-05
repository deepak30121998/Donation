<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Database\Seeder;

class FaqCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'  => 'General',
                'slug'  => 'general',
                'order' => 1,
                'faqs'  => [
                    [
                        'question' => 'What is Lenity Charity?',
                        'answer'   => 'Lenity Charity is a non-profit organization dedicated to empowering communities and improving lives through compassionate action, volunteer programs, and targeted fundraising initiatives.',
                        'order'    => 1,
                        'is_active' => true,
                    ],
                    [
                        'question' => 'How can I get involved?',
                        'answer'   => 'You can get involved by donating, volunteering, or spreading the word about our programs. Visit our volunteer page to learn more about current opportunities.',
                        'order'    => 2,
                        'is_active' => true,
                    ],
                    [
                        'question' => 'Is Lenity Charity a registered non-profit?',
                        'answer'   => 'Yes, Lenity Charity is a registered 501(c)(3) non-profit organization. All donations are tax-deductible to the extent permitted by law.',
                        'order'    => 3,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name'  => 'Donation',
                'slug'  => 'donation',
                'order' => 2,
                'faqs'  => [
                    [
                        'question' => 'How do I make a donation?',
                        'answer'   => 'You can donate online through our secure donation page, by bank transfer, or by mailing a cheque to our office. All payment methods are listed on the Donate page.',
                        'order'    => 1,
                        'is_active' => true,
                    ],
                    [
                        'question' => 'Will I receive a receipt for my donation?',
                        'answer'   => 'Yes. A tax receipt will be emailed to you automatically after your donation is processed. Please allow up to 24 hours for delivery.',
                        'order'    => 2,
                        'is_active' => true,
                    ],
                    [
                        'question' => 'Can I set up a recurring donation?',
                        'answer'   => 'Absolutely! During checkout you can choose a monthly, quarterly, or annual giving frequency. You can cancel or adjust your recurring gift at any time.',
                        'order'    => 3,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name'  => 'Volunteer',
                'slug'  => 'volunteer',
                'order' => 3,
                'faqs'  => [
                    [
                        'question' => 'What volunteering opportunities are available?',
                        'answer'   => 'We offer a range of opportunities including community outreach, event support, administrative assistance, and skills-based volunteering. Check our volunteer page for current openings.',
                        'order'    => 1,
                        'is_active' => true,
                    ],
                    [
                        'question' => 'Do I need prior experience to volunteer?',
                        'answer'   => 'No prior experience is required for most roles. We provide full training and ongoing support to all our volunteers.',
                        'order'    => 2,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name'  => 'Program',
                'slug'  => 'program',
                'order' => 4,
                'faqs'  => [
                    [
                        'question' => 'What programs does Lenity run?',
                        'answer'   => 'Lenity runs programs focused on education, healthcare access, food security, and community development. You can explore all active programs on our Programs page.',
                        'order'    => 1,
                        'is_active' => true,
                    ],
                    [
                        'question' => 'How are program beneficiaries selected?',
                        'answer'   => 'Beneficiaries are identified through partnerships with local community organisations and a needs-based assessment process carried out by our field teams.',
                        'order'    => 2,
                        'is_active' => true,
                    ],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $faqs = $categoryData['faqs'];
            unset($categoryData['faqs']);

            $category = FaqCategory::firstOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );

            foreach ($faqs as $faq) {
                Faq::firstOrCreate(
                    [
                        'faq_category_id' => $category->id,
                        'question'        => $faq['question'],
                    ],
                    array_merge($faq, ['faq_category_id' => $category->id])
                );
            }
        }
    }
}
