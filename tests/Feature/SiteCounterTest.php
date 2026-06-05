<?php

use App\Models\SiteCounter;

/**
 * Ensure counters are seeded before running these tests.
 * We call the seeder in beforeEach since DatabaseTransactions rolls back inserts.
 */
beforeEach(function () {
    // Only seed if not already present (idempotent seeder uses firstOrCreate)
    $this->artisan('db:seed', ['--class' => 'Database\\Seeders\\SiteCounterSeeder']);
});

it('site_counters table has 5 seeded records', function () {
    $count = SiteCounter::whereIn('key', [
        'years_experience',
        'volunteers',
        'offices',
        'funded_amount',
        'helped_count',
    ])->count();

    expect($count)->toBe(5);
});

it('all expected counter keys exist', function () {
    $expectedKeys = ['years_experience', 'volunteers', 'offices', 'funded_amount', 'helped_count'];

    foreach ($expectedKeys as $key) {
        $exists = SiteCounter::where('key', $key)->exists();
        expect($exists)->toBeTrue("Counter key '{$key}' should exist in site_counters.");
    }
});

it('counter values are positive integers', function () {
    $counters = SiteCounter::whereIn('key', [
        'years_experience',
        'volunteers',
        'offices',
        'funded_amount',
        'helped_count',
    ])->get();

    foreach ($counters as $counter) {
        expect($counter->value)->toBeGreaterThan(0);
    }
});
