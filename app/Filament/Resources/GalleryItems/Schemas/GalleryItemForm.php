<?php

namespace App\Filament\Resources\GalleryItems\Schemas;

use App\Enums\GalleryCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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

                        Select::make('category')
                            ->options(collect(GalleryCategory::cases())->mapWithKeys(
                                fn (GalleryCategory $c) => [$c->value => $c->label()]
                            ))
                            ->default(GalleryCategory::All->value)
                            ->required(),

                        TextInput::make('order')
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),

                Section::make('Image')
                    ->schema([
                        FileUpload::make('gallery_image')
                            ->label('Gallery Image')
                            ->image()
                            ->disk('public')
                            ->directory('gallery')
                            ->imagePreviewHeight('250')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
