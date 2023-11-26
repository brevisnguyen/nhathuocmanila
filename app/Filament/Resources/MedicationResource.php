<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicationResource\Pages;
use App\Filament\Resources\MedicationResource\RelationManagers;
use App\Models\Category;
use App\Models\Medication;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicationResource extends Resource
{
    protected static ?string $model = Medication::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                        Forms\Components\Select::make('category')
                            ->label('Danh mục thuốc')
                            ->required()
                            ->multiple()
                            ->searchable()
                            ->options(Category::all()->pluck('name', 'id')),
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
            ])
            ->filters([
                //
            ])
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
        return [
            //
        ];
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
