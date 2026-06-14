<?php

namespace App\Filament\Resources\GalleryCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Category Details')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(100)
                        ->live(onBlur: true)
                        ->columnSpan(2),

                    TextInput::make('slug')
                        ->required()
                        ->maxLength(100)
                        ->helperText('Used as CSS class for gallery filtering. Auto-generated from name.')
                        ->columnSpan(2),

                    TextInput::make('order')
                        ->numeric()
                        ->default(0),

                    Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),
                ]),
        ]);
    }
}
