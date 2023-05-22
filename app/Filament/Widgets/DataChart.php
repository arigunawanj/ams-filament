<?php

namespace App\Filament\Widgets;

use App\Models\Barang;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\LineChartWidget;


class DataChart extends LineChartWidget
{
    protected static ?string $heading = 'Data Barang';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Trend::model(Barang::class)
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();
 
    return [
        'datasets' => [
            [
                'label' => 'Jumlah Barang',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),
    ];
    }
}
