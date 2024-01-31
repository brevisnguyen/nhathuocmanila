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
                                Forms\Components\FileUpload::make('logo')
                                    ->columnSpanFull()
                                    ->label('Ảnh logo')
                                    ->required()
                                    ->image()
                                    ->preserveFilenames()
                                    ->imageEditor(),
                                Forms\Components\FileUpload::make('banner')
                                    ->columnSpanFull()
                                    ->label('Ảnh banner ở trang chủ')
                                    ->required()
                                    ->image()
                                    ->multiple()
                                    ->preserveFilenames()
                                    ->imageEditor(),
                                ]),
                    ]),
            ]);
    }
}
