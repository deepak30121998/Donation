<?php

namespace Database\Seeders;

use App\Models\SiteCounter;
use Illuminate\Database\Seeder;

class SiteCounterSeeder extends Seeder
{
    public function run(): void
    {
        $counters = [
            ['key' => 'years_experience', 'label' => 'Years of Experience', 'value' => 25,    'suffix' => '+', 'prefix' => '',  'order' => 1],
            ['key' => 'volunteers',       'label' => 'Volunteers',          'value' => 230,   'suffix' => '+', 'prefix' => '',  'order' => 2],
            ['key' => 'offices',          'label' => 'Offices Worldwide',   'value' => 400,   'suffix' => '+', 'prefix' => '',  'order' => 3],
            ['key' => 'funded_amount',    'label' => 'Dollars Funded',      'value' => 75000, 'suffix' => 'k', 'prefix' => '$', 'order' => 4],
            ['key' => 'helped_count',     'label' => 'People Helped',       'value' => 75958, 'suffix' => '',  'prefix' => '',  'order' => 5],
        ];

        foreach ($counters as $counter) {
            SiteCounter::firstOrCreate(['key' => $counter['key']], $counter);
        }
    }
}
