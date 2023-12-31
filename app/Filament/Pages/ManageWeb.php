<?php

namespace App\Filament\Pages;

use App\Settings\WebSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageWeb extends SettingsPage
{
    protected static ?string $navigationGroup = 'Trang web';
    protected static ?string $navigationIcon = 'heroicon-s-globe-alt';
    protected static ?string $navigationLabel = 'Cài đặt Web';
    protected static ?string $recordTitleAttribute = 'name';
    protected static string $settings = WebSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('tabs')->tabs([
                    Forms\Components\Tabs\Tab::make('Liên kết mạng xã hội')
                        ->schema([
                            Forms\Components\TextInput::make('facebook'),
                            Forms\Components\TextInput::make('tiktok'),
                            Forms\Components\TextInput::make('telegram'),
                        ]),
                    Forms\Components\Tabs\Tab::make('Ảnh Banners'),
                    Forms\Components\Tabs\Tab::make('Menu'),
                ]),
            ]);
    }
}
