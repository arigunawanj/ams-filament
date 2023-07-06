<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Barang;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Penjualan;
use App\Models\Distributor;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public function render()
    {
        // Jumlah Seluruh Barang
        $jmlbarang = Barang::all()->count();

        // Jumlah Seluruh Customer
        $jmlcust = Customer::all()->count();

        // Jumlah Seluruh Distributor
        $jmldist = Distributor::all()->count();

        // Merubah Format Bahasa
        setlocale(LC_ALL, 'id-ID', 'id_ID');

        // Mengambil Bulan ini
        $bulanIni = Carbon::now()->month;

        // Mengambil Waktu Saat ini
        $carbon = Carbon::now();

        // $bulanCarbon = date_create(Carbon::now());
        $bulanEkstrak = Carbon::parse($carbon)->formatLocalized('%B');

        // Menghitung Seluruh Penjualan Bulan ini
        $penjualanBulanan = Penjualan::where(DB::raw('MONTH(tanggal_kirim)'), $bulanIni)->sum('jumlah');

        // Menghitung Penjualan Bulan ini yang Lunas
        $lunasBulan = Penjualan::where([
            ['status', 1],
            [DB::raw('MONTH(tanggal_kirim)'), $bulanIni]
        ])->sum('jumlah');
        
        // Menghitung Penjualan Bulan ini yang Belum Lunas
        $belumBulan = Penjualan::where([
            ['status', 0],
            [DB::raw('MONTH(tanggal_kirim)'), $bulanIni]
        ])->sum('jumlah');

        // Menghitung Jumlah Orderan yang Lunas Bulan ini
        $jmlLunas = Penjualan::where([
            ['status', 1],
            [DB::raw('MONTH(tanggal_kirim)'), $bulanIni]
        ])->count();

        // Menghitung Jumlah Orderan yang Belum Lunas Bulan ini
        $jmlBelum = Penjualan::where([
            ['status', 0],
            [DB::raw('MONTH(tanggal_kirim)'), $bulanIni]
        ])->count();

        // Menghitung Jumlah Orderan Seluruhnya pada Bulan ini
        $orderBulan = Penjualan::where([
            [DB::raw('MONTH(tanggal_kirim)'), $bulanIni]
        ])->count();



        return view('livewire.dashboard', compact(
            'carbon',
            'bulanEkstrak',
            'jmlbarang',
            'jmlcust',
            'jmldist',
            'penjualanBulanan',
            'lunasBulan',
            'belumBulan',
            'jmlBelum',
            'jmlLunas',
            'orderBulan',
        ));
    }
}
