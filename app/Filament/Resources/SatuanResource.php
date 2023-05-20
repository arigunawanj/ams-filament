<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Satuan;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SatuanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SatuanResource\RelationManagers;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;

class SatuanResource extends Resource
{
    protected static ?string $model = Satuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationLabel = 'Kelola Satuan';
    protected static ?string $navigationGroup = 'Kelola';
    public static ?string $label = 'Kelola Satuan';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Forms\Components\TextInput::make('nama_satuan')
                        ->required()
                        ->maxLength(255),
                ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->sortable()
                ->label('ID'),
                Tables\Columns\TextColumn::make('nama_satuan')
                ->searchable()
                ->label('Nama Satuan')
                ->sortable(),
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
            'index' => Pages\ListSatuans::route('/'),
            'create' => Pages\CreateSatuan::route('/create'),
            'edit' => Pages\EditSatuan::route('/{record}/edit'),
        ];
    }    
}
