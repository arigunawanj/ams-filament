<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Importdistributor extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.importdistributor';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Import Distributor';

    protected static ?string $slug = 'import-distributor';

    protected static ?string $navigationLabel = 'Import Distributor';
}
