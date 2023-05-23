<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PajakResource\Pages;
use App\Filament\Resources\PajakResource\RelationManagers;
use App\Models\Pajak;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PajakResource extends Resource
{
    protected static ?string $model = Pajak::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'Laporan Faktur Pajak';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?int $navigationSort = 15;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('customer_id')
                    ->required(),
                Forms\Components\TextInput::make('kode_laporan')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_rep')
                    ->required(),
                Forms\Components\TextInput::make('no_fakpajak')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_upload')
                    ->required(),
                Forms\Components\TextInput::make('ket_rep')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_id'),
                Tables\Columns\TextColumn::make('kode_laporan'),
                Tables\Columns\TextColumn::make('tanggal_rep')
                    ->date(),
                Tables\Columns\TextColumn::make('no_fakpajak'),
                Tables\Columns\TextColumn::make('tanggal_upload')
                    ->date(),
                Tables\Columns\TextColumn::make('ket_rep'),
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
            'index' => Pages\ListPajaks::route('/'),
            'create' => Pages\CreatePajak::route('/create'),
            'edit' => Pages\EditPajak::route('/{record}/edit'),
        ];
    }    
}
