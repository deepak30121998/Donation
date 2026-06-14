<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $fields = [
            'site.bank_name'         => 'HDFC Bank',
            'site.bank_account_no'   => '50100321876635',
            'site.bank_ifsc'         => 'HDFC0001897',
            'site.bank_account_name' => 'Ujjawal Unnati Foundation',
        ];

        foreach ($fields as $key => $value) {
            if (! $this->migrator->exists($key)) {
                $this->migrator->add($key, $value);
            }
        }
    }
};
