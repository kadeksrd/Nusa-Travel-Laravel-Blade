<?php

namespace App\Filament\Widgets;

use App\Models\Pemesanan;
use Filament\Widgets\ChartWidget;


class ChartAdmins extends ChartWidget
{
    protected static ?string $heading = 'Tren Pesanan Tahun Ini';
    protected static ?int $sort = 2;

   protected function getData(): array
    {
        // Menghitung jumlah order per bulan (Jan - Des)
        $data = collect(range(1, 12))->map(function ($month) {
            return Pemesanan::whereYear('created_at', now()->year)
                ->whereMonth('created_at', $month)
                ->count();
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pesanan',
                    'data' => $data,
                    'borderColor' => '#3b82f6', // Warna biru rapi
                    'fill' => 'start',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
