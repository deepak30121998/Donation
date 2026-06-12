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
                        'question'  => 'What is Ujjawal Unnati Foundation?',
                        'answer'    => 'Ujjawal Unnati Foundation is a registered NGO based in Noida, Uttar Pradesh, working for women empowerment, Gau Sewa (cow protection), child labour eradication, free education, and hunger eradication across India.',
                        'order'     => 1,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'How can I get involved with Ujjawal Unnati Foundation?',
                        'answer'    => 'You can get involved by donating, volunteering, or partnering with us. Call us at +91-8130789837 or visit our Contact page to register as a volunteer.',
                        'order'     => 2,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'Is Ujjawal Unnati Foundation a registered NGO?',
                        'answer'    => 'Yes, Ujjawal Unnati Foundation is a duly registered NGO. We are 80G-certified, making all donations tax-exempt under the Income Tax Act of India.',
                        'order'     => 3,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'Where do you operate?',
                        'answer'    => 'We primarily operate in Noida, Gautam Budh Nagar, and surrounding districts of Uttar Pradesh. Our reach extends to over 50 villages through our education and ration distribution programs.',
                        'order'     => 4,
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
                        'question'  => 'How can I donate to Ujjawal Unnati Foundation?',
                        'answer'    => 'You can donate online via UPI, bank transfer, or card on our Donation page. You can also donate directly to a specific cause like Gau Sewa, Education, or Women Empowerment.',
                        'order'     => 1,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'Is my donation tax-exempt?',
                        'answer'    => 'Yes. We are 80G-certified. You will receive a donation receipt by email which can be used for tax exemption under Section 80G of the Income Tax Act.',
                        'order'     => 2,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'Where does my donation go?',
                        'answer'    => '100% of your donation goes directly to our programs — cow care, free education, women empowerment training, and ration distribution. We maintain full transparency and publish our accounts.',
                        'order'     => 3,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'Can I donate for a specific cause?',
                        'answer'    => 'Absolutely! You can choose to donate for Gau Sewa, Child Education, Women Empowerment, or Hunger Eradication when filling out the donation form.',
                        'order'     => 4,
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
                        'question'  => 'What volunteering opportunities are available?',
                        'answer'    => 'We need volunteers for Gau Sewa (cow care), ration distribution drives, women skill training camps, education centres, awareness campaigns, and event management.',
                        'order'     => 1,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'Do I need prior experience to volunteer?',
                        'answer'    => 'No prior experience is needed. We provide full orientation and training. What matters is your commitment and compassion.',
                        'order'     => 2,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'How do I register as a volunteer?',
                        'answer'    => 'Contact us at +91-8130789837 or fill the form on our Contact page. Our volunteer coordinator will get in touch with you within 24 hours.',
                        'order'     => 3,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name'  => 'Programs',
                'slug'  => 'programs',
                'order' => 4,
                'faqs'  => [
                    [
                        'question'  => 'How many cows do you care for?',
                        'answer'    => 'We have served over 22,500 cows since our founding through our Gau Sewa program. Our gaushala provides daily feeding, medical care, and shelter to abandoned and injured cows.',
                        'order'     => 1,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'What kind of skill training do you provide for women?',
                        'answer'    => 'We provide training in tailoring, beauty & wellness, food processing, handicrafts, and digital literacy. Over 1,15,000 women have been trained and empowered through our program.',
                        'order'     => 2,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'How many families receive ration kits every month?',
                        'answer'    => 'We distribute monthly ration kits to over 500 families in need, prioritising widows, daily-wage workers, elderly individuals, and families with disabled members.',
                        'order'     => 3,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'How do your education programs work?',
                        'answer'    => 'We run free coaching centres for Classes 1–12 in Noida and 50+ surrounding villages. We also conduct annual school supply drives distributing notebooks, bags, and stationery.',
                        'order'     => 4,
                        'is_active' => true,
                    ],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $faqs = $categoryData['faqs'];
            unset($categoryData['faqs']);

            $category = FaqCategory::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );

            foreach ($faqs as $faq) {
                Faq::updateOrCreate(
                    ['faq_category_id' => $category->id, 'question' => $faq['question']],
                    array_merge($faq, ['faq_category_id' => $category->id])
                );
            }
        }
    }
}
