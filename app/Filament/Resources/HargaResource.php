<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Harga;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\HargaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\HargaResource\RelationManagers;
use Filament\Tables\Actions\DeleteAction;

class HargaResource extends Resource
{
    protected static ?string $model = Harga::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Kelola Harga';
    protected static ?string $navigationGroup = 'Kelola';
    public static ?string $label = 'Kelola Harga';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Forms\Components\TextInput::make('kode_harga')
                        ->required()
                        ->label('Kode Harga')
                        ->unique()
                        ->maxLength(255),
                    Select::make('barang_id')
                        ->label('Barang')
                        ->relationship('barang', 'nama_barang'),
                    TextInput::make('harga')
                        ->required()
                        ->label('Harga Jual')
                        ->prefix('Rp')
                        ->mask(
                            fn (TextInput\Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(2)
                                ->decimalSeparator(',')
                                ->thousandsSeparator('.')
                        )
                        ->numeric(),
                    TextInput::make('harga_netto')
                        ->required()
                        ->label('Harga Netto')
                        ->prefix('Rp')
                        ->mask(
                            fn (TextInput\Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(2)
                                ->decimalSeparator(',')
                                ->thousandsSeparator('.')
                        )
                        ->numeric(),
                ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_harga')
                    ->label('Kode Harga'),
                Tables\Columns\TextColumn::make('barang.nama_barang')
                    ->label('Nama Barang'),
                Tables\Columns\TextColumn::make('harga')
                    ->money('IDR')
                    ->label('Harga Jual'),
                Tables\Columns\TextColumn::make('harga_netto')
                    ->money('IDR')
                    ->label('Harga Netto'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make()
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
            'index' => Pages\ListHargas::route('/'),
            'create' => Pages\CreateHarga::route('/create'),
            'edit' => Pages\EditHarga::route('/{record}/edit'),
        ];
    }
}
