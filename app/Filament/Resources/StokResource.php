<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StokResource\Pages;
use App\Filament\Resources\StokResource\RelationManagers;
use App\Models\Stok;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StokResource extends Resource
{
    protected static ?string $model = Stok::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Stok Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('barang_id')
                ->relationship('barang', 'nama_barang'),
                Select::make('distributor_id')
                ->relationship('distributor', 'nama_distributor'),
                Forms\Components\TextInput::make('stok_masuk')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_masuk')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('barang_id'),
                Tables\Columns\TextColumn::make('distributor_id'),
                Tables\Columns\TextColumn::make('stok_masuk'),
                Tables\Columns\TextColumn::make('tanggal_masuk')
                    ->date(),
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
            'index' => Pages\ListStoks::route('/'),
            'create' => Pages\CreateStok::route('/create'),
            'edit' => Pages\EditStok::route('/{record}/edit'),
        ];
    }    
}
