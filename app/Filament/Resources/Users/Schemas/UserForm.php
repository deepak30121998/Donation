<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Account Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->required(fn (string $operation) => $operation === 'create')
                            ->minLength(8)
                            ->dehydrated(fn ($state) => filled($state))
                            ->helperText(fn (string $operation) => $operation === 'edit'
                                ? 'Leave blank to keep existing password'
                                : null
                            )
                            ->columnSpanFull(),
                    ]),

                Section::make('Role & Access')
                    ->schema([
                        Select::make('role')
                            ->label('Role')
                            ->options(function () {
                                $options = [
                                    'admin'   => 'Admin — Full content & user management',
                                    'editor'  => 'Editor — Create & manage all content',
                                    'author'  => 'Author — Own posts only',
                                    'viewer'  => 'Viewer — Read-only access',
                                ];

                                if (auth()->user()?->hasRole('super_admin')) {
                                    $options = ['super_admin' => 'Super Admin — Unrestricted access'] + $options;
                                }

                                return $options;
                            })
                            ->required()
                            ->default('editor')
                            ->native(false)
                            ->dehydrated(false),
                    ]),
            ]);
    }
}
