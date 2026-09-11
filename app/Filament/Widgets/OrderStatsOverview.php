<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::where('status', 'delivered')->sum('total_price');

        return [
            Stat::make('Total Orders', $totalOrders)
                ->description('All orders placed')
                ->color('primary'),

            Stat::make('Pending Orders', $pendingOrders)
                ->description('Awaiting processing')
                ->color($pendingOrders > 0 ? 'warning' : 'success'),

            Stat::make('Total Revenue', number_format($totalRevenue, 2) . ' EGP')
                ->description('From delivered orders only')
                ->color('success'),
        ];
    }
}