<?php

namespace App\Filament\Resources\HargaResource\Pages;

use App\Filament\Resources\HargaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHarga extends CreateRecord
{
    protected static string $resource = HargaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Harga Barang berhasil ditentukan';
    }
}
