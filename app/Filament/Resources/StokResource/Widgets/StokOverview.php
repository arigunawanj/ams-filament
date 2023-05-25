<?php

namespace App\Filament\Resources\StokResource\Widgets;

use App\Models\Barang;
use App\Models\Stok;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StokOverview extends BaseWidget
{

    protected function getCards(): array
    {
        return [
            Card::make('Terakhir Barang Masuk', function (){ 
                if(Stok::latest()->first() != null){
                    return Stok::latest()->first()->barang->nama_barang;
                } else {
                    return '';
                }  
            }),
            Card::make('Jumlah Masuk', Stok::latest()->pluck('stok_masuk')->first()),
            Card::make('Tanggal Masuk', Stok::latest()->pluck('tanggal_masuk')->first()),
        ];
    }
}

