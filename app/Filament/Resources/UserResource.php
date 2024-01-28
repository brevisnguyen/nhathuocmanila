<?php

namespace App\Filament\Resources;

use App\Enums\Role;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = 'Trang web';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Người dùng';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin chính')
                    ->collapsible()
                    ->columns(2)
                    ->columnSpan(['lg' => fn (?User $record) => $record === null ? 3 : 2])
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Tên người dùng')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->required()
                            ->email()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->autocomplete('email'),
                        Forms\Components\TextInput::make('password')
                            ->label('Mật khẩu')
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->password()
                            ->revealable()
                            ->autocomplete('new-password')
                            ->hidden(fn (string $operation): bool => $operation === 'edit')
                            ->same('confirmPassword'),
                        Forms\Components\TextInput::make('confirmPassword')
                            ->label('Xác nhận mật khẩu')
                            ->password()
                            ->revealable()
                            ->autocomplete('new-password')
                            ->hidden(fn (string $operation): bool => $operation === 'edit'),
                        Forms\Components\TextInput::make('telegram_id')
                            ->label('Telegram ID')
                            ->hint('Nhắn tin cho bot để lấy ID')
                            ->numeric(),
                        Forms\Components\ToggleButtons::make('role')
                            ->label('Vai trò')
                            ->inline()
                            ->options(Role::class)
                            ->default(Role::GUEST)
                            ->required(),
                    ]),
                Forms\Components\Section::make()
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?User $record) => $record === null)
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Thời gian tạo')
                            ->content(fn (User $record): ?string => $record->created_at?->diffForHumans()),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Cập nhật lần cuối')
                            ->content(fn (User $record): ?string => $record->updated_at?->diffForHumans()),
                    ]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên người dùng')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(isIndividual: true, isGlobal: false),
                Tables\Columns\TextColumn::make('telegram_id')
                    ->label('Telegram')
                    ->icon('heroicon-s-paper-airplane')
                    ->url(fn (User $record): string => 'tg://user?id=' . $record->telegram_id)
                    ->placeholder('Chưa liên kết')
                    ->openUrlInNewTab()
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Vai trò')
                    ->badge(),
                Tables\Columns\TextColumn::make('orders_count')
                    ->label('Số đơn hàng')
                    ->counts('orders')
                    ->sortable()
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('changePassword')
                        ->label('Đổi mật khẩu')
                        ->icon('heroicon-o-lock-open')
                        ->modalHeading('Thay đổi mật khẩu')
                        ->form([
                            Forms\Components\TextInput::make('newPassword')
                                ->label('Mật khẩu mới')
                                ->required()
                                ->password()
                                ->autocomplete('new-password')
                                ->revealable()
                                ->same('confirmPassword'),
                            Forms\Components\TextInput::make('confirmPassword')
                                ->label('Xác nhận mật khẩu')
                                ->password()
                                ->revealable()
                                ->autocomplete('new-password')
                        ])
                        ->action(function (array $data, User $record): void {
                            $record->password = $data['newPassword'];
                            $record->save();
                        })
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
