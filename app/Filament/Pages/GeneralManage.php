<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class GeneralManage extends SettingsPage
{
    protected static ?string $navigationGroup = 'Cài đặt';
    protected static ?string $navigationLabel = 'Cài đặt chung';
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $recordTitleAttribute = 'name';

    protected static string $settings = GeneralSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Website')
                    ->schema([
                        Forms\Components\TextInput::make('site_brand')
                            ->label('Tên website'),
                        Forms\Components\TextInput::make('site_slogan')
                            ->label('Slogan'),
                        Forms\Components\FileUpload::make('site_logo')
                                ->label('Ảnh Logo')
                                ->image()
                                ->imageEditor()
                                ->maxSize(1024)
                                ->columnStart(1)
                                ->hint('Nên dùng ảnh ngang, kích thước không quá 1024Kb')
                                ->columnSpanFull(),
                        Forms\Components\TextInput::make('site_cache_ttl')
                                ->label('Thời gian lưu cache')
                                ->numeric()
                                ->suffix('giây (s)'),
                    ])
                    ->collapsible()
                    ->columns(),
                Forms\Components\Section::make('Khác')
                    ->schema([
                        Forms\Components\TextInput::make('site_facebook_app_id')
                            ->label('Facebook App ID'),
                        Forms\Components\Textarea::make('site_scripts_facebook_sdk')
                            ->label('Facebook JS SDK script tag'),
                        Forms\Components\Textarea::make('site_scripts_google_analytics')
                            ->label('Google analytics script tag'),
                        Forms\Components\Textarea::make('additional_footer_js')
                            ->label('Footer JS'),
                    ])
                    ->collapsible()
                    ->columns(),
            ]);
    }
}
