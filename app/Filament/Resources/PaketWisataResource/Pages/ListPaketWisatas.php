<?php
namespace App\Filament\Resources\PaketWisataResource\Pages;
use App\Filament\Resources\PaketWisataResource;
use Filament\Resources\Pages\ListRecords;
class ListPaketWisatas extends ListRecords {
    protected static string $resource = PaketWisataResource::class;
    protected function getHeaderActions(): array { return [\Filament\Actions\CreateAction::make()]; }
}
