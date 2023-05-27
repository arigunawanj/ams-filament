<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\BarangImport;
use App\Imports\CustomerImport;
use App\Imports\DistributorImport;
use App\Imports\HargaImport;
use App\Imports\SatuanImport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;

class ImportController extends Controller
{
    public function satuanImport(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new SatuanImport, $file);

        // Memberi Notifikasi jika Sukses
        Notification::make()
            ->title('Berhasil Import Data Satuan')
            ->success()
            ->seconds(3)
            ->body('Import Data Satuan **berhasil**.')
            ->send();

        return redirect('admin/satuans');
    }

    public function barangImport(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new BarangImport, $file);

        // Memberi Notifikasi jika Sukses
        Notification::make()
            ->title('Berhasil Import Data Barang')
            ->success()
            ->seconds(3)
            ->body('Import Data Barang **berhasil**.')
            ->send();

        return redirect('admin/barangs');
    }

    public function customerImport(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new CustomerImport, $file);

        // Memberi Notifikasi jika Sukses
        Notification::make()
            ->title('Berhasil Import Data Customer')
            ->success()
            ->seconds(3)
            ->body('Import Data Customer **berhasil**.')
            ->send();

        return redirect('admin/customers');
    }

    public function distributorImport(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new DistributorImport, $file);

        // Memberi Notifikasi jika Sukses
        Notification::make()
            ->title('Berhasil Import Data Distributor')
            ->success()
            ->seconds(3)
            ->body('Import Data Distributor **berhasil**.')
            ->send();

        return redirect('admin/distributors');
    }

    public function hargaImport(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new HargaImport, $file);

        // Memberi Notifikasi jika Sukses
        Notification::make()
            ->title('Berhasil Import Data Harga')
            ->success()
            ->seconds(3)
            ->body('Import Data Harga **berhasil**.')
            ->send();

        return redirect('admin/hargas');
    }
}
