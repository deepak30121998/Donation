<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name'         => 'Dipa Devi',
                'position'     => 'President',
                'bio'          => 'Founder and driving force of Ujjawal Unnati Foundation. Dipa Devi has dedicated over 10 years to fighting for women\'s rights and cow protection across Uttar Pradesh. Her grassroots leadership has inspired thousands of volunteers and transformed countless lives.',
                'facebook_url' => '',
                'instagram_url'=> '',
                'twitter_url'  => '',
                'order'        => 1,
                'is_active'    => true,
            ],
            [
                'name'         => 'Deepak Kumar',
                'position'     => 'Secretary',
                'bio'          => 'Manages operations, finances, and digital outreach for the foundation. Deepak is passionate about education and community development, and leads the foundation\'s technology and communications initiatives.',
                'facebook_url' => '',
                'instagram_url'=> '',
                'twitter_url'  => '',
                'order'        => 2,
                'is_active'    => true,
            ],
            [
                'name'         => 'Himanshu',
                'position'     => 'Volunteer Coordinator',
                'bio'          => 'Leads a vibrant network of 500+ volunteers across Noida and Uttar Pradesh. Himanshu is responsible for volunteer training, event coordination, and building new community partnerships.',
                'facebook_url' => '',
                'instagram_url'=> '',
                'twitter_url'  => '',
                'order'        => 3,
                'is_active'    => true,
            ],
            [
                'name'         => 'Ravi Mishra',
                'position'     => 'Community Outreach Coordinator',
                'bio'          => 'Builds deep grassroots connections with villages and urban slums across the region. Ravi identifies families in need, facilitates program enrollment, and ensures our work reaches those who need it most.',
                'facebook_url' => '',
                'instagram_url'=> '',
                'twitter_url'  => '',
                'order'        => 4,
                'is_active'    => true,
            ],
            [
                'name'         => 'Amit Kumar',
                'position'     => 'Volunteer Coordinator',
                'bio'          => 'Manages on-ground events, distribution drives, and cow shelter operations. Amit ensures every program runs smoothly, every volunteer is supported, and every beneficiary is served with dignity.',
                'facebook_url' => '',
                'instagram_url'=> '',
                'twitter_url'  => '',
                'order'        => 5,
                'is_active'    => true,
            ],
        ];

        foreach ($members as $data) {
            TeamMember::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
