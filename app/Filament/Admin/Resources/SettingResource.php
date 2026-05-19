<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationLabel = 'Настройки';

    protected static ?string $modelLabel = 'Настройка';

    protected static ?string $pluralModelLabel = 'Настройки';

    protected static ?int $navigationSort = 10;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основное')
                    ->schema([
                        TextInput::make('key')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->label('Ключ'),
                        KeyValue::make('value')
                            ->keyLabel('Язык')
                            ->valueLabel('Значение')
                            ->addable(false)
                            ->deletable(false)
                            ->keyOptions([
                                'ru' => 'Русский',
                                'uz' => "O'zbekcha",
                            ])
                            ->required(),
                        TextInput::make('group')
                            ->default('general')
                            ->label('Группа'),
                        Select::make('type')
                            ->options([
                                'text' => 'Текст',
                                'textarea' => 'Текстовая область',
                                'url' => 'Ссылка',
                                'email' => 'Email',
                                'phone' => 'Телефон',
                                'image' => 'Изображение',
                            ])
                            ->default('text')
                            ->label('Тип'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->label('Ключ'),
                Tables\Columns\TextColumn::make('value')
                    ->limit(50)
                    ->label('Значение'),
                Tables\Columns\TextColumn::make('group')
                    ->label('Группа'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Тип'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->label('Группа'),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
