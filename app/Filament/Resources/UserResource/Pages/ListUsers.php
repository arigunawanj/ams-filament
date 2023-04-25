<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Pages\Actions;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use Illuminate\Support\Facades\Hash;
use Konnco\FilamentImport\Actions\ImportField;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            
        ];
    }
}
