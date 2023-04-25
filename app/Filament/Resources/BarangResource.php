<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Barang;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BarangResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BarangResource\RelationManagers;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-sun';
    protected static ?string $navigationLabel = 'Barang';
    protected static ?string $navigationGroup = 'Pendataan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Forms\Components\TextInput::make('kode_barang')
                        ->required()
                        ->maxLength(255),
                    Select::make('satuan_id')
                        ->relationship('satuan', 'nama_satuan'),
                    Forms\Components\TextInput::make('nama_barang')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('harga_jual')
                        ->required()
                        ->prefix('Rp')
                        ->numeric(),
                    Forms\Components\TextInput::make('qty_barang')
                        ->required()
                        ->label('QTY'),
                    Forms\Components\TextInput::make('stok')
                        ->required()
                        ->numeric(),
                    Forms\Components\TextInput::make('harga_netto')
                        ->required()
                        ->prefix('Rp')
                        ->numeric(),
                    Forms\Components\TextInput::make('ket_barang')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('tgl_kadaluarsa')
                        ->required(),
                ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        
            ->columns([
                Tables\Columns\TextColumn::make('kode_barang')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('nama_barang')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('satuan.nama_satuan')
                ->sortable(),
                Tables\Columns\TextColumn::make('harga_jual')
                ->sortable(),
                Tables\Columns\TextColumn::make('qty_barang')
                ->label('QTY')
                ->sortable(),
                Tables\Columns\TextColumn::make('stok')
                ->sortable(),
                Tables\Columns\TextColumn::make('harga_netto')
                ->sortable(),
                Tables\Columns\TextColumn::make('ket_barang'),
                Tables\Columns\TextColumn::make('tgl_kadaluarsa')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
}
