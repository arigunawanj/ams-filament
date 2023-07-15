<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Importbarang extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.importbarang';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Import Barang';

    protected static ?string $slug = 'import-barang';

    protected static ?string $navigationLabel = 'Import Barang';
}
