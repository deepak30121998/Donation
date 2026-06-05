<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site.site_name', 'Ujjawal Unnati Foundation');
        $this->migrator->add('site.site_tagline', 'Empower change, one act of kindness at a time');
        $this->migrator->add('site.address', '12345 Unity Avenue Suite 100, Springfield, USA 54321');
        $this->migrator->add('site.phone', '+123 456 789');
        $this->migrator->add('site.email', 'info@lenity.org');
        $this->migrator->add('site.twitter_url', '#');
        $this->migrator->add('site.facebook_url', '#');
        $this->migrator->add('site.instagram_url', '#');
        $this->migrator->add('site.pinterest_url', '#');
        $this->migrator->add('site.maps_embed_url', '');
        $this->migrator->add('site.hero_headline', 'Empower change, one act of kindness at a time');
        $this->migrator->add('site.hero_subheadline', 'Together, we can build a better world.');
        $this->migrator->add('site.hero_variant', 'image');
        $this->migrator->add('site.admin_email', 'admin@lenity.org');
    }
};
