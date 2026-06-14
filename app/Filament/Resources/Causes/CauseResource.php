<?php

namespace App\Filament\Resources\Causes;

use App\Filament\Resources\Causes\Pages\CreateCause;
use App\Filament\Resources\Causes\Pages\EditCause;
use App\Filament\Resources\Causes\Pages\ListCauses;
use App\Filament\Resources\Causes\Schemas\CauseForm;
use App\Filament\Resources\Causes\Tables\CausesTable;
use App\Filament\Concerns\HasResourcePermissions;
use App\Models\Cause;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CauseResource extends Resource
{
    use HasResourcePermissions;

    protected static ?string $model = Cause::class;
    protected static string $permissionPrefix = 'causes';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHeart;

    protected static string|\UnitEnum|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return CauseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CausesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCauses::route('/'),
            'create' => CreateCause::route('/create'),
            'edit' => EditCause::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
