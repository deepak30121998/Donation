<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Update existing fields with real UUF values
        $updates = [
            'site.site_name'        => 'Ujjawal Unnati Foundation',
            'site.site_tagline'     => 'Empowering Communities, Protecting Rights!',
            'site.address'          => 'Sector 12, Noida, Gautam Budh Nagar 201301, India',
            'site.phone'            => '+91-8130789837',
            'site.email'            => 'info@ujjawalunnati.com',
            'site.admin_email'      => 'deepak.kr@enterslice.com',
            'site.facebook_url'     => 'https://www.facebook.com/ujjawalunnati',
            'site.hero_headline'    => 'Every Life is Important — We Care for You',
            'site.hero_subheadline' => 'Empowering communities, protecting rights, and transforming lives across India.',
            'site.hero_variant'     => 'image',
        ];

        foreach ($updates as $key => $value) {
            if ($this->migrator->exists($key)) {
                $this->migrator->update($key, fn () => $value);
            } else {
                $this->migrator->add($key, $value);
            }
        }

        // Add new fields that didn't exist before
        $newFields = [
            'site.whatsapp_number'   => '+91-8130789837',
            'site.youtube_url'       => 'https://www.youtube.com/channel/UC2CLzRsHH2pkU_UHz3fjlYA',
            'site.hero_video_url'    => 'https://www.youtube.com/watch?v=Y-x0efG1seA',
            'site.footer_about_text' => 'Ujjawal Unnati Foundation works tirelessly for women empowerment, cow protection, child welfare, education, and hunger eradication across India.',
            'site.footer_copyright'  => 'All Rights Reserved.',
            'site.donate_button_text'=> 'Donate Now',
            'site.donate_button_url' => '/donation',
            'site.maps_embed_url'    => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.3842234073986!2d77.3909!3d28.5935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjjCsDM1JzM2LjYiTiA3N8KwMjMnMjcuMiJF!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin',
        ];

        foreach ($newFields as $key => $value) {
            if (! $this->migrator->exists($key)) {
                $this->migrator->add($key, $value);
            }
        }
    }
};
