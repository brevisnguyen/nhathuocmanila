<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicationResource\Pages;
use App\Models\Category;
use App\Models\Medication;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MedicationResource extends Resource
{
    protected static ?string $model = Medication::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Thuốc';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin cơ bản')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Tên thuốc')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('categories')
                            ->label('Danh mục thuốc')
                            ->required()
                            ->multiple()
                            ->relationship('categories', 'name')
                            ->preload(),
                        Forms\Components\TextInput::make('inventory')
                            ->label('Số lượng trong kho')
                            ->numeric()
                            ->minValue(1)
                            ->required(),
                        Forms\Components\TextInput::make('sold_count')
                            ->label('Số lượng đã bán')
                            ->numeric()
                            ->disabled(),
                        Forms\Components\FileUpload::make('image')
                            ->label('Hình ảnh')
                            ->image()
                            ->required()
                            ->disk('medicines')
                            ->openable()
                            ->columnSpan(2),
                        Forms\Components\RichEditor::make('description')
                            ->label('Mô tả')
                            ->disableToolbarButtons(['attachFiles'])
                            ->columnSpan(2),
                    ])->columns(2),
                Forms\Components\Section::make('Giá bán')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('Giá bán lẻ')
                            ->required()
                            ->numeric()
                            ->inputMode('decimal')
                            ->suffix('₱'),
                        Forms\Components\TextInput::make('cost')
                            ->label('Giá nhập')
                            ->required()
                            ->numeric()
                            ->inputMode('decimal')
                            ->suffix('₱'),
                        Forms\Components\Select::make('unit_id')
                            ->label('Đơn vị')
                            ->required()
                            ->options(Unit::all()->pluck('name', 'id')),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên thuốc')
                    ->copyable()
                    ->searchable()
                    ->size(Tables\Columns\TextColumn\TextColumnSize::Large)
                    ->weight(\Filament\Support\Enums\FontWeight::Bold),
                Tables\Columns\TextColumn::make('price')
                    ->label('Giá bán')
                    ->money('PHP'),
                Tables\Columns\TextColumn::make('unit.name')
                    ->label('Đơn vị')
                    ->badge(),
                Tables\Columns\TextColumn::make('sold_count')
                    ->label('Đã bán')
                    ->sortable(),
                Tables\Columns\TextColumn::make('inventory')
                    ->label('Trong kho')
                    ->sortable()
                    ->badge()
                    ->color(function (int $state): string {
                        if ($state <= 10) {
                            return 'danger';
                        } else if ($state > 10 && $state <= 20) {
                            return 'warning';
                        } else if ($state > 20 && $state <= 50) {
                            return 'info';
                        } else {
                            return 'success';
                        }
                    }),
                Tables\Columns\ImageColumn::make('image')
                    ->disk('medicines')
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Danh mục')
                    ->relationship('categories', 'name')
                    ->searchable()
                    ->preload(),
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedications::route('/'),
            'create' => Pages\CreateMedication::route('/create'),
            'edit' => Pages\EditMedication::route('/{record}/edit'),
        ];
    }
}
