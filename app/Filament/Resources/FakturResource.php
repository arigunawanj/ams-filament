<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FakturResource\Pages;
use App\Filament\Resources\FakturResource\RelationManagers;
use App\Models\Faktur;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FakturResource extends Resource
{
    protected static ?string $model = Faktur::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';
    protected static ?string $navigationLabel = 'Tambah Barang Faktur';
    protected static ?string $navigationGroup = 'Pendataan';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('customer_id')
                        ->relationship('customer', 'nama_customer'),
                Forms\Components\TextInput::make('kode_faktur')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_faktur')
                    ->required(),
                Forms\Components\TextInput::make('ket_faktur')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_harga')
                    ->required(),
                Forms\Components\TextInput::make('ppn')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pph')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_pp')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_id'),
                Tables\Columns\TextColumn::make('kode_faktur'),
                Tables\Columns\TextColumn::make('tanggal_faktur')
                    ->date(),
                Tables\Columns\TextColumn::make('ket_faktur'),
                Tables\Columns\TextColumn::make('total_harga'),
                Tables\Columns\TextColumn::make('ppn'),
                Tables\Columns\TextColumn::make('pph'),
                Tables\Columns\TextColumn::make('total_pp'),
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
            'index' => Pages\ListFakturs::route('/'),
            'create' => Pages\CreateFaktur::route('/create'),
            'edit' => Pages\EditFaktur::route('/{record}/edit'),
        ];
    }    
}
