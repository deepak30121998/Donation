<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if (! $this->migrator->exists('site.favicon_path')) {
            $this->migrator->add('site.favicon_path', null);
        }
    }
};
