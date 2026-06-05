<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\PostCategory;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Notification;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable()
                    ->badge(),

                TextColumn::make('author.name')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),

                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('published_at')
                    ->label('Published At')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('post_category_id')
                    ->label('Category')
                    ->options(PostCategory::pluck('name', 'id')),

                TernaryFilter::make('is_published')
                    ->label('Published')
                    ->trueLabel('Published only')
                    ->falseLabel('Drafts only'),

                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),

                Action::make('toggle_publish')
                    ->label(fn ($record) => $record->is_published ? 'Unpublish' : 'Publish')
                    ->icon(fn ($record) => $record->is_published ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                    ->color(fn ($record) => $record->is_published ? 'warning' : 'success')
                    ->action(function ($record) {
                        $record->update([
                            'is_published' => ! $record->is_published,
                            'published_at' => ! $record->is_published ? now() : $record->published_at,
                        ]);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
