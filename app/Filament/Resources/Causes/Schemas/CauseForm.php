<?php

namespace App\Filament\Resources\Causes\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CauseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Cause Details')
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

                        TextInput::make('goal_amount')
                            ->label('Goal Amount ($)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->default(0.00),

                        TextInput::make('raised_amount')
                            ->label('Raised Amount ($)')
                            ->numeric()
                            ->minValue(0)
                            ->default(0.00),

                        TextInput::make('order')
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),

                Section::make('Description')
                    ->schema([
                        Textarea::make('short_description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Image')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('thumb')
                            ->label('Cause Image')
                            ->collection('thumb')
                            ->image()
                            ->imagePreviewHeight('200')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
