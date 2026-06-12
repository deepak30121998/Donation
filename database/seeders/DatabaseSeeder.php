<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesPermissionsSeeder::class,
            AdminUserSeeder::class,
            SiteCounterSeeder::class,
            FaqCategorySeeder::class,
            PageSectionSeeder::class,
            NavigationItemSeeder::class,
            ServiceSeeder::class,
            ProgramSeeder::class,
            CauseSeeder::class,
            TeamMemberSeeder::class,
            TestimonialSeeder::class,
            GalleryItemSeeder::class,
            PostSeeder::class,
        ]);
    }
}
