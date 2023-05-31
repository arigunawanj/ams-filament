<?php

namespace App\Filament\Resources\SetoranResource\Pages;

use App\Filament\Resources\SetoranResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;

class ListSetorans extends ListRecords
{
    protected static string $resource = SetoranResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeader(): View
    {
        return view('filament.header.setoranheader');
    }
}
