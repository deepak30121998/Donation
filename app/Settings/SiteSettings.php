<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SiteSettings extends Settings
{
    public string $site_name = 'Ujjawal Unnati Foundation';
    public string $site_tagline = 'Empower change, one act of kindness at a time';
    public ?string $logo_path = null;
    public string $address = '12345 Unity Avenue Suite 100 Springfield, USA 54321';
    public string $phone = '+123 456 789';
    public string $email = 'info@lenity.org';
    public string $twitter_url = '#';
    public string $facebook_url = '#';
    public string $instagram_url = '#';
    public string $pinterest_url = '#';
    public string $maps_embed_url = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.30591910525!2d-74.25987368715491!3d40.697149422113014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1609459200000!5m2!1sen!2sin';
    public string $hero_headline = 'Empower change, one act of kindness at a time';
    public string $hero_subheadline = 'Together, we can build a better world through compassion and action.';
    public string $hero_variant = 'image';
    public string $admin_email = 'admin@lenity.org';

    public static function group(): string
    {
        return 'site';
    }
}
