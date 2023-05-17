<?php

namespace App\Filament\Resources\PajakResource\Pages;

use App\Filament\Resources\PajakResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePajak extends CreateRecord
{
    protected static string $resource = PajakResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Data Pajak berhasil ditambahkan';
    }
}
