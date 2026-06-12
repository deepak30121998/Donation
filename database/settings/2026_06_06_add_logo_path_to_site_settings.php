<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if (! $this->migrator->exists('site.logo_path')) {
            $this->migrator->add('site.logo_path', null);
        }
    }
};
