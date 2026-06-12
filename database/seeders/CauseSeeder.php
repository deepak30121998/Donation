<?php

namespace Database\Seeders;

use App\Models\Cause;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CauseSeeder extends Seeder
{
    public function run(): void
    {
        $causes = [
            [
                'title'             => 'Gau Sewa — Feed a Cow',
                'short_description' => 'Help us feed and care for abandoned cows at our gaushala. Your donation provides fodder, medicine, and shelter.',
                'goal_amount'       => 1000000.00,
                'raised_amount'     => 364950.00,
                'order'             => 1,
                'is_active'         => true,
            ],
            [
                'title'             => 'Education for Underprivileged Children',
                'short_description' => 'Fund free coaching centres, notebooks, and school supplies for children who cannot afford education.',
                'goal_amount'       => 500000.00,
                'raised_amount'     => 125000.00,
                'order'             => 2,
                'is_active'         => true,
            ],
            [
                'title'             => 'Women Empowerment Fund',
                'short_description' => 'Support skill training, microfinance, and SHG formation for underprivileged women entrepreneurs.',
                'goal_amount'       => 800000.00,
                'raised_amount'     => 259780.00,
                'order'             => 3,
                'is_active'         => true,
            ],
            [
                'title'             => 'Hunger-Free India Drive',
                'short_description' => 'Contribute to our monthly ration kits and cooked meal camps for homeless and destitute families.',
                'goal_amount'       => 600000.00,
                'raised_amount'     => 180000.00,
                'order'             => 4,
                'is_active'         => true,
            ],
        ];

        foreach ($causes as $data) {
            Cause::firstOrCreate(
                ['slug' => Str::slug($data['title'])],
                $data
            );
        }
    }
}
