<?php
namespace App\Filament\Resources\RentalMobilResource\Pages;
use App\Filament\Resources\RentalMobilResource;
use Filament\Resources\Pages\EditRecord;
class EditRentalMobil extends EditRecord {
    protected static string $resource = RentalMobilResource::class;
    protected function getHeaderActions(): array { return [\Filament\Actions\DeleteAction::make()]; }
    protected function getRedirectUrl(): string
    // mengatur web ke halaman utama 
    {
        return $this->getResource()::getUrl('index');
    }
}
