<?php

namespace App\Filament\Pages;

use App\Models\Pengaturan;
use App\Models\PaketWisata;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;

class PengaturanWebsite extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan Website';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static string $view = 'filament.pages.pengaturan-website';

    public string $whatsapp_number = '';
    public ?string $paket_populer_1 = null;
    public ?string $paket_populer_2 = null;
    public ?string $paket_populer_3 = null;
    public string $admin_email = '';

    public function mount(): void
    {
        $this->whatsapp_number = Pengaturan::get('whatsapp_number', '');
        $this->admin_email = Pengaturan::get('admin_email', '');
        $this->paket_populer_1 = Pengaturan::get('paket_populer_1');
        $this->paket_populer_2 = Pengaturan::get('paket_populer_2');
        $this->paket_populer_3 = Pengaturan::get('paket_populer_3');
    }

    protected function getFormSchema(): array
    {
        $paketOptions = PaketWisata::aktif()->pluck('nama_paket', 'id')->toArray();

        return [
            Forms\Components\Section::make('Kontak')->schema([
                Forms\Components\TextInput::make('whatsapp_number')->label('Nomor WhatsApp (format: 628xxx)')->required(),
                Forms\Components\TextInput::make('admin_email')->email()->label('Email Admin'),
            ])->columns(2),

            Forms\Components\Section::make('Paket Populer di Homepage')->schema([
                Forms\Components\Select::make('paket_populer_1')->options($paketOptions)->label('Slot Populer 1'),
                Forms\Components\Select::make('paket_populer_2')->options($paketOptions)->label('Slot Populer 2'),
                Forms\Components\Select::make('paket_populer_3')->options($paketOptions)->label('Slot Populer 3'),
            ])->columns(3),
        ];
    }

    public function save(): void
    {
        Pengaturan::set('whatsapp_number', $this->whatsapp_number);
        Pengaturan::set('admin_email', $this->admin_email);
        Pengaturan::set('paket_populer_1', $this->paket_populer_1);
        Pengaturan::set('paket_populer_2', $this->paket_populer_2);
        Pengaturan::set('paket_populer_3', $this->paket_populer_3);

        Notification::make()->title('Pengaturan disimpan')->success()->send();
    }
}
