<?php

namespace App\Filament\Widgets;

use App\Models\ContactSubmission;
use App\Models\Donation;
use App\Models\NewsletterSubscriber;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Donations', '$' . number_format(Donation::sum('amount'), 2))
                ->description('All time donations')
                ->color('success')
                ->icon('heroicon-o-currency-dollar'),

            Stat::make('Unread Contacts', ContactSubmission::where('is_read', false)->count())
                ->description('Needs attention')
                ->color('warning')
                ->icon('heroicon-o-envelope'),

            Stat::make('Newsletter Subscribers', NewsletterSubscriber::where('is_active', true)->count())
                ->description('Active subscribers')
                ->color('info')
                ->icon('heroicon-o-newspaper'),

            Stat::make('Published Posts', Post::where('is_published', true)->count())
                ->description('Live on the site')
                ->color('primary')
                ->icon('heroicon-o-document-text'),
        ];
    }
}
