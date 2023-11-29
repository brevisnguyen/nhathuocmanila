<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Đơn hàng';
    protected static ?string $recordTitleAttribute = 'name';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin cơ bản')
                    ->schema([
                        Forms\Components\TextInput::make('customer')
                            ->label('Tên khách hàng')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Số điện thoại')
                            ->tel(),
                        Forms\Components\TextInput::make('total_amount')
                                ->label('Tổng tiền')
                                ->required()
                                ->numeric()
                                ->inputMode('decimal')
                                ->suffix('₱'),
                        Forms\Components\Select::make('payment_method')
                            ->label('Phương thức thanh toán')
                            ->options([
                                'cod' => 'Ship COD',
                                'bank' => "Chuyển khoản NH"
                            ])
                            ->required(),
                    ])->columns(2),
                Forms\Components\Section::make('Thông tin đơn thuốc')
                    ->schema([
                        Forms\Components\Repeater::make('orderMedications')
                            ->label('Danh sách thuốc và số lượng')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('medication_id')
                                    ->label('Tên thuốc')
                                    ->relationship('medication', 'name')
                                    ->required(),
                                Forms\Components\TextInput::make('quantity')
                                    ->label('Số lượng')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1),
                            ])->grid(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
