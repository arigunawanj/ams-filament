<?php

namespace App\Filament\Resources\NotesResource\Pages;

use App\Filament\Resources\NotesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNotes extends ListRecords
{
    protected static string $resource = NotesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
