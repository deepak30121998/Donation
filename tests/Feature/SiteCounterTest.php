<?php

use App\Models\SiteCounter;

beforeEach(function () {
    $this->artisan('db:seed', ['--class' => 'Database\\Seeders\\SiteCounterSeeder']);
});

it('site_counters table has 4 UUF seeded records', function () {
    $count = SiteCounter::whereIn('key', [
        'supporters',
        'cows_served',
        'women_entrepreneurs',
        'lives_transformed',
    ])->count();

    expect($count)->toBe(4);
});

it('all expected UUF counter keys exist', function () {
    $expectedKeys = ['supporters', 'cows_served', 'women_entrepreneurs', 'lives_transformed'];

    foreach ($expectedKeys as $key) {
        $exists = SiteCounter::where('key', $key)->exists();
        expect($exists)->toBeTrue("Counter key '{$key}' should exist in site_counters.");
    }
});

it('counter values are positive integers', function () {
    $counters = SiteCounter::whereIn('key', [
        'supporters',
        'cows_served',
        'women_entrepreneurs',
        'lives_transformed',
    ])->get();

    foreach ($counters as $counter) {
        expect($counter->value)->toBeGreaterThan(0);
    }
});

it('old Lenity counters do not exist', function () {
    $oldKeys = ['years_experience', 'volunteers', 'offices', 'funded_amount', 'helped_count'];

    foreach ($oldKeys as $key) {
        $exists = SiteCounter::where('key', $key)->exists();
        expect($exists)->toBeFalse("Old Lenity counter '{$key}' should not exist.");
    }
});
