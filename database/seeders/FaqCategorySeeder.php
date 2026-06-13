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
                        'answer'    => 'Ujjawal Unnati Foundation is a registered NGO based in Noida, Uttar Pradesh. We are dedicated to women empowerment, Gau Sewa (cow protection), child labour eradication, free education, and fighting hunger across India. Established in 2023, we have served 22,500+ cows and empowered 1,15,000+ women.',
                        'order'     => 1,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'When was Ujjawal Unnati Foundation established?',
                        'answer'    => 'Ujjawal Unnati Foundation was established in 2023. Despite being a young organisation, we have achieved significant impact — serving thousands of cows, empowering lakhs of women, and running education and ration programs across 50+ villages.',
                        'order'     => 2,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'Where do you operate?',
                        'answer'    => 'We primarily operate in Noida, Gautam Budh Nagar, and surrounding districts of Uttar Pradesh. Our programs reach over 50 villages through education centres, ration distribution, and awareness campaigns.',
                        'order'     => 3,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'Is Ujjawal Unnati Foundation a registered NGO?',
                        'answer'    => 'Yes, Ujjawal Unnati Foundation is a duly registered NGO. We are 80G-certified, making all donations tax-exempt under Section 80G of the Income Tax Act of India.',
                        'order'     => 4,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'How can I contact Ujjawal Unnati Foundation?',
                        'answer'    => 'You can reach us at +91-8130789837 or email us at info@ujjawalunnati.com. Our office is located at Sector 12, Noida, Gautam Budh Nagar 201301, India.',
                        'order'     => 5,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name'  => 'Donations',
                'slug'  => 'donations',
                'order' => 2,
                'faqs'  => [
                    [
                        'question'  => 'How can I donate to Ujjawal Unnati Foundation?',
                        'answer'    => 'You can donate online via UPI, bank transfer, or card on our Donation page. You can also choose to donate for a specific cause such as Gau Sewa, Child Education, or Women Empowerment.',
                        'order'     => 1,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'Is my donation tax-exempt?',
                        'answer'    => 'Yes. We are 80G-certified. You will receive a donation receipt by email which can be submitted to claim tax exemption under Section 80G of the Income Tax Act.',
                        'order'     => 2,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'Where does my donation go?',
                        'answer'    => '100% of your donation goes directly to our programs — cow care and medical treatment, free education centres, women empowerment training, and monthly ration distribution. We publish our accounts and maintain full transparency.',
                        'order'     => 3,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'Can I donate for a specific cause?',
                        'answer'    => 'Absolutely! When filling out the donation form, you can select a specific cause: Gau Sewa (Feed a Cow), Education for Underprivileged Children, or the Women Empowerment Fund.',
                        'order'     => 4,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'What is the minimum donation amount?',
                        'answer'    => 'There is no minimum donation amount. Even a small contribution helps — ₹100 can feed a cow for a day, ₹500 provides a month of notebooks for a child, and ₹1,000 supports a woman\'s skill training session.',
                        'order'     => 5,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name'  => 'Volunteering',
                'slug'  => 'volunteering',
                'order' => 3,
                'faqs'  => [
                    [
                        'question'  => 'What volunteering opportunities are available?',
                        'answer'    => 'We need volunteers for Gau Sewa (cow care and feeding), ration distribution drives, women skill training camps, free education centres, public awareness campaigns, social media outreach, and event management.',
                        'order'     => 1,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'Do I need prior experience to volunteer?',
                        'answer'    => 'No prior experience is needed. We provide full orientation and on-ground training. What matters most is your commitment, compassion, and willingness to make a difference.',
                        'order'     => 2,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'How do I register as a volunteer?',
                        'answer'    => 'Simply contact us at +91-8130789837 or fill out the form on our Contact Us page. Our volunteer coordinator will get in touch with you within 24 hours to guide you through the next steps.',
                        'order'     => 3,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'Can students volunteer with Ujjawal Unnati Foundation?',
                        'answer'    => 'Yes! We welcome student volunteers and offer internship certificates for those who participate in our programs. This is an excellent opportunity for community service, social work hours, and hands-on NGO experience.',
                        'order'     => 4,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name'  => 'Our Programs',
                'slug'  => 'our-programs',
                'order' => 4,
                'faqs'  => [
                    [
                        'question'  => 'How many cows do you care for?',
                        'answer'    => 'We have served over 22,500 cows since our founding through our Gau Sewa program. Our gaushala provides daily feeding, medical treatment, and shelter to abandoned, injured, and stray cows.',
                        'order'     => 1,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'What kind of skill training do you provide for women?',
                        'answer'    => 'We provide training in tailoring, beauty and wellness, food processing, handicrafts, and digital literacy. Over 1,15,000 women have been trained and empowered through our self-help groups and microfinance support.',
                        'order'     => 2,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'How many families receive ration kits every month?',
                        'answer'    => 'We distribute monthly ration kits to over 500 families, prioritising widows, daily-wage workers, elderly individuals, and families with disabled members. During festivals and emergencies, we scale up our distribution.',
                        'order'     => 3,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'How do your education programs work?',
                        'answer'    => 'We run free coaching centres for Classes 1–12 in Noida and 50+ surrounding villages. We also conduct annual school supply drives distributing notebooks, bags, and stationery to children who cannot afford them.',
                        'order'     => 4,
                        'is_active' => true,
                    ],
                    [
                        'question'  => 'How do you rescue children from child labour?',
                        'answer'    => 'Our team works with local communities and authorities to identify children engaged in labour. We facilitate their rescue, provide counselling and rehabilitation support, and enroll them back in school with follow-up monitoring to ensure they stay.',
                        'order'     => 5,
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
