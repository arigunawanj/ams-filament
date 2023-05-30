<?php

namespace App\Filament\Widgets;

use App\Models\Notes;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class TableDashboard extends BaseWidget
{
    protected static ?string $heading = 'Catatan';
    protected static ?int $sort = 3;
    protected function getTableQuery(): Builder
    {
        return Notes::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('judul'),
            TextColumn::make('tanggal')
            ->date(),
            TextColumn::make('isi')
            ->html(),
           
        ];
    }
}
