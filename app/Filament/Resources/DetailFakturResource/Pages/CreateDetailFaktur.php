<?php

namespace App\Filament\Resources\DetailFakturResource\Pages;

use App\Filament\Resources\DetailFakturResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDetailFaktur extends CreateRecord
{
    protected static string $resource = DetailFakturResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Detail Faktur berhasil ditambahkan';
    }
}
