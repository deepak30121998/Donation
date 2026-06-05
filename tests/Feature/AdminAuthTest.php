<?php

use App\Models\User;

it('redirects unauthenticated users from admin to login', function () {
    $response = $this->get('/admin');

    $response->assertRedirect();
    expect($response->headers->get('location'))->toContain('login');
});

it('shows admin login page', function () {
    $loginUrl = '/admin/login';

    $this->get($loginUrl)->assertOk();
});

it('allows super_admin role to access admin panel', function () {
    // Find or create a super_admin user
    $user = User::role('super_admin')->first();

    if (! $user) {
        $this->artisan('db:seed', ['--class' => 'Database\\Seeders\\RolesPermissionsSeeder']);
        $this->artisan('db:seed', ['--class' => 'Database\\Seeders\\AdminUserSeeder']);
        $user = User::role('super_admin')->first();
    }

    $this->actingAs($user)
        ->get('/admin')
        ->assertOk();
});

it('denies access to user without any role', function () {
    $user = User::factory()->create();

    // User without any role cannot access panel (canAccessPanel returns false)
    $response = $this->actingAs($user)->get('/admin');

    // Filament will redirect to login or show 403 if the user has no role
    expect(
        $response->status() === 302 || $response->status() === 403
    )->toBeTrue();
});

it('allows editor role to access admin panel', function () {
    // Ensure roles exist
    if (! \Spatie\Permission\Models\Role::where('name', 'editor')->exists()) {
        $this->artisan('db:seed', ['--class' => 'Database\\Seeders\\RolesPermissionsSeeder']);
    }

    $user = User::factory()->create();
    $user->assignRole('editor');

    $this->actingAs($user)
        ->get('/admin')
        ->assertOk();
});
