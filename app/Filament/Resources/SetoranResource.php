<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SetoranResource\Pages;
use App\Filament\Resources\SetoranResource\RelationManagers;
use App\Models\Setoran;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SetoranResource extends Resource
{
    protected static ?string $model = Setoran::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'Setoran';
    protected static ?string $navigationGroup = 'Pendataan';
    protected static ?int $navigationSort = 12;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('customer_id')
                    ->required(),
                Forms\Components\TextInput::make('kode_dep')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_dep')
                    ->required(),
                Forms\Components\TextInput::make('jumlah_masuk')
                    ->required(),
                Forms\Components\TextInput::make('jumlah_keluar')
                    ->required(),
                Forms\Components\TextInput::make('foto_dep')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ket_dep')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_id'),
                Tables\Columns\TextColumn::make('kode_dep'),
                Tables\Columns\TextColumn::make('tanggal_dep')
                    ->date(),
                Tables\Columns\TextColumn::make('jumlah_masuk'),
                Tables\Columns\TextColumn::make('jumlah_keluar'),
                Tables\Columns\TextColumn::make('foto_dep'),
                Tables\Columns\TextColumn::make('ket_dep'),
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
            'index' => Pages\ListSetorans::route('/'),
            'create' => Pages\CreateSetoran::route('/create'),
            'edit' => Pages\EditSetoran::route('/{record}/edit'),
        ];
    }    
}
