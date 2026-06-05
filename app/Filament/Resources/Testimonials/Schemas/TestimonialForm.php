<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Author')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Author Photo')
                            ->image()
                            ->disk('public')
                            ->directory('testimonials')
                            ->imagePreviewHeight('150')
                            ->columnSpanFull(),

                        TextInput::make('author_name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('author_position')
                            ->maxLength(255),

                        Textarea::make('quote')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        Select::make('rating')
                            ->options([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'])
                            ->default(5)
                            ->required(),

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
