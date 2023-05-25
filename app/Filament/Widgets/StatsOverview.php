<?php

namespace App\Filament\Widgets;

use App\Models\Barang;
use App\Models\Penjualan;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getCards(): array
    {
        return [
        Card::make('Penjualan Lunas', function (){ 
            if(Penjualan::latest()->first() != null){
                return Penjualan::where('status', 1)->count() . ' Lunas';
            } else {
                return '';
            }  
        }),
            
        Card::make('Jumlah Pemasukan', function (){ 
            if(Penjualan::latest()->first() != null){
                return 'Rp ' . number_format(Penjualan::where('tanggal_kirim', '<' ,Carbon::now()->toDateString())->sum('jumlah'), 0, '.');
            } else {
                return '';
            }
        }),
        Card::make('Penjualan Belum Lunas', function (){ 
            if(Penjualan::latest()->first() != null){
                return Penjualan::where('status', 0)->count() . ' Belum Lunas';
            } else {
                return '';
            }  
        }),
        ];
    }
}
