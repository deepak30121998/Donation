<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if (! $this->migrator->exists('site.page_header_bg')) {
            $this->migrator->addNullable('site.page_header_bg', null);
        }
    }
};
