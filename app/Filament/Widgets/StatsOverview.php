<?php

namespace App\Filament\Widgets;

use App\Enums\Status;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '20s';

    protected function getStats(): array
    {
        return [
            Stat::make('Thành viên', User::count())
                ->description(User::whereDate('created_at', Carbon::today())->count().' thành viên mới')
                ->color('success'),
            Stat::make('Đơn hàng', Order::where('status', Status::COMPLETED)->count())
                ->description(Order::whereIn('status', [Status::PENDING, Status::SHIPPING])->count().' đơn đang đợi')
                ->color('success'),
            Stat::make('Sản phẩm', Product::count())
                ->description(Product::where('status', Status::SOLD_OUT)->count().' sản phẩm hết hàng')
                ->color('warning'),
        ];
    }
}
