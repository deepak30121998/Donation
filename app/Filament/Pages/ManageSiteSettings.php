<?php

namespace App\Filament\Pages;

use App\Settings\SiteSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class ManageSiteSettings extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected string $view = 'filament.pages.manage-site-settings';
    protected static ?string $navigationLabel = 'Site Settings';
    protected static ?string $title = 'Site Settings';
    protected static string|\UnitEnum|null $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 99;

    public ?array $data = [];

    public function mount(): void
    {
        $s = app(SiteSettings::class);

        $this->form->fill([
            'site_name'          => $s->site_name,
            'site_tagline'       => $s->site_tagline,
            'logo_path'          => $s->logo_path ? [$s->logo_path] : [],
            'page_header_bg'     => $s->page_header_bg ? [$s->page_header_bg] : [],
            'address'            => $s->address,
            'phone'              => $s->phone,
            'email'              => $s->email,
            'admin_email'        => $s->admin_email,
            'whatsapp_number'    => $s->whatsapp_number,
            'facebook_url'       => $s->facebook_url,
            'youtube_url'        => $s->youtube_url,
            'instagram_url'      => $s->instagram_url,
            'twitter_url'        => $s->twitter_url,
            'pinterest_url'      => $s->pinterest_url,
            'maps_embed_url'     => $s->maps_embed_url,
            'hero_headline'      => $s->hero_headline,
            'hero_subheadline'   => $s->hero_subheadline,
            'hero_video_url'     => $s->hero_video_url,
            'footer_about_text'  => $s->footer_about_text,
            'footer_copyright'   => $s->footer_copyright,
            'donate_button_text' => $s->donate_button_text,
            'donate_button_url'  => $s->donate_button_url,
            'bank_name'          => $s->bank_name,
            'bank_account_no'    => $s->bank_account_no,
            'bank_ifsc'          => $s->bank_ifsc,
            'bank_account_name'  => $s->bank_account_name,
        ]);
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->components([
                Tabs::make('Tabs')
                    ->tabs([

                        Tabs\Tab::make('General')
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                TextInput::make('site_name')
                                    ->label('Site Name')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('site_tagline')
                                    ->label('Tagline')
                                    ->maxLength(255),

                                FileUpload::make('logo_path')
                                    ->label('Logo')
                                    ->image()
                                    ->disk('public')
                                    ->directory('logos')
                                    ->visibility('public')
                                    ->imagePreviewHeight('80')
                                    ->helperText('PNG/SVG/JPG — recommended 200×60px')
                                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/svg+xml', 'image/webp']),

                                FileUpload::make('page_header_bg')
                                    ->label('Inner Pages Banner Background')
                                    ->image()
                                    ->disk('public')
                                    ->directory('banners')
                                    ->visibility('public')
                                    ->imagePreviewHeight('120')
                                    ->helperText('Shown on all inner-page banners. Recommended: 1920×600px'),
                            ]),

                        Tabs\Tab::make('Contact')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Textarea::make('address')
                                    ->label('Address')
                                    ->rows(3),

                                TextInput::make('phone')
                                    ->label('Phone Number')
                                    ->tel(),

                                TextInput::make('whatsapp_number')
                                    ->label('WhatsApp Number')
                                    ->tel()
                                    ->placeholder('+91-XXXXXXXXXX'),

                                TextInput::make('email')
                                    ->label('Public Email')
                                    ->email(),

                                TextInput::make('admin_email')
                                    ->label('Admin Notification Email')
                                    ->email()
                                    ->helperText('Contact form submissions will be sent here'),

                                Textarea::make('maps_embed_url')
                                    ->label('Google Maps Embed URL')
                                    ->rows(3)
                                    ->helperText('Paste the full src URL from Google Maps → Share → Embed a map'),
                            ]),

                        Tabs\Tab::make('Social Links')
                            ->icon('heroicon-o-share')
                            ->schema([
                                TextInput::make('facebook_url')
                                    ->label('Facebook URL')
                                    ->placeholder('https://facebook.com/yourpage')
                                    ->nullable(),

                                TextInput::make('youtube_url')
                                    ->label('YouTube Channel URL')
                                    ->placeholder('https://youtube.com/channel/...')
                                    ->nullable(),

                                TextInput::make('instagram_url')
                                    ->label('Instagram URL')
                                    ->placeholder('https://instagram.com/yourhandle')
                                    ->nullable(),

                                TextInput::make('twitter_url')
                                    ->label('Twitter / X URL')
                                    ->placeholder('https://twitter.com/yourhandle')
                                    ->nullable(),

                                TextInput::make('pinterest_url')
                                    ->label('Pinterest URL')
                                    ->placeholder('https://pinterest.com/yourprofile')
                                    ->nullable(),
                            ]),

                        Tabs\Tab::make('Hero Section')
                            ->icon('heroicon-o-home')
                            ->schema([
                                TextInput::make('hero_headline')
                                    ->label('Hero Headline')
                                    ->maxLength(255),

                                Textarea::make('hero_subheadline')
                                    ->label('Hero Sub-headline')
                                    ->rows(2),

                                TextInput::make('hero_video_url')
                                    ->label('Hero Video URL')
                                    ->placeholder('https://www.youtube.com/watch?v=...')
                                    ->helperText('YouTube URL for the play-video button on homepage'),
                            ]),

                        Tabs\Tab::make('Footer & Donate')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Textarea::make('footer_about_text')
                                    ->label('Footer About Text')
                                    ->rows(3)
                                    ->helperText('Short description shown in footer below the logo'),

                                TextInput::make('footer_copyright')
                                    ->label('Copyright Text')
                                    ->helperText('Shown after "Copyright © Year SiteName." — e.g. All Rights Reserved.'),

                                TextInput::make('donate_button_text')
                                    ->label('Donate Button Text')
                                    ->maxLength(50),

                                TextInput::make('donate_button_url')
                                    ->label('Donate Button URL')
                                    ->placeholder('/donation'),
                            ]),

                        Tabs\Tab::make('Bank Transfer')
                            ->icon('heroicon-o-banknotes')
                            ->schema([
                                TextInput::make('bank_name')
                                    ->label('Bank Name')
                                    ->placeholder('HDFC Bank')
                                    ->maxLength(100),

                                TextInput::make('bank_account_name')
                                    ->label('Account Holder Name')
                                    ->placeholder('Ujjawal Unnati Foundation')
                                    ->maxLength(255),

                                TextInput::make('bank_account_no')
                                    ->label('Account Number')
                                    ->placeholder('50100321876635')
                                    ->maxLength(50),

                                TextInput::make('bank_ifsc')
                                    ->label('IFSC Code')
                                    ->placeholder('HDFC0001897')
                                    ->maxLength(20),
                            ]),

                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $s    = app(SiteSettings::class);

        $s->site_name          = $data['site_name']          ?? '';
        $s->site_tagline       = $data['site_tagline']       ?? '';
        $s->address            = $data['address']            ?? '';
        $s->phone              = $data['phone']              ?? '';
        $s->whatsapp_number    = $data['whatsapp_number']    ?? '';
        $s->email              = $data['email']              ?? '';
        $s->admin_email        = $data['admin_email']        ?? '';
        $s->facebook_url       = $data['facebook_url']       ?? '';
        $s->youtube_url        = $data['youtube_url']        ?? '';
        $s->instagram_url      = $data['instagram_url']      ?? '';
        $s->twitter_url        = $data['twitter_url']        ?? '';
        $s->pinterest_url      = $data['pinterest_url']      ?? '';
        $s->maps_embed_url     = $data['maps_embed_url']     ?? '';
        $s->hero_headline      = $data['hero_headline']      ?? '';
        $s->hero_subheadline   = $data['hero_subheadline']   ?? '';
        $s->hero_video_url     = $data['hero_video_url']     ?? '';
        $s->footer_about_text  = $data['footer_about_text']  ?? '';
        $s->footer_copyright   = $data['footer_copyright']   ?? '';
        $s->donate_button_text = $data['donate_button_text'] ?? '';
        $s->donate_button_url  = $data['donate_button_url']  ?? '';
        $s->bank_name         = $data['bank_name']         ?? '';
        $s->bank_account_no   = $data['bank_account_no']   ?? '';
        $s->bank_ifsc         = $data['bank_ifsc']         ?? '';
        $s->bank_account_name = $data['bank_account_name'] ?? '';

        if (!empty($data['logo_path'])) {
            $s->logo_path = is_array($data['logo_path']) ? reset($data['logo_path']) : $data['logo_path'];
        }

        if (!empty($data['page_header_bg'])) {
            $s->page_header_bg = is_array($data['page_header_bg']) ? reset($data['page_header_bg']) : $data['page_header_bg'];
        }

        $s->save();

        Notification::make()->title('Settings saved!')->success()->send();
    }
}
