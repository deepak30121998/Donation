<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
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

                Section::make('Image')
                    ->schema([
                        FileUpload::make('program_image')
                            ->label('Program Image')
                            ->image()
                            ->disk('public')
                            ->directory('programs')
                            ->imagePreviewHeight('200')
                            ->columnSpanFull(),
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
