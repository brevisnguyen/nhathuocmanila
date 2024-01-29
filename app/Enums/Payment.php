<?php

namespace App\Enums;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum Payment: string implements HasLabel, HasColor, HasIcon
{
    case SHIP_COD = 'ship_cod';
    case BANKING = 'banking';

    public function getLabel(): string
    {
        return match ($this) {
            self::SHIP_COD => 'Ship COD',
            self::BANKING => 'Chuyển khoản',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::SHIP_COD => 'success',
            self::BANKING => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::SHIP_COD => 'heroicon-o-currency-dollar',
            self::BANKING => 'heroicon-o-credit-card',
        };
    }
}
