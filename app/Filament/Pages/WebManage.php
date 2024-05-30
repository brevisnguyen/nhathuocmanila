<?php

namespace App\Filament\Pages;

use App\Settings\WebSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class WebManage extends SettingsPage
{
    protected static ?string $navigationGroup = 'Trang web';
    protected static ?string $navigationLabel = 'Cài đặt Web';
    protected static ?string $navigationIcon = 'heroicon-s-globe-alt';
    protected static ?string $recordTitleAttribute = 'name';

    protected static string $settings = WebSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Tabs::make('tabs')
                    ->columns(2)
                    ->contained(false)
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Cài đặt chung')
                            ->icon('heroicon-o-cog')
                            ->schema([
                                Forms\Components\TextInput::make('slogan')
                                    ->hint('Thông điệp trang web')
                            ]),
                        Forms\Components\Tabs\Tab::make('Liên kết mạng xã hội')
                            ->icon('heroicon-m-share')
                            ->schema([
                                Forms\Components\TextInput::make('telegram')
                                    ->required()
                                    ->hint('username của nhóm, channel, cá nhân')
                                    ->placeholder('nhathuocmanila')
                                    ->prefix('https://t.me/'),
                                Forms\Components\TextInput::make('facebook')
                                    ->required()
                                    ->hint('username của fanpage, cá nhấn, nhóm')
                                    ->placeholder('nhathuocmanila')
                                    ->prefix('https://www.facebook.com/'),
                                Forms\Components\TextInput::make('tiktok')
                                    ->hint('username của tài khoản toptop')
                                    ->placeholder('nhathuocmanila')
                                    ->prefix('https://www.tiktok.com/@'),
                                Forms\Components\TextInput::make('hotline')
                                    ->label('Số điện thoại Hotline')
                                    ->required()
                                    ->tel()
                                    ->mask('9999 999 9999')
                            ]),
                        Forms\Components\Tabs\Tab::make('Hình Ảnh')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\FileUpload::make('logo_landscape')
                                    ->columnSpanFull()
                                    ->label('Ảnh logo ngang')
                                    ->required()
                                    ->image()
                                    ->preserveFilenames()
                                    ->imageEditor(),
                                Forms\Components\FileUpload::make('logo_portrait')
                                    ->columnSpanFull()
                                    ->label('Ảnh logo dọc')
                                    ->required()
                                    ->image()
                                    ->preserveFilenames()
                                    ->imageEditor(),
                                Forms\Components\FileUpload::make('banner')
                                    ->columnSpanFull()
                                    ->label('Ảnh slide ở trang chủ')
                                    ->hint('Có thể chọn nhiều ảnh')
                                    ->required()
                                    ->image()
                                    ->multiple()
                                    ->preserveFilenames()
                                    ->imageEditor(),
                                Forms\Components\FileUpload::make('mid_banner')
                                    ->columnSpanFull()
                                    ->label('Ảnh banner ở trang chủ')
                                    ->required()
                                    ->image()
                                    ->preserveFilenames()
                                    ->imageEditor(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Upload')
                            ->icon('heroicon-m-cloud-arrow-up')
                            ->schema([
                                Forms\Components\Section::make('Ảnh sản phẩm')
                                    ->schema([
                                        Forms\Components\Fieldset::make('Kích thước ảnh Thumbnail')
                                            ->columnSpanFull()
                                            ->schema([
                                                Forms\Components\TextInput::make('thumb_width')
                                                    ->label('Chiều rộng')
                                                    ->numeric()
                                                    ->suffix('px')
                                                    ->afterStateHydrated(function (Forms\Components\TextInput $component, Forms\Get $get) {
                                                        $component->state($get('thumb_size')[0]);
                                                    }),
                                                Forms\Components\TextInput::make('thumb_height')
                                                    ->label('Chiều dài')
                                                    ->numeric()
                                                    ->suffix('px')
                                                    ->afterStateHydrated(function (Forms\Components\TextInput $component, Forms\Get $get) {
                                                        $component->state($get('thumb_size')[1]);
                                                    }),
                                            ]),
                                        Forms\Components\Fieldset::make('Kích thước ảnh cỡ vừa Medium')
                                            ->columnSpanFull()
                                            ->schema([
                                                Forms\Components\TextInput::make('medium_width')
                                                    ->label('Chiều rộng')
                                                    ->numeric()
                                                    ->suffix('px')
                                                    ->afterStateHydrated(function (Forms\Components\TextInput $component, Forms\Get $get) {
                                                        $component->state($get('medium_size')[0]);
                                                    }),
                                                Forms\Components\TextInput::make('medium_height')
                                                    ->label('Chiều dài')
                                                    ->numeric()
                                                    ->suffix('px')
                                                    ->afterStateHydrated(function (Forms\Components\TextInput $component, Forms\Get $get) {
                                                        $component->state($get('medium_size')[1]);
                                                    }),
                                            ]),
                                        Forms\Components\Fieldset::make('Kích thước ảnh cỡ lớn Large')
                                            ->columnSpanFull()
                                            ->schema([
                                                Forms\Components\TextInput::make('large_width')
                                                    ->label('Chiều rộng')
                                                    ->numeric()
                                                    ->suffix('px')
                                                    ->afterStateHydrated(function (Forms\Components\TextInput $component, Forms\Get $get) {
                                                        $component->state($get('large_size')[0]);
                                                    }),
                                                Forms\Components\TextInput::make('large_height')
                                                    ->label('Chiều dài')
                                                    ->numeric()
                                                    ->suffix('px')
                                                    ->afterStateHydrated(function (Forms\Components\TextInput $component, Forms\Get $get) {
                                                        $component->state($get('large_size')[1]);
                                                    }),
                                            ]),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['thumb_size'] = [$data['thumb_width'], $data['thumb_height']];
        $data['medium_size'] = [$data['medium_width'], $data['medium_height']];
        $data['large_size'] = [$data['large_width'], $data['large_height']];

        unset($data['thumb_width'], $data['thumb_height']);
        unset($data['medium_width'], $data['medium_height']);
        unset($data['large_width'], $data['large_height']);

        return $data;
    }
}
