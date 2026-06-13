<?php

namespace App\Filament\Resources\Donations\Tables;

use App\Actions\Donation\StoreDonationAction;
use App\Contracts\Services\DonationServiceInterface;
use App\Enums\DonationPaymentMethod;
use App\Enums\DonationStatus;
use App\Models\Cause;
use App\Models\Donation;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\TextInput;
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
                    ->money('INR')
                    ->sortable(),

                TextColumn::make('cause.title')
                    ->label('Cause')
                    ->default('—'),

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
                    ->dateTime('d M Y, h:i A')
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
            ->recordActions([
                Action::make('markCompleted')
                    ->label('Mark Completed')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Donation $record) => $record->status === DonationStatus::Pending)
                    ->form([
                        TextInput::make('transaction_id')
                            ->label('Transaction / Reference ID')
                            ->placeholder('e.g. NEFT123456789')
                            ->helperText('Enter the bank reference number or UTR number (optional)')
                            ->maxLength(100),
                    ])
                    ->modalHeading('Mark Donation as Completed')
                    ->modalDescription(fn (Donation $record) =>
                        'Confirm payment received from ' . $record->donor_full_name .
                        ' — ₹' . number_format($record->amount) . '.'
                    )
                    ->modalSubmitActionLabel('Yes, Mark as Completed')
                    ->requiresConfirmation(false)
                    ->action(function (Donation $record, array $data): void {
                        $storeDonationAction = app(StoreDonationAction::class);
                        $donationService     = app(DonationServiceInterface::class);

                        $txnId = filled($data['transaction_id']) ? $data['transaction_id'] : 'MANUAL-' . strtoupper(uniqid());

                        $storeDonationAction->markCompleted($record, $txnId);
                        $donationService->sendReceipt($record->fresh());

                        Notification::make()
                            ->title('Donation marked as completed')
                            ->body('Receipt has been sent to ' . $record->donor_email . '.')
                            ->success()
                            ->send();
                    }),

                Action::make('markFailed')
                    ->label('Mark Failed')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (Donation $record) => $record->status === DonationStatus::Pending)
                    ->requiresConfirmation()
                    ->modalHeading('Mark Donation as Failed')
                    ->modalDescription(fn (Donation $record) =>
                        'Mark donation from ' . $record->donor_full_name . ' (₹' . number_format($record->amount) . ') as failed?'
                    )
                    ->modalSubmitActionLabel('Yes, Mark as Failed')
                    ->action(function (Donation $record): void {
                        $record->update(['status' => DonationStatus::Failed]);

                        Notification::make()
                            ->title('Donation marked as failed')
                            ->warning()
                            ->send();
                    }),
            ])
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
