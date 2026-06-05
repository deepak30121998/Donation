<?php

namespace App\Filament\Widgets;

use App\Enums\DonationStatus;
use App\Models\Donation;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentDonationsWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Recent Donations')
            ->query(
                Donation::query()
                    ->with('cause')
                    ->latest('donated_at')
                    ->limit(10)
            )
            ->columns([
                TextColumn::make('donor_full_name')
                    ->label('Donor'),

                TextColumn::make('amount')
                    ->label('Amount')
                    ->money('USD'),

                TextColumn::make('cause.title')
                    ->label('Cause'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state) => $state instanceof DonationStatus ? $state->color() : 'gray')
                    ->formatStateUsing(fn ($state) => $state instanceof DonationStatus ? $state->label() : ucfirst($state)),

                TextColumn::make('donated_at')
                    ->label('Date')
                    ->dateTime(),
            ])
            ->paginated(false);
    }
}
