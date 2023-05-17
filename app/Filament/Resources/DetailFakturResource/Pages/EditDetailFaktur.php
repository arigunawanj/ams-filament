<?php

namespace App\Filament\Resources\DetailFakturResource\Pages;

use App\Filament\Resources\DetailFakturResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetailFaktur extends EditRecord
{
    protected static string $resource = DetailFakturResource::class;

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
        return 'Detail Faktur berhasil diedit';
    }
}
