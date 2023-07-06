<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CustomerResource\RelationManagers;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Kelola Customer';
    protected static ?string $navigationGroup = 'Kelola';
    protected static ?string $recordTitleAttribute = 'nama_customer';
    public static ?string $label = 'Kelola Customer';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Forms\Components\TextInput::make('kode_customer')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->label('Kode Customer')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('nama_customer')
                        ->required()
                        ->label('Nama Customer')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('telepon_customer')
                        ->tel()
                        ->label('Telepon')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Textarea::make('alamat_customer')
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
                BadgeColumn::make('kode_customer')
                    ->searchable()
                    ->color('warning')
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->sortable()
                    ->label('Kode Customer'),
                Tables\Columns\TextColumn::make('nama_customer')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Berhasil Disalin')
                    ->sortable()
                    ->label('Nama Customer'),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
