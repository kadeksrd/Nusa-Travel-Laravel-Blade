<?php
namespace App\Filament\Resources\RentalMobilResource\Pages;
use App\Filament\Resources\RentalMobilResource;
use Filament\Resources\Pages\ListRecords; // ← tambah s

class ListRentalMobils extends ListRecords {
    protected static string $resource = RentalMobilResource::class;
    protected function getHeaderActions(): array {
        return [\Filament\Actions\CreateAction::make()];
    }
}