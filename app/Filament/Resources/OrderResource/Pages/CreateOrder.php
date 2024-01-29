<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Pages\Concerns\HasWizard;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    use HasWizard;
    protected static string $resource = OrderResource::class;

    public function form(Form $form): Form
    {
        return parent::form($form)
            ->schema([
                Wizard::make($this->getSteps())
                    ->startOnStep($this->getStartStep())
                    ->cancelAction($this->getCancelFormAction())
                    ->submitAction($this->getSubmitFormAction())
                    ->skippable($this->hasSkippableSteps())
                    ->contained(false),
            ])
            ->columns(null);
    }

    protected function getSteps(): array
    {
        return [
            Wizard\Step::make('Chi tiết đơn hàng')
                ->schema([
                    Section::make()->schema(OrderResource::getDetailsFormSchema())->columns(),
                ]),

            Wizard\Step::make('Đơn Thuốc')
                ->schema([
                    Section::make()->schema([
                        OrderResource::getItemsRepeater(),
                    ]),
                ]),
        ];
    }

    protected function afterCreate(): void
    {
        $items = $this->record->items();
    }
}
