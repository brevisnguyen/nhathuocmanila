<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\OrderItem;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $items = $this->getRecord()?->items;
        $subtotal = $items->sum(fn (OrderItem $item): float => $item->quantity * $item->amount);

        $this->getRecord()->update(['subtotal' => $subtotal]);
    }
}
