<?php

namespace App\Filament\Resources\FakturResource\Pages;

use App\Models\Harga;
use App\Models\Barang;
use Filament\Pages\Actions;
use App\Filament\Resources\FakturResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateFaktur extends CreateRecord
{
    protected static string $resource = FakturResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Data Faktur berhasil ditambahkan';
    }

    protected function afterCreate(): void
    {
        $faktur = DB::table('detail_fakturs')
                ->join('hargas', 'detail_fakturs.harga_id', 'hargas.id')
                ->where('faktur_id', $this->record->id)
                ->get();

        foreach ($faktur as $item) {
            $barang = Barang::find($item->barang_id);
            $stok = $barang->stok - $item->stok_keluar;
            $barang->update([
                'stok' => $stok,
            ]);
        }


    }
}
