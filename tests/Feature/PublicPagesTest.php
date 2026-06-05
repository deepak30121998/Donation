<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

it('returns 200 on home page', function () {
    $this->get('/')->assertOk();
});

it('returns 200 on about page', function () {
    $this->get('/about')->assertOk();
});

it('returns 200 on services index', function () {
    $this->get('/services')->assertOk();
});

it('returns 200 on programs index', function () {
    $this->get('/programs')->assertOk();
});

it('returns 200 on blog index', function () {
    $this->get('/blog')->assertOk();
});

it('returns 200 on team page', function () {
    $this->get('/team')->assertOk();
});

it('returns 200 on gallery page', function () {
    $this->get('/gallery')->assertOk();
});

it('returns 200 on testimonials page', function () {
    $this->get('/testimonials')->assertOk();
});

it('returns 200 on donation page', function () {
    $this->get('/donation')->assertOk();
});

it('returns 200 on contact page', function () {
    $this->get('/contact')->assertOk();
});

it('returns 200 on faqs page', function () {
    $this->get('/faqs')->assertOk();
});

it('returns 404 for unknown route', function () {
    $this->get('/this-route-does-not-exist-at-all')->assertNotFound();
});

it('returns 404 for non-existent service slug', function () {
    $this->get('/services/non-existent-service-xyz')->assertNotFound();
});

it('returns 404 for non-existent program slug', function () {
    $this->get('/programs/non-existent-program-xyz')->assertNotFound();
});

it('returns 404 for non-existent blog slug', function () {
    $this->get('/blog/non-existent-blog-post-xyz')->assertNotFound();
});

it('redirects /admin to login when unauthenticated', function () {
    $response = $this->get('/admin');
    // Filament redirects unauthenticated users to the login page
    $response->assertRedirect();
    expect($response->headers->get('location'))->toContain('login');
});
