<?php

use App\Models\Service;

it('shows all active services on index', function () {
    $activeService = Service::create([
        'title'     => 'Active Service Test',
        'body'      => 'Body content here',
        'is_active' => true,
        'order'     => 99,
    ]);

    $this->get('/services')
        ->assertOk()
        ->assertSee('Active Service Test');
});

it('does not show inactive services', function () {
    $inactiveService = Service::create([
        'title'     => 'Inactive Service XYZ',
        'body'      => 'This should not appear',
        'is_active' => false,
        'order'     => 99,
    ]);

    $this->get('/services')
        ->assertOk()
        ->assertDontSee('Inactive Service XYZ');
});

it('shows service detail page by slug', function () {
    $service = Service::create([
        'title'     => 'Detail Service Test',
        'body'      => 'Detailed body content',
        'is_active' => true,
        'order'     => 1,
    ]);

    $service->refresh();

    $this->get("/services/{$service->slug}")
        ->assertOk()
        ->assertSee('Detail Service Test');
});

it('returns 404 for non-existent service slug', function () {
    $this->get('/services/this-slug-does-not-exist-abc123')
        ->assertNotFound();
});

it('returns 404 for soft-deleted service', function () {
    $service = Service::create([
        'title'     => 'Soon Deleted Service',
        'body'      => 'Will be soft deleted',
        'is_active' => true,
        'order'     => 1,
    ]);

    $service->refresh();
    $slug = $service->slug;

    $service->delete(); // soft delete

    // The service controller uses findBySlug which does not include soft-deleted records
    // by default (since SoftDeletes scope is applied to Eloquent queries).
    // If the service is deleted, it returns null and aborts with 404.
    $this->get("/services/{$slug}")
        ->assertNotFound();
});

it('service cards link to correct slug routes', function () {
    $service = Service::create([
        'title'     => 'Link Test Service',
        'body'      => 'Content for link test',
        'is_active' => true,
        'order'     => 1,
    ]);

    $service->refresh();

    $this->get('/services')
        ->assertOk()
        ->assertSee(route('services.show', $service->slug), false);
});
