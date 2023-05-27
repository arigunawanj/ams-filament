<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Harga;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HargaImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function Collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $barang = Barang::where('nama_barang', $row['nama_barang'])->first();
            $harga = Harga::where('kode_harga', $row['kode_harga'])->exists();
            $cari = Harga::where('kode_harga', $row['kode_harga'])->first();

            if ($barang != null && $harga == null) {
                Harga::create([
                    'kode_harga' => $row['kode_harga'],
                    'harga' => $row['harga_jual'],
                    'harga_netto' => $row['harga_netto'],
                    'barang_id' => $barang['id'],
                ]);
            } elseif ($barang != null && $harga != null) {
                $cari->update([
                    'kode_harga' => $row['kode_harga'],
                    'harga' => $row['harga_jual'],
                    'harga_netto' => $row['harga_netto'],
                    'barang_id' => $barang['id'],
                ]);
            }
        }
    }
}
