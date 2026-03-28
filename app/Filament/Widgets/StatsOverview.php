<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use App\Models\Project;
use App\Models\Finance;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalIncome = Finance::where('type', 'income')->where('status', 'approved')->sum('amount');
        $totalExpense = Finance::where('type', 'expense')->where('status', 'approved')->sum('amount');

        return [
            Stat::make('Total Leads', Lead::count())
                ->description('Leads baru bulan ini: ' . Lead::whereMonth('created_at', now()->month)->count())
                ->color('info')
                ->icon('heroicon-o-user-plus'),

            Stat::make('Project Aktif', Project::whereIn('status', ['planning','development','revision'])->count())
                ->description('Total project: ' . Project::count())
                ->color('warning')
                ->icon('heroicon-o-briefcase'),

            Stat::make('Total Income', 'Rp ' . number_format($totalIncome, 0, ',', '.'))
                ->description('Expense: Rp ' . number_format($totalExpense, 0, ',', '.'))
                ->color('success')
                ->icon('heroicon-o-banknotes'),

            Stat::make('Leads Belum Di-follow Up', Lead::where('status', 'new')->count())
                ->color('danger')
                ->icon('heroicon-o-exclamation-circle'),
        ];
    }
}