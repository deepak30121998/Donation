<?php

namespace Database\Seeders;

use App\Models\SiteCounter;
use Illuminate\Database\Seeder;

class SiteCounterSeeder extends Seeder
{
    public function run(): void
    {
        $counters = [
            ['key' => 'supporters',          'label' => 'Supporters',          'value' => 2500,   'suffix' => '+', 'prefix' => '',  'order' => 1],
            ['key' => 'cows_served',         'label' => 'Mother Cows Served',  'value' => 22500,  'suffix' => '+', 'prefix' => '',  'order' => 2],
            ['key' => 'women_entrepreneurs', 'label' => 'Women Entrepreneurs', 'value' => 115000, 'suffix' => '+', 'prefix' => '',  'order' => 3],
            ['key' => 'lives_transformed',   'label' => 'Lives Transformed',   'value' => 12000,  'suffix' => '+', 'prefix' => '',  'order' => 4],
            // backward-compat keys used in home view
            ['key' => 'funded_amount',       'label' => 'Amount Raised',       'value' => 75,     'suffix' => 'k', 'prefix' => '₹', 'order' => 5],
            ['key' => 'helped_count',        'label' => 'People Helped',       'value' => 12000,  'suffix' => '+', 'prefix' => '',  'order' => 6],
        ];

        foreach ($counters as $counter) {
            SiteCounter::updateOrCreate(['key' => $counter['key']], $counter);
        }
    }
}
