<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemesananResource\Pages;
use App\Models\Pemesanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PemesananResource extends Resource
{
    protected static ?string $model = Pemesanan::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Pemesanan';
    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('kode_booking')->disabled(),
                Forms\Components\TextInput::make('nama_pemesan')->required(),
                Forms\Components\TextInput::make('email_pemesan')->email()->required(),
                Forms\Components\TextInput::make('no_hp')->required(),
                Forms\Components\Select::make('tipe')->options(['wisata' => 'Wisata', 'rental' => 'Rental'])->required(),
                Forms\Components\Select::make('status')->options([
                    'pending' => 'Pending', 'dikonfirmasi' => 'Dikonfirmasi',
                    'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'
                ])->required(),
                Forms\Components\DatePicker::make('tanggal_berangkat')->required(),
                Forms\Components\TextInput::make('jumlah_orang')->numeric()->required(),
                Forms\Components\Textarea::make('catatan'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('kode_booking')->searchable()->copyable(),
            Tables\Columns\TextColumn::make('nama_pemesan')->searchable(),
            Tables\Columns\TextColumn::make('no_hp'),
            Tables\Columns\BadgeColumn::make('tipe')->colors(['primary' => 'wisata', 'warning' => 'rental']),
            Tables\Columns\BadgeColumn::make('status')->colors([
                'warning' => 'pending', 'success' => 'dikonfirmasi',
                'primary' => 'selesai', 'danger' => 'dibatalkan'
            ]),
            Tables\Columns\TextColumn::make('tanggal_berangkat')->date('d M Y')->sortable(),
            Tables\Columns\TextColumn::make('jumlah_orang')->suffix(' orang'),
        ])
        ->defaultSort('created_at', 'desc')
        ->filters([
            Tables\Filters\SelectFilter::make('tipe')->options(['wisata' => 'Wisata', 'rental' => 'Rental']),
            Tables\Filters\SelectFilter::make('status')->options(['pending' => 'Pending', 'dikonfirmasi' => 'Dikonfirmasi', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan']),
        ])
        ->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPemesanans::route('/'),
            'edit' => Pages\EditPemesanan::route('/{record}/edit'),
        ];
    }
}
