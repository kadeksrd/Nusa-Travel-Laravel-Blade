<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdmin extends BaseWidget
{
    protected function getStats(): array
{
    return [
    Stat::make('Total Paket', \App\Models\PaketWisata::count())
        ->description('Paket aktif di website')
        ->descriptionIcon('heroicon-m-map') // Tambah icon peta
        ->chart([7, 3, 4, 5, 6, 3, 5, 3]) // Garis hiasan kecil
        ->color('success'),

    Stat::make('Armada Mobil', \App\Models\RentalMobil::count())
        ->descriptionIcon('heroicon-m-truck') // Tambah icon mobil/truk
        ->color('info'),

    Stat::make('Pesanan Baru', \App\Models\Pemesanan::where('status', 'pending')->count())
        ->description('Segera konfirmasi admin')
        ->descriptionIcon('heroicon-m-bell') // Tambah icon lonceng
        ->color('danger'),
];
}
}
