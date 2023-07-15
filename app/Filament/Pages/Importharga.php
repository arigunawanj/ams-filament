<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Importharga extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.importharga';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Import Harga';

    protected static ?string $slug = 'import-harga';

    protected static ?string $navigationLabel = 'Import Harga';
}
