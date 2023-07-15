<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Importcustomer extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.importcustomer';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Import Customer';

    protected static ?string $slug = 'import-customer';

    protected static ?string $navigationLabel = 'Import Customer';
}
