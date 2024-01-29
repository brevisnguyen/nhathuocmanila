<?php

namespace App\Filament\Resources;

use App\Enums\Role;
use App\Enums\Status;
use App\Enums\Payment;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductUnit;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make()
                        ->schema(static::getDetailsFormSchema())
                        ->columns(2),

                    Forms\Components\Section::make('Đơn thuốc')
                        ->headerActions([
                            Forms\Components\Actions\Action::make('reset')
                                ->label('Đặt lại')
                                ->modalHeading('Bạn có chắc không?')
                                ->modalDescription('Tất cả sản phầm của đơn hàng này sẽ bị xóa!')
                                ->requiresConfirmation()
                                ->color('danger')
                                ->action(fn (Forms\Set $set) => $set('items', [])),
                        ])
                        ->schema([
                            static::getItemsRepeater(),
                        ]),
                ])
                ->columnSpan(['lg' => fn (?Order $record) => $record === null ? 3 : 2]),

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Thời gian tạo')
                            ->content(fn (Order $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Sửa lần cuối')
                            ->content(fn (Order $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Order $record) => $record === null),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Khách hàng')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('SĐT')
                    ->copyable(),
                Tables\Columns\TextColumn::make('payment')
                    ->label('Thanh toán')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('total')
                    ->label('Tổng tiền')
                    ->money('PHP')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
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

    public static function getDetailsFormSchema(): array
    {
        return [
            Forms\Components\Select::make('user_id')
                ->label('Khách hàng')
                ->relationship('user', 'name')
                ->preload()
                ->searchable()
                ->required()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->required()
                        ->email()
                        ->maxLength(255)
                        ->unique(),
                    Forms\Components\TextInput::make('password')
                        ->label('Mật khẩu')
                        ->hint('Mặc định 123456')
                        ->readonly()
                        ->default('123456'),
                    Forms\Components\ToggleButtons::make('role')
                        ->disabled()
                        ->inline()
                        ->options(Role::class)
                        ->default(Role::GUEST),
                ])
                ->createOptionAction(function (Forms\Components\Actions\Action $action) {
                    return $action
                        ->modalHeading('Tạo mới khách hàng')
                        ->modalSubmitActionLabel('Tạo mới khách hàng')
                        ->modalWidth('lg');
                }),

            Forms\Components\TextInput::make('phone')
                ->label('Số điện thoại')
                ->required()
                ->tel()
                ->maxLength(255),

            Forms\Components\TextInput::make('address')
                ->label('Địa chỉ')
                ->maxLength(255)
                ->required(),

            Forms\Components\ToggleButtons::make('payment')
                ->label('Phương thức thanh toán')
                ->inline()
                ->options(Payment::class)
                ->default(Payment::SHIP_COD)
                ->required(),

            Forms\Components\ToggleButtons::make('status')
                ->label('Trạng thái')
                ->inline()
                ->options(Status::class)
                ->default(Status::PENDING)
                ->required()
                ->columnSpan('full'),

            Forms\Components\RichEditor::make('description')
                ->label('Mô tả')
                ->maxLength(255)
                ->hint('Cách dùng, liều dùng của đơn thuốc')
                ->columnSpan('full')
                ->toolbarButtons(['bold', 'italic']),
        ];
    }

    public static function getItemsRepeater(): Repeater
    {
        return Repeater::make('items')
            ->relationship()
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Tên thuốc')
                    ->options(Product::all()->pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->distinct()
                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                    ->columnSpan(['md' => 5])
                    ->searchable()
                    ->preload(),

                Forms\Components\Select::make('unit_id')
                    ->label('Đơn vị')
                    ->reactive()
                    ->required()
                    ->options(fn (Forms\Get $get) => Product::find($get('product_id'))?->units->pluck('name', 'pivot.id'))
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('amount', ProductUnit::find($state)?->amount)),

                Forms\Components\TextInput::make('amount')
                    ->label('Thành tiền')
                    ->disabled()
                    ->dehydrated(),

                Forms\Components\TextInput::make('quantity')
                    ->label('Số lượng')
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
            ]);
    }
}
