<?php

namespace App\Filament\Pages;

use App\Settings\SiteSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected string $view = 'filament.pages.manage-site-settings';
    protected static ?string $navigationLabel = 'Site Settings';
    protected static ?string $title = 'Site Settings';
    protected static string|\UnitEnum|null $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 99;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = app(SiteSettings::class);

        $this->form->fill([
            'site_name'       => $settings->site_name,
            'site_tagline'    => $settings->site_tagline,
            'logo_path'       => $settings->logo_path ? [$settings->logo_path] : [],
            'address'         => $settings->address,
            'phone'           => $settings->phone,
            'email'           => $settings->email,
            'admin_email'     => $settings->admin_email,
            'twitter_url'     => $settings->twitter_url,
            'facebook_url'    => $settings->facebook_url,
            'instagram_url'   => $settings->instagram_url,
            'pinterest_url'   => $settings->pinterest_url,
            'maps_embed_url'  => $settings->maps_embed_url,
            'hero_headline'   => $settings->hero_headline,
            'hero_subheadline'=> $settings->hero_subheadline,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
                                    ->helperText('Upload PNG, SVG, or JPG. Recommended size: 200×60px')
                                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/svg+xml', 'image/webp']),
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
                                    ->helperText('Paste the full iframe src URL from Google Maps → Share → Embed'),
                            ]),

                        Tabs\Tab::make('Social Links')
                            ->icon('heroicon-o-share')
                            ->schema([
                                TextInput::make('facebook_url')
                                    ->label('Facebook URL')
                                    ->url()
                                    ->prefix('https://'),

                                TextInput::make('twitter_url')
                                    ->label('Twitter / X URL')
                                    ->url()
                                    ->prefix('https://'),

                                TextInput::make('instagram_url')
                                    ->label('Instagram URL')
                                    ->url()
                                    ->prefix('https://'),

                                TextInput::make('pinterest_url')
                                    ->label('Pinterest URL')
                                    ->url()
                                    ->prefix('https://'),
                            ]),

                        Tabs\Tab::make('Homepage Hero')
                            ->icon('heroicon-o-home')
                            ->schema([
                                TextInput::make('hero_headline')
                                    ->label('Hero Headline')
                                    ->maxLength(255),

                                Textarea::make('hero_subheadline')
                                    ->label('Hero Sub-headline')
                                    ->rows(2),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $settings = app(SiteSettings::class);

        $settings->site_name       = $data['site_name'];
        $settings->site_tagline    = $data['site_tagline'];
        $settings->address         = $data['address'];
        $settings->phone           = $data['phone'];
        $settings->email           = $data['email'];
        $settings->admin_email     = $data['admin_email'];
        $settings->twitter_url     = $data['twitter_url'];
        $settings->facebook_url    = $data['facebook_url'];
        $settings->instagram_url   = $data['instagram_url'];
        $settings->pinterest_url   = $data['pinterest_url'];
        $settings->maps_embed_url  = $data['maps_embed_url'];
        $settings->hero_headline   = $data['hero_headline'];
        $settings->hero_subheadline= $data['hero_subheadline'];

        // Handle logo upload — FileUpload returns array of paths
        if (!empty($data['logo_path'])) {
            $settings->logo_path = is_array($data['logo_path'])
                ? reset($data['logo_path'])
                : $data['logo_path'];
        }

        $settings->save();

        Notification::make()
            ->title('Settings saved successfully!')
            ->success()
            ->send();
    }
}
