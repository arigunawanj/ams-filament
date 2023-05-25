<?php

namespace App\Filament\Resources\BarangResource\Pages;

use App\Filament\Resources\BarangResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;

class ListBarangs extends ListRecords
{
    protected static string $resource = BarangResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),

        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BarangResource\Widgets\BarangOverview::class,
        ];
    }

    protected function getHeader(): View
    {
        return view('filament.header.barangheader');
    }
}
