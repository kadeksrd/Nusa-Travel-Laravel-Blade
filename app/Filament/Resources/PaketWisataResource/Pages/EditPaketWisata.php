<?php
namespace App\Filament\Resources\PaketWisataResource\Pages;
use App\Filament\Resources\PaketWisataResource;
use Filament\Resources\Pages\EditRecord;
class EditPaketWisata extends EditRecord {
    protected static string $resource = PaketWisataResource::class;
    protected function getHeaderActions(): array { return [\Filament\Actions\DeleteAction::make()]; }
}
