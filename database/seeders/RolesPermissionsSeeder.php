<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // Posts
            'view posts', 'create posts', 'edit posts', 'delete posts', 'publish posts',
            // Pages / Sections
            'view page-sections', 'edit page-sections',
            // Causes
            'view causes', 'create causes', 'edit causes', 'delete causes',
            // Donations
            'view donations', 'create donations', 'edit donations', 'delete donations',
            // Programs
            'view programs', 'create programs', 'edit programs', 'delete programs',
            // Services
            'view services', 'create services', 'edit services', 'delete services',
            // Team
            'view team-members', 'create team-members', 'edit team-members', 'delete team-members',
            // Testimonials
            'view testimonials', 'create testimonials', 'edit testimonials', 'delete testimonials',
            // Gallery
            'view gallery', 'create gallery', 'edit gallery', 'delete gallery',
            // FAQs
            'view faqs', 'create faqs', 'edit faqs', 'delete faqs',
            // Newsletters
            'view newsletter-subscribers', 'delete newsletter-subscribers',
            // Contact
            'view contact-submissions', 'delete contact-submissions',
            // Site Counters
            'view site-counters', 'edit site-counters',
            // Settings
            'view settings', 'edit settings',
            // Users
            'view users', 'create users', 'edit users', 'delete users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Super Admin role — gets all permissions via Gate::before
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());

        // Editor role
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $editor->syncPermissions([
            'view posts', 'create posts', 'edit posts', 'delete posts', 'publish posts',
            'view causes', 'create causes', 'edit causes',
            'view programs', 'create programs', 'edit programs',
            'view services', 'create services', 'edit services',
            'view team-members', 'create team-members', 'edit team-members',
            'view testimonials', 'create testimonials', 'edit testimonials',
            'view gallery', 'create gallery', 'edit gallery',
            'view faqs', 'create faqs', 'edit faqs',
            'view page-sections', 'edit page-sections',
        ]);

        // Admin role — full content management plus user & donation access
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::where('name', 'not like', 'edit settings')
            ->where('name', 'not like', 'view settings')
            ->get());

        // Author role — own posts only (enforced in policy/resource)
        $author = Role::firstOrCreate(['name' => 'author', 'guard_name' => 'web']);
        $author->syncPermissions([
            'view posts', 'create posts', 'edit posts',
        ]);

        // Viewer role — kept for backward compat, read-only access
        $viewer = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);
        $viewer->syncPermissions([
            'view posts', 'view causes', 'view programs', 'view services',
            'view team-members', 'view testimonials', 'view gallery', 'view faqs',
            'view donations', 'view contact-submissions', 'view newsletter-subscribers',
        ]);
    }
}
