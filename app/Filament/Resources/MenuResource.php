<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;
    protected static ?string $navigationIcon = 'heroicon-m-list-bullet';
    protected static ?string $navigationGroup = 'Trang web';
    protected static ?string $navigationLabel = 'Menu';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Tên')
                    ->required(),
                Forms\Components\TextInput::make('link')
                    ->label('Đường dẫn')
                    ->required(),
                Forms\Components\Select::make('parent_id')
                    ->label('Thuộc')
                    ->options(Menu::all()->pluck('name', 'id')),
                Forms\Components\TextInput::make('order')
                    ->label('Thứ tự')
                    ->numeric(),
                Forms\Components\Toggle::make('open_in_new_tab')
                    ->label('Mở trong tab mới')
                    ->default(false)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Tên'),
                Tables\Columns\TextColumn::make('link')->label('Đường dẫn'),
                Tables\Columns\ToggleColumn::make('open_in_new_tab')->label('Mở trong tab mới'),
                Tables\Columns\TextColumn::make('parent.name')->label('Thuộc'),
                Tables\Columns\TextColumn::make('order')->label('Thứ tự'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMenus::route('/'),
        ];
    }
}
