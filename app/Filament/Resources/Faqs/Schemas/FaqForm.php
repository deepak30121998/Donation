<?php

namespace App\Filament\Resources\Faqs\Schemas;

use App\Models\FaqCategory;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('FAQ Details')
                    ->columns(2)
                    ->schema([
                        Select::make('faq_category_id')
                            ->label('Category')
                            ->options(FaqCategory::pluck('name', 'id'))
                            ->searchable(),

                        TextInput::make('question')
                            ->required()
                            ->maxLength(500),

                        TextInput::make('order')
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),

                        RichEditor::make('answer')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
