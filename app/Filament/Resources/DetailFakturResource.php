<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\DetailFaktur;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DetailFakturResource\Pages;
use App\Filament\Resources\DetailFakturResource\RelationManagers;

class DetailFakturResource extends Resource
{
    protected static ?string $model = DetailFaktur::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Faktur';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Forms\Components\TextInput::make('kode_faktur')
                        ->required()
                        ->maxLength(255),
                    Repeater::make('Barang')
                        ->schema([
                            Select::make('barang_id')
                            ->relationship('barang', 'nama_barang'),
                            Forms\Components\TextInput::make('stok_keluar')
                                ->required(),
                            Forms\Components\TextInput::make('diskon')
                                ->required(),
                            Forms\Components\TextInput::make('subtotal')
                                ->required(),
                        ])
                        ->columns(1),
                    Select::make('customer_id')
                        ->relationship('customer', 'nama_customer'),
                    Forms\Components\DatePicker::make('tanggal_keluar')
                        ->required(),
                ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('barang_id'),
                Tables\Columns\TextColumn::make('customer_id'),
                Tables\Columns\TextColumn::make('kode_faktur'),
                Tables\Columns\TextColumn::make('tanggal_keluar')
                    ->date(),
                Tables\Columns\TextColumn::make('stok_keluar'),
                Tables\Columns\TextColumn::make('diskon'),
                Tables\Columns\TextColumn::make('subtotal'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListDetailFakturs::route('/'),
            'create' => Pages\CreateDetailFaktur::route('/create'),
            'edit' => Pages\EditDetailFaktur::route('/{record}/edit'),
        ];
    }    
}
