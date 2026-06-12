<?php

namespace App\Filament\Resources\NavigationItems\Schemas;

use App\Models\NavigationItem;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NavigationItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('label')
                ->label('Menu Label')
                ->required()
                ->maxLength(100),

            TextInput::make('route_name')
                ->label('Route Name')
                ->placeholder('e.g. home, services.index, contact.index')
                ->helperText('Use a Laravel named route. Leave blank if using URL.'),

            TextInput::make('url')
                ->label('URL (fallback)')
                ->placeholder('e.g. /about or https://...')
                ->helperText('Used if Route Name is empty.'),

            Select::make('parent_id')
                ->label('Parent Menu Item')
                ->options(
                    NavigationItem::whereNull('parent_id')
                        ->where('is_active', true)
                        ->orderBy('order')
                        ->pluck('label', 'id')
                )
                ->placeholder('— Top-level item —')
                ->nullable(),

            Select::make('target')
                ->label('Open In')
                ->options([
                    '_self'  => 'Same Tab',
                    '_blank' => 'New Tab',
                ])
                ->default('_self')
                ->required(),

            TextInput::make('order')
                ->label('Sort Order')
                ->numeric()
                ->default(0),

            Toggle::make('is_active')
                ->label('Active')
                ->default(true),
        ]);
    }
}
