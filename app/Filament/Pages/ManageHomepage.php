<?php

namespace App\Filament\Pages;

use App\Models\PageSection;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageHomepage extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';
    protected string $view = 'filament.pages.manage-homepage';
    protected static ?string $navigationLabel = 'Manage Homepage';
    protected static ?string $title = 'Manage Homepage';
    protected static string|\UnitEnum|null $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 98;

    public array $sectionOrder = [];

    public function mount(): void
    {
        $this->sectionOrder = PageSection::where('page', 'home')
            ->orderBy('order')
            ->pluck('id')
            ->toArray();
    }

    public function getSections(): \Illuminate\Database\Eloquent\Collection
    {
        return PageSection::where('page', 'home')
            ->orderBy('order')
            ->get();
    }

    public function toggleSection(int $id): void
    {
        $section = PageSection::findOrFail($id);
        $section->update(['is_active' => ! $section->is_active]);

        Notification::make()
            ->title($section->is_active ? 'Section shown' : 'Section hidden')
            ->success()
            ->send();
    }

    public function saveOrder(array $order): void
    {
        foreach ($order as $index => $id) {
            PageSection::where('id', $id)->update(['order' => $index + 1]);
        }

        Notification::make()
            ->title('Section order saved')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view_homepage')
                ->label('View Homepage')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->url(url('/'))
                ->openUrlInNewTab()
                ->color('gray'),
        ];
    }
}
