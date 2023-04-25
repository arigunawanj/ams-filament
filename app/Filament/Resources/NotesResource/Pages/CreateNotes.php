<?php

namespace App\Filament\Resources\NotesResource\Pages;

use App\Filament\Resources\NotesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNotes extends CreateRecord
{
    protected static string $resource = NotesResource::class;
}
