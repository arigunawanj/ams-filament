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
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DistributorResource extends Resource
{
    protected static ?string $model = Distributor::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Kelola Distributor';
    protected static ?string $navigationGroup = 'Pendataan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Forms\Components\TextInput::make('kode_distributor')
                        ->required()
                        ->label('Kode Distributor')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('nama_distributor')
                        ->required()
                        ->label('Nama Distributor')
                        ->maxLength(255),
                        Forms\Components\TextInput::make('telepon_distributor')
                        ->tel()
                        ->label('Telepon')
                        ->required()
                        ->maxLength(255),
                        Forms\Components\Textarea::make('alamat_distributor')
                            ->required()
                            ->label('Alamat')
                            ->maxLength(65535),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_distributor')
                ->label('Kode Distributor')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('nama_distributor')
                ->label('Nama Distributor')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('alamat_distributor')
                ->label('Alamat')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('telepon_distributor')
                ->label('Telepon')
                ->sortable()
                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
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
