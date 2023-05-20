<?php

namespace App\Filament\Resources\HargaResource\Pages;

use App\Filament\Resources\HargaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHarga extends EditRecord
{
    protected static string $resource = HargaResource::class;

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
        return 'Harga Barang berhasil diubah';
    }
}
