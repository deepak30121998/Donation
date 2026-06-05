<?php

namespace App\Filament\Resources\Donations\Tables;

use App\Enums\DonationPaymentMethod;
use App\Enums\DonationStatus;
use App\Models\Cause;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DonationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('donor_full_name')
                    ->label('Donor')
                    ->searchable(['donor_first_name', 'donor_last_name'])
                    ->sortable(['donor_first_name']),

                TextColumn::make('donor_email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('amount')
                    ->label('Amount')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('cause.title')
                    ->label('Cause')
                    ->searchable(),

                TextColumn::make('payment_method')
                    ->label('Method')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof DonationPaymentMethod ? $state->label() : ucfirst($state)),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state) => $state instanceof DonationStatus ? $state->color() : 'gray')
                    ->formatStateUsing(fn ($state) => $state instanceof DonationStatus ? $state->label() : ucfirst($state)),

                TextColumn::make('donated_at')
                    ->label('Donated At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('donated_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options(collect(DonationStatus::cases())->mapWithKeys(
                        fn (DonationStatus $s) => [$s->value => $s->label()]
                    )),

                SelectFilter::make('payment_method')
                    ->label('Payment Method')
                    ->options(collect(DonationPaymentMethod::cases())->mapWithKeys(
                        fn (DonationPaymentMethod $m) => [$m->value => $m->label()]
                    )),

                SelectFilter::make('cause_id')
                    ->label('Cause')
                    ->options(Cause::pluck('title', 'id')),
            ])
            ->recordActions([])
            ->toolbarActions([
                BulkActionGroup::make([
                    Action::make('export')
                        ->label('Export Selected')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(function () {
                            Notification::make()
                                ->title('Export queued')
                                ->body('Your export will be ready shortly.')
                                ->success()
                                ->send();
                        }),
                ]),
            ]);
    }
}
