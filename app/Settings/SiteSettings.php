<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SiteSettings extends Settings
{
    public string $site_name = 'Ujjawal Unnati Foundation';
    public string $site_tagline = 'Empowering Communities, Protecting Rights!';
    public ?string $logo_path = null;
    public ?string $page_header_bg = null;

    // Contact
    public string $address = 'Sector 12, Noida, Gautam Budh Nagar 201301, India';
    public string $phone = '+91-8130789837';
    public string $email = 'info@ujjawalunnati.com';
    public string $admin_email = 'deepak.kr@enterslice.com';
    public string $whatsapp_number = '+91-8130789837';

    // Social
    public string $facebook_url = 'https://www.facebook.com/ujjawalunnati';
    public string $youtube_url = 'https://www.youtube.com/channel/UC2CLzRsHH2pkU_UHz3fjlYA';
    public string $instagram_url = '';
    public string $twitter_url = '';
    public string $pinterest_url = '';

    // Hero
    public string $hero_headline = 'Every Life is Important — We Care for You';
    public string $hero_subheadline = 'Empowering communities, protecting rights, and transforming lives across India.';
    public string $hero_variant = 'image';
    public string $hero_video_url = 'https://www.youtube.com/watch?v=Y-x0efG1seA';

    // Footer
    public string $footer_about_text = 'Ujjawal Unnati Foundation works tirelessly for women empowerment, cow protection, child welfare, education, and hunger eradication across India.';
    public string $footer_copyright = 'All Rights Reserved.';

    // Maps
    public string $maps_embed_url = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.3842234073986!2d77.3909!3d28.5935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjjCsDM1JzM2LjYiTiA3N8KwMjMnMjcuMiJF!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin';

    // Donate button (global CTA)
    public string $donate_button_text = 'Donate Now';
    public string $donate_button_url = '/donation';

    // Bank Transfer Details
    public string $bank_name = 'HDFC Bank';
    public string $bank_account_no = '50100321876635';
    public string $bank_ifsc = 'HDFC0001897';
    public string $bank_account_name = 'Ujjawal Unnati Foundation';

    public static function group(): string
    {
        return 'site';
    }
}
