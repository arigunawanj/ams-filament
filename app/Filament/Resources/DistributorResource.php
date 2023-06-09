<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use App\Models\Distributor;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DistributorResource\Pages;
use App\Filament\Resources\DistributorResource\RelationManagers;

class DistributorResource extends Resource
{
    protected static ?string $model = Distributor::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Kelola Distributor';
    protected static ?string $navigationGroup = 'Kelola';
    protected static ?string $recordTitleAttribute = 'nama_distributor';
    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Forms\Components\TextInput::make('kode_distributor')
                        ->required()
                        ->unique(ignoreRecord: true)
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
                TextColumn::make('No')->getStateUsing(
                    static function (stdClass $rowLoop, HasTable $livewire): string {
                        return (string) ($rowLoop->iteration +
                            ($livewire->tableRecordsPerPage * ($livewire->page - 1
                            ))
                        );
                    }
                ),
                BadgeColumn::make('kode_distributor')
                    ->label('Kode Distributor')
                    ->copyable()
                    ->color('warning')
                    ->copyMessage('Berhasil Disalin')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_distributor')
                    ->label('Nama Distributor')
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->sortable()
                    ->searchable(),
            ])
            ->poll('3s')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
