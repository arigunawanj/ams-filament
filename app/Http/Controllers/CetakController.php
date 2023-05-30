<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Stok;
use App\Models\Pajak;
use App\Models\Barang;
use App\Models\Setoran;
use App\Models\Customer;
use App\Models\Penjualan;
use App\Models\Distributor;
use App\Models\DetailProfil;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CetakController extends Controller
{
    public function printBarang()
    {
        // Menampilkan seluruh data dalam tabel barang
        $barang = Barang::all()->sortBy('nama_barang');

        // Menjumlahkan tabel barang pada kolom harga stok
        $jumlahstok = DB::table('barangs')->select('stok')->sum('stok');

        // Halaman PDF akan di load dengan membawa data yang sudah di deklarasikan
        $pdf = Pdf::loadView('print.barangprint', ['barang' => $barang, 'jumlahstok' => $jumlahstok]);
        
        // PDF akan ditampilkan secara stream dengan ukuran A4-Landscape dan bisa didownload dengan nama yang sudah dideklarasikan
        return $pdf->setPaper('a4', 'landscape')->stream('Data Barang - '. Carbon::now(). '.pdf');
    }

    public function printDist()
    {

        // Mengambil seluruh data yang ada dalam tabel distributor 
        $distributor = Distributor::all()->sortBy('nama_distributor');

        // Halaman PDF akan di load dengan membawa data yang sudah di deklarasikan
        $pdf = Pdf::loadView('print.distprint', ['distributor' => $distributor]);
        
        // PDF akan ditampilkan secara stream dengan ukuran A4-Potrait dan bisa didownload dengan nama yang sudah dideklarasikan
        return $pdf->setPaper('a4', 'landscape')->stream('Data Distributor - '. Carbon::now(). '.pdf');
    }

    public function printCust()
    {
        // Mengambil seluruh data pada tabel Customer
        $customer = Customer::all()->sortBy('nama_customer');

        // PDF akan diload dengan membawa data yang sudah dideklarasikan
        $pdf = Pdf::loadView('print.custprint', ['customer' => $customer]);
        
        // PDF akan ditampilkan secara stream dengan ukuran A4-Landscape dan bisa didownload dengan nama yang sudah dideklarasikan
        return $pdf->setPaper('a4', 'landscape')->stream('Data Customer - '. Carbon::now(). '.pdf');
    }

    public function printSetoran()
    {
        // Mengambil seluruh data yang ada dalam tabel Setoran
        $setoran = Setoran::all();

        // Halaman PDF akan di load dengan membawa data yang sudah di deklarasikan
        $pdf = Pdf::loadView('print.setoranprint', ['setoran' => $setoran]);

        // PDF akan ditampilkan secara stream dengan ukuran A4-Potrait dan bisa didownload dengan nama yang sudah dideklarasikan
        return $pdf->setPaper('a4', 'landscape')->stream('Data Setoran - '. Carbon::now(). '.pdf');
    }

    public function printStok()
    {
        // Mengambil seluruh data yang ada dalam tabel Stok
        $stok = Stok::all()->sortBy('tanggal_masuk');

        // Halaman PDF akan di load dengan membawa data yang sudah di deklarasikan
        $pdf = Pdf::loadView('print.stokprint', ['stok' => $stok]);

        // PDF akan ditampilkan secara stream dengan ukuran A4-potrait dan bisa didownload dengan nama yang sudah dideklarasikan
        return $pdf->setPaper('a4', 'potrait')->stream('Data Stok - '. Carbon::now(). '.pdf');
    }

    public function printPenjualan($id)
    {
        // Parameter $id adalah Tahun yang di cari

        // Jika Tahun bernilai 0
        if ($id == 0) {
            // Menampilkan seluruh penjualan yang disortir sesuai kolom tanggal_kirim
            $penjualan = Penjualan::all()->sortBy('tanggal_kirim');

            // Menghitung jumlah status Lunas
            $lunas = DB::table('penjualans')->select('status')->where('status', 1)->count();

             // Menghitung jumlah status Belum Lunas
            $belum = DB::table('penjualans')->select('status')->where('status', 0)->count();
            
            // Menjumlahkan tabel penjualan pada kolom harga jumlah
            $pertahun = DB::table('penjualans')->select('jumlah')->sum('jumlah');

            // Mengambil seluruh data penjualan
            $year = DB::table('penjualans')->get();
        } 
        // Selain itu jika Tahun ada
        else {
            // Mengambil seluruh data yang ada dalam tabel Penjualan
            $penjualan = Penjualan::where(DB::raw('YEAR(tanggal_kirim)'), $id)->get()->sortBy('tanggal_kirim');
    
            // Mengambil Data berdasarkan tahun yang dicocokkan didatabase dan parameter tahun
            $year = DB::table('penjualans')->where(DB::raw('YEAR(tanggal_kirim)'), $id)->get();
    
            // Menghitung jumlah Status Lunas
            $lunas = DB::table('penjualans')->select('status')->where('status', 1)->where(DB::raw('YEAR(tanggal_kirim)'), $id)->count();
    
            // Menghitung jumlah Status Belum Lunas
            $belum = DB::table('penjualans')->select('status')->where('status', 0)->where(DB::raw('YEAR(tanggal_kirim)'), $id)->count();
    
            // Menjumlahkan tabel penjualan pada kolom harga jumlah
            $pertahun = DB::table('penjualans')->where(DB::raw('YEAR(tanggal_kirim)'), $id)->sum('jumlah');
        }

        // Pengulangan sebagai penampung nilai jumlah dengan variabel $year
        foreach($year as $item){
            for ($i=1; $i <= 12 ; $i++) { 
                $result[$i] = 0;
            }
        }

        // Menjumlahkan perbulan dengan pengulangan dengan variabel $year
        foreach($year as $dt){
            $bulan = date('n', strtotime($dt->tanggal_kirim));
            $result[$bulan] += $dt->jumlah;
        }

        // Pengulangan sebagai penampung nilai jumlah dengan variabel $penjualan
        foreach($penjualan as $item){
            for ($i=1; $i <= 12 ; $i++) { 
                $hasil[$i] = 0;
            }
        }

         // Menjumlahkan perbulan dengan pengulangan dengan variabel $penjualan
        foreach($penjualan as $dt){
            $bulan = date('n', strtotime($dt->tanggal_kirim));
            $hasil[$bulan] += $dt->jumlah;
        }


        // Jika Tahun didatabase dan parameternya cocok dan ada ATAU tahunnya bernilai 0
        if (DB::table('penjualans')->where(DB::raw('YEAR(tanggal_kirim)'), $id)->exists() || $id == 0) {
            // Halaman PDF akan di load dengan membawa data yang sudah di deklarasikan
                $pdf = Pdf::loadView('print.penjualanprint', [
                'penjualan' => $penjualan, 
                'lunas' => $lunas, 
                'belum' => $belum, 
                'pertahun' => $pertahun,
                'id' => $id,
                'result' => $result,
                'hasil' => $hasil,
            ]);
        } 
        // Sebaliknya jika tidak terdaftar
        else {
            $pdf = Pdf::loadView('print.penjualanprint', [
                'penjualan' => $penjualan, 
                'lunas' => $lunas, 
                'belum' => $belum, 
                'pertahun' => $pertahun,
                'id' => $id,
            ]);
        }
        
        // PDF akan ditampilkan secara stream dengan ukuran A4-Landscape dan bisa didownload dengan nama yang sudah dideklarasikan
        return $pdf->setPaper('a4', 'landscape')->stream('Data Penjualan - '. Carbon::now(). '.pdf');
    }

    public function printPajak()
    {
        // Mengambil seluruh data yang ada dalam tabel Pajak
        $pajak = Pajak::all();

        // Halaman PDF akan di load dengan membawa data yang sudah di deklarasikan
        $pdf = Pdf::loadView('print.pajakprint', ['pajak' => $pajak]);
        
        // PDF akan ditampilkan secara stream dengan ukuran A4-Landscape dan bisa didownload dengan nama yang sudah dideklarasikan
        return $pdf->setPaper('a4', 'landscape')->stream('Data Laporan Faktur Pajak - '. Carbon::now(). '.pdf');
    }

    public function printFaktur($id)
    {
        $faktur = DB::table('detail_fakturs')
                  ->join('hargas', 'detail_fakturs.harga_id', 'hargas.id')
                  ->join('barangs', 'hargas.barang_id', 'barangs.id')
                  ->join('satuans', 'barangs.satuan_id', 'satuans.id')
                  ->join('fakturs', 'detail_fakturs.faktur_id', 'fakturs.id')
                  ->join('customers', 'fakturs.customer_id', 'customers.id')
                  ->where('fakturs.kode_faktur', $id)
                  ->get();

        $kodenama = DB::table('detail_fakturs')
                    ->join('hargas', 'detail_fakturs.harga_id', 'hargas.id')
                    ->join('barangs', 'hargas.barang_id', 'barangs.id')
                    ->join('satuans', 'barangs.satuan_id', 'satuans.id')
                    ->join('fakturs', 'detail_fakturs.faktur_id', 'fakturs.id')
                    ->join('customers', 'fakturs.customer_id', 'customers.id')
                    ->where('fakturs.kode_faktur', $id)
                    ->get()
                    ->unique('kode_faktur');


        // Menampilkan data pada tabel faktur dengan kondisi kode faktur harus sama dengan kode faktur yang diambil
        $ppn = DB::table('fakturs')->where('kode_faktur', $id)->get();

        // Mengambil detail profil dengan user_id dengan ID yang sudah login
        $profil = User::where('id', Auth::user()->id)->get();
        
        // PDF akan ditampilkan dengan membawa data yang sudah dideklarasikan
        $pdf = Pdf::loadView('print.fakturprint', ['faktur' => $faktur, 'kodenama' => $kodenama, 'profil' => $profil]);
        
        // PDF akan ditampilkan secara stream dengan ukuran A4-Landscape dan bisa didownload dengan nama yang sudah dideklarasikan
        return $pdf->setPaper('a4', 'landscape')->stream('Data Faktur - '. Carbon::now(). '.pdf');
    }
}
