<?php

namespace App\Filament\Widgets;

use App\Enums\Status;
use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class OrderRevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Doanh thu';
    protected static ?string $pollingInterval = '10s';

    protected function getData(): array
    {
        $data = Trend::query(Order::query()->where('status', Status::COMPLETED))
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth()
            )
            ->perDay()
            ->sum('subtotal');

        return [
            'datasets' => [
                'label' => 'Doanh thu tháng này',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
