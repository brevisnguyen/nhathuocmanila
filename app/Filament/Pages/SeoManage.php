<?php

namespace App\Filament\Pages;

use App\Settings\SeoSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class SeoManage extends SettingsPage
{
    protected static ?string $navigationGroup = 'Cài đặt';
    protected static ?string $navigationLabel = 'SEO';
    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';
    protected static ?string $recordTitleAttribute = 'name';
    protected static string $settings = SeoSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Tabs::make('tabs')
                    ->contained(false)
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Cài đặt chung')
                            ->icon('heroicon-o-cog')
                            ->schema([
                                Forms\Components\TextInput::make('meta_site_name')
                                    ->label('Tên website'),
                                Forms\Components\TextInput::make('meta_title')
                                    ->label('Tiêu đề mặc định'),
                                Forms\Components\FileUpload::make('meta_favicon')
                                    ->label('Favicon')
                                    ->hint('Định dạng file .ico, kích thước 48x48, 96x96 hoặc 144x144 px')
                                    ->image()
                                    ->preserveFilenames()
                                    ->imageEditor(),
                                Forms\Components\Textarea::make('meta_description')
                                    ->label('Mô tả website'),
                                Forms\Components\TextInput::make('meta_keywords')
                                    ->label('Các từ khóa liên quan'),
                                Forms\Components\FileUpload::make('meta_image')
                                    ->label('Ảnh meta')
                                    ->image()
                                    ->hint('Tối đa 1024Kb')
                                    ->maxSize(1024),
                            ]),
                        Forms\Components\Tabs\Tab::make('Danh mục thuốc')
                            ->icon('heroicon-o-view-columns')
                            ->schema([
                                Forms\Components\TextInput::make('meta_category_title')
                                    ->label('Tiêu đề'),
                                Forms\Components\Textarea::make('meta_category_description')
                                    ->label('Mô tả'),
                                Forms\Components\TextInput::make('meta_category_keywords')
                                    ->label('Các từ khóa liên quan')
                            ]),
                        Forms\Components\Tabs\Tab::make('Thuốc')
                            ->icon('heroicon-s-link')
                            ->schema([
                                Forms\Components\TextInput::make('meta_product_title')
                                    ->label('Tiêu đề'),
                                Forms\Components\Textarea::make('meta_product_description')
                                    ->label('Mô tả'),
                                Forms\Components\TextInput::make('meta_product_keywords')
                                    ->label('Các từ khóa liên quan')
                            ]),
                        Forms\Components\Tabs\Tab::make('Bài Viết')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\TextInput::make('meta_post_title')
                                    ->label('Tiêu đề'),
                                Forms\Components\Textarea::make('meta_post_description')
                                    ->label('Mô tả'),
                                Forms\Components\TextInput::make('meta_post_keywords')
                                    ->label('Các từ khóa liên quan')
                            ]),
                    ])
            ]);
    }
}
