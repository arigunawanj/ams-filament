<?php

namespace App\Filament\Widgets;

use App\Models\Barang;
use App\Models\Penjualan;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\LineChartWidget;


class DataChart extends LineChartWidget
{
    protected static ?string $heading = 'Data Penjualan';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Trend::model(Penjualan::class)
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();
 
    return [
        'datasets' => [
            [
                'label' => 'Faktur Keluar',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),
    ];
    }
}
