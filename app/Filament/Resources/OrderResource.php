<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Medication;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationGroup = 'Cửa hàng';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
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
                        Forms\Components\Radio::make('payment_method')
                                ->label('Phương thức thanh toán')
                                ->required()
                                ->options([
                                    'cod' => 'Ship COD',
                                    'bank' => "Chuyển khoản NH"
                                ])
                                ->inlineLabel(true),
                        Forms\Components\TextInput::make('total_amount')
                                ->label('Tổng tiền')
                                ->disabled(fn (string $operation): bool => $operation === 'create')
                                ->suffix('₱')
                                ->columnSpan(1),
                    ])->columns(2),
                Forms\Components\Section::make('Thông tin đơn thuốc')
                    ->schema([
                        Forms\Components\Repeater::make('orderMedications')
                            ->label('Danh sách thuốc và số lượng')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('medication_id')
                                    ->label('Tên thuốc')
                                    ->reactive()
                                    ->required()
                                    ->relationship('medication', 'name')
                                    ->afterStateUpdated(function (Set $set, Get $get, ?string $state) {
                                        $amount = $get('quantity') * Medication::find($state)?->price;
                                        $set('amount', $amount);
                                    }),
                                Forms\Components\Grid::make()->schema([
                                    Forms\Components\TextInput::make('quantity')
                                        ->label('Số lượng')
                                        ->reactive()
                                        ->required()
                                        ->numeric()
                                        ->minValue(1)
                                        ->afterStateUpdated(function (Set $set, Get $get, ?string $state) {
                                            $amount = $state * Medication::find($get('medication_id'))?->price;
                                            $set('amount', $amount);
                                        }),
                                    Forms\Components\TextInput::make('amount')
                                        ->label('Thành tiền')
                                        ->disabled()
                                        ->dehydrated()
                                        ->reactive()
                                        ->numeric()
                                        ->suffix('₱'),
                                ]),
                            ])
                            ->grid(2)
                            ->mutateRelationshipDataBeforeFillUsing(function (array $data): array {
                                $order = Order::find($data['order_id']);
                                $order->setTotalAmount();
                                return $data;
                            }),
                    ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer')
                    ->label('Khách hàng')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('SĐT')
                    ->copyable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Thanh toán')
                    ->sortable()
                    ->badge()
                    ->formatStateUsing(function (string $state): string {
                        return $state === 'cod' ? 'Ship COD' : 'Chuyển khoản';
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'cod' => 'danger',
                        'bank' => 'info',
                    }),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Tổng tiền')
                    ->money('PHP')
                    ->sortable(),
            ])
            ->searchPlaceholder('Tìm tên khách hàng')
            ->filters([
                Tables\Filters\SelectFilter::make('payment_method')
                    ->label('Thanh toán')
                    ->options([
                        'cod' => 'Ship COD',
                        'bank' => 'Chuyển khoản'
                    ]),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
