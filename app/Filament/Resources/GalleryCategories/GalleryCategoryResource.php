<?php

namespace App\Filament\Resources\GalleryCategories;

use App\Filament\Concerns\HasResourcePermissions;
use App\Filament\Resources\GalleryCategories\Pages\CreateGalleryCategory;
use App\Filament\Resources\GalleryCategories\Pages\EditGalleryCategory;
use App\Filament\Resources\GalleryCategories\Pages\ListGalleryCategories;
use App\Filament\Resources\GalleryCategories\Schemas\GalleryCategoryForm;
use App\Filament\Resources\GalleryCategories\Tables\GalleryCategoriesTable;
use App\Models\GalleryCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GalleryCategoryResource extends Resource
{
    use HasResourcePermissions;

    protected static ?string $model = GalleryCategory::class;
    protected static string $permissionPrefix = 'gallery';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;
    protected static ?string $navigationLabel = 'Gallery Categories';
    protected static string|\UnitEnum|null $navigationGroup = 'Content';
    protected static ?int $navigationSort = 7;

    public static function form(Schema $schema): Schema
    {
        return GalleryCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GalleryCategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListGalleryCategories::route('/'),
            'create' => CreateGalleryCategory::route('/create'),
            'edit'   => EditGalleryCategory::route('/{record}/edit'),
        ];
    }
}
