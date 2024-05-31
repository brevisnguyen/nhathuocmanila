<?php

namespace App\Filament\Pages;

use App\Settings\AssociateSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class AssociateManage extends SettingsPage
{
    protected static ?string $navigationGroup = 'Cài đặt';
    protected static ?string $navigationLabel = 'Liên kết';
    protected static ?string $navigationIcon = 'heroicon-m-share';
    protected static ?string $recordTitleAttribute = 'name';
    protected static string $settings = AssociateSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Liên hệ')
                    ->schema([
                        Forms\Components\TextInput::make('telegram')
                            ->hint('username của nhóm, channel, cá nhân')
                            ->prefix('https://t.me/'),
                        Forms\Components\TextInput::make('facebook')
                            ->hint('username của fanpage, cá nhấn, nhóm')
                            ->prefix('https://www.facebook.com/'),
                        Forms\Components\TextInput::make('tiktok')
                            ->hint('username của tài khoản toptop')
                            ->prefix('https://www.tiktok.com/@'),
                        Forms\Components\TextInput::make('hotline')
                            ->label('Số điện thoại Hotline')
                            ->tel()
                            ->mask('9999 999 9999')
                    ]),
            ]);
    }
}
