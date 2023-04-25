<?php

namespace App\Filament\Resources\DistributorResource\Pages;

use App\Filament\Resources\DistributorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistributor extends EditRecord
{
    protected static string $resource = DistributorResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
