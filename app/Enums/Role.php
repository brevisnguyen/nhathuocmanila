<?php

namespace App\Enums;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum Role: string implements HasLabel, HasColor, HasIcon
{
    case ADMIN = 'admin';
    case GUEST = 'guest';

    public function getLabel(): string
    {
        return match ($this) {
            self::ADMIN => 'Quản lý',
            self::GUEST => 'Khách',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::ADMIN => 'danger',
            self::GUEST => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::ADMIN => 'heroicon-s-shield-check',
            self::GUEST => 'heroicon-s-globe-asia-australia',
        };
    }
}
