<?php

namespace App\Filament\Resources\MedicationResource\Pages;

use App\Filament\Resources\MedicationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMedication extends CreateRecord
{
    protected static string $resource = MedicationResource::class;
}
