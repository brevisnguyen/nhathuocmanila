<?php

namespace App\Enums;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum Status: string implements HasLabel, HasColor, HasIcon
{
    case PENDING = 'pending';
    case SHIPPING = 'shipping';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
    case IN_STOCK = 'in_stock';
    case SOLD_OUT = 'sold_out';

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Đang chờ',
            self::SHIPPING => 'Đang ship',
            self::CANCELLED => 'Đã hủy',
            self::COMPLETED => 'Hoàn thành',
            self::IN_STOCK => 'Còn hàng',
            self::SOLD_OUT => 'Hết hàng',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::PENDING, self::SHIPPING => 'warning',
            self::CANCELLED, self::SOLD_OUT => 'danger',
            self::COMPLETED => 'success',
            self::IN_STOCK => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PENDING => 'heroicon-m-arrow-path',
            self::SHIPPING => 'heroicon-o-truck',
            self::CANCELLED => 'heroicon-m-x-circle',
            self::COMPLETED => 'heroicon-m-check-badge',
            self::IN_STOCK => 'heroicon-o-check-circle',
            self::SOLD_OUT => 'heroicon-o-exclamation-triangle',
        };
    }
}
