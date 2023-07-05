<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class DashboardReview extends BaseWidget
{
    protected static string $view = 'filament.widgets.dashboard';

    protected static ?string $pollingInterval = '3s';
}
