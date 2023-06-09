<?php

namespace App\Filament\Resources\BarangResource\Widgets;

use App\Models\Barang;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\DB;

class BarangOverview extends BaseWidget
{

    protected function getCards(): array
    {
        return [
            Card::make('Barang Kadaluarsa', function (){ 
                if(Barang::latest()->first() != null){
                    return Barang::where('tgl_kadaluarsa', '<', Carbon::now()->addDays(5)->toDateString())->count();
                } else {
                    return 0;
                }  
            }),
            
            Card::make('Stok Habis', Barang::where('stok', 0)->count()),
        ];
    }
}
