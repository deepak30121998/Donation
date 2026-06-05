<?php

namespace App\Filament\Resources\Donations\Schemas;

use App\Enums\DonationPaymentMethod;
use App\Enums\DonationStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DonationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('cause_id')
                    ->relationship('cause', 'title'),
                TextInput::make('donor_first_name')
                    ->required(),
                TextInput::make('donor_last_name')
                    ->required(),
                TextInput::make('donor_email')
                    ->email()
                    ->required(),
                TextInput::make('donor_phone')
                    ->tel(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Select::make('payment_method')
                    ->options(DonationPaymentMethod::class)
                    ->default('online')
                    ->required(),
                Select::make('status')
                    ->options(DonationStatus::class)
                    ->default('pending')
                    ->required(),
                TextInput::make('transaction_id'),
                Textarea::make('message')
                    ->columnSpanFull(),
                DateTimePicker::make('donated_at'),
            ]);
    }
}
