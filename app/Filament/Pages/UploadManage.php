<?php

namespace App\Filament\Pages;

use App\Settings\UploadSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class UploadManage extends SettingsPage
{
    protected static ?string $navigationGroup = 'Cài đặt';
    protected static ?string $navigationLabel = 'Hiển thị';
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $recordTitleAttribute = 'name';

    protected static string $settings = UploadSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Tùy chỉnh kích thước ảnh')
                    ->collapsible()
                    ->columns()
                    ->schema([
                        Forms\Components\TextInput::make('thumb_size')
                            ->label('Kích thước ảnh cỡ nhỏ')
                            ->hint('Định dạng {width}x{height}')
                            ->suffix('px')
                            ->afterStateHydrated(function (Forms\Components\TextInput $component, Forms\Get $get) {
                                $component->state(implode('x', $get('thumb')));
                            }),
                        Forms\Components\TextInput::make('medium_size')
                            ->label('Kích thước ảnh cỡ vừa')
                            ->hint('Định dạng {width}x{height}')
                            ->suffix('px')
                            ->afterStateHydrated(function (Forms\Components\TextInput $component, Forms\Get $get) {
                                $component->state(implode('x', $get('medium')));
                            }),
                        Forms\Components\TextInput::make('large_size')
                            ->label('Kích thước ảnh cỡ lớn')
                            ->hint('Định dạng {width}x{height}')
                            ->suffix('px')
                            ->afterStateHydrated(function (Forms\Components\TextInput $component, Forms\Get $get) {
                                $component->state(implode('x', $get('large')));
                            }),
                    ]),
                Forms\Components\Section::make('Ảnh slider')
                    ->collapsible()
                    ->schema([
                        Forms\Components\FileUpload::make('homepage_mid_banner')
                            ->label('Ảnh banner trang chủ')
                            ->hint('Ảnh ngang, không quá 1024Kb')
                            ->image()
                            ->imageEditor(),
                        Forms\Components\FileUpload::make('slider')
                            ->label('Ảnh trình chiếu trang chủ')
                            ->hint('Chọn nhiều ảnh, tỷ lệ 16:9, không quá 1024Kb mỗi ảnh')
                            ->image()
                            ->multiple()
                            ->imageEditor(),
                    ]),
            ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['thumb']= array(
            'width' => explode('x', $data['thumb_size'])[0],
            'height' => explode('x', $data['thumb_size'])[1],
        );
        $data['medium']= array(
            'width' => explode('x', $data['medium_size'])[0],
            'height' => explode('x', $data['medium_size'])[1],
        );
        $data['large']= array(
            'width' => explode('x', $data['large_size'])[0],
            'height' => explode('x', $data['large_size'])[1],
        );
        unset($data['thumb_size'], $data['medium_size'], $data['large_size']);
        return $data;
    }
}
