<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationLabel = 'Страницы';

    protected static ?string $modelLabel = 'Страница';

    protected static ?string $pluralModelLabel = 'Страницы';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основное')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title.ru')
                                    ->label('Заголовок (RU)')
                                    ->required(),
                                TextInput::make('title.uz')
                                    ->label('Sarlavha (UZ)'),
                            ]),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Grid::make(1)
                            ->schema([
                                RichEditor::make('content.ru')
                                    ->label('Контент (RU)'),
                                RichEditor::make('content.uz')
                                    ->label('Kontent (UZ)'),
                            ]),
                        Toggle::make('is_active')
                            ->label('Активна')
                            ->default(true),
                    ]),

                Section::make('SEO')
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Meta Title'),
                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Активна'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
