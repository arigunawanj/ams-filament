<?php

namespace App\Filament\Resources\StokResource\Pages;

use App\Filament\Resources\StokResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;

class ListStoks extends ListRecords
{
    protected static string $resource = StokResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StokResource\Widgets\StokOverview::class,
        ];
    }
    protected function getHeader(): View
    {
        return view('filament.header.stokheader');
    }

    
}
