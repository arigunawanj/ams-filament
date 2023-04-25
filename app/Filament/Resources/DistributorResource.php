<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistributorResource\Pages;
use App\Filament\Resources\DistributorResource\RelationManagers;
use App\Models\Distributor;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DistributorResource extends Resource
{
    protected static ?string $model = Distributor::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Distributor';
    protected static ?string $navigationGroup = 'Pendataan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Forms\Components\TextInput::make('kode_distributor')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('nama_distributor')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Textarea::make('alamat_distributor')
                        ->required()
                        ->maxLength(65535),
                    Forms\Components\TextInput::make('telepon_distributor')
                        ->tel()
                        ->required()
                        ->maxLength(255),
                ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_distributor'),
                Tables\Columns\TextColumn::make('nama_distributor'),
                Tables\Columns\TextColumn::make('alamat_distributor'),
                Tables\Columns\TextColumn::make('telepon_distributor'),
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
            'index' => Pages\ListDistributors::route('/'),
            'create' => Pages\CreateDistributor::route('/create'),
            'edit' => Pages\EditDistributor::route('/{record}/edit'),
        ];
    }    
}
