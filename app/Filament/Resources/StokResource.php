<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StokResource\Pages;
use App\Filament\Resources\StokResource\RelationManagers;
use App\Models\Barang;
use App\Models\Stok;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StokResource extends Resource
{
    protected static ?string $model = Stok::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Stok Barang';
    protected static ?string $navigationGroup = 'Pendataan';
    public static ?string $label = 'Kelola Stok Masuk';
    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Select::make('barang_id')
                        ->label('Nama Barang')
                        ->relationship('barang', 'nama_barang'),
                    Select::make('distributor_id')
                        ->label('Nama Distributor')
                        ->relationship('distributor', 'nama_distributor'),
                    Forms\Components\TextInput::make('stok_masuk')
                        ->label('Jumlah Masuk')
                        ->required(),
                    Forms\Components\DatePicker::make('tanggal_masuk')
                        ->label('Tanggal Masuk')
                        ->required(),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('barang.nama_barang')
                    ->label('Nama Barang')
                    ->copyable()
                    ->copyMessage('Berhasil disalin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('distributor.nama_distributor')
                    ->label('Nama Distributor')
                    ->copyable()
                    ->copyMessage('Berhasil disalin')
                    ->searchable(),
                BadgeColumn::make('stok_masuk')
                    ->label('Jumlah Masuk')
                    ->copyable()
                    ->color('primary')
                    ->copyMessage('Berhasil disalin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_masuk')
                    ->date()
                    ->copyable()
                    ->copyMessage('Berhasil disalin')
                    ->label('Tanggal masuk')
                    ->searchable(),
            ])
            ->poll('3s')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->before(function ($record) {
                        $barang = Barang::find($record->barang_id);
                        $stok = Stok::find($record->id);

                        // Maka Table barang kolom stok barang dilakukan update dari (Table Barang kolom Stok) dikurangi dari (Table Stok kolom stok Masuk)
                        $barang->update([
                            'stok' => $barang->stok - $stok->stok_masuk,
                        ]);
                    })




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
            'index' => Pages\ListStoks::route('/'),
            'create' => Pages\CreateStok::route('/create'),
            'edit' => Pages\EditStok::route('/{record}/edit'),
        ];
    }
}
