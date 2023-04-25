<?php

namespace App\Filament\Resources\FakturResource\Pages;

use App\Filament\Resources\FakturResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFaktur extends EditRecord
{
    protected static string $resource = FakturResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
