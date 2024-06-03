<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationGroup = 'Cửa hàng';
    protected static ?string $navigationIcon = 'heroicon-o-view-columns';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Danh mục';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Tên danh mục')
                    ->required()
                    ->live(debounce: 500, onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', \Str::slug($state)))
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')->required(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                    ->label('Hình ảnh')
                    ->disk('categories')
                    ->image()
                    ->collection('categories')
                    ->imageEditor()
                    ->maxSize(1024)
                    ->orientImagesFromExif(false)
                    ->fetchFileInformation(false)
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên danh mục')
                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                    ->copyable()
                    ->copyMessage('Sao chép tên danh mục thành công!'),
                Tables\Columns\TextColumn::make('products_count')
                        ->counts('products')
                        ->label('Số lượng sản phẩm')
                        ->sortable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->label('Hình ảnh')
                    ->collection('categories')
                    ->conversion('thumb')
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('link')
                        ->label('Xem')
                        ->url(fn (Category $category): string => route('category', $category))
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
