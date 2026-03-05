<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Blog';
    protected static ?string $navigationGroup = 'Konten';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('judul')->required()->live(onBlur: true)
                    ->afterStateUpdated(fn($state, $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                Forms\Components\FileUpload::make('gambar')->image()->required()->directory('blog'),
                Forms\Components\Textarea::make('ringkasan')->rows(2),
                Forms\Components\RichEditor::make('konten')->required()->columnSpanFull(),
                Forms\Components\Toggle::make('is_published')->label('Published')->reactive(),
                Forms\Components\DateTimePicker::make('published_at')->visible(fn ($get) => $get('is_published')),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('gambar'),
            Tables\Columns\TextColumn::make('judul')->searchable()->limit(40),
            Tables\Columns\IconColumn::make('is_published')->boolean()->label('Published'),
            Tables\Columns\TextColumn::make('published_at')->dateTime('d M Y')->sortable(),
        ])
        ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()]);
    }

    public static function getPages(): array
{
    return [
        'index' => Pages\ListBlog::route('/'),      // ← hapus s
        'create' => Pages\CreateBlog::route('/create'),
        'edit' => Pages\EditBlog::route('/{record}/edit'),
    ];
}
}
