<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Program Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        TextInput::make('order')
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),

                Section::make('Content')
                    ->schema([
                        Textarea::make('short_description')
                            ->rows(3)
                            ->columnSpanFull(),

                        RichEditor::make('body')
                            ->columnSpanFull(),
                    ]),

                Section::make('Images')
                    ->columns(2)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('thumb')
                            ->label('Card Thumbnail')
                            ->collection('thumb')
                            ->image()
                            ->imagePreviewHeight('180')
                            ->helperText('Shown on program cards (listing page).'),

                        SpatieMediaLibraryFileUpload::make('banner')
                            ->label('Detail Page Banner')
                            ->collection('banner')
                            ->image()
                            ->imagePreviewHeight('180')
                            ->helperText('Shown on the program detail page.'),
                    ]),

                Section::make('SEO')
                    ->schema([
                        TextInput::make('meta_title')
                            ->maxLength(255),

                        Textarea::make('meta_description')
                            ->rows(2)
                            ->maxLength(500),
                    ]),
            ]);
    }
}
