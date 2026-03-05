<?php
namespace App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource;
use Filament\Resources\Pages\ListRecords; // ← tambah s

class ListBlog extends ListRecords {
    protected static string $resource = BlogResource::class;
    protected function getHeaderActions(): array {
        return [\Filament\Actions\CreateAction::make()];
    }
}