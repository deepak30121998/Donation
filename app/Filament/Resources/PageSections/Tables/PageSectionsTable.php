<?php

namespace App\Filament\Resources\PageSections\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PageSectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('section_key')
                    ->label('Section Key')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable()
                    ->limit(50)
                    ->placeholder('—'),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('page')
                    ->label('Page')
                    ->options([
                        'home'         => 'Home',
                        'about'        => 'About',
                        'services'     => 'Services',
                        'programs'     => 'Programs',
                        'blog'         => 'Blog',
                        'team'         => 'Team',
                        'gallery'      => 'Gallery',
                        'testimonials' => 'Testimonials',
                        'donation'     => 'Donation',
                        'contact'      => 'Contact',
                        'faqs'         => 'FAQs',
                        'global'       => 'Global (Shared)',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('page')
            ->defaultPaginationPageOption(25)
            ->paginationPageOptions([25, 50, 100]);
    }
}
