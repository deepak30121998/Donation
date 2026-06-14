<?php

namespace App\Filament\Resources\GalleryItems\Schemas;

use App\Models\GalleryCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Gallery Item')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->maxLength(255),

                        Select::make('gallery_category_id')
                            ->label('Category')
                            ->options(
                                GalleryCategory::where('is_active', true)
                                    ->orderBy('order')
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->nullable()
                            ->placeholder('— Uncategorised —'),

                        TextInput::make('order')
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),

                Section::make('Image')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->label('Gallery Image')
                            ->collection('gallery')
                            ->image()
                            ->imagePreviewHeight('250')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
