<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Distributor;
use App\Models\Stok;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StokImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $barang = Barang::where('nama_barang', $row['nama_barang'])->first();
            $distributor = Distributor::where('nama_distributor', $row['nama_distributor'])->first();
            $satuan = Stok::where('barang_id', $barang['id'])->exists();
            $cari = Stok::where('barang_id', $barang['id'])->first();

            if ($satuan == null) {
                Stok::create([
                    'nama_satuan' => $row['nama_satuan'],
                ]);
            } elseif ($satuan != null) {
                $cari->update([
                    'nama_satuan' => $row['nama_satuan'],
                ]);
            }
        }
    }
}
