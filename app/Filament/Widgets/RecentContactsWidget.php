<?php

namespace App\Filament\Widgets;

use App\Models\ContactSubmission;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentContactsWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Recent Unread Contact Submissions')
            ->query(
                ContactSubmission::query()
                    ->where('is_read', false)
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                TextColumn::make('full_name')
                    ->label('Name'),

                TextColumn::make('email')
                    ->label('Email'),

                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime(),
            ])
            ->paginated(false);
    }
}
