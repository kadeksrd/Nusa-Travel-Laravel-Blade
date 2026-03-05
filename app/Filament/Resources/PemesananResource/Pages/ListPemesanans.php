<?php
namespace App\Filament\Resources\PemesananResource\Pages;
use App\Filament\Resources\PemesananResource;
use Filament\Resources\Pages\ListRecords; // ← tambah s

class ListPemesanans extends ListRecords {
    protected static string $resource = PemesananResource::class;
}