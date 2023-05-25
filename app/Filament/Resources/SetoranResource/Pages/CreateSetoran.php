<?php

namespace App\Filament\Resources\SetoranResource\Pages;

use App\Filament\Resources\SetoranResource;
use App\Models\Penjualan;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSetoran extends CreateRecord
{
    protected static string $resource = SetoranResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Data Setoran berhasil ditambahkan';
    }

    protected function afterCreate(): void
    {
        Penjualan::create([
            'customer_id' => $this->record->customer_id,
            'tanggal_kirim' => $this->record->tanggal_dep,
            'kode' => $this->record->kode_dep,
            'jumlah' => $this->record->jumlah_masuk,
            'keterangan' => $this->record->ket_dep,
            'status' => 0
        ]);
    }
}
