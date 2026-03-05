<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaketWisataResource\Pages;
use App\Models\PaketWisata;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PaketWisataResource extends Resource
{
    protected static ?string $model = PaketWisata::class;
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'Paket Wisata';
    protected static ?string $navigationGroup = 'Paket';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Paket')->schema([
                Forms\Components\TextInput::make('nama_paket')->required()->maxLength(255)->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                Forms\Components\TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('wilayah')->required(),
                Forms\Components\TextInput::make('durasi')->numeric()->required()->suffix('Hari'),
                Forms\Components\TextInput::make('harga')->numeric()->required()->prefix('Rp'),
                Forms\Components\Textarea::make('deskripsi')->rows(3),
            ])->columns(2),

            Forms\Components\Section::make('Gambar')->schema([
                Forms\Components\FileUpload::make('gambar_utama')->image()->required()->directory('paket-wisata')->label('Gambar Utama'),
                Forms\Components\FileUpload::make('gambar_detail')->image()->multiple()->maxFiles(4)->directory('paket-wisata/detail')->label('4 Gambar Detail'),
            ])->columns(2),

            Forms\Components\Section::make('Fasilitas & Perjalanan')->schema([
                Forms\Components\Repeater::make('fasilitas')->label('Fasilitas Paket')
                    ->schema([
                        Forms\Components\TextInput::make('icon')->placeholder('heroicon-o-home')->required(),
                        Forms\Components\TextInput::make('label')->required(),
                    ])->columns(2)->collapsible(),
                Forms\Components\RichEditor::make('rencana_perjalanan')->label('Rencana Perjalanan')->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Pengaturan')->schema([
                Forms\Components\TextInput::make('rating')->numeric()->default(5.0)->minValue(1)->maxValue(5)->step(0.1),
                Forms\Components\Toggle::make('is_populer')->label('Tampilkan sebagai Populer')->default(false),
                Forms\Components\Toggle::make('is_aktif')->label('Aktif')->default(true),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('gambar_utama')->label('Foto')->circular(),
            Tables\Columns\TextColumn::make('nama_paket')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('wilayah')->badge()->sortable(),
            Tables\Columns\TextColumn::make('durasi')->suffix(' Hari')->sortable(),
            Tables\Columns\TextColumn::make('harga')->money('IDR')->sortable(),
            Tables\Columns\IconColumn::make('is_populer')->boolean()->label('Populer'),
            Tables\Columns\IconColumn::make('is_aktif')->boolean()->label('Aktif'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('wilayah')->options(fn() => PaketWisata::distinct()->pluck('wilayah', 'wilayah')),
            Tables\Filters\TernaryFilter::make('is_populer')->label('Populer'),
            Tables\Filters\TernaryFilter::make('is_aktif')->label('Aktif'),
        ])
        ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaketWisatas::route('/'),
            'create' => Pages\CreatePaketWisata::route('/create'),
            'edit' => Pages\EditPaketWisata::route('/{record}/edit'),
        ];
    }
}
