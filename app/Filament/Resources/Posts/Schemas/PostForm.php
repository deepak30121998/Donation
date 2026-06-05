<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\PostCategory;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Post Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Select::make('post_category_id')
                            ->label('Category')
                            ->options(PostCategory::pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        Select::make('author_id')
                            ->label('Author')
                            ->options(User::pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                    ]),

                Section::make('Content')
                    ->schema([
                        Textarea::make('excerpt')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),

                        RichEditor::make('body')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Featured Image')
                    ->schema([
                        FileUpload::make('featured_image')
                            ->label('Featured Image')
                            ->image()
                            ->disk('public')
                            ->directory('posts')
                            ->imagePreviewHeight('200')
                            ->columnSpanFull(),
                    ]),

                Section::make('Publishing')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(false),

                        DateTimePicker::make('published_at')
                            ->label('Publish Date'),
                    ]),

                Section::make('SEO')
                    ->columns(1)
                    ->schema([
                        TextInput::make('meta_title')
                            ->maxLength(255),

                        Textarea::make('meta_description')
                            ->rows(2)
                            ->maxLength(500),
                    ]),
            ]);
    }
}
