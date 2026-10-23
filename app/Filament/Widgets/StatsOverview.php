<?php

namespace App\Filament\Widgets;

use App\Models\Campaign;
use App\Models\Question;
use App\Models\Response;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::query()->count()),
            Stat::make('Campaigns', Campaign::query()->count()),
            Stat::make('Questions', Question::query()->count()),
            Stat::make('Responses', Response::query()->count()),
        ];
    }
}
