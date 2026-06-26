<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\VacancyResource\Pages;
use App\Models\Vacancy;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class VacancyResource extends Resource
{
    protected static ?string $model = Vacancy::class;

    protected static ?string $navigationLabel = 'Вакансии';

    protected static ?string $modelLabel = 'Вакансия';

    protected static ?string $pluralModelLabel = 'Вакансии';

    protected static ?int $navigationSort = 4;

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
                        Grid::make(2)
                            ->schema([
                                Textarea::make('description.ru')
                                    ->label('Описание (RU)'),
                                Textarea::make('description.uz')
                                    ->label('Tavsif (UZ)'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Textarea::make('requirements.ru')
                                    ->label('Требования (RU)'),
                                Textarea::make('requirements.uz')
                                    ->label('Talablar (UZ)'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Textarea::make('conditions.ru')
                                    ->label('Условия (RU)'),
                                Textarea::make('conditions.uz')
                                    ->label('Shartlar (UZ)'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Toggle::make('is_urgent')
                                    ->label('Срочно')
                                    ->default(false),
                                Toggle::make('is_active')
                                    ->label('Активна')
                                    ->default(true),
                            ]),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_urgent')
                    ->boolean()
                    ->label('Срочно'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Активна'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активность'),
                Tables\Filters\TernaryFilter::make('is_urgent')
                    ->label('Срочность'),
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
            'index' => Pages\ListVacancies::route('/'),
            'create' => Pages\CreateVacancy::route('/create'),
            'edit' => Pages\EditVacancy::route('/{record}/edit'),
        ];
    }
}
