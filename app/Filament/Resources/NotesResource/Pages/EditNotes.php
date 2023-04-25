<?php

namespace App\Filament\Resources\NotesResource\Pages;

use App\Filament\Resources\NotesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNotes extends EditRecord
{
    protected static string $resource = NotesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
