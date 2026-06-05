<?php

namespace App\Filament\Resources\PageSections\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\IconSize;
use Spatie\MediaLibrary\Support\MediaStream;

class PageSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Section Identity')
                    ->columns(2)
                    ->schema([
                        TextInput::make('page')
                            ->required()
                            ->maxLength(100)
                            ->helperText('e.g. home, about, services, programs, blog, team, gallery, testimonials, donation, contact, faqs'),

                        TextInput::make('section_key')
                            ->required()
                            ->maxLength(100)
                            ->helperText('e.g. hero, about, services, causes, programs, donate_cta, testimonials, gallery, blog'),
                    ]),

                Section::make('Content')
                    ->schema([
                        TextInput::make('title')
                            ->maxLength(255),

                        TextInput::make('subtitle')
                            ->maxLength(255),

                        RichEditor::make('body')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline',
                                'bulletList', 'orderedList',
                                'link', 'blockquote',
                                'h2', 'h3',
                                'undo', 'redo',
                            ])
                            ->columnSpanFull(),
                    ]),

                Section::make('Images')
                    ->description('Upload background/banner image and a secondary image for this section.')
                    ->columns(2)
                    ->schema([
                        \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                            ->label('Main Image / Banner')
                            ->collection('image')
                            ->image()
                            ->imagePreviewHeight('150')
                            ->helperText('Hero background, section banner, or primary image.')
                            ->columnSpanFull(),

                        \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('image_2')
                            ->label('Secondary Image')
                            ->collection('image_2')
                            ->image()
                            ->imagePreviewHeight('150')
                            ->helperText('Second image shown alongside the main image (e.g. about section).'),
                    ]),

                Section::make('Call to Action')
                    ->columns(2)
                    ->schema([
                        TextInput::make('button_text')
                            ->maxLength(100),

                        TextInput::make('button_url')
                            ->url()
                            ->maxLength(500),
                    ]),

                Section::make('Visibility')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }
}
