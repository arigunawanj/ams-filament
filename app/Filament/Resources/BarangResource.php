<?php

namespace App\Filament\Resources;

use Filament\Forms;
use TextInput\Mask;
use Filament\Tables;
use App\Models\Barang;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BarangResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Filament\Resources\BarangResource\Widgets\BarangOverview;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationLabel = 'Kelola Barang';
    protected static ?string $navigationGroup = 'Kelola';
    public static ?string $label = 'Kelola Barang';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Forms\Components\TextInput::make('nama_barang')
                        ->required()
                        ->label('Nama Barang')
                        ->placeholder('Masukkan Nama Barang...')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('kode_barang')
                        ->required()
                        ->label('Kode Barang')
                        ->placeholder('Masukkan Kode Barang...')
                        ->maxLength(255),
                    Select::make('satuan_id')
                        ->label('Satuan')
                        ->relationship('satuan', 'nama_satuan'),
                    Forms\Components\DatePicker::make('tgl_kadaluarsa')
                        ->label('Tanggal Kadaluarsa')
                        ->placeholder('Masukkan Tanggal Kadaluarsa...')
                        ->required(),
                    Forms\Components\TextInput::make('qty_barang')
                        ->required()
                        ->placeholder('Masukkan Jumlah Barang...')
                        ->label('QTY'),
                    Forms\Components\TextInput::make('stok')
                        ->required()
                        ->label('Stok')
                        ->placeholder('Masukkan Stok Barang...')
                        ->numeric(),
                    TextArea::make('ket_barang')
                        ->required()
                        ->maxLength(255)
                        ->label('Keterangan'),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                Tables\Columns\TextColumn::make('kode_barang')
                    ->searchable()
                    ->label('Kode Barang')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_barang')
                    ->searchable()
                    ->label('Nama Barang')
                    ->sortable(),
                Tables\Columns\TextColumn::make('satuan.nama_satuan')
                    ->label('Satuan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('qty_barang')
                    ->label('QTY')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stok')
                    ->label('Stok')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_kadaluarsa')
                    ->date()
                    ->label('Tanggal Kadaluarsa')
                    ->sortable(),
                Tables\Columns\TextColumn::make('ket_barang')
                    ->label('Keterangan'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            BarangOverview::class,
        ];
    }
}
