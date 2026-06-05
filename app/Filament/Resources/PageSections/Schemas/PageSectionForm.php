<?php

namespace App\Filament\Resources\PageSections\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

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

                        Textarea::make('body')
                            ->rows(4)
                            ->columnSpanFull(),
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
