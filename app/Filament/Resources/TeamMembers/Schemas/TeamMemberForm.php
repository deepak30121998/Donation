<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Photo')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Profile Photo')
                            ->image()
                            ->disk('public')
                            ->directory('team')
                            ->imagePreviewHeight('200')
                            ->columnSpanFull(),
                    ]),

                Section::make('Member Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('position')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('order')
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),

                        Textarea::make('bio')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Section::make('Social Links')
                    ->columns(3)
                    ->schema([
                        TextInput::make('twitter_url')
                            ->label('Twitter URL')
                            ->url()
                            ->maxLength(500),

                        TextInput::make('facebook_url')
                            ->label('Facebook URL')
                            ->url()
                            ->maxLength(500),

                        TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->url()
                            ->maxLength(500),
                    ]),
            ]);
    }
}
