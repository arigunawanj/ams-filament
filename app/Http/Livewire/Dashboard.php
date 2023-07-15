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
        /****** WIDGET ********/
        // Jumlah Seluruh Barang
        $jmlbarang = Barang::all()->count();

        // Jumlah Seluruh Customer
        $jmlcust = Customer::all()->count();

        // Jumlah Seluruh Distributor
        $jmldist = Distributor::all()->count();


        /****** UMUM ********/
        // Merubah Format Bahasa
        setlocale(LC_ALL, 'id-ID', 'id_ID');

        // Mengambil Bulan ini
        $bulanIni = Carbon::now()->month;

        // Mengambil Waktu Saat ini
        $carbon = Carbon::now();

        // $bulanCarbon = date_create(Carbon::now());
        $bulanEkstrak = Carbon::parse($carbon)->formatLocalized('%B');

        /****** BULANAN ********/

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

        $totBulan = Penjualan::where([
            [DB::raw('MONTH(tanggal_kirim)'), $bulanIni]
        ])->sum('jumlah');

        $jumOrBulan = Penjualan::where([
            [DB::raw('MONTH(tanggal_kirim)'), $bulanIni]
        ])->count();

        // Menghitung Jumlah Orderan Seluruhnya pada Bulan ini
        $orderBulan = Penjualan::where([
            [DB::raw('MONTH(tanggal_kirim)'), $bulanIni]
        ])->count();

        $bulanTerlaris = DB::table('penjualans')
                    ->join('fakturs', 'penjualans.kode', 'fakturs.kode_faktur')
                    ->join('detail_fakturs', 'fakturs.id', 'detail_fakturs.faktur_id')
                    ->join('barangs', 'detail_fakturs.barang_id', 'barangs.id')
                    ->where(DB::raw('MONTH(tanggal_kirim)'), $bulanIni)
                    ->groupBy('barangs.id', 'barangs.nama_barang')
                    ->select('barangs.nama_barang', DB::raw('count(*) as total_orders'))
                    ->orderBy('total_orders', 'desc')
                    ->first();

        $bulanCustomer = DB::table('penjualans')
                            ->join('customers', 'penjualans.customer_id', 'customers.id')
                            ->where(DB::raw('MONTH(tanggal_kirim)'), $bulanIni)
                            ->groupBy('customers.id', 'customers.nama_customer')
                            ->select('customers.nama_customer', DB::raw('count(*) as total_orders'))
                            ->orderBy('total_orders', 'desc')
                            ->first();

        /****** KESELURUHAN ********/
        
        // Jumlah orderan seluruhnya
        $jmlOrder = Penjualan::all()->count();

        // Jumlah Semua Penjualan Belum Lunas 
        $semuaBelum = Penjualan::where('status', 0)->sum('jumlah');

        $jumlahBelum = Penjualan::where('status', 0)->count();
        $jumlahLunas = Penjualan::where('status', 1)->count();
        
        // Jumlah Semua Penjualan yang Sudah Lunas 
        $semuaLunas = Penjualan::where('status', 1)->sum('jumlah');

        // Jumlah Seluruh Orderan baik Lunas dan Belum
        $jumlahSemua = Penjualan::all()->sum('jumlah');

        $barangTerlaris = DB::table('penjualans')
                    ->join('fakturs', 'penjualans.kode', 'fakturs.kode_faktur')
                    ->join('detail_fakturs', 'fakturs.id', 'detail_fakturs.faktur_id')
                    ->join('barangs', 'detail_fakturs.barang_id', 'barangs.id')
                    ->groupBy('barangs.id', 'barangs.nama_barang')
                    ->select('barangs.nama_barang', DB::raw('count(*) as total_orders'))
                    ->orderBy('total_orders', 'desc')
                    ->first();

        $customerLangganan = DB::table('penjualans')
                            ->join('customers', 'penjualans.customer_id', 'customers.id')
                            ->groupBy('customers.id', 'customers.nama_customer')
                            ->select('customers.nama_customer', DB::raw('count(*) as total_orders'))
                            ->orderBy('total_orders', 'desc')
                            ->first();







        return view('livewire.dashboard', compact(
            'carbon',
            'bulanEkstrak',
            'jmlbarang',
            'totBulan',
            'jumOrBulan',
            'jmlcust',
            'jmldist',
            'penjualanBulanan',
            'lunasBulan',
            'belumBulan',
            'jmlBelum',
            'jmlLunas',
            'orderBulan',
            'jmlOrder',
            'semuaLunas',
            'semuaBelum',
            'jumlahSemua',
            'jumlahBelum',
            'jumlahLunas',
            'barangTerlaris',
            'customerLangganan',
            'bulanTerlaris',
            'bulanCustomer',
        ));
    }
}
