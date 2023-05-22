<?php

namespace App\Filament\Resources\StokResource\Pages;

use App\Filament\Resources\StokResource;
use App\Models\Barang;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStok extends CreateRecord
{
    protected static string $resource = StokResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Data Stok berhasil ditambahkan';
    }

    protected function afterCreate(): void
    {
        $barang = Barang::find($this->record->barang_id);

        $stok = $barang->stok + $this->record->stok_masuk;

        $barang->update([
            'stok' => $stok,
        ]);
    }
}
