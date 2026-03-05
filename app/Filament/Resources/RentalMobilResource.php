<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RentalMobilResource\Pages;
use App\Models\RentalMobil;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RentalMobilResource extends Resource
{
    protected static ?string $model = RentalMobil::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Rental Mobil';
    protected static ?string $navigationGroup = 'Paket';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Mobil')->schema([
                Forms\Components\TextInput::make('nama_mobil')->required()->live(onBlur: true)
                    ->afterStateUpdated(fn($state, $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                Forms\Components\Select::make('jenis')->options(['terfavorit' => 'Terfavorit', 'besar' => 'Besar', 'sendiri' => 'Sendiri'])->required(),
                Forms\Components\Select::make('transmisi')->options(['manual' => 'Manual', 'automatic' => 'Automatic', 'both' => 'Keduanya'])->required(),
                Forms\Components\TextInput::make('kapasitas_penumpang')->numeric()->required()->suffix('Orang'),
                Forms\Components\TextInput::make('cc_mesin')->placeholder('1500cc'),
                Forms\Components\TextInput::make('harga_per_hari')->numeric()->required()->prefix('Rp'),
            ])->columns(2),

            Forms\Components\Section::make('Gambar')->schema([
                Forms\Components\FileUpload::make('gambar_utama')->image()->required()->directory('rental-mobil'),
                Forms\Components\FileUpload::make('gambar_detail')->image()->multiple()->maxFiles(4)->directory('rental-mobil/detail'),
            ])->columns(2),

            Forms\Components\Section::make('Fasilitas & Detail')->schema([
                Forms\Components\Repeater::make('fasilitas')->schema([
                    Forms\Components\TextInput::make('icon')->required(),
                    Forms\Components\TextInput::make('label')->required(),
                ])->columns(2)->collapsible(),
                Forms\Components\RichEditor::make('detail_rental')->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Pengaturan')->schema([
                Forms\Components\TextInput::make('rating')->numeric()->default(5.0)->step(0.1),
                Forms\Components\Toggle::make('is_populer')->default(false),
                Forms\Components\Toggle::make('is_aktif')->default(true),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('gambar_utama')->circular(),
            Tables\Columns\TextColumn::make('nama_mobil')->searchable()->sortable(),
            Tables\Columns\BadgeColumn::make('jenis'),
            Tables\Columns\BadgeColumn::make('transmisi'),
            Tables\Columns\TextColumn::make('kapasitas_penumpang')->suffix(' org'),
            Tables\Columns\TextColumn::make('harga_per_hari')->money('IDR'),
            Tables\Columns\IconColumn::make('is_aktif')->boolean()->label('Aktif'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('jenis')->options(['terfavorit' => 'Terfavorit', 'besar' => 'Besar', 'sendiri' => 'Sendiri']),
            Tables\Filters\SelectFilter::make('transmisi')->options(['manual' => 'Manual', 'automatic' => 'Automatic']),
        ])
        ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRentalMobils::route('/'),
            'create' => Pages\CreateRentalMobil::route('/create'),
            'edit' => Pages\EditRentalMobil::route('/{record}/edit'),
        ];
    }
}
