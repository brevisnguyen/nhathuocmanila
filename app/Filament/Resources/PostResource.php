<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationGroup = 'Trang web';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Bài viết';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin bài viết')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Tiêu đề')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\DatePicker::make('updated_at')
                            ->label('Ngày xuất bản'),
                        Forms\Components\TextInput::make('views')
                            ->label('Số lượt xem')
                            ->numeric()
                            ->minValue(0),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                            ->label('Ảnh bìa bài viết')
                            ->hint('Nên để ảnh ngang có tỷ lệ 16:9 hoặc vuôn 1:1')
                            ->required()
                            ->image()
                            ->preserveFilenames()
                            ->disk('posts')
                            ->collection('posts')
                            ->imageEditor()
                            ->orientImagesFromExif(false)
                            ->fetchFileInformation(false)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Nội dung')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('Nội dung bài viết')
                            ->fileAttachmentsDisk('posts')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->label('Hình ảnh')
                    ->collection('posts')
                    ->conversion('thumb'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                    ->copyable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Tác giả')
                    ->sortable(),
                Tables\Columns\TextColumn::make('views')
                    ->label('Lượt xem')
                    ->sortable()
                    ->default(0)
                    ->icon('heroicon-s-eye')
                    ->iconColor('success'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ngày cập nhật')
                    ->since(),
            ])
            ->filters([])
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
