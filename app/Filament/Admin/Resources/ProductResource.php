<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Models\Category;
use App\Models\Product;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationLabel = 'Продукция';

    protected static ?string $modelLabel = 'Товар';

    protected static ?string $pluralModelLabel = 'Продукция';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основное')
                    ->schema([
                        KeyValue::make('name')
                            ->keyLabel('Язык')
                            ->valueLabel('Название')
                            ->addable(false)
                            ->deletable(false)
                            ->keyOptions([
                                'ru' => 'Русский',
                                'uz' => "O'zbekcha",
                            ])
                            ->required(),
                        KeyValue::make('description')
                            ->keyLabel('Язык')
                            ->valueLabel('Описание')
                            ->addable(false)
                            ->deletable(false)
                            ->keyOptions([
                                'ru' => 'Русский',
                                'uz' => "O'zbekcha",
                            ]),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('sku')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->label('Артикул'),
                        Select::make('category_id')
                            ->options(fn (): array => Category::orderBy('sort_order')->orderBy('id')->get()->mapWithKeys(fn ($c) => [$c->id => $c->name])->toArray())
                            ->required()
                            ->label('Категория'),
                        TextInput::make('moq')
                            ->label('Мин. заказ'),
                        TextInput::make('lead_time')
                            ->label('Срок изготовления'),
                    ])
                    ->columns(2),

                Section::make('Технические характеристики')
                    ->schema([
                        KeyValue::make('specs')
                            ->keyLabel('Параметр (RU)')
                            ->valueLabel('Значение (RU)')
                            ->addable(true)
                            ->deletable(true),
                    ]),

                Section::make('Настройки')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('products')
                            ->label('Главное изображение'),
                        FileUpload::make('gallery')
                            ->multiple()
                            ->image()
                            ->directory('products/gallery')
                            ->label('Галерея'),
                        Grid::make(3)
                            ->schema([
                                Toggle::make('is_new')
                                    ->label('Новинка'),
                                Toggle::make('is_featured')
                                    ->label('В featured'),
                                Toggle::make('is_active')
                                    ->label('Активен'),
                                Toggle::make('customization')
                                    ->label('Кастомизация'),
                            ]),
                        TextInput::make('discount_percent')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->label('Скидка %'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->defaultImageUrl(fn () => '/images/placeholder.png')
                    ->square()
                    ->size(40),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('sku')
                    ->searchable()
                    ->label('Артикул'),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Категория'),
                Tables\Columns\IconColumn::make('is_new')
                    ->boolean()
                    ->label('Новинка'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Активен'),
                Tables\Columns\IconColumn::make('customization')
                    ->boolean()
                    ->label('Кастом'),
                Tables\Columns\TextColumn::make('discount_percent')
                    ->label('Скидка %'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->options(fn (): array => Category::orderBy('sort_order')->orderBy('id')->get()->mapWithKeys(fn ($c) => [$c->id => $c->name])->toArray())
                    ->label('Категория'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активность'),
                Tables\Filters\TernaryFilter::make('is_new')
                    ->label('Новинка'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
