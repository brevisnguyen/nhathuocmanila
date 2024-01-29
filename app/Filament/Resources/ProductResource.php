<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationGroup = 'Cửa hàng';
    protected static ?string $navigationIcon = 'heroicon-s-link';
    protected static ?string $navigationLabel = 'Thuốc';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Thông tin chính')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Tên thuốc')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', \Str::slug($state))),
                            Forms\Components\TextInput::make('slug')->readOnly(),
                            Forms\Components\TextInput::make('sold')
                                ->label('Số lượng đã bán')
                                ->disabled(),
                            Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                                ->label('Hình ảnh sản phẩm')
                                ->image()
                                ->disk('products')
                                ->collection('products')
                                ->imageEditor()
                                ->orientImagesFromExif(false)
                                ->fetchFileInformation(false)
                                ->columnSpanFull(),
                            Forms\Components\RichEditor::make('description')
                                ->label('Mô tả sản phẩm')
                                ->columnSpanFull()
                        ])
                        ->collapsible()
                        ->columns(),
                    Forms\Components\Section::make('Giá bán')
                        ->schema([
                            Forms\Components\Repeater::make('productUnits')
                                ->label('Giá theo đơn vị')
                                ->required()
                                ->relationship()
                                ->schema([
                                    Forms\Components\Select::make('unit_id')
                                        ->label('Đơn vị')
                                        ->distinct()
                                        ->required()
                                        ->options(Unit::all()->pluck('name', 'id')),
                                    Forms\Components\TextInput::make('amount')
                                        ->label('Giá')
                                        ->required()
                                        ->numeric()
                                        ->inputMode('decimal')
                                        ->minValue(0)
                                        ->suffix('₱'),
                                    Forms\Components\Toggle::make('default')
                                        ->label('Hiển thị mặc định')
                                        ->inline(false)
                                        ->onIcon('heroicon-s-eye')
                                        ->offIcon('heroicon-s-eye-slash')
                                        ->onColor('success')
                                        ->offColor('danger')
                                ])->columns(3)
                        ])->collapsible(),
                ])
                ->columnSpan(2),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Trạng thái và danh mục')
                        ->schema([
                            Forms\Components\Radio::make('status')
                                ->label('Trạng thái sản phẩm')
                                ->required()
                                ->options([
                                    Status::IN_STOCK->value => 'Còn hàng',
                                    Status::SOLD_OUT->value => 'Hết hàng',
                                ])
                                ->default(Status::IN_STOCK),
                            Forms\Components\Select::make('categories')
                                ->label('Danh mục')
                                ->required()
                                ->multiple()
                                ->relationship(name: 'categories', titleAttribute: 'name')
                                ->preload()
                        ])->collapsible()
                ]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->label('Hình ảnh')
                    ->collection('products')
                    ->conversion('thumb'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên')
                    ->searchable(isIndividual: true)
                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                    ->copyable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->sortable(),
                \App\Tables\Columns\PriceByUnit::make('productUnits')
                    ->label('Giá bán'),
                Tables\Columns\TextColumn::make('categories.name')
                    ->label('Danh mục')
                    ->badge()
                    ->separator(','),
                Tables\Columns\TextColumn::make('sold')
                    ->label('Đã bán')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Trạng thái')
                    ->trueLabel('Còn hàng')
                    ->falseLabel('Hết hàng'),
                Tables\Filters\SelectFilter::make('categories')
                    ->label('Danh mục')
                    ->relationship('categories', 'name')
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('link')
                        ->label('Xem')
                        ->url(fn (Product $product): string => route('product', $product))
                        ->openUrlInNewTab()
                        ->icon('heroicon-m-link')
                ])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
