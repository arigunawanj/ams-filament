<?php

namespace App\Filament\Resources\PajakResource\Pages;

use App\Filament\Resources\PajakResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPajak extends EditRecord
{
    protected static string $resource = PajakResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Data Pajak berhasil diubah';
    }
}
